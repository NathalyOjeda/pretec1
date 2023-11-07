<?php

require_once '../conexion/db.php';

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
    $query = $base_datos->conectar()->prepare("INSERT INTO `contrato_perfil`
        (`con_id`, `id_per_carg`, `estado`)
VALUES (:con_id, :id_per_carg, :estado)");

    $query->execute([
        'con_id' => $json_datos['con_id'],
        'id_per_carg' => $json_datos['id_per_carg'],
        'estado' => $json_datos['estado']
    ]);
}