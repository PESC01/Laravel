<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Persona;
use App\Models\Medicamento;
use Carbon\Carbon;
use PDF;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use App\Models\Dormitorio;

class PDFController extends Controller
{
    public function generateinfo($id)
    {
        config(['qrcode.driver' => 'gd']);

        ini_set('max_execution_time', 300);
        $startTime = microtime(true);

        $persona = DB::table('personas as p')
            ->join('generos as g', 'g.id', '=', 'p.genero')
            ->join('nacionalidades as n', 'n.id', '=', 'p.nacionalidad')
            ->select('p.id', 'p.nombres as nombrepersona', 'p.nacionalidad', 'p.apellidos', 'p.fech_nac', 'p.image', 'p.motivo_ingreso', 'p.ci', 'p.fech_registro', 'p.hora_registro', 'p.estado_civil', 'p.firma_consentimiento', 'n.nombre_nacionalidad', 'g.nombre_genero',)
            ->where('p.id', '=', $id)->first();

        $familiares = DB::table('contactos as c')
            ->join('personas as p', 'p.id', '=', 'c.persona')
            ->join('tipo_relaciones as tp', 'tp.id', '=', 'c.tipo_relacion')
            ->select('c.id', 'c.nombres AS cnombres', 'c.apellidos as capellidos', 'c.direccion_vivienda', 'c.celular', 'tp.nombre')
            ->where('c.persona', '=', $id)->get();

        $diarios = DB::table('registro_diario_atenciones as rd')
            ->join('personas as p', 'p.id', '=', 'rd.persona')
            ->select('rd.id', 'rd.actividades_paciente_descripcion', 'rd.fecha as rdfecha')
            ->where('rd.persona', '=', $id)
            ->orderBy('rd.fecha', 'DESC')->get();

        $medicamentos =  Medicamento::get();
        $preferencias = DB::table('preferencias as pr')
            ->join('personas as p', 'p.id', '=', 'pr.persona')
            ->select('pr.id', 'pr.preferencias_alimenticias as alimento', 'pr.preferencias_habitacion as habitacion', 'pr.necesidades_especiales as necesidades')
            ->where('pr.persona', '=', $id)->get();

        $seguimientos = DB::table('seguimientos as s')
            ->join('personas as p', 'p.id', '=', 's.persona')
            ->select('s.id', 's.presion_arterial as presion', 's.frecuencia_cardiaca as frecuencia', 's.temperatura', 's.fecha_seguimiento')
            ->where('s.persona', '=', $id)->get();

        $incidentes = DB::table('incidentes as i')
            ->join('personas as p', 'p.id', '=', 'i.persona')
            ->select('i.id', 'i.incidente_fecha', 'i.incidente_descripcion')
            ->where('i.persona', '=', $id)->get();

        $pruebas =  DB::table('resultados_pruebas_medicas as r')
            ->join('personas as p', 'p.id', '=', 'r.persona')
            ->select('r.descripcion_prueba_medica', 'r.fecha_prueba_medica', 'r.id')
            ->where('r.persona', '=', $id)->get();

        $antecedentes = DB::table('antecedentes_medicos as am')
            ->join('personas as p', 'p.id', '=', 'am.persona')
            ->select('am.id', 'am.enfermedades_cronicas', 'am.alergias_medicamentos', 'am.cirugias_previas', 'am.historial_enfermedades')
            ->where('am.persona', '=', $id)->get();

        $historiales = DB::table('historial_medicamentos as hm')
            ->join('personas as p', 'p.id', '=', 'hm.persona')
            ->select('hm.id', 'hm.medicamentos', 'hm.medicamentos_anteriores_recetados', 'hm.dosis_duracion_medicacion')
            ->where('hm.persona', '=', $id)->get();

        // Construye la URL con el nombre y apellidos de la persona
        $nombreCompleto = $persona->nombrepersona . ' ' . $persona->apellidos;
        $url = url('carnet/buscar?nombre=' . $nombreCompleto);

        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($url) // Usa la URL con el nombre
            ->size(200)
            ->build();

        $qrCodeString = base64_encode($result->getString());
        $qrData = 'data:' . $result->getMimeType() . ';base64,' . $qrCodeString;

        $data = [
            'persona' => $persona,
            'familiares' => $familiares,
            'diarios' => $diarios,
            'medicamentos' => $medicamentos,
            'preferencias' => $preferencias,
            'seguimientos' => $seguimientos,
            'incidentes' => $incidentes,
            'pruebas' => $pruebas,
            'antecedentes' => $antecedentes,
            'historiales' => $historiales,
            'qrCode'  => $qrData,
        ];

        $queryTime = microtime(true);
        error_log('Tiempo de consultas: ' . ($queryTime - $startTime) . ' segundos');

        $pdf = PDF::loadView('userpdf', $data);

        $pdfTime = microtime(true);
        error_log('Tiempo de generación del PDF: ' . ($pdfTime - $queryTime) . ' segundos');

        $date = Carbon::now();

        $downloadStartTime = microtime(true);
        $response = $pdf->download($date . '.pdf');
        $downloadEndTime = microtime(true);
        error_log('Tiempo de descarga del PDF: ' . ($downloadEndTime - $downloadStartTime) . ' segundos');

        return $pdf->download($date . '.pdf');
    }

    public function generateDormitoriosCamas()
    {
        // Obtenemos todos los dormitorios con sus camas y las ocupaciones de cada cama
        $dormitorios = \App\Models\Dormitorio::with(['camas', 'camas.ocupaciones'])->get();

        // Link para generar el pdf (ruta actual)
        $link = route('pdf.dormitorios_camas');

        // Generamos el QR con Endroid\QrCode
        $result = \Endroid\QrCode\Builder\Builder::create()
            ->writer(new \Endroid\QrCode\Writer\PngWriter())
            ->data($link)
            ->size(200)
            ->build();
        $qrCodeString = base64_encode($result->getString());
        $qrData = 'data:' . $result->getMimeType() . ';base64,' . $qrCodeString;

        // Cargamos la vista del reporte pasando también el qrData
        $pdf = \PDF::loadView('pdf.dormitorios-camas', compact('dormitorios', 'qrData'));

        // Descarga el PDF con un nombre basado en la fecha y hora actual
        $fileName = "dormitorios_camas_" . now()->format('Ymd_His') . ".pdf";
        return $pdf->download($fileName);
    }
}
