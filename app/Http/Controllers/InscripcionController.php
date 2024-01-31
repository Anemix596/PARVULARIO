<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Persona;
use DateTime;
use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

class InscripcionController extends Controller
{

    public function listar_nivel(){
        if(!empty(session('usuario'))){
            $html = "";
            $lista = Inscripcion::listar_nivel();
            if(count($lista)>0){
                $html.="<option value='' disabled selected>".'Seleccionar Nivel'."</option>";
                foreach($lista as $val){
                    $html.="<option value='".$val->ide."'>".$val->descripe." ".$val->costoe."</option>";
                    
                }
            }
            return $html;
        }
    }

    public function listar_periodo(){
        date_default_timezone_set("America/La_Paz");
        $fecha = date('Y');
        $i=1;
        if(!empty(session('usuario'))){
            $html = "";
            $html.="<option value='' disabled selected>".'Seleccionar Periodo'."</option>";
            for ($i=1; $i <= 12; $i++) { 
                $html.="<option value='".$i."/".$fecha."'>".$i."/".$fecha."</option>";
            }
            return $html;
        }
    }

    public function calcular_fecha(){
        date_default_timezone_set("America/La_Paz");
        $fechaA = date('d-m-Y');
        $fechaB = date('His');
        if(!empty(session('usuario'))){
            $fecha = $_POST['f'];
            $dias = $_POST['d'];
            $a = "+ ".$dias." days";
            $fechaf = date('d-m-Y', strtotime($fecha.$a));

            return $fechaf;
        }
    }

    public function calcular_precio(){
        date_default_timezone_set("America/La_Paz");
        $fechai = $_POST['fi'];
        $fechaf = $_POST['ff'];
        $id = $_POST['id'];

        $fecha = explode("-", $fechai);
        $fechai = $fecha[2]."-".$fecha[1]."-".$fecha[0];
        $fecha = explode("-", $fechaf);
        $fechaf = $fecha[2]."-".$fecha[1]."-".$fecha[0];
        $fecha1 = new DateTime($fechai);
        $fecha2 = new DateTime($fechaf);
        $cant_mes = date('Y-m-d', strtotime($fechai."+ 1 month"));
        $dife = date_diff($fecha1, new DateTime($cant_mes));
        $dias_mes = $dife->days;
        $diferencia = date_diff($fecha1, $fecha2);
        $dias = $diferencia->days;
        $precio = 0;

        $listar = Inscripcion::listar_nivel();
        if(count($listar)>0){
            foreach($listar as $val){
                if($val->ide == $id){
                    $costo = $val->costoe;
                }
            }
            $precio = round($costo/$dias_mes*($dias+1), 0);
        }
        
        return $precio;
    }

    public function registrar_inscripcion(){
        $usuario = session('id');
        if(!empty($usuario)){
            $estudiante = $_POST['est'];
            $tutor = $_POST['tutor'];
            $aspecto = $_POST['aspecto'];
            $vive = $_POST['vive'];
            $turno = $_POST['turno'];
            $nivel = $_POST['nivel'];
            $periodo = $_POST['periodo'];

            if($_POST['fechai'] == '' || $_POST['fechaf'] == '' || $_POST['precio'] == '')
                return 4;

            $precio = $_POST['precio'];
            $fechai = $_POST['fechai'];
            $fechaf = $_POST['fechaf'];

            $fecha = explode("-", $fechai);
            $fechai = $fecha[2]."-".$fecha[1]."-".$fecha[0];
            $fecha = explode("-", $fechaf);
            $fechaf = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                       
            $verificar_inscrip = Inscripcion::verificar_inscrip($estudiante);
            if(empty($verificar_inscrip)){
                $insertar_inscrip = Inscripcion::insertar_inscripcion($estudiante, $aspecto, $usuario, $vive);
                if($insertar_inscrip){
                    foreach($insertar_inscrip as $val){
                        $inscrip_id = $val->insertar_inscripcion;
                    }
                    $insertar_cobro = Inscripcion::insertar_cobro_mens($inscrip_id, $estudiante, $precio, $fechai, $fechaf, $periodo, $tutor, $usuario, $nivel, $turno);
                    if($insertar_cobro) return 1;
                    else return 0;
                }
                else return 0;
            }
            else{
                $verificar_periodo = Inscripcion::verificar_periodo($estudiante, $periodo);
                if(empty($verificar_periodo)){
                    foreach($verificar_inscrip as $val){
                        $inscrip_id = $val->id;
                    }
                    $insertar_cobro = Inscripcion::insertar_cobro_mens($inscrip_id, $estudiante, $precio, $fechai, $fechaf, $periodo, $tutor, $usuario, $nivel, $turno);
                    if($insertar_cobro) return 1;
                    else return 0;
                }
                else return 3;
            }
        }
    }

