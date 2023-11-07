<?php
require_once '../conexion/db.php';

//guardar
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO `empleados`("
            . "`func_id`, `func_ingreso`, "
            . " `cur_id`, `suc_id`, `estado`) "
            . "VALUES ((SELECT IF(MAX(c.func_id) IS NULL, 1 , 
                         MAX(c.func_id) + 1)  FROM empleados c), 
                         :func_ingreso, :cur_id, :suc_id, :estado)");

    $query->execute([
        'func_ingreso' => $json_datos['func_ingreso'],
        'cur_id' => $json_datos['cur_id'],
        'suc_id' => $json_datos['suc_id'],
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
    $query = $base_datos->conectar()->prepare("SELECT MAX(`func_id`) AS id"
            . " FROM `empleados`");

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


if (isset($_POST['id_existe'])) {
    existeIDCurriculum($_POST['id_existe']);
}

function existeIDCurriculum($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `func_id`, `func_ingreso`, 
`func_baja`, `cur_id`, `suc_id`, 
`estado`
FROM `empleados` 
WHERE cur_id = $id");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'func_id' => $fila['func_id'],
                'func_ingreso' => $fila['func_ingreso'],
                'func_baja' => $fila['func_baja'],
                'cur_id' => $fila['cur_id'],
                'suc_id' => $fila['suc_id'],
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

if (isset($_POST['b_nombre'])) {
    buscarNombre($_POST['b_nombre']);
}

function buscarNombre($nombre) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $nombre = strtoupper($nombre);
    $query = $base_datos->conectar()->prepare("SELECT 
             e.func_id,
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            c.cur_fecha,
            if(e.estado = 1, 'ACTIVO', 'INACTIVO') as estado, 
            e.func_ingreso,
            IF(e.func_baja IS NULL, 'NO ESPECIFICADO', e.func_baja) as func_baja
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id = c.cur_id
            WHERE UPPER(CONCAT(p.per_nom,' ',p.per_apell)) like '%$nombre%'");

    $query->execute();
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'func_id' => $fila['func_id'],
                'personal' => $fila['personal'],
                'cedula' => $fila['cedula'],
                'func_ingreso' => $fila['func_ingreso'],
                'func_baja' => $fila['func_baja'],
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
    $query = $base_datos->conectar()->prepare("SELECT e.func_id, 
        e.func_ingreso, e.func_baja,
        e.cur_id, e.suc_id, e.estado,
        p.per_apell, p.per_nom, p.cedula,
         p.per_direc, p.per_ciud, 
        p.per_nacion, p.per_est_civ, p.per_nacim,
        p.per_genero
        FROM empleados e
        JOIN curriculum c 
        ON c.cur_id = e.cur_id
        JOIN personal p 
        ON p.per_id = c.per_id
        WHERE e.func_id = $id");

    $query->execute();
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'func_id' => $fila['func_id'],
                'func_ingreso' => $fila['func_ingreso'],
                'func_baja' => $fila['func_baja'],
                'cur_id' => $fila['cur_id'],
                'suc_id' => $fila['suc_id'],
                'per_apell' => $fila['per_apell'],
                'per_nom' => $fila['per_nom'],
                'cedula' => $fila['cedula'],
                'per_direc' => $fila['per_direc'],
                'per_ciud' => $fila['per_ciud'],
                'per_nacion' => $fila['per_nacion'],
                'per_est_civ' => $fila['per_est_civ'],
                'per_nacim' => $fila['per_nacim'],
                'per_genero' => $fila['per_genero'],
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
    $query = $base_datos->conectar()->prepare("UPDATE `empleados` SET 
        `func_ingreso`=:func_ingreso,
        `func_baja`= :func_baja,`cur_id`= :cur_id,
        `suc_id`= :suc_id,`estado`= :estado
        WHERE func_id = :func_id ");

    $query->execute([
       'func_id' => $json_datos['func_id'],
       'func_ingreso' => $json_datos['func_ingreso'],
       'func_baja' => $json_datos['func_baja'],
        'cur_id' => $json_datos['cur_id'],
        'suc_id' => $json_datos['suc_id'],
        'estado' => $json_datos['estado']
    ]);
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
            . " UPDATE empleados SET estado = 0 "
            . " WHERE func_id = $id");

    $query->execute();
}