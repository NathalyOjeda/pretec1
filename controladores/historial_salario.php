<?php

require_once '../conexion/db.php';

//guardar
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO `historial_salario`( 
    `con_id`, `fecha`, `monto`, `estado`) 
    VALUES (:con_id, :fecha, :monto, :estado)");

    $query->execute([
        'con_id' => $json_datos['con_id'],
        'fecha' => $json_datos['fecha'],
        'monto' => $json_datos['monto'],
        'estado' => $json_datos['estado']
    ]);
}
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
if (isset($_POST['desactivar_anteriores'])) {
    desactivar_anteriores($_POST['desactivar_anteriores']);
}

function desactivar_anteriores($id) {
   
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("UPDATE `historial_salario` SET `estado`= 'INACTIVO'
WHERE `con_id` = $id");

    $query->execute();
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------


if (isset($_POST['buscar_salario'])) {
    buscar_salario($_POST['buscar_salario']);
}

function buscar_salario($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT
hs.id_historial_salario,
hs.fecha,
hs.monto,
hs.estado
FROM historial_salario hs 
JOIN contrato c 
ON c.con_id =  hs.con_id
JOIN empleados e 
ON e.func_id =  c.func_id
JOIN curriculum cu 
ON cu.cur_id =  e.cur_id
JOIN personal per 
ON per.per_id =  cu.per_id
WHERE c.con_id = :con_id and hs.fecha BETWEEN :desde and :hasta 
ORDER BY hs.id_historial_salario DESC");

    $query->execute([
        'con_id' => $json_datos['con_id'],
        'desde' => $json_datos['desde'],
        'hasta' => $json_datos['hasta']
    ]);

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'id_historial_salario' => $fila['id_historial_salario'],
                'fecha' => $fila['fecha'],
                'monto' => $fila['monto'],
                'estado' => $fila['estado']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
if (isset($_POST['eliminar'])) {
    eliminar($_POST['eliminar']);
}

function eliminar($id) {
   
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("DELETE FROM `historial_salario` 
WHERE `id_historial_salario` = $id");

    $query->execute();
}