    public function registrar_inscripcion2(){
        $usuario = session('id');
        if(!empty($usuario)){
            $estudiante = $_POST['est_ida'];
            $tutor = $_POST['tutor2a'];
            $turno = $_POST['turno2a'];
            $nivel = $_POST['nivel2a'];
            $periodo = $_POST['periodo2a'];
            $precio = $_POST['precio2a'];
            $fechai = $_POST['fechai2a'];
            $fechaf = $_POST['fechaf2a'];

            $fecha = explode("-", $fechai);
            $fechai = $fecha[2]."-".$fecha[1]."-".$fecha[0];
            $fecha = explode("-", $fechaf);
            $fechaf = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                       
            $verificar_inscrip = Inscripcion::verificar_inscrip($estudiante);
            if(!empty($verificar_inscrip)){
                foreach($verificar_inscrip as $val){
                    $inscrip_id = $val->id;
                }

                $verificar_periodo = Inscripcion::verificar_periodo($estudiante, $periodo);
                if(empty($verificar_periodo)){
                    foreach($verificar_inscrip as $val){
                        $inscrip_id = $val->id;
                    }

                    $insertar_cobro = Inscripcion::insertar_cobro_mens($inscrip_id, $estudiante, $precio, $fechai, $fechaf, $periodo, $tutor, $usuario, $nivel, $turno);
                    if($insertar_cobro) return 1;
                    else return 0;
                }
                else return 3;
                
            }
        }
    }

    public function registrar_nivel(){
        $actualizar = Inscripcion::actualizar_estados();
        return view('nivel');
    }

    public function ver_lista_niveles(){
        $vector = Array();
        $bandera = 1;
        $usuario = session('usuario');
        if(!empty($usuario)){
            $consulta = Inscripcion::listar_todo_nivel();
            if(count($consulta) > 0){
                foreach($consulta as $val){
                    if($val->estadoe=="A"){
                        $vector[] = array(
                            "valor" => '3',
                            "numero" => $bandera,
                            "id" => $val->ide,
                            "descrip" => $val->descripe,
                            "costo" => $val->costoe,
                            "gestion" => $val->gestione,
                            "estado" => ($val->estadoe=="A"?"ACTIVO":"BAJA"),
                        );
                        $bandera++;
                    }
                    
                }
                return Datatables::of($vector)->addColumn('boton', 'botones.btn_buscar')->rawColumns(['boton'])->toJson(); 
                
            }
            return Datatables::of($vector)->toJson();
        }
    }

    public function ver_lista_niveles_valor(){
        $valor1 = $_POST['est_ped1'];
        $valor2 = $_POST['est_ped2'];
        $usuario = session('usuario');
        if(!empty($usuario)){
            if($valor1 == 0 && $valor2 == 0) $valor1='P';
            if($valor1 == 1) $valor1 = 'P';
            if($valor2 == 2) $valor2 = 'A';
            $vector = Array();
            $bandera = 1;
            $consulta = Inscripcion::listar_todo_nivel_valor($valor1, $valor2);
            if(count($consulta) > 0){
                foreach($consulta as $val){
                    $vector[] = array(
                        "valor" => '3',
                        "numero" => $bandera,
                        "id" => $val->ide,
                        "descrip" => $val->descripe,
                        "costo" => $val->costoe,
                        "gestion" => $val->gestione,
                        "estado" => ($val->estadoe=="A"?"ACTIVO":"BAJA"),
                    );
                    $bandera++;
                }
                return Datatables::of($vector)->addColumn('boton', 'botones.btn_buscar')->rawColumns(['boton'])->toJson(); 
                
            }
            return Datatables::of($vector)->toJson();
        }
    }

