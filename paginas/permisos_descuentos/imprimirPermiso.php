

<?php
//importaciones de db para conexiones

require_once '../../conexion/db.php';

$base_datos = new DB();
$query = $base_datos->conectar()->prepare("SELECT 
          
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            per.perm_descri,
            per.perm_fec_solic,
            per.perm_estado,
            per.perm_fec_desde,
            per.perm_fec_hasta
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id  = c.cur_id
            JOIN contrato t 
            ON t.func_id = e.func_id
            JOIN permiso per 
            ON per.con_id = t.con_id
            WHERE per.perm_id = " . $_GET['id']);

$arreglo = array();
$query->execute();
if ($query->rowCount()) {

    foreach ($query as $fila) {
        array_push($arreglo, array(
            'personal' => $fila['personal'],
            'cedula' => $fila['cedula'],
            'perm_descri' => $fila['perm_descri'],
            'perm_fec_solic' => $fila['perm_fec_solic'],
            'perm_estado' => $fila['perm_estado'],
            'perm_fec_desde' => $fila['perm_fec_desde'],
            'perm_fec_hasta' => $fila['perm_fec_hasta']
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
        <title>DETALLE DEL PERMISO</title>
        <script src="../../css/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <link href="../../css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">    </head>
    <body style="margin: 30px auto; width: 700px;
          box-shadow: 1px 1px 10px 5px #999999; padding: 50px;">
        <img src="../../images/membrete.jpg" style="width: 100%;" alt="">
        <h2 style="margin-top: 20px;"><center>DETALLE DEL PERMISO</center></h2>
        <hr> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h3>Datos del empleado</h3>
                </div>
                <div class="col-md-4">
                    <label>Nombre y Apellido: </label><br> <?php echo $arreglo[0]['personal'] ?>

                </div>
                <div class="col-md-4">
                    <label>Cédula: </label><br><?php echo $arreglo[0]['cedula'] ?>

                </div>

            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">

                    <h3>Datos del permiso</h3>
                </div>
                <div class="col-md-3">
                    <label>Fecha de solicitud</label><br> <?php echo $arreglo[0]['perm_fec_solic'] ?>

                </div>
                
                <div class="col-md-3">
                    <label>Desde: </label><br><?php echo $arreglo[0]['perm_fec_desde'] ?>

                </div>
                <div class="col-md-3">
                    <label>Hasta: </label><br><?php echo $arreglo[0]['perm_fec_hasta'] ?>

                </div>
                <div class="col-md-3">
                    <label>Estado: </label><br><?php echo $arreglo[0]['perm_estado'] ?>

                </div>
                <div class="col-md-12">
                    <label>Descripción: </label><br><?php echo $arreglo[0]['perm_descri'] ?>

                </div>

            </div>
        </div>

    </body>
</html>

<script>

    window.print();
</script>