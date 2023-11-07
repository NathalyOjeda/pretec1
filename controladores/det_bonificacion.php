<?php

require_once '../conexion/db.php';

//guardar
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO `det_bonif`( `bon_id`, `nombre_apellido`,
                        `fecha_nacimiento`, `estado`) 
                        VALUES (:bon_id, :nombre_apellido, :fecha_nacimiento, :estado);");

    $query->execute([
        'bon_id' => $json_datos['bon_id'],
        'nombre_apellido' => $json_datos['nombre_apellido'],
        'fecha_nacimiento' => $json_datos['fecha_nacimiento'],
        'estado' => $json_datos['estado']
    ]);
}