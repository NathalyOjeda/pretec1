<?php

require_once '../conexion/db.php';

//guardar
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO `det_min_trab`( 
    `con_id`, `det_mjt_patrl`, `det_mjt_fe_pla`,
    `det_mjt_esta`, `det_min_trab_desc`) 
    VALUES (:con_id, :det_mjt_patrl, :det_mjt_fe_pla, :det_mjt_esta, :det_min_trab_desc)");

    $query->execute([
        'con_id' => $json_datos['con_id'],
        'det_mjt_patrl' => $json_datos['det_mjt_patrl'],
        'det_mjt_fe_pla' => $json_datos['det_mjt_fe_pla'],
        'det_mjt_esta' => $json_datos['det_mjt_esta'],
        'det_min_trab_desc' => $json_datos['det_min_trab_desc']
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
    $query = $base_datos->conectar()->prepare("SELECT MAX(`det_min_trab_id`) AS id"
            . " FROM `det_min_trab`");

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
    $query = $base_datos->conectar()->prepare("SELECT `det_min_trab_id`, `con_id`, 
            `det_mjt_patrl`, `det_mjt_fe_pla`,
            `det_mjt_esta`, `det_min_trab_desc` 
            FROM `det_min_trab` 
            WHERE det_min_trab_id =  $id");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'det_min_trab_id' => $fila['det_min_trab_id'],
                'con_id' => $fila['con_id'],
                'det_mjt_patrl' => $fila['det_mjt_patrl'],
                'det_mjt_fe_pla' => $fila['det_mjt_fe_pla'],
                'det_mjt_esta' => $fila['det_mjt_esta'],
                'det_min_trab_desc' => $fila['det_min_trab_desc']
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
    $query = $base_datos->conectar()->prepare("UPDATE `det_min_trab` SET `con_id`=:con_id,
        `det_mjt_patrl`=:det_mjt_patrl,`det_mjt_fe_pla`=:det_mjt_fe_pla,
        `det_mjt_esta`=:det_mjt_esta,`det_min_trab_desc`=:det_min_trab_desc 
        WHERE det_min_trab_id = :det_min_trab_id");

    $query->execute([
         'det_min_trab_id' => $json_datos['det_min_trab_id'],
         'con_id' => $json_datos['con_id'],
        'det_mjt_patrl' => $json_datos['det_mjt_patrl'],
        'det_mjt_fe_pla' => $json_datos['det_mjt_fe_pla'],
        'det_mjt_esta' => $json_datos['det_mjt_esta'],
        'det_min_trab_desc' => $json_datos['det_min_trab_desc']
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
            . " UPDATE det_min_trab SET det_mjt_esta = 'ANULADO' "
            . " WHERE det_min_trab_id= $id");

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
    $query = $base_datos->conectar()->prepare("SELECT `det_min_trab_id`, `con_id`, 
            `det_mjt_patrl`, `det_mjt_fe_pla`,
            `det_mjt_esta`, `det_min_trab_desc` 
            FROM `det_min_trab` 
            WHERE con_id = :id_contrato");

    $query->execute([
        'id_contrato' => $json_datos['id_contrato']
    ]);
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'det_min_trab_id' => $fila['det_min_trab_id'],
                'con_id' => $fila['con_id'],
                'det_mjt_patrl' => $fila['det_mjt_patrl'],
                'det_mjt_fe_pla' => $fila['det_mjt_fe_pla'],
                'det_mjt_esta' => $fila['det_mjt_esta'],
                'det_min_trab_desc' => $fila['det_min_trab_desc']
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
    grilla();
}

function grilla() {
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT 
            con.con_id,
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            dt.det_mjt_patrl,
            dt.det_mjt_fe_pla,
            dt.det_mjt_esta,
            dt.det_min_trab_desc,
            dt.det_min_trab_id,
            car.car_descri
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id = c.cur_id
            JOIN contrato con 
            ON con.func_id = e.func_id
            join det_min_trab dt 
            ON dt.con_id = con.con_id
            JOIN cargos car 
            ON car.car_id = con.car_id
            ORDER BY dt.det_min_trab_id DESC 
            LIMIT 30");

    $query->execute();
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'personal' => $fila['personal'],
                'cedula' => $fila['cedula'],
                'car_descri' => $fila['car_descri'],
                'det_mjt_patrl' => $fila['det_mjt_patrl'],
                'det_mjt_esta' => $fila['det_mjt_esta'],
                'det_min_trab_desc' => $fila['det_min_trab_desc'],
                'det_min_trab_id' => $fila['det_min_trab_id'],
                'det_mjt_fe_pla' => $fila['det_mjt_fe_pla']
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
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------


if (isset($_POST['paraxmlempleados'])) {
    paraxmlempleados($_POST['paraxmlempleados']);
}

function paraxmlempleados() {
    
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT 
			CONCAT(p.cedula,'-', t.con_id) as nro_patronal,
            p.per_nom,
            p.per_apell,
            p.per_nacim,
            p.per_nacion,
            p.per_direc,
            p.cedula,
            t.con_salario,
            car.car_descri,
            if(p.per_genero = 'FEMEMINO', 'F', 'M') AS sexo,
            if(p.per_est_civ = 'SOLTERO', 'S', 'C') as estado_civil,
            p.per_nacion,
            p.per_direc,
            p.per_nacim,
            t.profesion,
             (SELECT
        COUNT(db.bon_id) as cantidad
        FROM  det_bonif db 
        JOIN bonif_filia b 
        WHERE b.con_id = t.con_id 
        and YEAR(CURDATE())-YEAR(db.fecha_nacimiento)  < 18) as hijos,
        if(t.con_fin is null, '-' , t.con_fin ) as con_fin,
        if(t.motivo_salida is null, '-', t.motivo_salida) as motivo_salida,
        t.con_emis
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id  = c.cur_id
            JOIN contrato t 
            ON t.func_id = e.func_id
            join cargos car 
            ON car.car_id = t.car_id");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'Nropatronal' => $fila['nro_patronal'],
                'Documento' => $fila['cedula'],
                'Nombre' => $fila['per_nom'],
                'Apellido' => $fila['per_apell'],
                'Sexo' => $fila['sexo'],
                'Estadocivil' => $fila['estado_civil'],
                'Fechanac' => $fila['per_nacim'],
                'Nacionalidad' => $fila['per_nacion'],
                'Domicilio' => $fila['per_direc'],
                'Fechanacmenor' => '',
                'hijosmenores' => $fila['hijos'],
                'cargo' => $fila['car_descri'],
                'profesion' => $fila['profesion'],
                'fechaentrada' => $fila['con_emis']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}