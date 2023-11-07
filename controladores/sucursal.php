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
    $query = $base_datos->conectar()->prepare("INSERT INTO `sucursal`(
        `suc_descri`, `estado`) 
         VALUES (:suc_descri, :estado)");

    $query->execute([
        'suc_descri' => $json_datos['descripcion'],
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
    $query = $base_datos->conectar()->prepare("SELECT `suc_id`, `suc_descri`,"
            . "IF(`estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `sucursal`");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'suc_id' => $fila['suc_id'],
                'suc_descri' => $fila['suc_descri'],
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


if (isset($_POST['dame_activos'])) {
    dameActivo();
}

function dameActivo() {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `suc_id`, `suc_descri`,"
            . "IF(`estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `sucursal` WHERE estado = 1");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'suc_id' => $fila['suc_id'],
                'suc_descri' => $fila['suc_descri'],
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


//if (isset($_POST['dame_todo'])) {
//    dameTodo();
//}
//
//function dameTodo() {
////    $json_datos = json_decode($lista, true);
//    $base_datos = new DB();
//    $query = $base_datos->conectar()->prepare("SELECT `suc_id`, `suc_descri`,"
//            . "IF(`estado` = 1, 'ACTIVO','INACTIVO') as estado "
//            . "FROM `sucursal`");
//
//    $query->execute();
//
//    if ($query->rowCount()) {
//        $arreglo = array();
//
//        foreach ($query as $fila) {
//            array_push($arreglo, array(
//                'suc_id' => $fila['suc_id'],
//                'suc_descri' => $fila['suc_descri'],
//                'estado' => $fila['estado']
//            ));
//        }
//        echo json_encode($arreglo);
//    } else {
//        echo '0';
//    }
//}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------


if (isset($_POST['id'])) {
    registroPorID($_POST['id']);
}

function registroPorID($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `suc_id`, `suc_descri`,"
            . "`estado` as estado "
            . "FROM `sucursal` WHERE suc_id = $id");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
             array_push($arreglo, array(
                'suc_id' => $fila['suc_id'],
                'suc_descri' => $fila['suc_descri'],
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
    $query = $base_datos->conectar()->prepare("UPDATE `sucursal` SET "
            . "`suc_descri`=:descripcion,`estado`=:estado WHERE suc_id = :suc_id");

    $query->execute([
        'descripcion' => $json_datos['descripcion'],
        'estado' => $json_datos['estado'],
        'suc_id' => $json_datos['id_sucursal']
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
            . " DELETE FROM sucursal "
            . " WHERE suc_id = $id");

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
            . " UPDATE sucursal SET estado = 0 "
            . " WHERE suc_id = $id");

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
    $query = $base_datos->conectar()->prepare("SELECT `suc_id`, `suc_descri`,"
            . "IF(`estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `sucursal` WHERE UPPER(suc_descri) LIKE '%$nombre%'");

    $query->execute();
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
             array_push($arreglo, array(
                'suc_id' => $fila['suc_id'],
                'suc_descri' => $fila['suc_descri'],
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
    $query = $base_datos->conectar()->prepare("SELECT `suc_id`, `suc_descri`,"
            . "IF(`estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `sucursal` WHERE UPPER(suc_descri) LIKE '$nombre'");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();
        foreach ($query as $fila) {
             array_push($arreglo, array(
                'suc_id' => $fila['suc_id'],
                'suc_descri' => $fila['suc_descri'],
                'estado' => $fila['estado']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}