    public function agregar_nivel(){
        $usuario = session('usuario');
        if(!empty($usuario)){
            $descrip = $_POST['fullname'];
            $costo = $_POST['precio'];
            $gestion = $_POST['gestion'];
            $verificar = Inscripcion::verificar_nivel($descrip);
            if(empty($verificar)){
                $insertar = Inscripcion::insertar_nivel($descrip, $costo, $gestion);
                if($insertar) return 1;
                return 0;
            }
            else return 2;
        }
    }

    public function obtener_nivel(){
        if(!empty(session('usuario'))){
            $lista = Inscripcion::listar_todo_nivel();
            $id=$_POST['id'];
            $vector = array();
            if(count($lista)>0){
                foreach($lista as $val){
                    if ($val->ide == $id) {
                        $vector[0]=$val->ide;
                        $vector[1]=$val->descripe;
                        $vector[2]=$val->costoe;
                        $vector[3]=$val->gestione;
                        $vector[4]=$val->estadoe;
                    }
                    
                }
            }
            return $vector;
        }
    }

    public function actualizar_datos_nivel(){
        $usuario = session('id');
        if(!empty($usuario)){
            $id = $_POST['ide'];
            $descrip = $_POST['fullnam'];
            $costo = $_POST['preci'];
            $gestion = $_POST['gestio'];
            $estado = $_POST['gene'];
            $verificar = Inscripcion::verificar_nivel($descrip);
            if(count($verificar)>0){
                foreach($verificar as $val){
                    $ide = $val->id;
                }
                if($id == $ide){
                    $act = Inscripcion::actualizar_nivel($id, $descrip, $costo, $gestion, $estado);
                    if($act) return 1;
                    else return 0;
                }
                else return 2;
                
            }
            else{
                $act = Inscripcion::actualizar_nivel($id, $descrip, $costo, $gestion, $estado);
                if($act) return 1;
                else return 0;
            }
        }
    }

    public function ver_lista_inscripcion(){
        $vector = Array();
        $bandera = 1;
        $usuario = session('usuario');
        if(!empty($usuario)){
            $consulta = Inscripcion::listar_inscripcion_vigente();
            if(count($consulta) > 0){
                foreach($consulta as $val_vig){
                    $consulta_cobro = Inscripcion::listar_cobro($val_vig->estud_ide);
                    foreach($consulta_cobro as $val){
                        $listar_est = Persona::listar_ninos();
                        if(count($listar_est) > 0){
                            foreach($listar_est as $val2){
                                if($val->estud_ide == $val2->ide){
                                    $ci = $val2->no_cie;
                                    $est = $val2->nombrese." ".$val2->ape_pate." ".$val2->ape_mate;
                                }
                            }
                        }

                        $listar_nivel = Inscripcion::listar_nivel();
                        if(count($listar_nivel) > 0){
                            foreach($listar_nivel as $val2){
                                if($val2->ide == $val->nivele)
                                    $nivel = $val2->descripe;
                            }
                        }

                        $verificar = Inscripcion::verificar_devolucion($val->id_cobro);
                        if(count($verificar)>0) $estado = 1;
                        else $estado = 0;

                        $vector[] = array(
                            "valor" => '4',
                            "numero" => $bandera,
                            "id" => $val->id_cobro,
                            "ci" => $ci,
                            "est" => $est,
                            "fechai" => $val->fechai,
                            "fechaf" => $val->fechaf,
                            "turno" => ($val->turnoe=="M"?"MAÑANA":"TARDE"),
                            "nivel" => $nivel,
                            "estado" => ($val->estadoe == "A"?"VIGENTE":"VENCIDO"),
                        );
                        $bandera++;
                    }
                    
                }
                return Datatables::of($vector)->addColumn('boton', 'botones.btn_buscar')->rawColumns(['boton'])->toJson(); 
                
            }
            return Datatables::of($vector)->toJson();
        }
    }

