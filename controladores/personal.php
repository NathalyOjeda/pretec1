<?php

require_once '../conexion/db.php';
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

if (isset($_POST['dame_activos_color'])) {
    dameActivos();
}

function dameActivos() {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `dep_id`, `dep_descri`,"
            . "IF(`dep_estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `departamento` WHERE dep_estado = 1");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();
        foreach ($query as $fila) {
            array_push($arreglo, array(
                'dep_id' => $fila['dep_id'],
                'dep_descri' => $fila['dep_descri'],
                'estado' => $fila['estado']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//guardar
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO `personal`( `per_apell`, `per_nom`, 
                       `per_nacim`, `per_direc`, `per_genero`, 
                       `per_ciud`, `per_nacion`, `per_est_civ`, `per_correo`, `per_telfono`, cedula) 
                       VALUES (:per_apell, :per_nom, :per_nacim, :per_direc, :per_genero,
                       :per_ciud, :per_nacion, :per_est_civ, :per_correo, :per_telfono, 
                       :cedula)");

    $query->execute([
        'per_apell' => $json_datos['apellido'],
        'per_nom' => $json_datos['nombre'],
        'cedula' => $json_datos['cedula'],
        'per_nacim' => $json_datos['fecha_nacimiento'],
        'per_direc' => $json_datos['direccion'],
        'per_genero' => $json_datos['genero'],
        'per_ciud' => $json_datos['ciudad'],
        'per_nacion' => $json_datos['nacion'],
        'per_est_civ' => $json_datos['estado_civil'],
        'per_correo' => $json_datos['correo'],
        'per_telfono' => $json_datos['telefono']
    ]);
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------


if (isset($_POST['dame_todo'])) {
    dameTodo();
}

function dameTodo() {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `per_id`, `per_apell`, "
            . "`per_nom`, `per_nacim`, `per_direc`, `per_genero`,"
            . " `per_ciud`, `per_nacion`, `per_est_civ`, `per_correo`,"
            . " `per_telfono`, cedula FROM `personal`");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'per_id' => $fila['per_id'],
                'per_apell' => $fila['per_apell'],
                'per_nom' => $fila['per_nom'],
                'cedula' => $fila['cedula'],
                'per_nacim' => $fila['per_nacim'],
                'per_direc' => $fila['per_direc'],
                'per_genero' => $fila['per_genero'],
                'per_ciud' => $fila['per_ciud'],
                'per_nacion' => $fila['per_nacion'],
                'per_est_civ' => $fila['per_est_civ'],
                'per_correo' => $fila['per_correo'],
                'per_telfono' => $fila['per_telfono']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------


if (isset($_POST['ultimo_registro'])) {
    ultimo_registro();
}

function ultimo_registro() {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `per_id`, `per_apell`, "
            . "`per_nom`, `per_nacim`, `per_direc`, `per_genero`,"
            . " `per_ciud`, `per_nacion`, `per_est_civ`, `per_correo`,"
            . " `per_telfono`, cedula FROM `personal` ORDER BY per_id DESC limit 1");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'per_id' => $fila['per_id'],
                'per_apell' => $fila['per_apell'],
                'per_nom' => $fila['per_nom'],
                'cedula' => $fila['cedula'],
                'per_nacim' => $fila['per_nacim'],
                'per_direc' => $fila['per_direc'],
                'per_genero' => $fila['per_genero'],
                'per_ciud' => $fila['per_ciud'],
                'per_nacion' => $fila['per_nacion'],
                'per_est_civ' => $fila['per_est_civ'],
                'per_correo' => $fila['per_correo'],
                'per_telfono' => $fila['per_telfono']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------


if (isset($_POST['id'])) {
    registroPorID($_POST['id']);
}

function registroPorID($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `per_id`, `per_apell`, "
            . "`per_nom`, `per_nacim`, `per_direc`, `per_genero`,"
            . " `per_ciud`, `per_nacion`, `per_est_civ`, `per_correo`,"
            . " `per_telfono`, cedula FROM `personal` WHERE per_id = $id");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'per_id' => $fila['per_id'],
                'per_apell' => $fila['per_apell'],
                'per_nom' => $fila['per_nom'],
                'cedula' => $fila['cedula'],
                'per_nacim' => $fila['per_nacim'],
                'per_direc' => $fila['per_direc'],
                'per_genero' => $fila['per_genero'],
                'per_ciud' => $fila['per_ciud'],
                'per_nacion' => $fila['per_nacion'],
                'per_est_civ' => $fila['per_est_civ'],
                'per_correo' => $fila['per_correo'],
                'per_telfono' => $fila['per_telfono']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

if (isset($_POST['actualizar'])) {
    actualizar($_POST['actualizar']);
}

function actualizar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("UPDATE `personal` SET "
            . "`per_apell` = :per_apell, `per_nom` = :per_nom , 
                       `per_nacim` = :per_nacim, `per_direc`= :per_direc, `per_genero` = :per_genero, 
                       `per_ciud` = :per_ciud, `per_nacion` = :per_nacion, 
                       `per_est_civ` = :per_est_civ, `per_correo` = :per_correo, 
                       `per_telfono` = :per_telfono, cedula= :cedula
                       WHERE per_id = :per_id");

    $query->execute([
        'per_id' => $json_datos['id_personal'],
        'per_apell' => $json_datos['apellido'],
        'per_nom' => $json_datos['nombre'],
        'cedula' => $json_datos['cedula'],
        'per_nacim' => $json_datos['fecha_nacimiento'],
        'per_direc' => $json_datos['direccion'],
        'per_genero' => $json_datos['genero'],
        'per_ciud' => $json_datos['ciudad'],
        'per_nacion' => $json_datos['nacion'],
        'per_est_civ' => $json_datos['estado_civil'],
        'per_correo' => $json_datos['correo'],
        'per_telfono' => $json_datos['telefono']
    ]);
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

if (isset($_POST['eliminar'])) {
    eliminar($_POST['eliminar']);
}

function eliminar($id) {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare(""
            . " DELETE FROM personal "
            . " WHERE per_id = $id");

    $query->execute();
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

if (isset($_POST['desactivar'])) {
    desactivar($_POST['desactivar']);
}

function desactivar($id) {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare(""
            . " UPDATE personal SET dep_estado = 0 "
            . " WHERE dep_id = $id");

    $query->execute();
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

if (isset($_POST['b_nombre'])) {
    buscarNombre($_POST['b_nombre']);
}

function buscarNombre($nombre) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $nombre = strtoupper($nombre);
    $sql = "SELECT `per_id`, `per_apell`, "
            . "`per_nom`, `per_nacim`, `per_direc`, `per_genero`,"
            . " `per_ciud`, `per_nacion`, `per_est_civ`, `per_correo`,"
            . " `per_telfono`, cedula FROM `personal` "
            . "WHERE UPPER(CONCAT(per_nom, ' ',per_apell)) LIKE '%$nombre%'";
    $query = $base_datos->conectar()->prepare($sql);
    
    $query->execute();
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'per_id' => $fila['per_id'],
                'per_apell' => $fila['per_apell'],
                'per_nom' => $fila['per_nom'],
                'cedula' => $fila['cedula'],
                'per_nacim' => $fila['per_nacim'],
                'per_direc' => $fila['per_direc'],
                'per_genero' => $fila['per_genero'],
                'per_ciud' => $fila['per_ciud'],
                'per_nacion' => $fila['per_nacion'],
                'per_est_civ' => $fila['per_est_civ'],
                'per_correo' => $fila['per_correo'],
                'per_telfono' => $fila['per_telfono']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
if (isset($_POST['b_nombre_exacto'])) {
    PorNombreExacto($_POST['b_nombre_exacto']);
}

function PorNombreExacto($nombre) {
    $nombre = strtoupper($nombre);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `per_id`, `per_apell`, "
            . "`per_nom`, `per_nacim`, `per_direc`, `per_genero`,"
            . " `per_ciud`, `per_nacion`, `per_est_civ`, `per_correo`,"
            . " `per_telfono`, cedula FROM `personal` "
            . "WHERE cedula = $nombre");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();
        foreach ($query as $fila) {
            array_push($arreglo, array(
                'per_id' => $fila['per_id'],
                'per_apell' => $fila['per_apell'],
                'per_nom' => $fila['per_nom'],
                'cedula' => $fila['cedula'],
                'per_nacim' => $fila['per_nacim'],
                'per_direc' => $fila['per_direc'],
                'per_genero' => $fila['per_genero'],
                'per_ciud' => $fila['per_ciud'],
                'per_nacion' => $fila['per_nacion'],
                'per_est_civ' => $fila['per_est_civ'],
                'per_correo' => $fila['per_correo'],
                'per_telfono' => $fila['per_telfono']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
