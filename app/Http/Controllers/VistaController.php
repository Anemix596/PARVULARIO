<?php

namespace App\Http\Controllers;

use App\Models\Vista;
use App\Models\Inscripcion;
use Illuminate\Http\Request;

class VistaController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function vista_solicitante(){
        $actualizar = Inscripcion::actualizar_estados();
        return view('index');
    }

    public function vista_inscripcion(){
        $actualizar = Inscripcion::actualizar_estados();
        return view('inscripcion');
    }

    public function vista_devolucion(){
        $actualizar = Inscripcion::actualizar_estados();
        return view('devolucion');
    }

    public function vista_cobro(){
        $actualizar = Inscripcion::actualizar_estados();
        return view('cobro');
    }

    public function vista_baja(){
        $actualizar = Inscripcion::actualizar_estados();
        return view('baja');
    }
}
