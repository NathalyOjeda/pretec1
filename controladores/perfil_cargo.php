<?php

require_once '../conexion/db.php';

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//guardar
if (isset($_POST['guardar_perfil'])) {
    guardar($_POST['guardar_perfil']);
}

function guardar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO `perfil_cargo` "
            . "(`car_id`,`descripcion`, estado) "
            . "VALUES (:car_id, :descripcion, :estado)");

    $query->execute([
        'car_id' => $json_datos['id_cargo'],
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
    $query = $base_datos->conectar()->prepare("SELECT `car_id`, `car_descri`,"
            . "IF(`estado` = 1, 'ACTIVO','INACTIVO') as estado, salario "
            . "FROM `cargos`");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'car_id' => $fila['car_id'],
                'car_descri' => $fila['car_descri'],
                'salario' => $fila['salario'],
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
    $query = $base_datos->conectar()->prepare("SELECT id_per_carg, car_id, descripcion, estado "
            . "FROM perfil_cargo WHERE car_id = $id");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'id_per_carg' => $fila['id_per_carg'],
                'car_id' => $fila['car_id'],
                'descripcion' => $fila['descripcion'],
                'estado' => $fila['estado']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}

if (isset($_POST['eliminar'])) {
    eliminar($_POST['eliminar']);
}

function eliminar($id) {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare(""
            . " DELETE FROM perfil_cargo "
            . " WHERE id_per_carg = $id");

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
            . " UPDATE perfil_cargo SET estado = 0 "
            . " WHERE id_per_carg = $id");

    $query->execute();
}