    public function ver_lista_inscripcion2(){
        $vector = Array();
        $bandera = 1;
        $usuario = session('usuario');
        if(!empty($usuario)){
            $consulta = Inscripcion::listar_inscripcion_vigente();
            if(count($consulta) > 0){
                foreach($consulta as $val_vig){
                    $consulta_cobro = Inscripcion::listar_cobro($val_vig->estud_ide);
                    foreach($consulta_cobro as $val){
                        $listar_est = Persona::listar_ninos();
                        if(count($listar_est) > 0){
                            foreach($listar_est as $val2){
                                if($val->estud_ide == $val2->ide){
                                    $ci = $val2->no_cie;
                                    $est = $val2->nombrese." ".$val2->ape_pate." ".$val2->ape_mate;
                                }
                            }
                        }

                        $listar_nivel = Inscripcion::listar_nivel();
                        if(count($listar_nivel) > 0){
                            foreach($listar_nivel as $val2){
                                if($val2->ide == $val->nivele)
                                    $nivel = $val2->descripe;
                            }
                        }

                        $verificar = Inscripcion::verificar_devolucion($val->id_cobro);
                        if(count($verificar)>0) $estado = 1;
                        else $estado = 0;

                        if($val->estadoe == "A"){
                            $vector[] = array(
                                "valor" => '5',
                                "numero" => $bandera,
                                "id" => $val->id_cobro,
                                "ci" => $ci,
                                "est" => $est,
                                "fechai" => $val->fechai,
                                "fechaf" => $val->fechaf,
                                "turno" => ($val->turnoe=="M"?"MAÑANA":"TARDE"),
                                "nivel" => $nivel,
                                "estado" => $estado,
                            );
                            $bandera++;
                        }
                    }
                    
                }
                return Datatables::of($vector)->addColumn('boton', 'botones.btn_buscar')->rawColumns(['boton'])->toJson(); 
                
            }
            return Datatables::of($vector)->toJson();
        }
    }
    
    public function ver_lista_inscripcion3(){
        $vector = Array();
        $bandera = 1;
        $usuario = session('usuario');
        if(!empty($usuario)){
            $consulta = Inscripcion::listar_inscripcion_vigente();
            if(count($consulta) > 0){
                foreach($consulta as $val_vig){
                    $consulta_cobro = Inscripcion::listar_cobro($val_vig->estud_ide);
                    foreach($consulta_cobro as $val){
                        $listar_est = Persona::listar_ninos();
                        if(count($listar_est) > 0){
                            foreach($listar_est as $val2){
                                if($val->estud_ide == $val2->ide){
                                    $ci = $val2->no_cie;
                                    $est = $val2->nombrese." ".$val2->ape_pate." ".$val2->ape_mate;
                                }
                            }
                        }

                        $listar_nivel = Inscripcion::listar_nivel();
                        if(count($listar_nivel) > 0){
                            foreach($listar_nivel as $val2){
                                if($val2->ide == $val->nivele)
                                    $nivel = $val2->descripe;
                            }
                        }

                        $vector[] = array(
                            "valor" => '6',
                            "numero" => $bandera,
                            "id" => $val->id_cobro,
                            "ci" => $ci,
                            "est" => $est,
                            "fechai" => $val->fechai,
                            "fechaf" => $val->fechaf,
                            "turno" => ($val->turnoe=="M"?"MAÑANA":"TARDE"),
                            "nivel" => $nivel,
                            "estado" => ($val->estadoe == "A"?"VIGENTE":"VENCIDO"),
                        );
                        $bandera++;
                    }
                    
                }
                return Datatables::of($vector)->addColumn('boton', 'botones.btn_buscar')->rawColumns(['boton'])->toJson(); 
                
            }
            return Datatables::of($vector)->toJson();
        }
    }

