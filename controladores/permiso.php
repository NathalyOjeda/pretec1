<?php

require_once '../conexion/db.php';

//guardar
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO `permiso`( `con_id`, `jus_per_id`, `perm_descri`,
                      `perm_fec_solic`, `perm_estado`, `perm_fec_desde`, 
                      `perm_fec_hasta`) 
                      VALUES (:con_id, :jus_per_id, :perm_descri, :perm_fec_solic, 
                      :perm_estado, :perm_fec_desde, :perm_fec_hasta)");

    $query->execute([
        'con_id' => $json_datos['con_id'],
        'jus_per_id' => $json_datos['jus_per_id'],
        'perm_descri' => $json_datos['perm_descri'],
        'perm_fec_solic' => $json_datos['perm_fec_solic'],
        'perm_estado' => $json_datos['perm_estado'],
        'perm_fec_desde' => $json_datos['perm_fec_desde'],
        'perm_fec_hasta' => $json_datos['perm_fec_hasta']
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
    $query = $base_datos->conectar()->prepare("SELECT MAX(`perm_id`) AS id"
            . " FROM `permiso`");

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
    $query = $base_datos->conectar()->prepare("SELECT `perm_id`, `con_id`, `jus_per_id`, 
            `perm_descri`, `perm_fec_solic`, `perm_estado`,
            `perm_fec_desde`, `perm_fec_hasta` 
            FROM `permiso` 
            WHERE perm_id =   $id");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'perm_id' => $fila['perm_id'],
                'con_id' => $fila['con_id'],
                'jus_per_id' => $fila['jus_per_id'],
                'perm_descri' => $fila['perm_descri'],
                'perm_fec_solic' => $fila['perm_fec_solic'],
                'perm_estado' => $fila['perm_estado'],
                'perm_fec_desde' => $fila['perm_fec_desde'],
                'perm_fec_hasta' => $fila['perm_fec_hasta']
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


if (isset($_POST['id_func'])) {
    contratoActivo($_POST['id_func']);
}

function contratoActivo($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT 
        t.con_fin
        FROM contrato t
        WHERE t.con_estado = 1 and t.func_id = $id  and t.con_fin >  CURDATE() 
        LIMIT 1");

    $query->execute();

    if ($query->rowCount()) {
        

        foreach ($query as $fila) {
            echo $fila['con_fin'];
        }
            
    } else {
        echo '0';
    }
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------


if (isset($_POST['existe_personal'])) {
    existePersonal($_POST['existe_personal']);
}

function existePersonal($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `cur_id`, `"
            . "cur_fecha`, `cur_des`, `per_id`, `estado`"
            . " FROM `curriculum` WHERE per_id = $id ");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'cur_id' => $fila['cur_id'],
                'cur_fecha' => $fila['cur_fecha'],
                'cur_des' => $fila['cur_des'],
                'per_id' => $fila['per_id'],
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
    $query = $base_datos->conectar()->prepare("UPDATE `permiso` set 
        `jus_per_id` = :jus_per_id, `perm_descri` = :perm_descri,
      `perm_fec_solic` = :perm_fec_solic, `perm_estado`= :perm_estado, `perm_fec_desde` = :perm_fec_desde, 
      `perm_fec_hasta` = :perm_fec_hasta 
      where perm_id = :perm_id");

    $query->execute([
      'perm_id' => $json_datos['perm_id'],
        'jus_per_id' => $json_datos['jus_per_id'],
        'perm_descri' => $json_datos['perm_descri'],
        'perm_fec_solic' => $json_datos['perm_fec_solic'],
        'perm_estado' => $json_datos['perm_estado'],
        'perm_fec_desde' => $json_datos['perm_fec_desde'],
        'perm_fec_hasta' => $json_datos['perm_fec_hasta']
    ]);
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

if (isset($_POST['eliminar'])) {
    eliminar($_POST['eliminar']);
}

function eliminar($id) {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare(""
            . " DELETE FROM cargos "
            . " WHERE car_id = $id");

    $query->execute();
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
            . " UPDATE permiso SET perm_estado = 'ANULADO' "
            . " WHERE perm_id = $id");

    $query->execute();
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
            t.con_id,
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            t.con_emis,
            t.con_fin,
            t.con_salario,
            ca.car_descri as cargo,
            IF(t.con_estado = 1, 'ACTIVO', 'ANULADO') as estado
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id  = c.cur_id
            JOIN contrato t 
            ON t.func_id = e.func_id
            JOIN cargos ca 
            ON ca.car_id = t.car_id
            WHERE UPPER(CONCAT(p.per_nom,' ',p.per_apell)) like '%$nombre%'
            LIMIT 20");

    $query->execute();
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'con_id' => $fila['con_id'],
                'personal' => $fila['personal'],
                'cedula' => $fila['cedula'],
                'con_emis' => $fila['con_emis'],
                'con_fin' => $fila['con_fin'],
                'con_salario' => $fila['con_salario'],
                'cargo' => $fila['cargo'],
                'estado' => $fila['estado']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
if (isset($_POST['b_nombre_exacto'])) {
    PorNombreExacto($_POST['b_nombre_exacto']);
}

function PorNombreExacto($nombre) {
    $nombre = strtoupper($nombre);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `car_id`, `car_descri`,"
            . "IF(`estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `cargos` WHERE UPPER(car_descri) LIKE '$nombre'");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();
        foreach ($query as $fila) {
            array_push($arreglo, array(
                'car_id' => $fila['car_id'],
                'car_descri' => $fila['car_descri'],
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
//------------------------------------------------------------------------------

if (isset($_POST['b_cedula'])) {
    buscarCedula($_POST['b_cedula']);
}

function buscarCedula($cedula) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT 
            con.con_id,
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id = c.cur_id
            JOIN contrato con 
            ON con.func_id = e.func_id
            WHERE p.cedula =  $cedula");

    $query->execute();
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'con_id' => $fila['con_id'],
                'personal' => $fila['personal'],
                'cedula' => $fila['cedula']
               
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

if (isset($_POST['b_filtros'])) {
    buscarFiltro($_POST['b_filtros']);
}

function buscarFiltro($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT
        p.perm_id,
        p.perm_fec_solic,
        p.perm_fec_desde,
        p.perm_fec_hasta,
        p.perm_estado,
        p.perm_descri
        FROM  permiso p 
        WHERE p.con_id = :id_contrato  
        ORDER BY p.perm_id DESC");

    $query->execute([
        'id_contrato' => $json_datos['id_contrato']
    ]);
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'perm_id' => $fila['perm_id'],
                'perm_fec_solic' => $fila['perm_fec_solic'],
                'perm_fec_hasta' => $fila['perm_fec_hasta'],
                'perm_descri' => $fila['perm_descri'],
                'perm_estado' => $fila['perm_estado'],
                'perm_fec_desde' => $fila['perm_fec_desde']
               
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}
