<?php

require_once '../conexion/db.php';
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

if (isset($_POST['dame_activos'])) {
    dameActivos();
}

function dameActivos() {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `mot_san_id`, `mot_san`,"
            . "IF(`estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `mot_sancion` WHERE estado = 1");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();
        foreach ($query as $fila) {
           array_push($arreglo, array(
                'mot_san_id' => $fila['mot_san_id'],
                'mot_san' => $fila['mot_san'],
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
    $query = $base_datos->conectar()->prepare("INSERT INTO `mot_sancion`
        ( `mot_san`, `estado`) 
        VALUES (:mot_san, :estado)");

    $query->execute([
        'mot_san' => $json_datos['descripcion'],
        'estado' => $json_datos['estado']
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
    $query = $base_datos->conectar()->prepare("SELECT `mot_san_id`, `mot_san`,"
            . "IF(`estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `mot_sancion`");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'mot_san_id' => $fila['mot_san_id'],
                'mot_san' => $fila['mot_san'],
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


if (isset($_POST['id'])) {
    registroPorID($_POST['id']);
}

function registroPorID($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `mot_san_id`, `mot_san`,"
            . "`estado` as estado "
            . "FROM `mot_sancion` WHERE mot_san_id = $id");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
             array_push($arreglo, array(
                'mot_san_id' => $fila['mot_san_id'],
                'mot_san' => $fila['mot_san'],
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

if (isset($_POST['actualizar'])) {
    actualizar($_POST['actualizar']);
}

function actualizar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("UPDATE `mot_sancion` SET "
            . "`mot_san`=:descripcion,`estado`=:estado WHERE mot_san_id = :id_motivo_sancion");

    $query->execute([
        'descripcion' => $json_datos['descripcion'],
        'estado' => $json_datos['estado'],
        'id_motivo_sancion' => $json_datos['id_motivo_sancion']
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
            . " DELETE FROM mot_sancion "
            . " WHERE mot_san_id = $id");

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
            . " UPDATE mot_sancion SET estado = 0 "
            . " WHERE mot_san_id = $id");

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
    $query = $base_datos->conectar()->prepare("SELECT `mot_san_id`, `mot_san`,"
            . "IF(`estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `mot_sancion` WHERE UPPER(mot_san) LIKE '%$nombre%'");

    $query->execute();
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
             array_push($arreglo, array(
                'mot_san_id' => $fila['mot_san_id'],
                'mot_san' => $fila['mot_san'],
                'estado' => $fila['estado']
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
    $query = $base_datos->conectar()->prepare("SELECT `mot_san_id`, `mot_san`,"
            . "IF(`estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `mot_sancion` WHERE UPPER(mot_san) LIKE '$nombre'");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();
        foreach ($query as $fila) {
             array_push($arreglo, array(
                'mot_san_id' => $fila['mot_san_id'],
                'mot_san' => $fila['mot_san'],
                'estado' => $fila['estado']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}
