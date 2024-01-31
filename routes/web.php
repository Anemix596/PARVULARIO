<?php

use App\Http\Controllers\VistaController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\InscripcionController;


Auth::routes();
Route::get('/', [VistaController::class, 'index']);
Route::middleware(['auth'])->group(function () {


//ocupacion
Route::get('/listar_ocupacion', [PersonaController::class, 'listar_ocupacion'])->name('listar.ocupacion');
Route::get('/ver_lista_ocupaciones', [PersonaController::class, 'ver_lista_ocupaciones'])->name('ver.lista.ocupaciones');
Route::post('/mostrar_ocupacion', [PersonaController::class, 'mostrar_ocupacion'])->name('mostrar.ocupacion');
Route::get('/registrar_ocupacion', [PersonaController::class, 'registrar_ocupacion'])->name('registrar.ocupacion');
Route::post('/agregar_ocupacion', [PersonaController::class, 'agregar_ocupacion'])->name('agregar.ocupacion');
Route::post('/obtener_ocupacion', [PersonaController::class, 'obtener_ocupacion'])->name('obtener.ocupacion');
Route::post('/actualizar_datos_ocu', [PersonaController::class, 'actualizar_datos_ocu'])->name('actualizar.datos.ocu');
Route::post('/ver_lista_ocupaciones_valor', [PersonaController::class, 'ver_lista_ocupaciones_valor'])->name('ver.lista.ocupaciones.valor');


//Nivel
Route::get('/registrar_nivel', [InscripcionController::class, 'registrar_nivel'])->name('registrar.nivel');
Route::post('/agregar_nivel', [InscripcionController::class, 'agregar_nivel'])->name('agregar.nivel');
Route::get('/ver_lista_niveles', [InscripcionController::class, 'ver_lista_niveles'])->name('ver.lista.niveles');
Route::post('/ver_lista_niveles_valor', [InscripcionController::class, 'ver_lista_niveles_valor'])->name('ver.lista.niveles.valor');
Route::post('/obtener_nivel', [InscripcionController::class, 'obtener_nivel'])->name('obtener.nivel');
Route::post('/actualizar_datos_nivel', [InscripcionController::class, 'actualizar_datos_nivel'])->name('actualizar.datos.nivel');


//Persona
Route::get('/inicio', [VistaController::class, 'vista_solicitante'])->name('inicio');
Route::post('/registrar_persona', [PersonaController::class, 'registrar_persona'])->name('registrar.persona');
Route::post('/buscar_persona', [PersonaController::class, 'buscar_persona'])->name('buscar.persona');
Route::get('/recuperar_fecha', [PersonaController::class, 'recuperar_fecha'])->name('recuperar.fecha');
Route::get('/listar_parentesco', [PersonaController::class, 'listar_parentesco'])->name('listar.parentesco');
Route::post('/buscar_datos_persona', [PersonaController::class, 'buscar_datos_persona'])->name('buscar.datos.persona');
Route::post('/actualizar_datos_ben', [PersonaController::class, 'actualizar_datos_ben'])->name('actualizar.datos.ben');
Route::post('/actualizar_datos_persona', [PersonaController::class, 'actualizar_datos_persona'])->name('actualizar.datos.persona');
Route::post('/agregar_persona', [PersonaController::class, 'agregar_persona'])->name('agregar.persona');
Route::get('/listar_ninos', [PersonaController::class, 'listar_ninos'])->name('listar.ninos');
Route::post('/listar_tutores', [PersonaController::class, 'listar_tutores'])->name('listar.tutores');
Route::post('/listar_tutores_selec', [PersonaController::class, 'listar_tutores_selec'])->name('listar.tutores2');

//Niños
Route::get('/ver_lista_ninos', [PersonaController::class, 'ver_lista_ninos'])->name('ver.lista.ninos');
Route::post('/obtener_tutores', [PersonaController::class, 'obtener_tutores'])->name('obtener.tutores');


//inscripcion
Route::get('/inscripcion', [VistaController::class, 'vista_inscripcion'])->name('inscripcion');
Route::post('/registrar_inscripcion', [InscripcionController::class, 'registrar_inscripcion'])->name('registrar.inscripcion');
Route::post('/registrar_inscripcion2', [InscripcionController::class, 'registrar_inscripcion2'])->name('registrar.inscripcion2');
Route::get('/listar_nivel', [InscripcionController::class, 'listar_nivel'])->name('listar.nivel');
Route::get('/listar_periodo', [InscripcionController::class, 'listar_periodo'])->name('listar.periodo');
Route::post('/calcular_fecha', [InscripcionController::class, 'calcular_fecha'])->name('calcular.fecha');
Route::post('/calcular_precio', [InscripcionController::class, 'calcular_precio'])->name('calcular.precio');
Route::get('/ver_lista_inscripcion', [InscripcionController::class, 'ver_lista_inscripcion'])->name('ver.lista.inscripcion');
Route::get('/ver_lista_inscripcion2', [InscripcionController::class, 'ver_lista_inscripcion2'])->name('ver.lista.inscripcion2');
Route::get('/ver_lista_inscripcion3', [InscripcionController::class, 'ver_lista_inscripcion3'])->name('ver.lista.inscripcion3');
Route::get('/ver_lista_inscripcion4', [InscripcionController::class, 'ver_lista_inscripcion4'])->name('ver.lista.inscripcion4');
Route::post('/ver_inscripcion_valor', [InscripcionController::class, 'ver_inscripcion_valor'])->name('ver.inscripcion.valor');
Route::post('/obtener_inscripcion', [InscripcionController::class, 'obtener_inscripcion'])->name('obtener.inscripcion');
Route::post('/actualizar_inscripcion', [InscripcionController::class, 'actualizar_inscripcion'])->name('actualizar.datos.inscrip');
Route::post('/actualizar_cobro', [InscripcionController::class, 'actualizar_cobro'])->name('actualizar.datos.cobro');
Route::post('/obtener_anios', [InscripcionController::class, 'obtener_anios'])->name('obtener.anios');
Route::post('/obtener_periodos', [InscripcionController::class, 'obtener_periodos'])->name('obtener.periodos');

//inscripcion
Route::get('/cobro', [VistaController::class, 'vista_cobro'])->name('cobro');
Route::get('/baja', [VistaController::class, 'vista_baja'])->name('baja');
Route::post('/baja_estudiante', [InscripcionController::class, 'baja_estudiante'])->name('baja.estudiante');
Route::get('/devolucion', [VistaController::class, 'vista_devolucion'])->name('devolucion');
Route::post('/calcular_precio_devolucion', [InscripcionController::class, 'calcular_precio_devolucion'])->name('calcular.precio.devolucion');
Route::post('/verificar_devolucion', [InscripcionController::class, 'verificar_devolucion'])->name('verificar.devolucion');
Route::post('/registrar_devolucion', [InscripcionController::class, 'registrar_devolucion'])->name('registrar.datos.devolucion');
Route::post('/obtener_devolucion', [InscripcionController::class, 'obtener_devolucion'])->name('obtener.devolucion');
Route::post('/actualizar_devolucion', [InscripcionController::class, 'actualizar_devolucion'])->name('actualizar.datos.devolucion');
Route::post('/obtener_fecha_ultima', [InscripcionController::class, 'obtener_fecha_ultima'])->name('obtener.fecha.ultima');


Route::post('/imprimir_recibo', [InscripcionController::class, 'imprimir_recibo'])->name('imprimir.recibo');
    
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
