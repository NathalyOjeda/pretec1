<?php

require_once '../conexion/db.php';

//guardar
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO `aguinaldo`( `con_id`, `agui_nic`,
                        `agui_ruc`, `agui_di_trab`, `agui_sal_bas`,
                        `agui_q_horas`, `agui_bnf_fli`, `agui_tot_ing`, 
                        `agui_ips`, `agui_anticip`, `agui_tot_egr`, `agui_sal_net`,
                        `agui_estado`, agui_fecha) 
                        VALUES (:con_id, :agui_nic, :agui_ruc, :agui_di_trab, :agui_sal_bas,
                        :agui_q_horas, :agui_bnf_fli, :agui_tot_ing, :agui_ips, :agui_anticip, 
                        :agui_tot_egr, :agui_sal_net, :agui_estado, :agui_fecha)");

    $query->execute([
        'con_id' => $json_datos['con_id'],
        'agui_nic' => $json_datos['agui_nic'],
        'agui_ruc' => $json_datos['agui_ruc'],
        'agui_di_trab' => $json_datos['agui_di_trab'],
        'agui_sal_bas' => $json_datos['agui_sal_bas'],
        'agui_q_horas' => $json_datos['agui_q_horas'],
        'agui_bnf_fli' => $json_datos['agui_bnf_fli'],
        'agui_tot_ing' => $json_datos['agui_tot_ing'],
        'agui_ips' => $json_datos['agui_ips'],
        'agui_anticip' => $json_datos['agui_anticip'],
        'agui_tot_egr' => $json_datos['agui_tot_egr'],
        'agui_sal_net' => $json_datos['agui_sal_net'],
        'agui_fecha' => $json_datos['agui_fecha'],
        'agui_estado' => $json_datos['agui_estado']
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
    $query = $base_datos->conectar()->prepare("SELECT MAX(`agui_id`) AS id"
            . " FROM `aguinaldo`");

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

if (isset($_POST['anular'])) {
    desactivar($_POST['anular']);
}

function desactivar($id) {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare(""
            . " UPDATE aguinaldo SET agui_estado = 'ANULADO' "
            . " WHERE agui_id= $id");

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
            con.con_id,
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            car.car_descri,
            a.agui_sal_bas,
            a.agui_tot_ing,
            a.agui_tot_egr,
            a.agui_sal_net,
            a.agui_estado,
            a.agui_id,
            a.agui_fecha
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id = c.cur_id
            JOIN contrato con 
            ON con.func_id = e.func_id
            JOIN cargos car 
            ON car.car_id = con.car_id
            JOIN aguinaldo a 
            ON a.con_id = con.con_id
            WHERE a.con_id = :id_contrato and det_ips_fe_pg BETWEEN :desde and :hasta");

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
    $query = $base_datos->conectar()->prepare("SELECT 
            con.con_id,
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            car.car_descri,
            a.agui_sal_bas,
            a.agui_tot_ing,
            a.agui_tot_egr,
            a.agui_sal_net,
            a.agui_estado,
            a.agui_id,
            a.agui_fecha
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id = c.cur_id
            JOIN contrato con 
            ON con.func_id = e.func_id
            JOIN cargos car 
            ON car.car_id = con.car_id
            JOIN aguinaldo a 
            ON a.con_id = con.con_id
            WHERE a.con_id = 
            ORDER BY a.agui_id DESC 
            LIMIT 30");

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
            car.car_descri,
            a.agui_sal_bas,
            a.agui_tot_ing,
            a.agui_tot_egr,
            a.agui_sal_net,
            a.agui_estado,
            a.agui_id,
            a.agui_fecha
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id = c.cur_id
            JOIN contrato con 
            ON con.func_id = e.func_id
            JOIN cargos car 
            ON car.car_id = con.car_id
            JOIN aguinaldo a 
            ON a.con_id = con.con_id
            ORDER BY a.agui_id DESC 
            LIMIT 30");

    $query->execute();
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'agui_id' => $fila['agui_id'],
                'personal' => $fila['personal'],
                'cedula' => $fila['cedula'],
                'agui_sal_bas' => $fila['agui_sal_bas'],
                'agui_fecha' => $fila['agui_fecha'],
                'agui_tot_ing' => $fila['agui_tot_ing'],
                'agui_tot_egr' => $fila['agui_tot_egr'],
                'agui_sal_net' => $fila['agui_sal_net'],
                'agui_estado' => $fila['agui_estado']
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


if (isset($_POST['existe'])) {
    existeEnMes($_POST['existe']);
}

function existeEnMes($lista) {
    $json_datos = json_decode($lista, true);
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT * 
FROM aguinaldo a
WHERE a.con_id = :id_contrato and a.agui_estado = 'ACTIVO' 
 and YEAR(a.agui_fecha) = :anio");

    $query->execute([
        'id_contrato' => $json_datos['id_contrato'],
        'anio' => $json_datos['anio']
    ]);

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            echo "1";
        }
    } else {
        echo '0';
    }
}