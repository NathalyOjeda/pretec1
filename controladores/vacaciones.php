<?php

require_once '../conexion/db.php';

//guardar
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO `vacaciones`( `vac_dias`,
                         `vac_salida`, `vac_fin`,
                         `vac_estado`, `con_id`) 
                         VALUES (:vac_dias, :vac_salida, :vac_fin, :vac_estado, :con_id)");

    $query->execute([
        'vac_dias' => $json_datos['vac_dias'],
        'vac_salida' => $json_datos['vac_salida'],
        'vac_fin' => $json_datos['vac_fin'],
        'vac_estado' => $json_datos['vac_estado'],
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
        v.vac_dias,
        v.vac_id,
        v.vac_salida,
        v.vac_fin,
        v.vac_estado
        FROM vacaciones v 
        WHERE v.con_id = $id order by v.vac_estado DESC");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'vac_dias' => $fila['vac_dias'],
                'vac_id' => $fila['vac_id'],
                'vac_salida' => $fila['vac_salida'],
                'vac_fin' => $fila['vac_fin'],
                'vac_estado' => $fila['vac_estado']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}

if (isset($_POST['pagadas'])) {
    pagadas($_POST['pagadas']);
}

function pagadas($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT 
        SUM(v.vac_dias) AS dias
        
        FROM vacaciones v 
        WHERE v.con_id = :id and v.vac_salida between :desde and :hasta and v.vac_estado = 'CONFIRMADO' order by v.vac_estado DESC");

    $query->execute([
        "id" => $json_datos['id_contrato'],
        "desde" => $json_datos['desde'],
        "hasta"=> $json_datos['hasta']
    ]);

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'dias' => $fila['dias'],
                
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


if (isset($_POST['dias'])) {
    dias($_POST['dias']);
}

function dias($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT 
if(sum(v.vac_dias) is null, 0, sum(v.vac_dias)) as dias
FROM vacaciones v 
WHERE v.con_id =  $id AND YEAR(v.vac_salida) = year(now()) and v.vac_estado = 'CONFIRMADO'");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
         
                echo  $fila['dias'];
            
        }
        
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

if (isset($_POST['cambiar_estado'])) {
    cambiar_estado($_POST['cambiar_estado']);
}

function cambiar_estado($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare(""
            . " UPDATE  vacaciones SET vac_estado = :estado "
            . " WHERE 	vac_id = :id");

    $query->execute([
        'estado' => $json_datos['estado'],
        'id' => $json_datos['id']
    ]);
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
        v.vac_dias,
        v.vac_id,
        v.vac_salida,
        v.vac_fin,
        v.vac_estado
        FROM vacaciones v 
        WHERE v.con_id = :id order by v.vac_estado DESC");

    $query->execute([
        'id' => $json_datos['id_contrato']
    ]);

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'vac_dias' => $fila['vac_dias'],
                'vac_id' => $fila['vac_id'],
                'vac_salida' => $fila['vac_salida'],
                'vac_fin' => $fila['vac_fin'],
                'vac_estado' => $fila['vac_estado']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}