    public function ver_lista_inscripcion4(){
        $vector = Array();
        $bandera = 1;
        $usuario = session('usuario');
        if(!empty($usuario)){
            $consulta = Inscripcion::listar_inscripcion_baja();
            if(count($consulta) > 0){
                foreach($consulta as $val_vig){
                    $consulta_cobro = Inscripcion::listar_cobro2($val_vig->ide);
                    foreach($consulta_cobro as $val){
                        $listar_est = Persona::listar_ninos();
                        if(count($listar_est) > 0){
                            foreach($listar_est as $val2){
                                if($val->estud_ide == $val2->ide){
                                    $ci = $val2->no_cie;
                                    $est = $val2->nombrese." ".$val2->ape_pate." ".$val2->ape_mate;
                                }
                            }
                        }

                        $listar_nivel = Inscripcion::listar_nivel();
                        if(count($listar_nivel) > 0){
                            foreach($listar_nivel as $val2){
                                if($val2->ide == $val->nivele)
                                    $nivel = $val2->descripe;
                            }
                        }

                        $vector[] = array(
                            "valor" => '7',
                            "numero" => $bandera,
                            "id" => $val->id_cobro,
                            "ci" => $ci,
                            "est" => $est,
                            "fechai" => $val->fechai,
                            "fechaf" => $val->fechaf,
                            "turno" => ($val->turnoe=="M"?"MAÑANA":"TARDE"),
                            "nivel" => $nivel,
                        );
                        $bandera++;
                    }
                    
                }
                return Datatables::of($vector)->addColumn('boton', 'botones.btn_buscar')->rawColumns(['boton'])->toJson(); 
                
            }
            return Datatables::of($vector)->toJson();
        }
    }

    public function obtener_inscripcion(){
        date_default_timezone_set("America/La_Paz");
        $usuario = session('usuario');
        if(!empty($usuario)){
            $id = $_POST['id'];
            $vector = array();
            $consulta = Inscripcion::obtener_datos_inscripcion($id);
            if(count($consulta) > 0){
                foreach($consulta as $val){
                    $listar_tutor = Inscripcion::obtener_tutor();
                    if(count($listar_tutor) > 0){
                        foreach($listar_tutor as $val2){
                            if($val->perso_pagoe == $val2->ide){
                                $tutor = $val2->no_cie." ".$val2->nombrese." ".$val2->ape_pate." ".$val2->ape_mate;
                            }
                        }
                    }

                    $listar_est = Persona::listar_ninos();
                    if(count($listar_est) > 0){
                        foreach($listar_est as $val2){
                            if($val->estud_ide == $val2->ide){
                                $cie = ($val2->no_cie != ""?$val2->no_cie:"");
                                $est = $cie.$val2->nombrese." ".$val2->ape_pate." ".$val2->ape_mate;
                            }
                        }
                    }

                    $listar_nivel = Inscripcion::listar_nivel();
                    if(count($listar_nivel) > 0){
                        foreach($listar_nivel as $val2){
                            if($val2->ide == $val->nivele)
                                $nivel = $val2->descripe;
                        }
                    }
                    $fecha2 = date('Y-m-d');
                    $fecha1 = new DateTime($val->fin_vigencia);
                    $fecha2 = new DateTime($fecha2);

                    if($fecha1<$fecha2){
                        $diferencia = date_diff($fecha1, $fecha2);
                        $dias = $diferencia->days;
                        $dias = "LA INSCRIPCIÓN VENCIÓ HACE ".$dias." DÍAS";
                    }
                    else if($fecha1==$fecha2){
                        $diferencia = date_diff($fecha1, $fecha2);
                        $dias = $diferencia->days;
                        $dias = "LA INSCRIPCIÓN VENCE EL DÍA DE HOY";
                    }
                    else if($fecha1>$fecha2){
                        $diferencia = date_diff($fecha1, $fecha2);
                        $dias = $diferencia->days;
                        $dias = "LA INSCRIPCIÓN VENCE EN ".$dias." DÍAS";
                    }
                    else{ $dias = ""; }

                    $fecha = explode("-", $val->ini_vigenciae);
                    $iv = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                    $fecha = explode("-", $val->fin_vigencia);
                    $fv = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                    
                    $vector[0] = $est;
                    $vector[1] = $val->observe;
                    $vector[2] = $val->vivee;
                    $vector[3] = $nivel;
                    $vector[4] = $val->turnoe;
                    $vector[5] = $val->periodoe;
                    $vector[6] = $tutor;
                    $vector[7] = $iv;
                    $vector[8] = $fv;
                    $vector[9] = $val->precioe;
                    $vector[10] = $val->estadoe;
                    $vector[11] = $val->id_cobro;
                    $vector[12] = $dias;
                    $vector[13] = $val->estud_ide;
                    $vector[14] = $val->nivele;
                }
            }
            return $vector;
        }
    }

