

<?php
//importaciones de db para conexiones

require_once '../../conexion/db.php';

$base_datos = new DB();
$query = $base_datos->conectar()->prepare("SELECT 
c.cur_id,
c.cur_fecha,
c.cur_des,
if(e.estado = 1, 'ACTIVO', 'INACTIVO') as estado,
p.per_apell,
p.per_nom,
p.cedula,
p.per_nacim,
p.per_direc,
p.per_genero,
p.per_ciud,
p.per_nacion,
p.per_est_civ,
p.per_correo,
p.per_telfono,
e.func_ingreso,
IF(e.func_baja IS NULL, 'NO ESPECIFICADO', e.func_baja) as func_baja,
s.suc_descri as sucursal
FROM curriculum c 
JOIN personal p
ON p.per_id = c.per_id
JOIN empleados e 
ON e.cur_id = c.cur_id
JOIN sucursal s 
ON s.suc_id = e.suc_id
WHERE e.func_id =" . $_GET['id']);

$arreglo = array();
$query->execute();
if ($query->rowCount()) {

    foreach ($query as $fila) {
        array_push($arreglo, array(
            'cur_id' => $fila['cur_id'],
            'func_ingreso' => $fila['func_ingreso'],
            'sucursal' => $fila['sucursal'],
            'func_baja' => $fila['func_baja'],
            'cur_fecha' => $fila['cur_fecha'],
            'cur_des' => $fila['cur_des'],
            'estado' => $fila['estado'],
            'per_apell' => $fila['per_apell'],
            'per_nom' => $fila['per_nom'],
            'cedula' => $fila['cedula'],
            'per_nacim' => $fila['per_nacim'],
            'per_direc' => $fila['per_direc'],
            'per_genero' => $fila['per_genero'],
            'per_ciud' => $fila['per_ciud'],
            'per_nacion' => $fila['per_nacion'],
            'per_est_civ' => $fila['per_est_civ'],
            'per_correo' => $fila['per_correo'],
            'per_telfono' => $fila['per_telfono']
        ));
    }
} else {
    
}
?>
<!doctype html>
<html lang="es">
    <style>
        label{
            font-weight: bolder;
        }
        .row{
            margin-top: 10px;
        }
        .col-md-6{
            margin-top: 20px;
        }
    </style>
    <head>
        <meta charset="UTF-8">
        <title>DETALLE DEL EMPLEADO</title>
        <script src="../../css/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <link href="../../css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">    </head>
    <body style="margin: 30px auto; width: 700px;
          box-shadow: 1px 1px 10px 5px #999999; padding: 50px;">
        <img src="../../images/membrete.jpg" style="width: 100%;" alt="">
        <h2 style="margin-top: 20px;"><center>DETALLE DEL EMPLEADO</center></h2>
        <hr> 
        <h4>Detalles Especificos del empleo</h4>
        <hr> 
        <div class="row">
            <div class="col-md-3">
                <label>Fecha de ingreso</label><br>
                <span><?php echo $arreglo[0]['func_ingreso'] ?></span>
            </div>
            <div class="col-md-3">
                <label>Fecha de Baja</label><br>
                <span><?php echo $arreglo[0]['func_baja'] ?></span>
            </div>
            <div class="col-md-3">
                <label>Estado</label><br>
                <span><?php echo $arreglo[0]['estado'] ?></span>
            </div>
            <div class="col-md-3">
                <label>Sucursal</label><br>
                <span><?php echo $arreglo[0]['sucursal'] ?></span>
            </div>
        </div>
        <hr> 
        <h4>Detalles del Personal</h4>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <label>Nombre</label><br>
                <span><?php echo $arreglo[0]['per_nom'] ?></span>
            </div>
            <div class="col-md-6">
                <label>Apellido</label><br>
                <span><?php echo $arreglo[0]['per_apell'] ?></span>
            </div>
            <div class="col-md-6">
                <label>Cédula de identidad</label><br>
                <span><?php echo $arreglo[0]['cedula'] ?></span>
            </div>
            <div class="col-md-6">
                <label>Fecha de nacimiento</label><br>
                <span><?php echo $arreglo[0]['per_nacim'] ?></span>
            </div>
            <div class="col-md-6">
                <label>Dirección</label><br>
                <span><?php echo $arreglo[0]['per_direc'] ?></span>
            </div>
            <div class="col-md-6">
                <label>Ciudad</label><br>
                <span><?php echo $arreglo[0]['per_ciud'] ?></span>
            </div>
            <div class="col-md-6">
                <label>Género</label><br>
                <span><?php echo $arreglo[0]['per_genero'] ?></span>
            </div>
            <div class="col-md-6">
                <label>Nación</label><br>
                <span><?php echo $arreglo[0]['per_nacion'] ?></span>
            </div>
            <div class="col-md-6">
                <label>Estado Civil</label><br>
                <span><?php echo $arreglo[0]['per_est_civ'] ?></span>
            </div>
            <div class="col-md-6">
                <label>Correo</label><br>
                <span><?php echo $arreglo[0]['per_correo'] ?></span>
            </div>
            <div class="col-md-6">
                <label>Teléfono</label><br>
                <span><?php echo $arreglo[0]['per_telfono'] ?></span>
            </div>
            
        </div>


    </body>
</html>

<script>

    window.print();
</script>