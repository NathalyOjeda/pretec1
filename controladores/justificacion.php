<?php

require_once '../conexion/db.php';

//guardar
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO `permiso_justif`(`con_id`, `fecha`,
                             `jus_per_id`, `observacion`,
                             `file`, `estado`) 
                             VALUES (:con_id, :fecha, :jus_per_id, :observacion, :file, :estado)");

    $query->execute([
        'con_id' => $json_datos['con_id'],
        'fecha' => $json_datos['fecha'],
        'jus_per_id' => $json_datos['jus_per_id'],
        'observacion' => $json_datos['observacion'],
        'file' => $json_datos['file'],
        'estado' => $json_datos['estado']
    ]);
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
            pj.id_permiso_justif,
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            pj.fecha,
            jp.just_per_de,
            pj.observacion,
            pj.file,
            IF(pj.estado = 1, 'ACTIVO', 'ANULADO') as estado
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id  = c.cur_id
            JOIN contrato t 
            ON t.func_id = e.func_id
            JOIN permiso_justif pj 
            ON pj.con_id = t.con_id
            JOIN justi_perm jp 
            ON jp.jus_per_id =  pj.jus_per_id
            WHERE UPPER(CONCAT(p.per_nom,' ',p.per_apell)) like '%$nombre%'
            LIMIT 20");

    $query->execute();
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'id_permiso_justif' => $fila['id_permiso_justif'],
                'personal' => $fila['personal'],
                'cedula' => $fila['cedula'],
                'fecha' => $fila['fecha'],
                'just_per_de' => $fila['just_per_de'],
                'observacion' => $fila['observacion'],
                'file' => $fila['file'],
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
    id($_POST['id']);
}

function id($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
   
    $query = $base_datos->conectar()->prepare("SELECT 
            pj.id_permiso_justif,
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            pj.fecha,
            jp.just_per_de,
            pj.observacion,
            pj.file,
            IF(pj.estado = 1, 'ACTIVO', 'ANULADO') as estado
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id  = c.cur_id
            JOIN contrato t 
            ON t.func_id = e.func_id
            JOIN permiso_justif pj 
            ON pj.con_id = t.con_id
            JOIN justi_perm jp 
            ON jp.jus_per_id =  pj.jus_per_id
            WHERE  pj.id_permiso_justif = $id
            LIMIT 20");

    $query->execute();
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'id_permiso_justif' => $fila['id_permiso_justif'],
                'personal' => $fila['personal'],
                'cedula' => $fila['cedula'],
                'fecha' => $fila['fecha'],
                'just_per_de' => $fila['just_per_de'],
                'observacion' => $fila['observacion'],
                'file' => $fila['file'],
                'estado' => $fila['estado']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}