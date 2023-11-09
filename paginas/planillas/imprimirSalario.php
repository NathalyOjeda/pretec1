

<?php
//importaciones de db para conexiones

require_once '../../conexion/db.php';

$base_datos = new DB();
$query = $base_datos->conectar()->prepare("SELECT 
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            car.car_descri,
            ds.total_extra,
            ds.total_descuento + ds.ips as total_descuento,
            ds.sal_id,
            ds.ips,
            ds.sal_mes,
            ds.estado
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id  = c.cur_id
            JOIN contrato t 
            ON t.func_id = e.func_id
            join cargos car 
            ON car.car_id = t.car_id
            JOIN  det_salario ds 
            ON ds.con_id = t.con_id
            WHERE ds.det_salario_id = " . $_GET['id']);

$arreglo = array();
$query->execute();
if ($query->rowCount()) {

    foreach ($query as $fila) {
        array_push($arreglo, array(
            'personal' => $fila['personal'],
            'cedula' => $fila['cedula'],
            'car_descri' => $fila['car_descri'],
            'total_extra' => $fila['total_extra'],
            'ips' => $fila['ips'],
            'total_descuento' => $fila['total_descuento'],
            'sal_id' => $fila['sal_id'],
            'sal_mes' => $fila['sal_mes'],
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
        
        <script src="../../css/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <link href="../../css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">    </head>
    <body style="margin: 30px auto; width: 700px;
          box-shadow: 1px 1px 10px 5px #999999; padding: 50px;">
        <img src="../../images/originalcabecera.png" style="width: 100%;" alt="">
        
        <hr> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h3>Datos del empleado</h3>
                </div>
                <div class="col-md-3">
                    <label>Nombre y Apellido: </label><br> <?php echo $arreglo[0]['personal'] ?>

                </div>
                <div class="col-md-3">
                    <label>Cédula: </label><br><?php echo $arreglo[0]['cedula'] ?>

                </div>
                <div class="col-md-3">
                    <label>Cargo: </label><br><?php echo $arreglo[0]['car_descri'] ?>

                </div>
                <div class="col-md-3">
                    <label>Estado: </label><br><?php echo $arreglo[0]['estado'] ?>

                </div>

            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">

                    <h3>Liquidación de salario</h3>
                </div>
                <div class="col-md-12">
                    <label>Salario base </label><br> <?php echo number_format(is_numeric($arreglo[0]['sal_id']) ? $arreglo[0]['sal_id'] : 0, 0, ',', '.') ?>

                </div>
                <div class="col-md-12">
                    <label>Total Extras </label><br> <?php echo number_format(is_numeric($arreglo[0]['total_extra']) ? $arreglo[0]['total_extra'] : 0, 0, ',', '.') ?>

                </div>
                <div class="col-md-12">
                    <label>Total Descuentos </label><br> <?php echo number_format(is_numeric($arreglo[0]['total_descuento']) ? $arreglo[0]['total_descuento'] : 0, 0, ',', '.') ?>

                </div>
                <div class="col-md-12">
                    <label>Salario Neto </label><br> <?php echo number_format(is_numeric($arreglo[0]['sal_mes']) ? $arreglo[0]['sal_mes'] : 0, 0, ',', '.') ?>

                </div>
                
                
               
            </div>
        </div>

    </body>
    <body style="margin: 30px auto; width: 700px;
          box-shadow: 1px 1px 10px 5px #999999; padding: 50px;">
        <img src="../../images/copiacabecera.png" style="width: 100%;" alt="">
        
        <hr> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h3>Datos del empleado</h3>
                </div>
                <div class="col-md-3">
                    <label>Nombre y Apellido: </label><br> <?php echo $arreglo[0]['personal'] ?>

                </div>
                <div class="col-md-3">
                    <label>Cédula: </label><br><?php echo $arreglo[0]['cedula'] ?>

                </div>
                <div class="col-md-3">
                    <label>Cargo: </label><br><?php echo $arreglo[0]['car_descri'] ?>

                </div>
                <div class="col-md-3">
                    <label>Estado: </label><br><?php echo $arreglo[0]['estado'] ?>

                </div>

            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">

                    <h3>Liquidación de salario</h3>
                </div>
                <div class="col-md-12">
                    <label>Salario base </label><br> <?php echo number_format(is_numeric($arreglo[0]['sal_id']) ? $arreglo[0]['sal_id'] : 0, 0, ',', '.') ?>

                </div>
                <div class="col-md-12">
                    <label>Total Extras </label><br> <?php echo number_format(is_numeric($arreglo[0]['total_extra']) ? $arreglo[0]['total_extra'] : 0, 0, ',', '.') ?>

                </div>
                <div class="col-md-12">
                    <label>Total Descuentos </label><br> <?php echo number_format(is_numeric($arreglo[0]['total_descuento']) ? $arreglo[0]['total_descuento'] : 0, 0, ',', '.') ?>

                </div>
                <div class="col-md-12">
                    <label>Salario Neto </label><br> <?php echo number_format(is_numeric($arreglo[0]['sal_mes']) ? $arreglo[0]['sal_mes'] : 0, 0, ',', '.') ?>

                </div>
                
                
               
            </div>
        </div>

    </body>
</html>

<script>

    window.print();
</script>