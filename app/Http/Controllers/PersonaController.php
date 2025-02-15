<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Models\Medicamento;
use App\Models\Nacionalidad;
use App\Models\Persona;
use App\Models\DocumentoLegal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:persona-list|persona-create|persona-edit|persona-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:persona-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:persona-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:persona-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $personas = Persona::with('informes')->get();
        $nacionalidades             =           Nacionalidad::get();


        return view('personas.index', compact('personas', 'nacionalidades'));
    }

    public function create()
    {
        $title                      =           __("Agregar nuevo paciente");
        $textButton                 =           __("Registrar paciente");
        $persona                    =           new Persona();
        $generos                    =           Genero::get();
        $nacionalidades             =           Nacionalidad::get();
        $route                      =           route('personas.store');

        return view('personas.create', compact('title', 'textButton', 'persona', 'route', 'generos', 'nacionalidades'));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                "nombres"               => "required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/",
                "apellidos"             => "required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/",
                "fech_nac"              =>          "required",
                "ci"                    => "required|numeric|unique:personas,ci",
                "image"                 =>          "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
                "estado_civil"          =>          "required",
                "nacionalidad"          =>          "required",
                "genero"                =>          "required",
                "motivo_ingreso"        =>          "required",
                "firma_consentimiento"  => "required|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048",
                "fech_registro"         =>          "required",
                "hora_registro"         =>          "required",
            ],
            [
                'nombres.required'              => 'El campo nombres es obligatorio.',
                'apellidos.required'            => 'El campo apellidos es obligatorio.',
                'fech_nac.required'             => 'El campo fecha de nacimiento es obligatorio.',
                'ci.required'                   => 'El campo cédula de identidad es obligatorio.',
                'ci.numeric'                    => 'El campo cédula de identidad debe ser un número.',
                'ci.unique'                     => 'La cédula de identidad ya se encuentra registrada.',
                'image.required'                => 'El campo foto del paciente es obligatorio.',
                'estado_civil.required'         => 'El campo estado civil es obligatorio.',
                'nacionalidad.required'         => 'El campo nacionalidad es obligatorio.',
                'genero.required'               => 'El campo género es obligatorio.',
                'motivo_ingreso.required'       => 'El campo motivo de ingreso es obligatorio.',
                'firma_consentimiento.required' => 'El campo documento es obligatorio.',
                'fech_registro.required'        => 'El campo fecha de registro es obligatorio.',
                'hora_registro.required'        => 'El campo hora de registro es obligatorio.',
            ]
        );

        $input = $request->all();

        // Procesar la primera imagen ("image")
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        }

        // Procesar la segunda imagen ("firma_consentimiento")
        if ($firma = $request->file('firma_consentimiento')) {
            $destinationPath = 'firma/';
            $firmaImage = date('YmdHis') . "_firma." . $firma->getClientOriginalExtension();
            $firma->move($destinationPath, $firmaImage);
            $input['firma_consentimiento'] = $firmaImage;
        }

        Persona::create($input);

        return redirect()->route('personas.index');
    }


    public function show($id)
    {
        $persona = DB::table('personas as p')
            ->join('generos as g', 'g.id', '=', 'p.genero')
            ->join('nacionalidades as n', 'n.id', '=', 'p.nacionalidad')
            ->select('p.id', 'p.nombres', 'p.nacionalidad', 'p.apellidos', 'p.fech_nac', 'p.image', 'p.motivo_ingreso', 'p.ci', 'p.fech_registro', 'p.hora_registro', 'p.estado_civil', 'p.firma_consentimiento', 'n.nombre_nacionalidad', 'g.nombre_genero',)
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
        $documentos = DocumentoLegal::where('persona_id', $id)->get();

        return view('personas.show', compact('medicamentos', 'persona', 'familiares', 'diarios', 'preferencias', 'seguimientos', 'incidentes', 'pruebas', 'antecedentes', 'historiales', 'documentos'));
    }

    public function edit(Persona $persona)
    {
        $update = true;
        $title = __("Editar datos del paciente");
        $generos = Genero::get();
        $nacionalidades = Nacionalidad::get();
        $textButton = __("Actualizar registros");
        $route = route('personas.update', ["persona" => $persona]);

        return view('personas.edit', compact('update', 'title', 'textButton', 'route', 'persona', 'nacionalidades', 'generos'));
    }

    public function update(Request $request, Persona $persona)
    {
        $this->validate(
            $request,
            [
                "nombres"               => "required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/",
                "apellidos"             => "required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/",
                "fech_nac" => "required",
                "ci"                    => "required|numeric|unique:personas,ci",
                "image" => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
                "estado_civil" => "required",
                "nacionalidad" => "required",
                "genero" => "required",
                "motivo_ingreso" => "required",
                "firma_consentimiento" => "image|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048",
                "fech_registro" => "required",
                "hora_registro" => "required",
            ],
            [
                'nombres.required'              => 'El campo nombres es obligatorio.',
                'apellidos.required'            => 'El campo apellidos es obligatorio.',
                'fech_nac.required'             => 'El campo fecha de nacimiento es obligatorio.',
                'ci.numeric'                    => 'El campo cédula de identidad debe ser un número.',
                'ci.required'                   => 'El campo cédula de identidad es obligatorio.',
                'ci.unique'                     => 'La cédula de identidad ya se encuentra registrada.',
                'estado_civil.required'         => 'El campo estado civil es obligatorio.',
                'nacionalidad.required'         => 'El campo nacionalidad es obligatorio.',
                'genero.required'               => 'El campo género es obligatorio.',
                'motivo_ingreso.required'       => 'El campo motivo de ingreso es obligatorio.',
                'fech_registro.required'        => 'El campo fecha de registro es obligatorio.',
                'hora_registro.required'        => 'El campo hora de registro es obligatorio.',
            ]
        );
        $input = $request->all();

        // Procesar la nueva imagen "image" si se proporciona
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        } else {
            // Si no se proporciona una nueva imagen, mantén la imagen existente
            $input['image'] = $persona->image;
        }

        // Procesar la nueva imagen "firma_consentimiento" si se proporciona
        if ($firma = $request->file('firma_consentimiento')) {
            $destinationPath = 'firma/';
            $firmaImage = date('YmdHis') . "_firma." . $firma->getClientOriginalExtension();
            $firma->move($destinationPath, $firmaImage);
            $input['firma_consentimiento'] = $firmaImage;
        } else {
            // Si no se proporciona una nueva imagen, mantén la imagen existente
            $input['firma_consentimiento'] = $persona->firma_consentimiento;
        }

        $persona->update($input);

        return redirect()->route('personas.index');
    }


    public function destroy(Persona $persona)
    {
        $persona->delete();
        return back();
    }
}
