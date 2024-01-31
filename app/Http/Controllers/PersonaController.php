<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Inscripcion;
use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

class PersonaController extends Controller
{
    
    public function registrar_persona(){
        $usuario = session('id');
        if(!empty($usuario)){
            $ci = $_POST['ci'];
            $nombres = $_POST['nombre'];
            $ape_pat = $_POST['ape_pat'];
            $ape_mat = $_POST['ape_mat'];
            $fecha = $_POST['fecha'];
            $genero = $_POST['gen'];

            $parentesco = $_POST['paren'];
            $cip = $_POST['cip'];
            $nombresp = $_POST['nombrep'];
            $ape_patp = $_POST['ape_patp'];
            $ape_matp = $_POST['ape_matp'];
            $fechap = $_POST['fechap'];
            $generop = $_POST['genp'];
            $domicilio = $_POST['domp'];
            $tel_persp = $_POST['tel_persp'];
            $telp = $_POST['telp'];
            $ocup = $_POST['ocup'];
            $vector = array();

            $verificar_ben = Persona::verificar_ben($ci, $nombres, $ape_pat, $ape_mat, $fecha, $genero);
            if(empty($verificar_ben)){
                $insertar_ben = Persona::insertar_ben($ci, $nombres, $ape_pat, $ape_mat, $fecha, $genero, $usuario);
                if($insertar_ben){
                    foreach($insertar_ben as $val){
                        $vector[0] = $val->insertar_ben;
                    }

                    $verificar = Persona::verificar_persona($cip);
                    if(empty($verificar)){
                        $insertar = Persona::insertar_persona($ape_patp, $ape_matp, $nombresp, $cip, $fechap, $generop, $domicilio, $telp, $ocup, $tel_persp, $usuario);
                        if($insertar){
                            foreach($insertar as $val){
                                $vector[1] = $val->insertar_persona;
                            }
                            $verificar_paren = Persona::verificar_paren($vector[0], $vector[1]);
                            if(empty($verificar_paren)){
                                $insertar_paren = Persona::insertar_parentesco($vector[0], $vector[1], $parentesco);
                                if($insertar_paren)
                                    return 1;
                                else return 2;
                            }
                            else return 2;
                        }
                        return 2;
                    }
                    else{
                        foreach($verificar as $val){
                            $vector[1] = $val->id;
                        }
                        $insertar_paren = Persona::insertar_parentesco($vector[0], $vector[1], $parentesco);
                        if($insertar_paren)
                            return 1;
                        else return 2;
                    }
                    
                }
            }
            else{
                foreach($verificar_ben as $val){
                    $vector[0] = $val->id;
                }

                $verificar = Persona::verificar_persona($cip);
                if(empty($verificar)){
                    $insertar = Persona::insertar_persona($ape_patp, $ape_matp, $nombresp, $cip, $fechap, $generop, $domicilio, $telp, $ocup, $tel_persp, $usuario);
                    if($insertar){
                        foreach($insertar as $val){
                            $vector[1] = $val->insertar_persona;
                        }

                        $verificar_paren = Persona::verificar_paren($vector[0], $vector[1]);
                        if(empty($verificar_paren)){
                            $insertar_paren = Persona::insertar_parentesco($vector[0], $vector[1], $parentesco);
                            if($insertar_paren)
                                return 1;
                            else return 2;
                        }
                        else return 2;
                    }
                    else return 2;
                }
                else{
                    foreach($verificar as $val){
                        $vector[1] = $val->id;
                    }

                    $verificar_paren = Persona::verificar_paren($vector[0], $vector[1]);
                    if(empty($verificar_paren)){
                        $insertar_paren = Persona::insertar_parentesco($vector[0], $vector[1], $parentesco);
                        if($insertar_paren)
                            return 1;
                        else return 2;
                    }
                    else return 2;
                }
            }
        }
        
    }

    public function buscar_persona(){
        if(!empty(session('usuario'))){
            $vector = array();
            $ci = $_POST['no'];
            $buscar = Persona::verificar_persona($ci);
            if(!empty($buscar)){
                foreach($buscar as $val){
                    $vector[0] = $val->apell_pat;
                    $vector[1] = $val->apell_mat;
                    $vector[2] = $val->nombres;
                    $vector[3] = $val->no_ci;
                    $fecha = explode("-", $val->fecha_nac);
                    $vector[4] = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                    $vector[5] = $val->sexo;
                    $vector[6] = $val->ocupacion_id;
                    $vector[7] = $val->fono;
                    $vector[8] = $val->celular;
                    $vector[9] = $val->direc;
                }
                return [1, $vector];
            }
            else return 2;
        }
    }

