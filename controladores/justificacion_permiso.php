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
    $query = $base_datos->conectar()->prepare("SELECT jus_per_id, `just_per_de`,"
            . "IF(`just_estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `justi_perm` WHERE just_estado = 1");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'jus_per_id' => $fila['jus_per_id'],
                'just_per_de' => $fila['just_per_de'],
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
    $query = $base_datos->conectar()->prepare("INSERT INTO `justi_perm`( 
        `just_per_de`, `just_estado`) 
        VALUES (:just_per_de, :estado)");

    $query->execute([
        'just_per_de' => $json_datos['descripcion'],
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
    $query = $base_datos->conectar()->prepare("SELECT jus_per_id, `just_per_de`,"
            . "IF(`just_estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `justi_perm`");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'jus_per_id' => $fila['jus_per_id'],
                'just_per_de' => $fila['just_per_de'],
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
    $query = $base_datos->conectar()->prepare("SELECT `jus_per_id`, `just_per_de`,"
            . "`just_estado` as estado "
            . "FROM `justi_perm` WHERE jus_per_id = $id");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'jus_per_id' => $fila['jus_per_id'],
                'just_per_de' => $fila['just_per_de'],
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
    $query = $base_datos->conectar()->prepare("UPDATE `justi_perm` SET "
            . "`just_per_de`=:descripcion,`just_estado`=:estado "
            . "WHERE jus_per_id = :id_justificacion_permiso");

    $query->execute([
        'descripcion' => $json_datos['descripcion'],
        'estado' => $json_datos['estado'],
        'id_justificacion_permiso' => $json_datos['id_justificacion_permiso']
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
            . " DELETE FROM justi_perm "
            . " WHERE jus_per_id = $id");

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
            . " UPDATE justi_perm SET just_estado = 0 "
            . " WHERE jus_per_id = $id");

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
    $query = $base_datos->conectar()->prepare("SELECT jus_per_id, `just_per_de`,"
            . "IF(`just_estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `justi_perm` WHERE UPPER(just_per_de) LIKE '%$nombre%'");

    $query->execute();
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'jus_per_id' => $fila['jus_per_id'],
                'just_per_de' => $fila['just_per_de'],
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
    $query = $base_datos->conectar()->prepare("SELECT jus_per_id, `just_per_de`,"
            . "IF(`just_estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `justi_perm` WHERE UPPER(just_per_de) LIKE '$nombre'");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();
        foreach ($query as $fila) {
            array_push($arreglo, array(
                'jus_per_id' => $fila['jus_per_id'],
                'just_per_de' => $fila['just_per_de'],
                'estado' => $fila['estado']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}
