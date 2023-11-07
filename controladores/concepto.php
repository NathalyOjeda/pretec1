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
    $query = $base_datos->conectar()->prepare("SELECT `id_concepto`, `descripcion`,"
            . "IF(`estado` = 1, 'ACTIVO','INACTIVO') as estado, monto "
            . "FROM `concepto` WHERE estado = 1");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();
        foreach ($query as $fila) {
           array_push($arreglo, array(
                'id_concepto' => $fila['id_concepto'],
                'descripcion' => $fila['descripcion'],
                'monto' => $fila['monto'],
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
    $query = $base_datos->conectar()->prepare("INSERT INTO `concepto`
        ( `descripcion`, `estado`, monto) 
        VALUES (:descripcion, :estado, :monto)");

    $query->execute([
        'descripcion' => $json_datos['descripcion'],
        'monto' => $json_datos['monto'],
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
    $query = $base_datos->conectar()->prepare("SELECT `id_concepto`, `descripcion`,"
            . "IF(`estado` = 1, 'ACTIVO','INACTIVO') as estado, monto "
            . "FROM `concepto`");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'id_concepto' => $fila['id_concepto'],
                'descripcion' => $fila['descripcion'],
                'monto' => $fila['monto'],
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
    $query = $base_datos->conectar()->prepare("SELECT `id_concepto`, `descripcion`,"
            . "`estado` as estado, monto "
            . "FROM `concepto` WHERE id_concepto = $id");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
             array_push($arreglo, array(
                'id_concepto' => $fila['id_concepto'],
                'descripcion' => $fila['descripcion'],
                'monto' => $fila['monto'],
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
    $query = $base_datos->conectar()->prepare("UPDATE `concepto` SET "
            . "`descripcion`=:descripcion,`estado`=:estado, monto = :monto WHERE id_concepto = :id_concepto");

    $query->execute([
        'descripcion' => $json_datos['descripcion'],
        'estado' => $json_datos['estado'],
        'monto' => $json_datos['monto'],
        'id_concepto' => $json_datos['id_concepto']
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
            . " DELETE FROM concepto "
            . " WHERE id_concepto = $id");

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
            . " UPDATE concepto SET estado = 0 "
            . " WHERE id_concepto = $id");

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
    $query = $base_datos->conectar()->prepare("SELECT `id_concepto`, `descripcion`,"
            . "IF(`estado` = 1, 'ACTIVO','INACTIVO') as estado, monto "
            . "FROM `concepto` WHERE UPPER(descripcion) LIKE '%$nombre%'");

    $query->execute();
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
             array_push($arreglo, array(
                'id_concepto' => $fila['id_concepto'],
                'descripcion' => $fila['descripcion'],
                'monto' => $fila['monto'],
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
    $query = $base_datos->conectar()->prepare("SELECT `id_concepto`, `descripcion`,"
            . "IF(`estado` = 1, 'ACTIVO','INACTIVO') as estado, monto "
            . "FROM `concepto` WHERE UPPER(descripcion) LIKE '$nombre'");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();
        foreach ($query as $fila) {
             array_push($arreglo, array(
                'id_concepto' => $fila['id_concepto'],
                'descripcion' => $fila['descripcion'],
                'monto' => $fila['monto'],
                'estado' => $fila['estado']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}
