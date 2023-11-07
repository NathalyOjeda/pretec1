<?php

require_once '../conexion/db.php';

//guardar
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO `curriculum_ref_laboral`( 
    `cur_id`, `nombre_apellido`, `telefono`, `descripcion`) 
    VALUES (:cur_id, :nombre_apellido, :telefono,  :descripcion)");

    $query->execute([
        'cur_id' => $json_datos['cur_id'],
        'nombre_apellido' => $json_datos['nombre_apellido'],
        'telefono' => $json_datos['telefono'],
        'descripcion' => $json_datos['descripcion']
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
    $query = $base_datos->conectar()->prepare("SELECT  `nombre_apellido`, `telefono`, `descripcion` 
FROM `curriculum_ref_laboral` 
WHERE `cur_id` = $id");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'nombre_apellido' => $fila['nombre_apellido'],
                'telefono' => $fila['telefono'],
                'descripcion' => $fila['descripcion']
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

if (isset($_POST['eliminar'])) {
    eliminar($_POST['eliminar']);
}

function eliminar($id) {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare(""
            . " DELETE FROM curriculum_ref_laboral "
            . " WHERE cur_id = $id");

    $query->execute();
}

