<?php

require_once '../conexion/db.php';

//guardar
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO `desvinculacion`( `con_id`, `fecha_desvinculacion`,
                             `justiticado`, `descripcion`, `total_liquidacion`,
                             `preaviso`, `indemnizacion`, `ips`, `aguinaldo`,
                             `salario`, `estado`)
                             VALUES (:con_id, :fecha_desvinculacion, :justiticado, 
                             :descripcion, :total_liquidacion, :preaviso, :indemnizacion, 
                             :ips, :aguinaldo, :salario, :estado)");

    $query->execute([
        'con_id' => $json_datos['con_id'],
        'fecha_desvinculacion' => $json_datos['fecha_desvinculacion'],
        'justiticado' => $json_datos['justiticado'],
        'descripcion' => $json_datos['descripcion'],
        'total_liquidacion' => $json_datos['total_liquidacion'],
        'preaviso' => $json_datos['preaviso'],
        'indemnizacion' => $json_datos['indemnizacion'],
        'ips' => $json_datos['ips'],
        'aguinaldo' => $json_datos['aguinaldo'],
        'salario' => $json_datos['salario'],
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
    $query = $base_datos->conectar()->prepare("SELECT MAX(`id_desvinculacion`) AS id"
            . " FROM `desvinculacion`");

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


if (isset($_POST['id_contrato'])) {
    registroPorID($_POST['id_contrato']);
}

function registroPorID($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT
        *
        FROM desvinculacion b 
        WHERE b.con_id = $id and estado  = 'ACTIVO'");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'bon_id' => $fila['bon_id']
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


if (isset($_POST['id_contrato_hijos'])) {
    registroPorIDHijos($_POST['id_contrato_hijos']);
}

function registroPorIDHijos($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT
        b.bon_id,
        db.nombre_apellido,
        db.fecha_nacimiento,
        db.id_def_bonif,
        YEAR(CURDATE())-YEAR(db.fecha_nacimiento) as edad
        FROM bonif_filia b 
        JOIN det_bonif db 
        ON db.bon_id = b.bon_id
        WHERE b.con_id = $id");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'id_def_bonif' => $fila['id_def_bonif'],
                'nombre_apellido' => $fila['nombre_apellido'],
                'edad' => $fila['edad'],
                'fecha_nacimiento' => $fila['fecha_nacimiento']
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
    $query = $base_datos->conectar()->prepare("UPDATE  `sancion` SET  
        `con_id` = :con_id, `mot_san_id` = :mot_san_id,
          `sanc_descri` = :sanc_descri, `sanc_fec` = :sanc_fec,
          `sanc_estado` = :sanc_estado
          WHERE san_id = :san_id");

    $query->execute([
        'san_id' => $json_datos['san_id'],
        'con_id' => $json_datos['con_id'],
        'mot_san_id' => $json_datos['mot_san_id'],
        'sanc_descri' => $json_datos['sanc_descri'],
        'sanc_estado' => $json_datos['sanc_estado'],
        'sanc_fec' => $json_datos['sanc_fec']
    ]);
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

if (isset($_POST['eliminar'])) {
    desactivar($_POST['eliminar']);
}

function desactivar($id) {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare(""
            . " DELETE  FROM desvinculacion "
            . " WHERE id_desvinculacion = $id");

    $query->execute();
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

if (isset($_POST['b_filtros'])) {
    buscarFiltro($_POST['b_filtros']);
}

function buscarFiltro($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT
            *
            FROM desvinculacion s 
            WHERE s.con_id = :id_contrato 
            ORDER BY s.id_desvinculacion DESC");

    $query->execute([
        'id_contrato' => $json_datos['id_contrato']
    ]);
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'id_desvinculacion' => $fila['id_desvinculacion'],
                'fecha_desvinculacion' => $fila['fecha_desvinculacion'],
                'justificado' => $fila['justiticado'],
                'descripcion' => $fila['descripcion'],
                'estado' => $fila['estado'],
                'total_liquidacion' => $fila['total_liquidacion']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}
