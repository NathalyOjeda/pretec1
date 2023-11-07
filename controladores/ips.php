<?php

require_once '../conexion/db.php';

//guardar
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO `det_ips`( `con_id`, 
                      `det_ips_fe_pg`, `det_ips_des`,
                      `det_ips_aport`, `det_ips_estado`) 
                      VALUES (:con_id, :det_ips_fe_pg, 
                      :det_ips_des, :det_ips_aport, :det_ips_estado)");

    $query->execute([
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


if (isset($_POST['ultimoID'])) {
    ultimoID();
}

function ultimoID() {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT MAX(`det_ips_id`) AS id"
            . " FROM `det_ips`");

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


if (isset($_POST['total_aporte_aguinaldo'])) {
    totalAporteAguinaldo($_POST['total_aporte_aguinaldo']);
}

function totalAporteAguinaldo($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT
            if(SUM(d.det_ips_aport) is null, 0, SUM(d.det_ips_aport)) as aporte
            FROM det_ips d 
            WHERE d.con_id = :id_contrato
            and d.det_ips_estado = 'ACTIVO' AND YEAR(d.det_ips_fe_pg) =  :anio");

    $query->execute([
        'id_contrato' => $json_datos['id_contrato'],
        'anio' => $json_datos['anio']
    ]);

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            echo $fila['aporte'];
        }
        
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

if (isset($_POST['anular'])) {
    desactivar($_POST['anular']);
}

function desactivar($id) {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare(""
            . " UPDATE det_ips SET det_ips_estado = 'ANULADO' "
            . " WHERE det_ips_id= $id");

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
    $query = $base_datos->conectar()->prepare("SELECT `det_ips_id`, `con_id`, 
date_format(det_ips_fe_pg, '%m-%Y') as det_ips_fe_pg, `det_ips_des`,
`det_ips_aport`, 
`det_ips_estado` 
FROM `det_ips`
WHERE  con_id = :id_contrato and det_ips_fe_pg BETWEEN :desde and :hasta");

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
            ips.det_ips_id,
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            ips.det_ips_fe_pg,
            ips.det_ips_estado,
            con.con_salario,
            ips.det_ips_aport,
            car.car_descri
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id = c.cur_id
            JOIN contrato con 
            ON con.func_id = e.func_id
            join det_ips ips 
            ON ips.con_id = con.con_id
            JOIN cargos car 
            ON car.car_id = con.car_id
            ORDER BY ips.det_ips_id DESC 
            LIMIT 30");

    $query->execute();
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'det_ips_id' => $fila['det_ips_id'],
                'personal' => $fila['personal'],
                'cedula' => $fila['cedula'],
                'det_ips_fe_pg' => $fila['det_ips_fe_pg'],
                'det_ips_aport' => $fila['det_ips_aport'],
                'car_descri' => $fila['car_descri'],
                'con_salario' => $fila['con_salario'],
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


if (isset($_POST['existe_en_mes'])) {
    existeEnMes($_POST['existe_en_mes']);
}

function existeEnMes($lista) {
    $json_datos = json_decode($lista, true);
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `det_ips_id`, `con_id`, 
            `det_ips_fe_pg`, `det_ips_des`,
            `det_ips_aport`, `det_ips_estado` 
            FROM `det_ips`
            WHERE con_id =  :id_contrato and det_ips_estado = 'ACTIVO' and det_ips_fe_pg = :fecha");

    $query->execute([
        'id_contrato' => $json_datos['id_contrato'],
        'fecha' => $json_datos['fecha']
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