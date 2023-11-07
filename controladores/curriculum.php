<?php

require_once '../conexion/db.php';

//guardar
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO `curriculum`(`cur_id`,
                         `cur_fecha`, `cur_des`, 
                         `per_id`, `estado`) VALUES ((SELECT IF(MAX(c.cur_id) IS NULL, 1 , 
                         MAX(c.cur_id) + 1)  FROM curriculum c), :cur_fecha, :cur_des, 
                         :per_id, :estado)");

    $query->execute([
        'cur_fecha' => $json_datos['cur_fecha'],
        'cur_des' => $json_datos['cur_des'],
        'per_id' => $json_datos['per_id'],
        'estado' => $json_datos['estado']
    ]);
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------


if (isset($_POST['ultimoID'])) {
    ultimoID();
}

function ultimoID() {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT MAX(`cur_id`) AS id"
            . " FROM `curriculum`");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            echo $fila['id'];
        }
        
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
    $query = $base_datos->conectar()->prepare("SELECT `cur_id`, `"
            . "cur_fecha`, `cur_des`, `per_id`, `estado`"
            . " FROM `curriculum` WHERE cur_id = $id");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'cur_id' => $fila['cur_id'],
                'cur_fecha' => $fila['cur_fecha'],
                'cur_des' => $fila['cur_des'],
                'per_id' => $fila['per_id'],
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


if (isset($_POST['existe_personal'])) {
    existePersonal($_POST['existe_personal']);
}

function existePersonal($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `cur_id`, `"
            . "cur_fecha`, `cur_des`, `per_id`, `estado`"
            . " FROM `curriculum` WHERE per_id = $id");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'cur_id' => $fila['cur_id'],
                'cur_fecha' => $fila['cur_fecha'],
                'cur_des' => $fila['cur_des'],
                'per_id' => $fila['per_id'],
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
    $query = $base_datos->conectar()->prepare("UPDATE  `curriculum` SET
                         `cur_fecha` = :cur_fecha, `cur_des` = :cur_des, 
                         `per_id`= :per_id, `estado` = :estado 
                         WHERE `cur_id`= :cur_id ");

    $query->execute([
       'cur_fecha' => $json_datos['cur_fecha'],
        'cur_des' => $json_datos['cur_des'],
        'per_id' => $json_datos['per_id'],
        'cur_id' => $json_datos['cur_id'],
        'estado' => $json_datos['estado']
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
            . " DELETE FROM cargos "
            . " WHERE car_id = $id");

    $query->execute();
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

if (isset($_POST['anular'])) {
    desactivar($_POST['anular']);
}

function desactivar($id) {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare(""
            . " UPDATE curriculum SET estado = 'ANULADO' "
            . " WHERE cur_id = $id");

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
    $query = $base_datos->conectar()->prepare("SELECT 
            c.cur_id,
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            c.cur_fecha,
            c.estado
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            WHERE UPPER(CONCAT(p.per_nom,' ',p.per_apell)) like '%$nombre%'
            LIMIT 20");

    $query->execute();
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'cur_id' => $fila['cur_id'],
                'personal' => $fila['personal'],
                'cedula' => $fila['cedula'],
                'cur_fecha' => $fila['cur_fecha'],
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
    $query = $base_datos->conectar()->prepare("SELECT `car_id`, `car_descri`,"
            . "IF(`estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `cargos` WHERE UPPER(car_descri) LIKE '$nombre'");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();
        foreach ($query as $fila) {
            array_push($arreglo, array(
                'car_id' => $fila['car_id'],
                'car_descri' => $fila['car_descri'],
                'estado' => $fila['estado']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}
