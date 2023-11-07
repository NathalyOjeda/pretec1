

<?php
//importaciones de db para conexiones

require_once '../../conexion/db.php';

$base_datos = new DB();
$query = $base_datos->conectar()->prepare("SELECT 
          
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            des.fecha_desvinculacion,
            if(des.justiticado = 1, 'SI', 'NO') as justificado,
            des.descripcion,
            des.ips,
            des.indemnizacion,
            des.total_liquidacion,
            des.preaviso,
            des.aguinaldo,
            des.salario
            
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id  = c.cur_id
            JOIN contrato t 
            ON t.func_id = e.func_id
            JOIN desvinculacion des
            ON des.con_id = t.con_id
            WHERE des.id_desvinculacion = " . $_GET['id']);

$arreglo = array();
$query->execute();
if ($query->rowCount()) {

    foreach ($query as $fila) {
        array_push($arreglo, array(
            'personal' => $fila['personal'],
            'cedula' => $fila['cedula'],
            'fecha_desvinculacion' => $fila['fecha_desvinculacion'],
            'ips' => $fila['ips'],
            'indemnizacion' => $fila['indemnizacion'],
            'total_liquidacion' => $fila['total_liquidacion'],
            'preaviso' => $fila['preaviso'],
            'aguinaldo' => $fila['aguinaldo'],
            'salario' => $fila['salario']
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
        <title>DETALLE DEL DESVINCULACION</title>
        <script src="../../css/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <link href="../../css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">    </head>
    <body style="margin: 30px auto; width: 700px;
          box-shadow: 1px 1px 10px 5px #999999; padding: 50px;">
        <img src="../../images/membrete.jpg" style="width: 100%;" alt="">
        <h2 style="margin-top: 20px;"><center>DETALLE DE DESVINCULACION</center></h2>
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
                <div class="col-md-12" style="margin-top: 30px;">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr align='center'>
                                <th style="width: 70%;">CONCEPTO</th>
                                <th style="width: 30%;" align='right'>MONTO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Salario por días trabajados</td>
                                <td id="salario_dias_trabajados" align='right'><?= $arreglo[0]['salario'] ?></td>
                            </tr>
                            <tr>
                                <td>Preaviso</td>
                                <td id="preaviso" align='right'><?= $arreglo[0]['preaviso'] ?></td>
                            </tr>
                            <tr>
                                <td>Indemnización</td>
                                <td id="indemnizacion" align='right'><?= $arreglo[0]['indemnizacion'] ?></td>
                            </tr>
                            <tr>
                                <td>(-) Descuento por IPS (9%)</td>
                                <td id="ips" align='right'><?= $arreglo[0]['ips'] ?></td>
                            </tr>
                            
                            <tr>
                                <td>Aguinaldo proporcional</td>
                                <td id="aguinaldo" align='right'><?= $arreglo[0]['aguinaldo'] ?></td>
                            </tr>
                            <tr>
                                <th>TOTAL</th>
                                <td id="total" align='right' style="font-weight: bolder;"><?= $arreglo[0]['total_liquidacion'] ?></td>
                            </tr>

                        </tbody>
                    </table>
                </div>


            </div>
        </div>

    </body>
</html>

<script>

//    window.print();
</script>