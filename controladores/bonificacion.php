<?php

require_once '../conexion/db.php';

//guardar
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO `bonif_filia`( `bon_monto`, `bon_estad`, `bon_cant`,
                          `bon_fec_pg`, `con_id`) 
                          VALUES (:bon_monto, :bon_estad, :bon_cant, :bon_fec_pg, :con_id)");

    $query->execute([
        'bon_monto' => $json_datos['bon_monto'],
        'bon_estad' => $json_datos['bon_estad'],
        'bon_cant' => $json_datos['bon_cant'],
        'bon_fec_pg' => $json_datos['bon_fec_pg'],
        'con_id' => $json_datos['con_id']
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
    $query = $base_datos->conectar()->prepare("SELECT MAX(`san_id`) AS id"
            . " FROM `sancion`");

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
        b.bon_id
        FROM bonif_filia b 
        WHERE b.con_id = $id");

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
            . " DELETE  FROM det_bonif "
            . " WHERE id_def_bonif = $id");

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
            s.san_id,
            s.sanc_fec,
            m.mot_san,
            s.sanc_descri,
            s.sanc_estado
            FROM sancion s 
            JOIN mot_sancion m 
            ON m.mot_san_id = s.mot_san_id
            WHERE s.con_id = :id_contrato 
            ORDER BY s.san_id DESC");

    $query->execute([
        'id_contrato' => $json_datos['id_contrato']
    ]);
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'san_id' => $fila['san_id'],
                'sanc_fec' => $fila['sanc_fec'],
                'mot_san' => $fila['mot_san'],
                'sanc_descri' => $fila['sanc_descri'],
                'sanc_estado' => $fila['sanc_estado']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}