    public function actualizar_inscripcion(){
        $usuario = session('usuario');
        if(!empty($usuario)){
            $id = $_POST['ide'];
            $turno = $_POST['turno2'];
            $obser = $_POST['aspecto2'];
            $vive = $_POST['vive2'];
            $fechai = $_POST['fechai2'];
            $fechaf = $_POST['fechaf2'];
            $precio = $_POST['precio2'];
            $actualizar = Inscripcion::actualizar_inscripcion($id, $obser, $vive, $turno, $fechai, $fechaf, $precio);
            if($actualizar){
                return 1;
            }
            else return 2;
        }
    }

    public function actualizar_cobro(){
        $usuario = session('usuario');
        if(!empty($usuario)){
            $id = $_POST['ide'];
            $turno = $_POST['turno2'];
            $fechai = $_POST['fechai2'];
            $fechaf = $_POST['fechaf2'];
            $precio = $_POST['precio2'];
            $actualizar = Inscripcion::actualizar_cobro($id, $turno, $fechai, $fechaf, $precio);
            if($actualizar){
                return 1;
            }
            else return 2;
        }
    }

    public function calcular_precio_devolucion(){
        date_default_timezone_set("America/La_Paz");
        $fechai = $_POST['fi'];
        $fechaf = $_POST['ff'];
        $id = $_POST['id'];
        $dias_devol = $_POST['d'];

        $fecha = explode("-", $fechai);
        $fechai = $fecha[2]."-".$fecha[1]."-".$fecha[0];
        $fecha = explode("-", $fechaf);
        $fechaf = $fecha[2]."-".$fecha[1]."-".$fecha[0];
        $fecha1 = new DateTime($fechai);
        $fecha2 = new DateTime($fechaf);
        $cant_mes = date('Y-m-d', strtotime($fechai."+ 1 month"));
        $dife = date_diff($fecha1, new DateTime($cant_mes));
        $dias_mes = $dife->days;
        $diferencia = date_diff($fecha1, $fecha2);
        $dias = $diferencia->days;
        $precio = 0;

        if($dias_devol <= $dias && $dias_devol != 0){
            $listar = Inscripcion::listar_nivel();
            if(count($listar)>0){
                foreach($listar as $val){
                    if($val->ide == $id){
                        $costo = $val->costoe;
                    }
                }
                $precio = round($costo/$dias_mes*($dias_devol+1), 0);
            }
            return [1, $precio];
        }
        else return [3, $dias];
        
    }

    public function verificar_devolucion(){
        $usuario = session('usuario');
        if(!empty($usuario)){
            $id = $_POST['id'];
            $vector = array();
            $consulta = Inscripcion::verificar_devolucion($id);
            if(count($consulta) > 0){
                foreach($consulta as $val){
                    $vector[0] = 1;
                    $vector[1] = $val->id;
                }
            }
            else{$vector[0] = 2;}
            return $vector;
        }
    }

    public function registrar_devolucion(){
        $usuario = session('id');
        if(!empty($usuario)){
            $est = $_POST['est_ida'];
            $id_cobro = $_POST['idea'];
            $cant = $_POST['cant2a'];
            $precio = $_POST['precioa'];
            $precio_ant = $_POST['preca'];
            $tutor = $_POST['tutor2a'];
            $motivo = $_POST['motivoa'];

            $verificar = Inscripcion::verificar_devolucion($id_cobro);
            if(count($verificar) > 0){
                return 2;
            }
            else{
                $registrar = Inscripcion::insertar_devolucion($id_cobro, $est, $cant, $precio, $tutor, $motivo, $precio_ant, $usuario);
                if($registrar){
                    return 1;
                }
                else return 0;
            }
            
        }
    }

