<?php

require_once '../conexion/db.php';
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

if (isset($_POST['dame_activos'])) {
    dameActivos();
}

function dameActivos() {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `dep_id`, `dep_descri`,"
            . "IF(`dep_estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `departamento` WHERE dep_estado = 1");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();
        foreach ($query as $fila) {
          array_push($arreglo, array(
                'dep_id' => $fila['dep_id'],
                'dep_descri' => $fila['dep_descri'],
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

//guardar
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO `departamento`"
            . "( `dep_descri`, `dep_estado`) "
            . "VALUES (:dep_descri, :dep_estado)");

    $query->execute([
        'dep_descri' => $json_datos['descripcion'],
        'dep_estado' => $json_datos['estado']
    ]);
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------


if (isset($_POST['dame_todo'])) {
    dameTodo();
}

function dameTodo() {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `dep_id`, `dep_descri`,"
            . "IF(`dep_estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `departamento`");

    $query->execute();
    
    if($query->rowCount()) {
        $arreglo = array();
        
        foreach ($query as $fila) {
           array_push($arreglo, array(
                'dep_id' => $fila['dep_id'],
                'dep_descri' => $fila['dep_descri'],
                'estado' => $fila['estado']
            ));
        }
        echo json_encode($arreglo);
                
    }else{
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
    $query = $base_datos->conectar()->prepare("SELECT `dep_id`, `dep_descri`,"
            . "`dep_estado` as estado "
            . "FROM `departamento` WHERE dep_id = $id");

    $query->execute();
    
    if($query->rowCount()) {
        $arreglo = array();
        
        foreach ($query as $fila) {
           array_push($arreglo, array(
                'dep_id' => $fila['dep_id'],
                'dep_descri' => $fila['dep_descri'],
                'estado' => $fila['estado']
            ));
        }
        echo json_encode($arreglo);
                
    }else{
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
    $query = $base_datos->conectar()->prepare("UPDATE `departamento` SET "
            . "`dep_descri`=:descripcion,`dep_estado`=:estado WHERE dep_id = :id_departamento");

    $query->execute([
        'descripcion' => $json_datos['descripcion'],
        'estado' => $json_datos['estado'],
        'id_departamento' => $json_datos['id_departamento']
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
            . " DELETE FROM departamento "
            . " WHERE dep_id = $id");

    $query->execute();
      
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

if (isset($_POST['desactivar'])) {
    desactivar($_POST['desactivar']);
}

function desactivar($id) {
    
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare(""
            . " UPDATE departamento SET dep_estado = 0 "
            . " WHERE dep_id = $id");

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
    $query = $base_datos->conectar()->prepare("SELECT `dep_id`, `dep_descri`,"
            . "IF(`dep_estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `departamento` WHERE UPPER(dep_descri) LIKE '%$nombre%'");

    
    $query->execute();
    
    if($query->rowCount()) {
        $arreglo = array();
        
        foreach ($query as $fila) {
            array_push($arreglo, array(
                'dep_id' => $fila['dep_id'],
                'dep_descri' => $fila['dep_descri'],
                'estado' => $fila['estado']
            ));
        }
        echo json_encode($arreglo);
                
    }else{
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
    $query = $base_datos->conectar()->prepare("SELECT `dep_id`, `dep_descri`,"
            . "IF(`dep_estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `departamento` WHERE UPPER(dep_descri) LIKE '$nombre'");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();
        foreach ($query as $fila) {
             array_push($arreglo, array(
                'dep_id' => $fila['dep_id'],
                'dep_descri' => $fila['dep_descri'],
                'estado' => $fila['estado']
            ));
        }
        echo json_encode($arreglo);
    } else {
        echo '0';
    }
}    