    public function mostrar_ocupacion(){
        if(!empty(session('usuario'))){
            $id = $_POST['id'];
            $html = "";
            $lista = Persona::listar_ocupacion();
            if(count($lista)>0){
                foreach($lista as $val){
                    if ($val->id == $id) {
                        $html.="<option value='".$val->id."'>".$val->descrip."</option>";
                    }
                    
                }
    
                foreach($lista as $val){
                    if ($val->id != $id) {
                        $html.="<option value='".$val->id."'>".$val->descrip."</option>";
                    }
                    
                }
            }
            return $html;
        }
    }

    public function listar_ocupacion(){
        if(!empty(session('usuario'))){
            $html = "";
            $lista = Persona::listar_ocupacion();
            if(count($lista)>0){
                $html.="<option value='' disabled selected>".'Seleccionar Ocupación'."</option>";
                foreach($lista as $val){
                    $html.="<option value='".$val->id."'>".$val->descrip."</option>";
                    
                }
            }
            return $html;
        }
    }

    public function listar_parentesco(){
        if(!empty(session('usuario'))){
            $html = "";
            $lista = Persona::listar_parentesco();
            if(count($lista)>0){
                $html.="<option value='' disabled selected>".'Seleccionar Parentesco'."</option>";
                foreach($lista as $val){
                    if(!str_contains($val->descrip, 'HIJ'))
                        $html.="<option value='".$val->id."'>".$val->descrip."</option>";
                    
                }
            }
            return $html;
        }
    }

    public function recuperar_fecha(){
        date_default_timezone_set("America/La_Paz");
        $fechaB = date('d-m-Y');
        $fecha = date('Y-m-d', strtotime($fechaB."- 1 month"));
        $fecha = explode("-", $fecha);
        $fechaA = $fecha[2]."-".$fecha[1]."-".$fecha[0];
        
        return [$fechaA, $fechaB];
    }

    public function ver_lista_ninos(){
        $vector = Array();
        $bandera = 1;
        $usuario = session('usuario');
        if(!empty($usuario)){
            $consulta = Persona::listar_ninos();
            if(count($consulta) > 0){
                foreach($consulta as $val){
                    $vector[] = array(
                        "valor" => '1',
                        "numero" => $bandera,
                        "id" => $val->ide,
                        "ci" => $val->no_cie,
                        "nombres" => $val->nombrese." ".($val->ape_pate != ''?$val->ape_pate:"")." ".($val->ape_mate != ''?$val->ape_mate:""),
                        "fecha_nac" => $val->fecha_nace,
                        "edad" => ($val->anioe==0 && $val->mese==0?$val->diae." días":($val->anioe==0 && $val->mese>0?$val->mese." mes(es) ":($val->anioe>0 && $val->mese==0?$val->anioe." año(s)":($val->anioe>4?$val->anioe." años":$val->anioe." años ".$val->mese." mes(es)")))),
                        "sexo" => ($val->sexoe=="M"?"MASCULINO":"FEMENINO"),
                    );
                    $bandera++;
                }
                return Datatables::of($vector)->addColumn('boton', 'botones.btn_buscar')->rawColumns(['boton'])->toJson(); 
                
            }
            return Datatables::of($vector)->toJson();
        }
        
    }

    public function obtener_tutores(){
        if(!empty(session('usuario'))){
            $id = $_POST['id'];
            $vector = array();
            $i = 0;
            $obtener = Persona::obtener_tutores($id);
            if(count($obtener)>0){
                foreach($obtener as $val){
                    $vector[$i++] = $val->ide;
                    $vector[$i++] = $val->perso_tutore;
                    $vector[$i++] = $val->descripe;
                }
            }
            return $vector;
        }
    }

    public function buscar_datos_persona(){
        if(!empty(session('usuario'))){
            $id = $_POST['id'];
            $vector = array();
            $buscar = Persona::buscar_persona($id);
            if(!empty($buscar)){
                foreach($buscar as $val){
                    $vector[0] = $val->id;
                    $vector[1] = $val->apell_pat;
                    $vector[2] = $val->apell_mat;
                    $vector[3] = $val->nombres;
                    $vector[4] = $val->no_ci;
                    $fecha = explode("-", $val->fecha_nac);
                    $vector[5] = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                    $vector[6] = $val->sexo;
                    $vector[7] = $val->direc;
                    $vector[8] = $val->fono;
                    $vector[9] = $val->ocupacion_id;
                    $vector[10] = $val->estado;
                    $vector[11] = $val->celular;
                }
            }
            return $vector;
        }
    }

