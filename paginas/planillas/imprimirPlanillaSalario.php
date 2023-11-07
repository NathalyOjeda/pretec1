

<?php
//importaciones de db para conexiones

require_once '../../conexion/db.php';

$base_datos = new DB();
$query = $base_datos->conectar()->prepare("SELECT 
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            car.car_descri,
            ds.total_extra,
            ds.total_descuento,
            ds.sal_id,
            ds.sal_mes
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
            WHERE ds.sal_fec_emis BETWEEN  '" . $_GET['desde'] . "' AND '" . $_GET['hasta'] . "' "
        . "and ds.estado = 'ACTIVO'");

$arreglo = array();
$query->execute();
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
        <title>PLANILLA POR PERIODO DE SALARIOS</title>
        <script src="../../css/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <link href="../../css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">    </head>
    <body style="margin: 30px auto; width: 700px;
          box-shadow: 1px 1px 10px 5px #999999; padding: 50px;">
        <img src="../../images/membrete.jpg" style="width: 100%;" alt="">
        <h2 style="margin-top: 20px;"><center>PLANILLA POR PERIODO DE SALARIOS</center></h2>
        <hr> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h3>Periodos</h3>
                </div>
                <div class="col-md-4">
                    <label>Desde: </label><br> <?php echo $_GET['desde'] ?>

                </div>
                <div class="col-md-4">
                    <label>Hasta: </label><br> <?php echo $_GET['hasta'] ?>

                </div>


            </div>
            <hr>
            <div class="row">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Empleado</th>
                            <th>Cédula de Identidad</th>
                            <th>Cargo</th>
                            <th>Salario Base</th>
                            <th>Total extras</th>
                            <th>Total descuento</th>
                            <th>Salario Neto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        if ($query->rowCount()) {
                            foreach ($query as $fila) {
                                echo "<tr>";
                                echo "<td>" . $fila['personal'] . "</td>";
                                echo "<td>" . $fila['cedula'] . "</td>";
                                echo "<td>" . $fila['car_descri'] . "</td>";
                                echo "<td>" . number_format(is_numeric($fila['sal_id']) ? $fila['sal_id'] : 0, 0, ',', '.') . "</td>";
                                echo "<td>" . number_format(is_numeric($fila['total_extra']) ? $fila['total_extra'] : 0, 0, ',', '.') . "</td>";
                                echo "<td>" . number_format(is_numeric($fila['total_descuento']) ? $fila['total_descuento'] : 0, 0, ',', '.') . "</td>";
                                echo "<td>" . number_format(is_numeric($fila['sal_mes']) ? $fila['sal_mes'] : 0, 0, ',', '.') . "</td>";
                                echo "</tr>";
                                $total += (is_numeric($fila['sal_mes'])) ? $fila['sal_mes'] : 0;
                            }
                        } else {
                            echo "NO HAY REGISTROS";
                        }
                        ?>
                    </tbody>
                </table>
                <hr>
                <div class="col-md-12" style="text-align: right; font-size: 20px; font-weight: bolder;">
                    Total <span><?php echo number_format(is_numeric($total) ? $total : 0, 0, ',', '.') ?></span>
                </div>
            </div>
        </div>

    </body>
</html>

<script>

    window.print();
</script>