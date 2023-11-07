

<?php
//importaciones de db para conexiones

require_once '../../conexion/db.php';

$base_datos = new DB();
$query = $base_datos->conectar()->prepare("SELECT 
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            date_format(d.det_ips_fe_pg, \"%m-%Y\") as det_ips_fe_pg,
            d.det_ips_des,
            d.det_ips_aport,
            d.det_ips_estado,
            t.con_salario,
            car.car_descri
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id  = c.cur_id
            JOIN contrato t 
            ON t.func_id = e.func_id
            JOIN det_ips d
            ON d.con_id = t.con_id
             join cargos car 
            ON car.car_id = t.car_id
            where d.det_ips_fe_pg BETWEEN '" . $_GET['desde'] . "' AND '" . $_GET['hasta'] . "' "
        . "and d.det_ips_estado = 'ACTIVO'");

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
        <title>PLANILLA POR PERIODO DE APORTES DE IPS</title>
        <script src="../../css/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <link href="../../css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">    </head>
    <body style="margin: 30px auto; width: 700px;
          box-shadow: 1px 1px 10px 5px #999999; padding: 50px;">
        <img src="../../images/membrete.jpg" style="width: 100%;" alt="">
        <h2 style="margin-top: 20px;"><center>PLANILLA POR PERIODO DE APORTES DE IPS</center></h2>
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
                            <th>Descripción</th>
                            <th>Salario Actual</th>
                            <th>Aporte</th>
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
                                echo "<td>" . $fila['det_ips_des'] . "</td>";
                                echo "<td>" . number_format(is_numeric($fila['con_salario']) ? $fila['con_salario'] : 0, 0, ',', '.') . "</td>";
                                echo "<td>" . number_format(is_numeric($fila['det_ips_aport']) ? $fila['det_ips_aport'] : 0, 0, ',', '.') . "</td>";
                                echo "</tr>";
                                $total += (is_numeric($fila['det_ips_aport'])) ? $fila['det_ips_aport'] : 0;
                            }
                        } else {
                            echo "NO HAY REGISTROS";
                        }
                        ?>
                    </tbody>
                </table>
                <hr>
                <div class="col-md-12" style="text-align: right; font-size: 20px; font-weight: bolder;">
                    Total de aportes <span><?php echo number_format(is_numeric($total) ? $total : 0, 0, ',', '.') ?></span>
                </div>
            </div>
        </div>

    </body>
</html>

<script>

    window.print();
</script>