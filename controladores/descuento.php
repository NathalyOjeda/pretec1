<?php

require_once '../conexion/db.php';

//guardar
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO `descuento`( `des_motiv_id`,
                        `con_id`, `des_fec`, `des_monto`, estado) 
                        VALUES (:des_motiv_id, :con_id, :des_fec, :des_monto, :estado)");

    $query->execute([
        'con_id' => $json_datos['con_id'],
        'des_motiv_id' => $json_datos['des_motiv_id'],
        'des_fec' => $json_datos['des_fec'],
        'estado' => $json_datos['estado'],
        'des_monto' => $json_datos['des_monto']
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
    $query = $base_datos->conectar()->prepare("SELECT MAX(`des_id`) AS id"
            . " FROM `descuento`");

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
    $query = $base_datos->conectar()->prepare("SELECT `des_id`, `des_motiv_id`, 
        `con_id`, `des_fec`, `des_monto`, estado
        FROM `descuento` 
        WHERE des_id =  $id");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'des_id' => $fila['des_id'],
                'des_motiv_id' => $fila['des_motiv_id'],
                'con_id' => $fila['con_id'],
                'des_fec' => $fila['des_fec'],
                'estado' => $fila['estado'],
                'des_monto' => $fila['des_monto']
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
    $query = $base_datos->conectar()->prepare("UPDATE `descuento` SET "
            . "`des_motiv_id`= :des_motiv_id,"
            . "`con_id`= :con_id,`des_fec`= :des_fec,"
            . "`des_monto`=:des_monto,`estado`= :estado "
            . "WHERE des_id= :des_id");

    $query->execute([
        'des_id' => $json_datos['des_id'],
        'con_id' => $json_datos['con_id'],
        'des_motiv_id' => $json_datos['des_motiv_id'],
        'des_fec' => $json_datos['des_fec'],
        'estado' => $json_datos['estado'],
        'des_monto' => $json_datos['des_monto']
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
            . " UPDATE descuento SET estado = 'ANULADO' "
            . " WHERE des_id= $id");

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
            d.des_id,
            d.des_fec,
            m.des_mot_desci,
            d.des_monto,
            d.estado
            FROM descuento d 
            JOIN desc_motiv m 
            ON m.des_motiv_id = d.des_motiv_id
            WHERE d.con_id = :id_contrato ORDER BY d.des_id DESC ");

    $query->execute([
        'id_contrato' => $json_datos['id_contrato']
    ]);
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'des_id' => $fila['des_id'],
                'des_fec' => $fila['des_fec'],
                'des_mot_desci' => $fila['des_mot_desci'],
                'estado' => $fila['estado'],
                'des_monto' => $fila['des_monto']
               
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

if (isset($_POST['descuentos_activos_periodo'])) {
    descuentoActivoPeriodo($_POST['descuentos_activos_periodo']);
}

function descuentoActivoPeriodo($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT
m.des_mot_desci,
d.des_monto,
d.des_fec
FROM descuento d 
JOIN desc_motiv m 
ON m.des_motiv_id = d.des_motiv_id
WHERE d.estado = 'ACTIVO' AND d.des_fec BETWEEN :desde and :hasta  and d.con_id = :id_contrato
ORDER BY d.des_fec DESC");

    $query->execute([
        'id_contrato' => $json_datos['id_contrato'],
        'desde' => $json_datos['desde'],
        'hasta' => $json_datos['hasta']
    ]);
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'des_mot_desci' => $fila['des_mot_desci'],
                'des_fec' => $fila['des_fec'],
                'des_monto' => $fila['des_monto']
               
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}
