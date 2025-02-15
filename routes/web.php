<?php

use App\Http\Controllers\AntecedentesMedicosController;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\HistorialMedicamentosController;
use App\Http\Controllers\HistorialMedicoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncidenteController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\NacionalidadController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\PreferenciaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RegistroDiarioAtencionController;
use App\Http\Controllers\ResultadoPruebaMedicaController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\SuministroController;
use App\Http\Controllers\TipoMedicamentoController;
use App\Http\Controllers\TipoSuministroController;
use App\Http\Controllers\AdoptanteController;
use App\Http\Controllers\AdopcionController;
use App\Http\Controllers\CamaController;
use App\Http\Controllers\DormitorioController;
use App\Http\Controllers\OcupacionController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Models\Contacto;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentosLegalesController;
use App\Http\Controllers\CanastaController;
use App\Http\Controllers\AbogadoController;
use App\Http\Controllers\CarnetController;
use App\Http\Controllers\InformeController;









Route::resource('informes', InformeController::class);



Route::group(['middleware' => ['auth', 'role:Trabajador social|Administrador']], function () {
    Route::resource('informes', InformeController::class);
});

Route::get('informes/generatePdf/{id}', [InformeController::class, 'generatePdf'])->name('informes.generatePdf');

Route::get('/medicamentos/{medicamento}/suministrar', [MedicamentoController::class, 'suministrarForm'])->name('medicamentos.suministrarForm');
Route::post('/medicamentos/{medicamento}/suministrar', [MedicamentoController::class, 'suministrarStore'])->name('medicamentos.suministrarStore');
Route::get('proveedores/pdf', [App\Http\Controllers\ProveedorController::class, 'pdf'])->name('proveedores.pdf');
Route::get('/canasta/pdf/{fecha}', [CanastaController::class, 'pdfFecha'])->name('canasta.pdfFecha');
Route::get('documentoslegales/pdf', [DocumentosLegalesController::class, 'pdf'])->name('documentoslegales.pdf');
Route::get('administrativos/pdf', [EmpleadoController::class, 'pdf'])->name('administrativos.pdf');
Route::get('tiposuministros/pdf', [TipoSuministroController::class, 'pdf'])->name('tiposuministros.pdf');
Route::get('suministros/pdf', [SuministroController::class, 'pdf'])->name('suministros.pdf');
Route::get('tipos/pdf', [TipoMedicamentoController::class, 'pdf'])->name('tipos.pdf');
Route::get('medicamentos/pdf', [MedicamentoController::class, 'pdf'])->name('medicamentos.pdf');
Route::get('canasta/pdf', [CanastaController::class, 'pdf'])->name('canasta.pdf');
Route::get('adoptantes/pdf', [AdoptanteController::class, 'pdf'])->name('adoptantes.pdf');
Route::get('adopciones/pdf', [AdopcionController::class, 'pdf'])->name('adopciones.pdf');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/ocupaciones/create/{cama?}', [OcupacionController::class, 'create'])->name('ocupaciones.create');
Route::get('/dormitorios/{dormitorio}/pdf', [DormitorioController::class, 'pdf'])->name('dormitorios.pdf');
Route::get('/pdf/dormitorios-camas', [\App\Http\Controllers\PDFController::class, 'generateDormitoriosCamas'])
    ->name('pdf.dormitorios_camas');

Route::get('carnet/buscar', [CarnetController::class, 'formulario'])->name('carnet.index');
Route::get('carnet/search', [CarnetController::class, 'search'])->name('carnet.search');
Route::resource('abogados', AbogadoController::class);
Route::resource('canasta', CanastaController::class)->except(['show']);
Route::get('canasta/{fecha}', [CanastaController::class, 'show'])->name('canasta.show');
Route::get('canasta/{fecha}/edit', [CanastaController::class, 'edit'])->name('canasta.edit');
Route::put('canasta/{fecha}', [CanastaController::class, 'update'])->name('canasta.update');
Route::delete('canasta/{fecha}', [CanastaController::class, 'destroy'])->name('canasta.destroy');

