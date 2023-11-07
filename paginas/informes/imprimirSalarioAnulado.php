

<?php
//importaciones de db para conexiones

require_once '../../conexion/db.php';

$base_datos = new DB();
$query = $base_datos->conectar()->prepare("SELECT 
            con.con_id,
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            di.bon_flia,
            di.sal_id,
            di.sal_mes,
            di.total_extra,
            di.total_descuento,
            di.sal_fec_emis,
            di.estado,
            ips.det_ips_aport,
            sum(sal_mes) AS total
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id = c.cur_id
            JOIN contrato con 
            ON con.func_id = e.func_id
            JOIN det_salario di
            ON di.con_id = con.con_id
            JOIN det_ips ips 
            ON ips.det_ips_id = di.det_ips_id
            WHERE di.sal_fec_emis BETWEEN '" . $_GET['desde'] . "' and '" . $_GET['hasta'] . "' "
        . " AND di.estado =  'ANULADO' "
        . " GROUP BY di.det_salario_id");

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
        <title>INFORME DE LIQUIDACION DE SALARIO</title>
        <script src="../../css/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <link href="../../css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">    </head>
    <body style="margin: 30px auto; 
          box-shadow: 1px 1px 10px 5px #999999; padding: 50px;">
        <img src="../../images/membrete.jpg" style="width: 100%;" alt="">
        <h2 style="margin-top: 20px;"><center>INFORME DE LIQUIDACION DE SALARIO POR PERIODO</center></h2>
        <hr> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h3>PERIODOS DE</h3>
                    <h4>DESDE <?php echo $_GET['desde']; ?></h4>
                    <h4>HASTA <?php echo $_GET['hasta']; ?></h4>
                </div>



            </div>
            <hr>
            <div class="row">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Empleado</th>
                            <th>Cédula de Identidad</th>
                            <th>Salario Básico</th>
                            <th>Bonificación Familia</th>
                            <th>I.P.S</th>
                            <th>Total Extra</th>
                            <th>Total Descuento</th>
                            <th>Sueldo neto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        if ($query->rowCount()) {
                            foreach ($query as $fila) {
                                echo "<tr>";
                                echo "<td>" . $fila['sal_fec_emis'] . "</td>";
                                echo "<td>" . $fila['personal'] . "</td>";
                                echo "<td>" . $fila['cedula'] . "</td>";
                                echo "<td>" . $fila['sal_id'] . "</td>";
                                echo "<td>" . $fila['bon_flia'] . "</td>";
                                echo "<td>" . $fila['det_ips_aport'] . "</td>";
                                echo "<td>" . $fila['total_extra'] . "</td>";
                                echo "<td>" . $fila['total_descuento'] . "</td>";
                                echo "<td>" . $fila['sal_mes'] . "</td>";

                                echo "</tr>";
                                $total = $fila['total'];
                            }
                        } else {
                            echo "NO HAY REGISTROS";
                        }
                        ?>
                    </tbody>
                </table>
                <hr>
                <h1>Total <?php echo $total; ?></h1>
            </div>
        </div>

    </body>
</html>

<script>

    window.print();
</script>