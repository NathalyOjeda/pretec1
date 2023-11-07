

<?php
//importaciones de db para conexiones

require_once '../../conexion/db.php';

$base_datos = new DB();
$query = $base_datos->conectar()->prepare("SELECT 
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            car.car_descri,
            a.agui_sal_bas,
            a.agui_tot_ing,
            a.agui_tot_egr,
            a.agui_sal_net,
            a.agui_estado,
            a.agui_id,
            a.agui_fecha,
            a.agui_nic,
            a.agui_ruc,
            a.agui_di_trab,
            a.agui_q_horas,
            a.agui_bnf_fli,
            a.agui_ips,
            a.agui_anticip
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id  = c.cur_id
            JOIN contrato t 
            ON t.func_id = e.func_id
            JOIN cargos car 
            ON car.car_id = t.car_id
            JOIN aguinaldo a 
            ON a.con_id = t.con_id
            WHERE YEAR(a.agui_fecha)  = " . $_GET['anio'] . ""
        . " and a.agui_estado = 'ACTIVO'");

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
    <body style="margin: 30px auto; width: 800px;
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
                    <label>Año: </label><br> <?php echo $_GET['anio'] ?>

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
                            <th>Dias Trabajados</th>
                            <th>Anticipo</th>
                            <th>Aguinaldo</th>
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
                                echo "<td>" . number_format(is_numeric($fila['agui_sal_bas']) ? $fila['agui_sal_bas'] : 0, 0, ',', '.') . "</td>";
                                echo "<td>" . $fila['agui_di_trab'] . "</td>";
                                echo "<td>" . number_format(is_numeric($fila['agui_anticip']) ? $fila['agui_anticip'] : 0, 0, ',', '.') . "</td>";
                                echo "<td>" . number_format(is_numeric($fila['agui_sal_net']) ? $fila['agui_sal_net'] : 0, 0, ',', '.') . "</td>";
                                echo "</tr>";
                                $total += (is_numeric($fila['agui_sal_net'])) ? $fila['agui_sal_net'] : 0;
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