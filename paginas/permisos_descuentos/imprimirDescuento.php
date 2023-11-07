

<?php
//importaciones de db para conexiones

require_once '../../conexion/db.php';

$base_datos = new DB();
$query = $base_datos->conectar()->prepare("SELECT 
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            dm.des_mot_desci,
            d.des_fec,
            d.des_monto,
            d.estado
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id  = c.cur_id
            JOIN contrato t 
            ON t.func_id = e.func_id
            JOIN descuento d 
            ON d.con_id = t.con_id
            JOIN desc_motiv dm 
            ON dm.des_motiv_id = d.des_motiv_id
            WHERE d.des_id =" . $_GET['id']);

$arreglo = array();
$query->execute();
if ($query->rowCount()) {

    foreach ($query as $fila) {
        array_push($arreglo, array(
            'personal' => $fila['personal'],
            'cedula' => $fila['cedula'],
            'des_mot_desci' => $fila['des_mot_desci'],
            'des_fec' => $fila['des_fec'],
            'des_monto' => $fila['des_monto'],
            'estado' => $fila['estado']
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
        <title>DETALLE DEL DESCUENTO</title>
        <script src="../../css/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <link href="../../css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">    </head>
    <body style="margin: 30px auto; width: 700px;
          box-shadow: 1px 1px 10px 5px #999999; padding: 50px;">
        <img src="../../images/membrete.jpg" style="width: 100%;" alt="">
        <h2 style="margin-top: 20px;"><center>DETALLE DEL DESCUENTO</center></h2>
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

                    <h3>Datos del descuento</h3>
                </div>
                <div class="col-md-3">
                    <label>Fecha </label><br> <?php echo $arreglo[0]['des_fec'] ?>

                </div>
                <div class="col-md-3">
                    <label>Motivo: </label><br><?php echo $arreglo[0]['des_mot_desci'] ?>

                </div>
                
                <div class="col-md-3">
                    <label>Monto: </label><br><?php echo $arreglo[0]['des_monto'] ?>

                </div>
                <div class="col-md-3">
                    <label>Estado: </label><br><?php echo $arreglo[0]['estado'] ?>

                </div>
               
            </div>
        </div>

    </body>
</html>

<script>

    window.print();
</script>