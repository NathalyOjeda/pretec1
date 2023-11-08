<?php

require_once '../conexion/db.php';

//guardar
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO `contrato`(`con_id`, `con_emis`,
                       `contrat_clau`, `con_fin`, `con_salario`, `con_estado`,
                       `car_id`, `dep_id`, `func_id`, profesion) VALUES ((SELECT IF(MAX(c.con_id) IS NULL, 1 , 
                         MAX(c.con_id) + 1)  FROM contrato c), :con_emis, 
                         :contrat_clau, :con_fin, :con_salario, :con_estado, :car_id,
                         :dep_id, :func_id, :profesion)");

    $query->execute([
        'con_emis' => $json_datos['con_emis'],
        'contrat_clau' => $json_datos['contrat_clau'],
        'con_fin' => $json_datos['con_fin'],
        'con_salario' => $json_datos['con_salario'],
        'con_estado' => $json_datos['con_estado'],
        'profesion' => $json_datos['profesion'],
        'car_id' => $json_datos['car_id'],
        'dep_id' => $json_datos['dep_id'],
        'func_id' => $json_datos['func_id']
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
    $query = $base_datos->conectar()->prepare("SELECT MAX(`con_id`) AS id"
            . " FROM `contrato`");

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
    $query = $base_datos->conectar()->prepare("SELECT c.con_id, c.con_emis,
            c.contrat_clau, c.con_fin, c.con_salario, 
            c.con_estado, car_id, c.dep_id, c.func_id , d.dep_descri
            FROM contrato c
            JOIN departamento d 
            ON d.dep_id = c.dep_id
            WHERE con_id   = $id");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'con_id' => $fila['con_id'],
                'dep_descri' => $fila['dep_descri'],
                'con_emis' => $fila['con_emis'],
                'contrat_clau' => $fila['contrat_clau'],
                'con_fin' => $fila['con_fin'],
                'con_salario' => $fila['con_salario'],
                'con_estado' => $fila['con_estado'],
                'car_id' => $fila['car_id'],
                'dep_id' => $fila['dep_id'],
                'func_id' => $fila['func_id']
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
    $query = $base_datos->conectar()->prepare("UPDATE  `contrato` SET
                         `con_emis` = :con_emis,
                       `contrat_clau` = :contrat_clau, `con_fin` = :con_fin, 
                       `con_salario` = :con_salario, `con_estado` = :con_estado,
                       `car_id` = :car_id, `dep_id` = :dep_id, `func_id` = :func_id 
                         WHERE `con_id`= :con_id ");

    $query->execute([
        'con_id' => $json_datos['con_id'],
        'con_emis' => $json_datos['con_emis'],
        'contrat_clau' => $json_datos['contrat_clau'],
        'con_fin' => $json_datos['con_fin'],
        'con_salario' => $json_datos['con_salario'],
        'con_estado' => $json_datos['con_estado'],
        'car_id' => $json_datos['car_id'],
        'dep_id' => $json_datos['dep_id'],
        'func_id' => $json_datos['func_id']
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
            . " UPDATE contrato SET con_estado = 0 "
            . " WHERE con_id = $id");

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
            WHERE p.cedula =  $cedula and con.con_estado = 1");

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

if (isset($_POST['b_nombre_busquedas'])) {
    buscarNombreBusquedas($_POST['b_nombre_busquedas']);
}

function buscarNombreBusquedas($nombre) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $nombre = strtoupper($nombre);
    $query = $base_datos->conectar()->prepare("SELECT 
            con.con_id,
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            ca.car_descri as cargo
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id = c.cur_id
            JOIN contrato con 
            ON con.func_id = e.func_id
            JOIN cargos ca 
            ON ca.car_id = con.car_id
            WHERE UPPER(CONCAT(p.per_nom,' ',p.per_apell)) like  '%$nombre%'");

    $query->execute();
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'con_id' => $fila['con_id'],
                'personal' => $fila['personal'],
                'cedula' => $fila['cedula'],
                'cargo' => $fila['cargo']
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

if (isset($_POST['existe_en_aguinaldo'])) {
    existeEnAguinaldo($_POST['existe_en_aguinaldo']);
}

function existeEnAguinaldo($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT * FROM `aguinaldo`
    WHERE con_id =  $id limit 1");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            echo 1;
        }
    } else {
        echo '0';
    }
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------

if (isset($_POST['existe_en_asistencia'])) {
    existeEnAsistencia($_POST['existe_en_asistencia']);
}

function existeEnAsistencia($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT * FROM `asistencia` 
WHERE con_id =   $id limit 1");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            echo 1;
        }
    } else {
        echo '0';
    }
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------

if (isset($_POST['existe_en_bonificacion'])) {
    existeEnBonificacion($_POST['existe_en_bonificacion']);
}

function existeEnBonificacion($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT * FROM `bonif_filia` 
WHERE con_id =  $id limit 1");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            echo 1;
        }
    } else {
        echo '0';
    }
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------

if (isset($_POST['existe_en_descuento'])) {
    existeEnDescuento($_POST['existe_en_descuento']);
}

function existeEnDescuento($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT * FROM `descuento`
WHERE con_id =  $id limit 1");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            echo 1;
        }
    } else {
        echo '0';
    }
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------

if (isset($_POST['existe_en_det_ips'])) {
    existeEnDetIPS($_POST['existe_en_det_ips']);
}

function existeEnDetIPS($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT * FROM `det_ips` 
WHERE  con_id =  $id limit 1");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            echo 1;
        }
    } else {
        echo '0';
    }
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------

if (isset($_POST['existe_en_det_min'])) {
    existeEnDetMin($_POST['existe_en_det_min']);
}

function existeEnDetMin($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT * FROM `det_min_trab` 
WHERE con_id =  $id limit 1");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            echo 1;
        }
    } else {
        echo '0';
    }
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------

if (isset($_POST['existe_en_det_salario'])) {
    existeEnDetSalario($_POST['existe_en_det_salario']);
}

function existeEnDetSalario($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT * FROM `det_salario`
WHERE con_id =  $id limit 1");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            echo 1;
        }
    } else {
        echo '0';
    }
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------

if (isset($_POST['existe_en_legajo_funcionario'])) {
    existeEnLegajoFuncionario($_POST['existe_en_legajo_funcionario']);
}

function existeEnLegajoFuncionario($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT * FROM `legajo_funcionario` 
WHERE  con_id =  $id limit 1");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            echo 1;
        }
    } else {
        echo '0';
    }
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------

if (isset($_POST['existe_en_permiso'])) {
    existeEnPermiso($_POST['existe_en_permiso']);
}

function existeEnPermiso($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT * FROM `permiso`
WHERE con_id =  $id limit 1");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            echo 1;
        }
    } else {
        echo '0';
    }
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------

if (isset($_POST['existe_en_vacaciones'])) {
    existeEnVacaciones($_POST['existe_en_permiso']);
}

function existeEnVacaciones($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT * FROM `vacaciones` 
WHERE con_id =  $id limit 1 ");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            echo 1;
        }
    } else {
        echo '0';
    }
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------

if (isset($_POST['actualizar_salario'])) {
    actualizar_salario($_POST['actualizar_salario']);
}

function actualizar_salario($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("UPDATE contrato 
set con_salario = :salario
WHERE con_id = :con_id");

    $query->execute([
        'salario' => $json_datos['salario'],
        'con_id' => $json_datos['con_id']
    ]);

    
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