    public function actualizar_datos_ben(){
        $usuario = session('id');
        if(!empty($usuario)){
            $id = $_POST['ben'];
            $ci = $_POST['cie'];
            $nombres = $_POST['nombree'];
            $ape_pat = $_POST['ape_pate'];
            $ape_mat = $_POST['ape_mate'];
            $fecha = $_POST['fechae'];
            $genero = $_POST['gene'];
            if($ci != ''){
                $buscar=Persona::buscar_persona($id);
                if(!empty($buscar)){
                    foreach($buscar as $val){
                        $civ = $val->no_ci;
                    }
                }
                $ban=2;
                $verificar = Persona::verificar_persona($ci);
                if(!empty($verificar)){
                    foreach($verificar as $val){
                        $cie = $val->no_ci;
                    }
                    if($civ == $cie) $ban = 1;
                }
                else $ban=1;
                
                if($ban == 1){
                    $actualizar = Persona::actualizar_ben($id, $ci, $nombres, $ape_pat, $ape_mat, $fecha, $genero, $usuario);
                    if($actualizar){
                        return 1;
                    }
                    return 0;
                }
                else if($ban == 2) return 2;
            }
            else{
                $actualizar = Persona::actualizar_ben($id, $ci, $nombres, $ape_pat, $ape_mat, $fecha, $genero, $usuario);
                if($actualizar){
                    return 1;
                }
                return 0;
            }
        }
    }

    public function actualizar_datos_persona(){
        $usuario = session('id');
        if(!empty($usuario)){
            $id = $_POST['tutor'];
            $ci = $_POST['cipe'];
            $nombres = $_POST['nombrepe'];
            $ape_pat = $_POST['ape_patpe'];
            $ape_mat = $_POST['ape_matpe'];
            $fecha = $_POST['fechape'];
            $genero = $_POST['genpe'];
            $direc = $_POST['dompe'];
            $fono = $_POST['telpe'];
            $celular = $_POST['tel_perspe'];
            $ocupacion = $_POST['ocupe'];
            $buscar=Persona::buscar_persona($id);
            if(!empty($buscar)){
                foreach($buscar as $val){
                    $civ = $val->no_ci;
                }
            }
            $ban=2;
            $verificar = Persona::verificar_persona($ci);
            if(!empty($verificar)){
                foreach($verificar as $val){
                    $cie = $val->no_ci;
                }
                if($civ == $cie) $ban = 1;
            }
            else $ban=1;
            
            if($ban == 1){
                $actualizar = Persona::actualizar_persona($id, $ape_pat, $ape_mat, $nombres, $ci, $fecha, $genero, $direc, $fono, $ocupacion, $celular, $usuario);
                if($actualizar){
                    return 1;
                }
                return 0;
            }
            else if($ban == 2) return 2;
        }
    }

    public function agregar_persona(){
        $usuario = session('id');
        if(!empty($usuario)){
            $parentesco = $_POST['parena'];
            $cip = $_POST['cipa'];
            $nombresp = $_POST['nombrepa'];
            $ape_patp = $_POST['ape_patpa'];
            $ape_matp = $_POST['ape_matpa'];
            $fechap = $_POST['fechapa'];
            $generop = $_POST['genpa'];
            $domicilio = $_POST['dompa'];
            $tel_persp = $_POST['tel_perspa'];
            $telp = $_POST['telpa'];
            $ocup = $_POST['ocupa'];
            $vector = array();
            $vector[0] = $_POST['ben2'];
            $verificar = Persona::verificar_persona($cip);
            if(empty($verificar)){
                $insertar = Persona::insertar_persona($ape_patp, $ape_matp, $nombresp, $cip, $fechap, $generop, $domicilio, $telp, $ocup, $tel_persp, $usuario);
                if($insertar){
                    foreach($insertar as $val){
                        $vector[1] = $val->insertar_persona;
                    }
                    $verificar_paren = Persona::verificar_paren($vector[0], $vector[1]);
                    if(empty($verificar_paren)){
                        $insertar_paren = Persona::insertar_parentesco($vector[0], $vector[1], $parentesco);
                        if($insertar_paren)
                            return [1, $vector[0]];
                        else return [2];
                    }
                    else return [2];
                }
                else return [2];
            }
            else return [2];
        }
    }

    public function registrar_ocupacion(){
        $actualizar = Inscripcion::actualizar_estados();
        return view('ocupacion');
    }

    public function ver_lista_ocupaciones(){
        $vector = Array();
        $bandera = 1;
        $usuario = session('usuario');
        if(!empty($usuario)){
            $consulta = Persona::listar_todo_ocupaciones();
            if(count($consulta) > 0){
                foreach($consulta as $val){
                    if($val->estado=="A"){
                        $vector[] = array(
                            "valor" => '2',
                            "numero" => $bandera,
                            "id" => $val->id,
                            "descrip" => $val->descrip,
                            "estado" => ($val->estado=="A"?"ACTIVO":"BAJA"),
                        );
                        $bandera++;
                    }
                    
                }
                return Datatables::of($vector)->addColumn('boton', 'botones.btn_buscar')->rawColumns(['boton'])->toJson(); 
                
            }
            return Datatables::of($vector)->toJson();
        }
    }

