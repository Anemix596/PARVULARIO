<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Persona extends Model
{
    use HasFactory;

    public static function insertar_ben($ci, $nombres, $ape_pat, $ape_mat, $fecha, $genero, $usuario){
        $query=DB::select("SELECT *from insertar_ben('$ci', '$nombres', '$ape_pat', '$ape_mat', '$fecha', '$genero', '$usuario')");
        return $query;
    }

    public static function insertar_persona($apell_pate, $apell_mate, $nombrese, $no_cie, $fecha_nace, $sexoe, $direce, $fonoe, $ocupacion_ide, $celulare, $user_ide){
        $query=DB::select("SELECT *from insertar_persona('$apell_pate', '$apell_mate', '$nombrese', '$no_cie', '$fecha_nace', '$sexoe', '$direce', '$fonoe', '$ocupacion_ide', '$celulare', '$user_ide')");
        return $query;
    }

    public static function insertar_parentesco($id_benefeciario, $id_tutor, $tipo_persona){
        $query=DB::select("SELECT insertar_parentesco('$id_benefeciario', '$id_tutor', '$tipo_persona')");
        return $query;
    }

    public static function verificar_persona($cip){
        $query=DB::select("SELECT * FROM verificar_persona('$cip')");
        return $query;
    }

    public static function buscar_ocupacion($id){
        $query=DB::select("SELECT * FROM buscar_ocupacion('$id')");
        return $query;
    }

    public static function listar_ocupacion(){
        $query=DB::select("SELECT * FROM listar_ocupacion()");
        return $query;
    }

    public static function listar_todo_ocupaciones(){
        $query=DB::select("SELECT * FROM listar_todo_ocupacion()");
        return $query;
    }

    public static function listar_todo_ocupacion_valor($a, $b){
        $query=DB::select("SELECT * FROM listar_todo_ocupacion_valor('$a', '$b')");
        return $query;
    }

    public static function listar_parentesco(){
        $query=DB::select("SELECT * FROM listar_tipo_persona()");
        return $query;
    }

    public static function verificar_ben($ci, $nombres, $ape_pat, $ape_mat, $fecha, $genero){
        $query=DB::select("SELECT * FROM verificar_ben('$ci', '$nombres', '$ape_pat', '$ape_mat', '$fecha', '$genero')");
        return $query;
    }

    public static function listar_ninos(){
        $query=DB::select("SELECT * FROM listar_ninos()");
        return $query;
    }

    public static function listar_tutores($id){
        $query=DB::select("SELECT * FROM listar_tutores('$id')");
        return $query;
    }

    public static function obtener_tutores($id_nino){
        $query=DB::select("SELECT * FROM obtener_tutores('$id_nino')");
        return $query;
    }

    public static function buscar_persona($id){
        $query=DB::select("SELECT * FROM buscar_persona('$id')");
        return $query;
    }

    public static function actualizar_ben($id, $ci, $nombres, $ape_pat, $ape_mat, $fecha, $genero, $usuario){
        $query=DB::select("SELECT *from actualizar_ben('$id', '$ci', '$nombres', '$ape_pat', '$ape_mat', '$fecha', '$genero', '$usuario')");
        return $query;
    }

    public static function actualizar_persona($id, $apell_pate, $apell_mate, $nombrese, $no_cie, $fecha_nace, $sexoe, $direce, $fonoe, $ocupacion_ide, $celulare, $user_ide){
        $query=DB::select("SELECT *from actualizar_persona('$id', '$apell_pate', '$apell_mate', '$nombrese', '$no_cie', '$fecha_nace', '$sexoe', '$direce', '$fonoe', '$ocupacion_ide', '$celulare', '$user_ide')");
        return $query;
    }

    public static function verificar_paren($id, $id2){
        $query=DB::select("SELECT * FROM verificar_paren('$id', '$id2')");
        return $query;
    }

    public static function verificar_ocupacion($cip){
        $query=DB::select("SELECT * FROM verificar_ocupacion('$cip')");
        return $query;
    }

    public static function insertar_ocupacion($cip){
        $query=DB::select("SELECT * FROM insertar_ocupacion('$cip')");
        return $query;
    }

    public static function actualizar_ocupacion($id, $cip, $est){
        $query=DB::select("SELECT * FROM actualizar_ocupacion('$id', '$cip', '$est')");
        return $query;
    }

}