Route::resource('documentoslegales', DocumentosLegalesController::class)->middleware('permission:documentoslegales-list|documentoslegales-create|documentoslegales-edit|documentoslegales-delete');
Route::resource('documentoslegales', DocumentosLegalesController::class);


Route::resource('generos', GeneroController::class);
Route::resource('personas', PersonaController::class);
Route::resource('nacionalidades', NacionalidadController::class);
Route::resource('contactos', ContactoController::class);
Route::resource('diarios', RegistroDiarioAtencionController::class);
Route::resource('tipos', TipoMedicamentoController::class);
Route::resource('proveedores', ProveedorController::class);
Route::resource('medicamentos', MedicamentoController::class);
Route::resource('tiposuministros', TipoSuministroController::class);
Route::resource('suministros', SuministroController::class);
Route::resource('administrativos', EmpleadoController::class);
Route::resource('preferencias', PreferenciaController::class);
Route::resource('seguimientos', SeguimientoController::class);
Route::resource('incidentes', IncidenteController::class);
Route::resource('pruebas', ResultadoPruebaMedicaController::class);
Route::resource('antecedentes', AntecedentesMedicosController::class);
Route::resource('historial', HistorialMedicamentosController::class);
Route::resource('detalles', HistorialMedicoController::class);
Route::resource('adoptantes', AdoptanteController::class);
Route::resource('adopciones', AdopcionController::class);

Route::get('historial/create/{persona}', [HistorialMedicamentosController::class, 'create'])->name('historial.create');
Route::get('antecedentes/create/{persona}', [AntecedentesMedicosController::class, 'create'])->name('antecedentes.create');
Route::get('pruebas/create/{persona}', [ResultadoPruebaMedicaController::class, 'create'])->name('pruebas.create');
Route::get('incidentes/create/{persona}', [IncidenteController::class, 'create'])->name('incidentes.create');
Route::get('seguimientos/create/{persona}', [SeguimientoController::class, 'create'])->name('seguimientos.create');
Route::get('preferencias/create/{persona}', [PreferenciaController::class, 'create'])->name('preferencias.create');
Route::get('contactos/create/{persona}', [ContactoController::class, 'create'])->name('contactos.create');
Route::get('diarios/create/{persona}', [RegistroDiarioAtencionController::class, 'create'])->name('diarios.create');

Route::get('buscar_paciente', [HistorialMedicoController::class, 'buscar'])->name('buscar_paciente');

