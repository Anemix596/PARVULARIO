<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Inscripcion extends Model
{
    use HasFactory;

    public static function listar_nivel(){
        $query=DB::select("SELECT * FROM listar_nivel()");
        return $query;
    }

    public static function insertar_inscripcion($est, $obser, $user, $vive){
        $query=DB::select("SELECT * FROM insertar_inscripcion('$est', '$obser', '$user', '$vive')");
        return $query;
    }
    
    public static function insertar_cobro_mens($inscrip, $est, $precio, $ini_vigencia, $fin_vigencia, $periodo, $tutor, $user, $nivel, $turno){
        $query=DB::select("SELECT * FROM insertar_cobro_mens('$inscrip', '$est', '$precio', '$ini_vigencia', '$fin_vigencia', '$periodo', '$tutor', '$user', '$nivel', '$turno')");
        return $query;
    }

    public static function verificar_inscrip($est){
        $query=DB::select("SELECT * FROM verificar_inscrip('$est')");
        return $query;
    }

    public static function verificar_periodo($est, $periodo){
        $query=DB::select("SELECT * FROM verificar_periodo('$est', '$periodo')");
        return $query;
    }

    public static function listar_todo_nivel(){
        $query=DB::select("SELECT * FROM listar_todo_nivel()");
        return $query;
    }

    public static function listar_todo_nivel_valor($valor1, $valor2){
        $query=DB::select("SELECT * FROM listar_todo_nivel_valor('$valor1', '$valor2')");
        return $query;
    }

    public static function insertar_nivel($descrip, $costo, $gestion){
        $query=DB::select("SELECT * FROM insertar_nivel('$descrip', '$costo', '$gestion')");
        return $query;
    }

    public static function verificar_nivel($descrip){
        $query=DB::select("SELECT * FROM verificar_nivel('$descrip')");
        return $query;
    }

    public static function actualizar_nivel($id, $descrip, $costo, $gestion, $estado){
        $query=DB::select("SELECT * FROM actualizar_nivel('$id', '$descrip', '$costo', '$gestion', '$estado')");
        return $query;
    }

    public static function obtener_tutor(){
        $query=DB::select("SELECT * FROM obtener_tutor()");
        return $query;
    }

    public static function listar_inscripcion(){
        $query=DB::select("SELECT * FROM listar_inscripcion()");
        return $query;
    }

    public static function listar_inscripcion_vigente(){
        $query=DB::select("SELECT * FROM listar_inscripcion_vigente()");
        return $query;
    }

    public static function listar_inscripcion_baja(){
        $query=DB::select("SELECT * FROM listar_inscripcion_baja()");
        return $query;
    }

    public static function listar_cobro($estudiante){
        $query=DB::select("SELECT * FROM listar_cobro('$estudiante')");
        return $query;
    }

    public static function listar_cobro2($estudiante){
        $query=DB::select("SELECT * FROM listar_cobro2('$estudiante')");
        return $query;
    }

    public static function listar_inscripcion_valor($valor1, $valor2){
        $query=DB::select("SELECT * FROM listar_inscripcion_valor('$valor1', '$valor2')");
        return $query;
    }

    public static function obtener_datos_inscripcion($id){
        $query=DB::select("SELECT * FROM obtener_datos_inscripcion('$id')");
        return $query;
    }

    public static function obtener_datos_cobro($id){
        $query=DB::select("SELECT * FROM obtener_datos_cobro('$id')");
        return $query;
    }

    public static function actualizar_inscripcion($id, $obser, $vive, $turno, $fechai, $fechaf, $precio){
        $query=DB::select("SELECT * FROM actualizar_inscripcion('$id', '$obser', '$vive', '$turno', '$fechai', '$fechaf', '$precio')");
        return $query;
    }

    public static function actualizar_cobro($id, $turno, $fechai, $fechaf, $precio){
        $query=DB::select("SELECT * FROM actualizar_cobro('$id', '$turno', '$fechai', '$fechaf', '$precio')");
        return $query;
    }

    public static function actualizar_inscrip($id){
        $query=DB::select("SELECT * FROM actualizar_inscrip('$id')");
        return $query;
    }

    public static function actualizar_estados(){
        $query=DB::select("SELECT * FROM actualizar_estados()");
        return $query;
    }

    public static function verificar_devolucion($id){
        $query=DB::select("SELECT * FROM verificar_devolucion('$id')");
        return $query;
    }

    public static function insertar_devolucion($cobro, $est, $dias, $monto, $tutor, $motivo, $monto_ant, $usuario){
        $query=DB::select("SELECT * FROM insertar_devolucion('$cobro', '$est', '$dias', '$monto', '$tutor', '$motivo', '$monto_ant', '$usuario')");
        return $query;
    }

    public static function actualizar_devolucion($cobro, $dias, $monto, $tutor, $motivo, $usuario){
        $query=DB::select("SELECT * FROM actualizar_devolucion('$cobro', '$dias', '$monto', '$tutor', '$motivo', '$usuario')");
        return $query;
    }

    public static function obtener_datos_devolucion($id){
        $query=DB::select("SELECT * FROM obtener_datos_devolucion('$id')");
        return $query;
    }

    public static function obtener_ultima_fecha($id){
        $query=DB::select("SELECT * FROM obtener_ultima_fecha('$id')");
        return $query;
    }

    public static function dar_baja($id, $usuario){
        $query=DB::select("SELECT * FROM dar_baja('$id', '$usuario')");
        return $query;
    }
}
