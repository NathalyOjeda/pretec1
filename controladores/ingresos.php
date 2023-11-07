<?php

require_once '../conexion/db.php';

//guardar
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    session_start();
    $query = $base_datos->conectar()->prepare("INSERT INTO `ingresos`( `cantidad_horas`, 
                       `monto`, `id_concepto`, `fecha`,
                       `id_usuario`, `estado`, con_id) 
                       VALUES (:cantidad_horas, :monto, :id_concepto, :fecha, :id_usuario, :estado, :con_id)");

    $query->execute([
        'cantidad_horas' => $json_datos['cantidad_horas'],
        'monto' => $json_datos['monto'],
        'id_concepto' => $json_datos['id_concepto'],
        'fecha' => $json_datos['fecha'],
        'id_usuario' => $_SESSION['id_usuario'],
        'estado' => $json_datos['estado'],
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


if (isset($_POST['id'])) {
    registroPorID($_POST['id']);
}

function registroPorID($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `san_id`, `con_id`, `mot_san_id`,
        `sanc_descri`, `sanc_fec`, `sanc_estado` 
        FROM `sancion`
        WHERE san_id =   $id");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'san_id' => $fila['san_id'],
                'con_id' => $fila['con_id'],
                'mot_san_id' => $fila['mot_san_id'],
                'sanc_descri' => $fila['sanc_descri'],
                'sanc_fec' => $fila['sanc_fec'],
                'sanc_estado' => $fila['sanc_estado']
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

if (isset($_POST['anular'])) {
    desactivar($_POST['anular']);
}

function desactivar($id) {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare(""
            . " UPDATE ingresos SET estado = 'ANULADO' "
            . " WHERE id_ingreso = $id");

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
            i.id_ingreso,
            i.cantidad_horas,
            i.fecha,
            i.monto,
            (i.cantidad_horas * i.monto) as total,
            c.descripcion,
            i.estado
            FROM ingresos i 
            JOIN concepto c 
            ON c.id_concepto = i.id_concepto
            WHERE i.con_id =  :id_contrato 
            ORDER BY i.id_ingreso DESC");

    $query->execute([
        'id_contrato' => $json_datos['id_contrato']
    ]);
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'id_ingreso' => $fila['id_ingreso'],
                'cantidad_horas' => $fila['cantidad_horas'],
                'fecha' => $fila['fecha'],
                'monto' => $fila['monto'],
                'descripcion' => $fila['descripcion'],
                'estado' => $fila['estado'],
                'total' => $fila['total']
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

if (isset($_POST['segun_mes'])) {
    segun_mes($_POST['segun_mes']);
}

function segun_mes($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT
if(SUM(i.monto) is null, 0, SUM(i.monto)) as total
FROM ingresos i
WHERE i.con_id =  ".$json_datos['con_id'].
            " and  date_format(i.fecha, \"%Y-%m\")  = '".$json_datos['fecha']."' "
            . "and i.estado = '1'");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            echo $fila['total'];
        }
        
    } else {
        echo '0';
    }
}