Route::get('/search-patients', [BusquedaController::class, 'searchByVoice']);
Route::get('buscar',  [BusquedaController::class, 'index']);
/*Route::get('palabras/buscar', [BusquedaController::class, 'buscar_palabra'])->name('searchData');
Route::post('palabras/vozData', [BusquedaController::class, 'vozData'])->name('palabra');
Route::get('palabras/data', [BusquedaController::class,'mostrarData'])->name('midata');
Route::get('palabras', [BusquedaController::class, 'index'])->name('palabras');
/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('generate-pdf/{id}', [PDFController::class, 'generateinfo'])->name('generatePDF');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('detalles', HistorialMedicoController::class);
    Route::resource('tiposuministros', TipoSuministroController::class);
    Route::resource('medicamentos', MedicamentoController::class);
    Route::resource('tipos', TipoMedicamentoController::class);
    Route::resource('dormitorios', DormitorioController::class);
    Route::resource('documentoslegales', DocumentosLegalesController::class);
    Route::resource('historial', HistorialMedicamentosController::class);
    Route::resource('canasta', CanastaController::class);

    Route::get('historial/create/{persona}', [HistorialMedicamentosController::class, 'create'])->name('historial.create');
    Route::get('antecedentes/create/{persona}', [AntecedentesMedicosController::class, 'create'])->name('antecedentes.create');
    Route::get('pruebas/create/{persona}', [ResultadoPruebaMedicaController::class, 'create'])->name('pruebas.create');
    Route::get('incidentes/create/{persona}', [IncidenteController::class, 'create'])->name('incidentes.create');
    Route::get('seguimientos/create/{persona}', [SeguimientoController::class, 'create'])->name('seguimientos.create');
    Route::get('preferencias/create/{persona}', [PreferenciaController::class, 'create'])->name('preferencias.create');
    Route::get('contactos/create/{persona}', [ContactoController::class, 'create'])->name('contactos.create');
    Route::get('diarios/create/{persona}', [RegistroDiarioAtencionController::class, 'create'])->name('diarios.create');
});

Route::group(['middleware' => ['auth', 'permission:tmedicamento-list']], function () {
    Route::resource('detalles', HistorialMedicamentosController::class);
    Route::resource('detalles', HistorialMedicoController::class);
});

Route::get('dormitorios/{dormitorio}/camas', [DormitorioController::class, 'camas'])->name('dormitorios.camas');
//Route::get('camas/{cama}/ocupante', [CamaController::class, 'ocupante'])->name('camas.ocupante');
Route::resource('dormitorios', DormitorioController::class);
Route::resource('camas', CamaController::class);
Route::resource('ocupaciones', OcupacionController::class);

//Route::get('camas/{cama}/ocupante', [CamaController::class, 'ocupante'])->name('camas.ocupante');
Route::put('camas/{cama}/liberar', [CamaController::class, 'liberarOcupante'])->name('camas.liberar');
Route::get('/camas/{cama}/ocupante', [CamaController::class, 'verOcupante'])->name('camas.ocupante');
Route::post('/camas/{cama}/ocupante', [CamaController::class, 'agregarOcupante'])->name('camas.agregar_ocupante');
Route::get('/personas', [PersonaController::class, 'index'])->name('personas.index'); // Devuelve la lista de personas


Route::get('/camas/{cama}/gestionar-ocupante', [CamaController::class, 'gestionarOcupante'])->name('camas.gestionarOcupante');
Route::post('/ocupantes/store', [OcupacionController::class, 'store'])->name('ocupantes.store');


use App\Http\Controllers\OcupanteController;

// Ruta para la vista de gestión de ocupantes
Route::get('camas/{cama_id}/gestion-ocupante', [OcupacionController::class, 'index'])->name('ocupantes.index');

// Ruta para guardar una nueva ocupación
Route::post('ocupantes/store', [OcupacionController::class, 'store'])->name('ocupantes.store');

// Ruta para liberar una cama (cambiar su estado a libre)
Route::post('ocupantes/{ocupacion}/liberar', [OcupacionController::class, 'liberar'])->name('ocupantes.liberar');

// Ruta para ocupar una cama nuevamente (cambiar su estado a ocupado)
Route::post('ocupantes/{ocupacion}/ocupar', [OcupacionController::class, 'ocupar'])->name('ocupantes.ocupar');



Route::group(['middleware' => ['auth', 'role:Administrador']], function () {
    Route::resource('dormitorios', DormitorioController::class);
});

Route::group(['middleware' => ['auth', 'role:Administrador']], function () {
    Route::resource('camas', CamaController::class);
});

Route::group(['middleware' => ['auth', 'permission:medicamento-list|medicamento-create|medicamento-edit|medicamento-delete']], function () {
    Route::resource('medicamentos', MedicamentoController::class);
});

Route::group(['middleware' => ['auth', 'permission:proveedor-list']], function () {
    Route::resource('canasta', CanastaController::class);
    Route::get('canasta/{fecha}', [CanastaController::class, 'show'])->name('canasta.show');
    Route::get('canasta/{fecha}/edit', [CanastaController::class, 'edit'])->name('canasta.edit');
    Route::put('canasta/{fecha}', [CanastaController::class, 'update'])->name('canasta.update');
    Route::delete('canasta/{fecha}', [CanastaController::class, 'destroy'])->name('canasta.destroy');
});
