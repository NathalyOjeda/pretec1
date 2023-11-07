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
    $query = $base_datos->conectar()->prepare("SELECT `des_motiv_id`, 
        `des_mot_desci`, `estado`
        FROM `desc_motiv` 
        WHERE  estado = 1");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();
        foreach ($query as $fila) {
           array_push($arreglo, array(
                'des_motiv_id' => $fila['des_motiv_id'],
                'des_mot_desci' => $fila['des_mot_desci'],
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
    $query = $base_datos->conectar()->prepare("INSERT INTO `desc_motiv`"
            . "(`des_mot_desci`, `estado`) "
            . "VALUES (:descripcion, :estado)");

    $query->execute([
        'descripcion' => $json_datos['descripcion'],
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
    $query = $base_datos->conectar()->prepare("SELECT `des_motiv_id`, 
        `des_mot_desci`, if(`estado` = 1, 'ACTIVO', 'ANULADO') as estado
        FROM `desc_motiv` 
        ORDER by des_motiv_id desc 
        limit 10");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'des_motiv_id' => $fila['des_motiv_id'],
                'des_mot_desci' => $fila['des_mot_desci'],
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
    $query = $base_datos->conectar()->prepare("SELECT `des_motiv_id`, 
        `des_mot_desci`, `estado`
        FROM `desc_motiv` WHERE des_motiv_id = $id");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
             array_push($arreglo, array(
                'des_motiv_id' => $fila['des_motiv_id'],
                'des_mot_desci' => $fila['des_mot_desci'],
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
    $query = $base_datos->conectar()->prepare("UPDATE  `desc_motiv` SET "
            . "`des_mot_desci` = :descripcion, `estado` = :estado "
            . "WHERE des_motiv_id = :des_motiv_id");

    $query->execute([
        'descripcion' => $json_datos['descripcion'],
        'estado' => $json_datos['estado'],
        'des_motiv_id' => $json_datos['des_motiv_id']
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
            . " DELETE FROM desc_motiv "
            . " WHERE des_motiv_id = $id");

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
            . " UPDATE desc_motiv SET estado = 0 "
            . " WHERE des_motiv_id = $id");

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
    $query = $base_datos->conectar()->prepare("SELECT `des_motiv_id`, 
        `des_mot_desci`, if(`estado` = 1, 'ACTIVO', 'ANULADO') as estado
        FROM `desc_motiv` 
        WHERE UPPER(des_mot_desci) LIKE '%$nombre%'
        ORDER by des_motiv_id desc 
        limit 10 ");

    $query->execute();
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
             array_push($arreglo, array(
                'des_motiv_id' => $fila['des_motiv_id'],
                'des_mot_desci' => $fila['des_mot_desci'],
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
    $query = $base_datos->conectar()->prepare("SELECT `des_motiv_id`, 
        `des_mot_desci`, if(`estado` = 1, 'ACTIVO', 'ANULADO') as estado
        FROM `desc_motiv` 
        WHERE UPPER(des_mot_desci) LIKE '$nombre'
        ORDER by des_motiv_id desc 
        limit 10 ");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();
        foreach ($query as $fila) {
             array_push($arreglo, array(
                'des_motiv_id' => $fila['des_motiv_id'],
                'des_mot_desci' => $fila['des_mot_desci'],
                'estado' => $fila['estado']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}
