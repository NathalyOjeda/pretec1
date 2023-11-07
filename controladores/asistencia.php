<?php
require_once '../conexion/db.php';

//guardar
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO `asistencia`(
        `asi_hor_entr`, `asi_fech`, `con_id`, asi_descri)
        VALUES (:asi_hor_entr, :asi_fech, :con_id, :asi_descri)");

    $query->execute([
        'asi_hor_entr' => $json_datos['asi_hor_entr'],
        'asi_fech' => $json_datos['asi_fech'],
        'asi_descri' => $json_datos['asi_descri'],
        'con_id' => $json_datos['con_id']
    ]);
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
if (isset($_POST['actualizar_salida'])) {
    actualizarSalida($_POST['actualizar_salida']);
}

function actualizarSalida($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("UPDATE  `asistencia` SET
         `asi_hor_sali` = :asi_hor_sali
        WHERE asi_id =  :asi_id");

    $query->execute([
        'asi_id' => $json_datos['asi_id'],
        'asi_hor_sali' => $json_datos['asi_hor_sali']
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
    $query = $base_datos->conectar()->prepare("SELECT MAX(`func_id`) AS id"
            . " FROM `empleados`");

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


if (isset($_POST['buscar_asistencia'])) {
    buscarAsistencia($_POST['buscar_asistencia']);
}

function buscarAsistencia($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT
        a.asi_id,
        a.asi_hor_entr
        FROM asistencia a 
        where a.con_id = $id and a.asi_hor_sali is null ");

    $query->execute();

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'asi_id' => $fila['asi_id'],
                'asi_hor_entr' => $fila['asi_hor_entr']
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


if (isset($_POST['total_asistencia'])) {
    total_asistencia($_POST['total_asistencia']);
}

function total_asistencia($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT
        count(a.asi_id) as cantidad
        FROM asistencia a 
        where a.con_id = :id and a.asi_fech = :fecha and a.asi_hor_sali is not null ");

    $query->execute([
        'id' => $json_datos['id'],
        'fecha' => $json_datos['fecha']
    ]);

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            echo $fila['cantidad'];
        }
        
    } else {
        echo '0';
    }
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------


if (isset($_POST['total_horas'])) {
    total_horas($_POST['total_horas']);
}

function total_horas($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT 
ROUND(sum(TIMESTAMPDIFF(MINUTE , asi_hor_entr, asi_hor_sali)) / 60) AS hora
FROM `asistencia`
WHERE con_id = :id and YEAR(asi_fech) =  :fecha ");

    $query->execute([
        'id' => $json_datos['id'],
        'fecha' => $json_datos['fecha']
    ]);

    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            echo $fila['hora'];
        }
        
    } else {
        echo '0';
    }
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

if (isset($_POST['b_asistancias_filtro'])) {
    buscarAsistenciaFiltro($_POST['b_asistancias_filtro']);
}

function buscarAsistenciaFiltro($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT
            a.asi_id,
            a.asi_fech,
            a.asi_hor_entr,
            IF(a.asi_hor_sali is null, 'NO ASIGNADO', a.asi_hor_sali) asi_hor_sali,
            a.asi_descri
            FROM asistencia a 
            WHERE a.con_id = :id_contrato and 
            a.asi_fech BETWEEN :desde and :hasta");

    $query->execute([
        'id_contrato' => $json_datos['id_contrato'],
        'desde' => $json_datos['desde'],
        'hasta' => $json_datos['hasta']
    ]);
    
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'asi_id' => $fila['asi_id'],
                'asi_hor_entr' => $fila['asi_hor_entr'],
                'asi_hor_sali' => $fila['asi_hor_sali'],
                'asi_fech' => $fila['asi_fech'],
                'asi_descri' => $fila['asi_descri']
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

if (isset($_POST['id'])) {
    registroPorID($_POST['id']);
}

function registroPorID($id) {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT
            a.asi_id,
            a.asi_fech,
            a.asi_hor_entr,
            IF(a.asi_hor_sali is null, 'NO ASIGNADO', a.asi_hor_sali) asi_hor_sali,
            a.asi_descri
            FROM asistencia a 
            WHERE a.asi_id = $id");

    $query->execute();
    if ($query->rowCount()) {
        $arreglo = array();

        foreach ($query as $fila) {
            array_push($arreglo, array(
                'asi_id' => $fila['asi_id'],
                'asi_hor_entr' => $fila['asi_hor_entr'],
                'asi_hor_sali' => $fila['asi_hor_sali'],
                'asi_fech' => $fila['asi_fech'],
                'asi_descri' => $fila['asi_descri']
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
    $query = $base_datos->conectar()->prepare("UPDATE asistencia  SET 
            asi_fech = :asi_fech,
            asi_hor_entr = :asi_hor_entr,
            asi_hor_sali = :asi_hor_sali,
            asi_descri = :asi_descri
        WHERE asi_id = :asi_id  ");

    $query->execute([
       'asi_fech' => $json_datos['asi_fech'],
       'asi_hor_entr' => $json_datos['asi_hor_entr'],
       'asi_hor_sali' => $json_datos['asi_hor_sali'],
        'asi_descri' => $json_datos['asi_descri'],
        'asi_id' => $json_datos['asi_id']
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
            . " UPDATE empleados SET estado = 0 "
            . " WHERE func_id = $id");

    $query->execute();
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------


if (isset($_POST['dias_trabajados'])) {
    diasTrabajados($_POST['dias_trabajados']);
}

function diasTrabajados($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT
        if(COUNT(a.asi_id) is null, 0, COUNT(a.asi_id)) as dias
        FROM asistencia a 
        WHERE a.con_id =  :id_contrato  and YEAR(a.asi_fech) = :anio");

    $query->execute([
        "id_contrato" => $json_datos['id_contrato'],
        "anio" => $json_datos['anio']
    ]);

    if ($query->rowCount()) {
        

        foreach ($query as $fila) {
            echo $fila['dias'];
            
        }
        
    } else {
        echo '0';
    }
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------


if (isset($_POST['horas_trabajados'])) {
    horasTrabajados($_POST['horas_trabajados']);
}

function horasTrabajados($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT
        SEC_TO_TIME(sum(TIMEDIFF(a.asi_hor_sali, a.asi_hor_entr))) as hora
        FROM asistencia a 
        WHERE a.con_id =  :id_contrato  and YEAR(a.asi_fech) = :anio");

    $query->execute([
        "id_contrato" => $json_datos['id_contrato'],
        "anio" => $json_datos['anio']
    ]);

    if ($query->rowCount()) {
        

        foreach ($query as $fila) {
            echo $fila['hora'];
            
        }
        
    } else {
        echo '0';
    }
}