    public function agregar_ocupacion(){
        $usuario = session('usuario');
        if(!empty($usuario)){
            $descrip = $_POST['fullname'];
            $verificar = Persona::verificar_ocupacion($descrip);
            if(empty($verificar)){
                $insertar = Persona::insertar_ocupacion($descrip);
                if($insertar)
                    return 1;
                else return 2;
            }
            else return 2;
        }
    }

    public function obtener_ocupacion(){
        if(!empty(session('usuario'))){
            $lista = Persona::listar_todo_ocupaciones();
            $id=$_POST['id'];
            $vector = array();
            if(count($lista)>0){
                foreach($lista as $val){
                    if ($val->id == $id) {
                        $vector[0]=$val->id;
                        $vector[1]=$val->descrip;
                        $vector[2]=$val->estado;
                    }
                    
                }
            }
            return $vector;
        }
    }

    public function actualizar_datos_ocu(){
        $usuario = session('id');
        if(!empty($usuario)){
            $id = $_POST['ide'];
            $ci = $_POST['fullnam'];
            $estado = $_POST['gene'];
            $verificar = Persona::verificar_ocupacion($ci);
            if(count($verificar)>0){
                foreach($verificar as $val){
                    $ide = $val->id;
                }
                if($id == $ide){
                    $act = Persona::actualizar_ocupacion($id, $ci, $estado);
                    if($act) return 1;
                    else return 0;
                }
                else return 2;
                
            }
            else{
                $act = Persona::actualizar_ocupacion($id, $ci, $estado);
                if($act) return 1;
                else return 0;
            }
        }
    }

    public function ver_lista_ocupaciones_valor(){
        $valor1 = $_POST['est_ped1'];
        $valor2 = $_POST['est_ped2'];
        $usuario = session('usuario');
        if(!empty($usuario)){
            if($valor1 == 0 && $valor2 == 0) $valor1='P';
            if($valor1 == 1) $valor1 = 'P';
            if($valor2 == 2) $valor2 = 'A';
            $vector = Array();
            $bandera = 1;
            $consulta = Persona::listar_todo_ocupacion_valor($valor1, $valor2);
            if(count($consulta) > 0){
                foreach($consulta as $val){
                    $vector[] = array(
                        "valor" => '2',
                        "numero" => $bandera,
                        "id" => $val->id,
                        "descrip" => $val->descrip,
                        "estado" => ($val->estado=="A"?"ACTIVO":"BAJA"),
                    );
                    $bandera++;
                }
                return Datatables::of($vector)->addColumn('boton', 'botones.btn_buscar')->rawColumns(['boton'])->toJson(); 
                
            }
            return Datatables::of($vector)->toJson();
        }
    }

    public function listar_ninos(){
        if(!empty(session('usuario'))){
            $html = "";
            $lista = Persona::listar_ninos();
            if(count($lista)>0){
                $html.="<option value='' disabled selected>".'Seleccionar Niño/Niña'."</option>";
                foreach($lista as $val){
                    $html.="<option value='".$val->ide."'>".$val->no_cie." ".$val->nombrese." ".$val->ape_pate." ".$val->ape_mate."</option>";
                    
                }
            }
            return $html;
        }
    }

    public function listar_tutores(){
        if(!empty(session('usuario'))){
            $id = $_POST['id'];
            $html = "";
            $lista = Persona::listar_tutores($id);
            if(count($lista)>0){
                $html.="<option value='' disabled selected>Seleccionar Tutor</option>";
                foreach($lista as $val){
                    $html.="<option value='".$val->ide."'>".$val->no_cie." ".$val->nombrese." ".$val->ape_pate." ".$val->ape_mate."</option>";
                    
                }
            }
            return $html;
        }
    }

    public function listar_tutores_selec(){
        if(!empty(session('usuario'))){
            $ide = $_POST['ide'];
            $idt = $_POST['idt'];
            $html = "";
            $lista = Persona::listar_tutores($ide);
            if(count($lista)>0){
                foreach($lista as $val){
                    if($val->ide == $idt)
                        $html.="<option value='".$val->ide."'>".$val->no_cie." ".$val->nombrese." ".$val->ape_pate." ".$val->ape_mate."</option>";
                }
                foreach($lista as $val){
                    if($val->ide != $idt)
                        $html.="<option value='".$val->ide."'>".$val->no_cie." ".$val->nombrese." ".$val->ape_pate." ".$val->ape_mate."</option>";
                }
            }
            return $html;
        }
    }

}