    public function obtener_devolucion(){
        date_default_timezone_set("America/La_Paz");
        $usuario = session('usuario');
        if(!empty($usuario)){
            $id = $_POST['id'];
            $vector = array();
            $consulta = Inscripcion::obtener_datos_devolucion($id);
            if(count($consulta) > 0){
                foreach($consulta as $val){

                    $listar_est = Persona::listar_ninos();
                    if(count($listar_est) > 0){
                        foreach($listar_est as $val2){
                            if($val->estud_ida == $val2->ide){
                                $cie = ($val2->no_cie != ""?$val2->no_cie:"");
                                $est = $cie.$val2->nombrese." ".$val2->ape_pate." ".$val2->ape_mate;
                            }
                        }
                    }

                    $listar_nivel = Inscripcion::listar_nivel();
                    if(count($listar_nivel) > 0){
                        foreach($listar_nivel as $val2){
                            if($val2->ide == $val->nivel_ida)
                                $nivel = $val2->descripe;
                        }
                    }
                    $fecha2 = date('Y-m-d');
                    $fecha1 = new DateTime($val->fin_vigenciaa);
                    $fecha2 = new DateTime($fecha2);

                    if($fecha1<$fecha2){
                        $diferencia = date_diff($fecha1, $fecha2);
                        $dias = $diferencia->days;
                        $dias = "LA INSCRIPCIÓN VENCIÓ HACE ".$dias." DÍAS";
                    }
                    else if($fecha1==$fecha2){
                        $diferencia = date_diff($fecha1, $fecha2);
                        $dias = $diferencia->days;
                        $dias = "LA INSCRIPCIÓN VENCE EL DÍA DE HOY";
                    }
                    else if($fecha1>$fecha2){
                        $diferencia = date_diff($fecha1, $fecha2);
                        $dias = $diferencia->days;
                        $dias = "LA INSCRIPCIÓN VENCE EN ".$dias." DÍAS";
                    }
                    else{ $dias = ""; }

                    $fecha = explode("-", $val->ini_vigenciaa);
                    $iv = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                    $fecha = explode("-", $val->fin_vigenciaa);
                    $fv = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                    
                    $vector[0] = $est;
                    $vector[1] = $val->motivoa;
                    $vector[2] = $val->monto_anta;
                    $vector[3] = $nivel;
                    $vector[4] = $val->turnoa;
                    $vector[5] = $val->periodoa;
                    $vector[6] = $val->perso_devola;
                    $vector[7] = $iv;
                    $vector[8] = $fv;
                    $vector[9] = $val->montoa;
                    $vector[10] = $val->dias_devola;
                    $vector[11] = $val->ida;
                    $vector[12] = $dias;
                    $vector[13] = $val->estud_ida;
                    $vector[14] = $val->nivel_ida;
                }
            }
            return $vector;
        }
    }

    public function actualizar_devolucion(){
        $usuario = session('id');
        if(!empty($usuario)){
            $id_cobro = $_POST['ide'];
            $cant = $_POST['cant2'];
            $precio = $_POST['precio'];
            $tutor = $_POST['tutor2'];
            $motivo = $_POST['motivo'];

            $registrar = Inscripcion::actualizar_devolucion($id_cobro, $cant, $precio, $tutor, $motivo, $usuario);
            if($registrar){
                return 1;
            }
            else return 0;
            
        }
    }

    public function obtener_fecha_ultima(){
        $usuario = session('usuario');
        if(!empty($usuario)){
            $id = $_POST['id'];
            $fecha = '';
            $fechai = '';
            if($id != ''){
                $obtener = Inscripcion::obtener_ultima_fecha($id);
                if($obtener){
                    foreach($obtener as $val){
                        $fecha = $val->fin_vigencia;
                        $fecha = date('Y-m-d', strtotime($fecha."+ 1 day"));
                        $fecha = explode("-", $fecha);
                        $fechai = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                    }

                    return $fechai;
                }
            }
        }
    }

    public function baja_estudiante(){
        $usuario = session('id');
        if(!empty($usuario)){
            $id = $_POST['pid'];
            $baja = Inscripcion::dar_baja($id, $usuario);
            if($baja) return 1;
            else return 0;
        }
    }

    public function imprimir_recibo(){
        $usuario = session('usuario');
        $html = "";
        if(!empty($usuario)){
            $id = $_POST['id'];
            $html = "http://localhost:8081/pentaho/api/repos/%3Apublic%3ASteel%20Wheels%3AReports%3ARecibo2.prpt/generatedContent?output-target=pageable%2Fpdf&cobro=".$id;
            return $html;
        }
    }
}
