<?php

require_once '../conexion/db.php';

//guardar
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO `det_salario`
( `con_id`, `bon_flia`, `sal_id`, `sal_mes`,
 `total_extra`, `total_descuento`,
 `sal_fec_emis`, `ips`, estado) 
 VALUES (:con_id, :bon_flia, :sal_id, :sal_mes, :total_extra, :total_descuento, 
 :sal_fec_emis, :ips, :estado )");

    $query->execute([
        'con_id' => $json_datos['con_id'],
        'bon_flia' => $json_datos['bon_flia'],
        'sal_id' => $json_datos['sal_id'],
        'sal_mes' => $json_datos['sal_mes'],
        'total_descuento' => $json_datos['total_descuento'],
        'sal_fec_emis' => $json_datos['sal_fec_emis'],
        'ips' => $json_datos['ips'],
        'estado' => $json_datos['estado'],
        'total_extra' => $json_datos['total_extra']
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
    $query = $base_datos->conectar()->prepare("SELECT MAX(`det_salario_id`) AS id"
            . " FROM `det_salario`");

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

if (isset($_POST['anular'])) {
    desactivar($_POST['anular']);
}

function desactivar($id) {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare(""
            . " UPDATE det_salario SET estado = 'ANULADO' "
            . " WHERE det_salario_id= $id");

    $query->execute();
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
    $query = $base_datos->conectar()->prepare("SELECT `det_ips_id`, `con_id`, 
            `det_ips_fe_pg`, `det_ips_des`,
            `det_ips_aport`, `det_ips_estado` 
            FROM `det_ips`
            WHERE det_ips_id =  $id");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'det_ips_id' => $fila['det_ips_id'],
                'con_id' => $fila['con_id'],
                'det_ips_fe_pg' => $fila['det_ips_fe_pg'],
                'det_ips_des' => $fila['det_ips_des'],
                'det_ips_aport' => $fila['det_ips_aport'],
                'det_ips_estado' => $fila['det_ips_estado']
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
    $query = $base_datos->conectar()->prepare("UPDATE `det_ips` SET 
        `con_id`=:con_id,`det_ips_fe_pg`=:det_ips_fe_pg,
        `det_ips_des`=:det_ips_des,
        `det_ips_aport`=:det_ips_aport,`det_ips_estado`= :det_ips_estado 
        WHERE det_ips_id = :det_ips_id");

    $query->execute([
        'det_ips_id' => $json_datos['det_ips_id'],
        'con_id' => $json_datos['con_id'],
        'det_ips_fe_pg' => $json_datos['det_ips_fe_pg'],
        'det_ips_des' => $json_datos['det_ips_des'],
        'det_ips_aport' => $json_datos['det_ips_aport'],
        'det_ips_estado' => $json_datos['det_ips_estado']
    ]);
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------



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
            con.con_id,
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            ds.det_salario_id,
            ds.bon_flia,
            ds.sal_id,
            ds.sal_mes,
            ds.total_extra,
            ds.total_descuento,
            ds.sal_fec_emis,
            ds.estado
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id = c.cur_id
            JOIN contrato con 
            ON con.func_id = e.func_id
            join det_salario ds
            ON ds.con_id = con.con_id
            WHERE ds.con_id = :id_contrato and ds.sal_fec_emis BETWEEN :desde and :hasta
            ORDER BY ds.det_salario_id DESC 
            LIMIT 50");

    $query->execute([
        'id_contrato' => $json_datos['id_contrato'],
        'desde' => $json_datos['desde'],
        'hasta' => $json_datos['hasta']
    ]);
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
             array_push($arreglo, array(
                'personal' => $fila['personal'],
                'cedula' => $fila['cedula'],
                'det_salario_id' => $fila['det_salario_id'],
                'bon_flia' => $fila['bon_flia'],
                'sal_id' => $fila['sal_id'],
                'sal_mes' => $fila['sal_mes'],
                'total_extra' => $fila['total_extra'],
                'total_descuento' => $fila['total_descuento'],
                'sal_fec_emis' => $fila['sal_fec_emis'],
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

if (isset($_POST['totales_aguinaldo'])) {
    totalesAguinaldo($_POST['totales_aguinaldo']);
}

function totalesAguinaldo($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT
            sum(ds.bon_flia) as bonificacion,
            sum(ds.total_extra) as total_extra,
            sum(ds.total_descuento) as total_descuento
            FROM det_salario ds 
            WHERE ds.con_id = :id_contrato and 
            ds.estado = 'ACTIVO' and YEAR(ds.sal_fec_emis) = :anio");

    $query->execute([
        'id_contrato' => $json_datos['id_contrato'],
        'anio' => $json_datos['anio']
    ]);
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
             array_push($arreglo, array(
                'bonificacion' => $fila['bonificacion'],
                'total_extra' => $fila['total_extra'],
                'total_descuento' => $fila['total_descuento']
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

if (isset($_POST['aporte_en_fecha'])) {
    aporteEnFecha($_POST['aporte_en_fecha']);
}

function aporteEnFecha($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `det_ips_id`, `con_id`, 
date_format(det_ips_fe_pg, '%m-%Y') as det_ips_fe_pg, `det_ips_des`,
`det_ips_aport`, 
`det_ips_estado` 
FROM `det_ips`
WHERE  con_id = :id_contrato and det_ips_fe_pg BETWEEN :desde and :hasta 
and det_ips_estado = 'ACTIVO'");

    $query->execute([
        'id_contrato' => $json_datos['id_contrato'],
        'desde' => $json_datos['desde'],
        'hasta' => $json_datos['hasta']
    ]);
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'det_ips_id' => $fila['det_ips_id'],
                'con_id' => $fila['con_id'],
                'det_ips_fe_pg' => $fila['det_ips_fe_pg'],
                'det_ips_des' => $fila['det_ips_des'],
                'det_ips_aport' => $fila['det_ips_aport'],
                'det_ips_estado' => $fila['det_ips_estado']
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

if (isset($_POST['b_filtros_todo'])) {
    buscarFiltroTodo();
}

function buscarFiltroTodo() {
    
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `det_ips_id`, `con_id`, 
date_format(det_ips_fe_pg, '%m-%Y') as det_ips_fe_pg, `det_ips_des`,
`det_ips_aport`, 
`det_ips_estado` 
FROM `det_ips`
WHERE  det_ips_estado = 'ACTIVO' 
ORDER BY det_ips_id DESC limit 30");

    $query->execute();
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'det_ips_id' => $fila['det_ips_id'],
                'con_id' => $fila['con_id'],
                'det_ips_fe_pg' => $fila['det_ips_fe_pg'],
                'det_ips_des' => $fila['det_ips_des'],
                'det_ips_aport' => $fila['det_ips_aport'],
                'det_ips_estado' => $fila['det_ips_estado']
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

if (isset($_POST['grilla'])) {
    Grilla();
}

function Grilla() {
    
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT 
            con.con_id,
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            ds.det_salario_id,
            ds.bon_flia,
            ds.sal_id,
            ds.sal_mes,
            ds.total_extra,
            ds.total_descuento,
            ds.sal_fec_emis,
            ds.estado
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id = c.cur_id
            JOIN contrato con 
            ON con.func_id = e.func_id
            join det_salario ds
            ON ds.con_id = con.con_id
            ORDER BY ds.det_salario_id DESC 
            LIMIT 50");

    $query->execute();
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'personal' => $fila['personal'],
                'cedula' => $fila['cedula'],
                'det_salario_id' => $fila['det_salario_id'],
                'bon_flia' => $fila['bon_flia'],
                'sal_id' => $fila['sal_id'],
                'sal_mes' => $fila['sal_mes'],
                'total_extra' => $fila['total_extra'],
                'total_descuento' => $fila['total_descuento'],
                'sal_fec_emis' => $fila['sal_fec_emis'],
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


if (isset($_POST['existe_en_mes'])) {
    existeEnMes($_POST['existe_en_mes']);
}

function existeEnMes($lista) {
    $json_datos = json_decode($lista, true);
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `det_salario_id`, `con_id`, 
        `bon_flia`, `sal_id`, `sal_mes`, 
        `total_extra`, `total_descuento`, 
        `sal_fec_emis`, `det_ips_id`, `estado` 
        FROM `det_salario` 
        WHERE con_id = :id_contrato and estado = 'ACTIVO'  
        AND sal_fec_emis  BETWEEN :desde and :hasta");

    $query->execute([
        'id_contrato' => $json_datos['id_contrato'],
        'desde' => $json_datos['desde'],
        'hasta' => $json_datos['hasta']
    ]);

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'det_salario_id' => $fila['det_salario_id']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}