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
    $query = $base_datos->conectar()->prepare("SELECT `id_motivo_desvinculacion`, `descripcion`,"
            . "IF(`estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `motivo_desvinculacion` WHERE estado = 1");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();
        foreach ($query as $fila) {
           array_push($arreglo, array(
                'id_motivo_desvinculacion' => $fila['id_motivo_desvinculacion'],
                'descripcion' => $fila['descripcion'],
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
    $query = $base_datos->conectar()->prepare("INSERT INTO `preaviso`( `id_motivo`, `dias`,
                       `desde`, `hasta`, `estado`, tipo, con_id) 
                       VALUES (:id_motivo, :dias, :desde, :hasta, :estado, :tipo, :con_id)");

    $query->execute([
        'id_motivo' => $json_datos['id_motivo'],
        'dias' => $json_datos['dias'],
        'desde' => $json_datos['desde'],
        'hasta' => $json_datos['hasta'],
        'con_id' => $json_datos['con_id'],
        'tipo' => $json_datos['tipo'],
        'estado' => $json_datos['estado']
    ]);
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------


if (isset($_POST['dame_todo'])) {
    dameTodo($_POST['dame_todo']);
}

function dameTodo($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT 
p.id_preaviso,
p.id_motivo, 
p.dias, 
p.desde,
p.hasta, 
p.tipo, 
IF(p.estado = 1, 'ACTIVO','INACTIVO') as estado,
m.descripcion as  motivo
FROM preaviso p
JOIN motivo_desvinculacion m 
ON m.id_motivo_desvinculacion = p.id_motivo
WHERE p.con_id = $id
ORDER BY p.id_preaviso desc
");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'id_preaviso' => $fila['id_preaviso'],
                'dias' => $fila['dias'],
                'desde' => $fila['desde'],
                'hasta' => $fila['hasta'],
                'tipo' => $fila['tipo'],
                'motivo' => $fila['motivo'],
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


if (isset($_POST['dame_activo'])) {
    dame_activo($_POST['dame_activo']);
}

function dame_activo($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT 
p.id_preaviso,
p.id_motivo, 
p.dias, 
p.desde,
p.hasta, 
p.tipo, 
IF(p.estado = 1, 'ACTIVO','INACTIVO') as estado,
m.descripcion as  motivo
FROM preaviso p
JOIN motivo_desvinculacion m 
ON m.id_motivo_desvinculacion = p.id_motivo
WHERE p.con_id = $id and p.estado = 1
ORDER BY p.id_preaviso desc
");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'id_preaviso' => $fila['id_preaviso'],
                'dias' => $fila['dias'],
                'desde' => $fila['desde'],
                'hasta' => $fila['hasta'],
                'tipo' => $fila['tipo'],
                'motivo' => $fila['motivo'],
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
    $query = $base_datos->conectar()->prepare("SELECT `id_motivo_desvinculacion`, `descripcion`,"
            . "`estado` as estado "
            . "FROM `motivo_desvinculacion` WHERE id_motivo_desvinculacion = $id");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
             array_push($arreglo, array(
                'id_motivo_desvinculacion' => $fila['id_motivo_desvinculacion'],
                'descripcion' => $fila['descripcion'],
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
    $query = $base_datos->conectar()->prepare("UPDATE `motivo_desvinculacion` SET "
            . "`descripcion`=:descripcion,`estado`=:estado WHERE id_motivo_desvinculacion = :id_motivo_desvinculacion");

    $query->execute([
        'descripcion' => $json_datos['descripcion'],
        'estado' => $json_datos['estado'],
        'id_motivo_desvinculacion' => $json_datos['id_motivo_desvinculacion']
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
            . " DELETE FROM preaviso "
            . " WHERE id_preaviso = $id");

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
            . " UPDATE preaviso SET estado = 0 "
            . " WHERE id_preaviso = $id");

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
    $query = $base_datos->conectar()->prepare("SELECT `id_motivo_desvinculacion`, `descripcion`,"
            . "IF(`estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `motivo_desvinculacion` WHERE UPPER(descripcion) LIKE '%$nombre%'");

    $query->execute();
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
             array_push($arreglo, array(
                'id_motivo_desvinculacion' => $fila['id_motivo_desvinculacion'],
                'descripcion' => $fila['descripcion'],
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
    $query = $base_datos->conectar()->prepare("SELECT `id_motivo_desvinculacion`, `descripcion`,"
            . "IF(`estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `motivo_desvinculacion` WHERE UPPER(descripcion) LIKE '$nombre'");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();
        foreach ($query as $fila) {
             array_push($arreglo, array(
                'id_motivo_desvinculacion' => $fila['id_motivo_desvinculacion'],
                'descripcion' => $fila['descripcion'],
                'estado' => $fila['estado']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}
