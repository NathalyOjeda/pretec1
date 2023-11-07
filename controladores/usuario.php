<?php
require_once '../conexion/db.php';
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

if (isset($_POST['nombre_usuario'])) {
    dameSucursal($_POST['nombre_usuario']);
}

function dameSucursal($usuario) {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT
            u.usu_id,
            CONCAT(p.per_nom, ' ', p.per_apell) as nombre_apellido,
            e.suc_id,
            u.usu_nivel as rol,
            s.suc_descri as sucursal
            FROM usuario u 
            JOIN empleados e 
            ON e.func_id = u.func_id
            JOIN curriculum cu 
            ON cu.cur_id = e.cur_id
            JOIN personal  p 
            ON p.per_id = cu.per_id
            JOIN sucursal s 
            ON s.suc_id = e.suc_id 
            WHERE u.usu_log LIKE '$usuario'");

    $query->execute();

    if ($query->rowCount()) {
        foreach ($query as $fila) {
           echo $fila['sucursal'];
        }
       
    } else {
        echo '0';
    }
}