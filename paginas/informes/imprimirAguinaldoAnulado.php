

<?php
//importaciones de db para conexiones

require_once '../../conexion/db.php';

$base_datos = new DB();
$query = $base_datos->conectar()->prepare("SELECT 
            con.con_id,
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            di.agui_fecha,
            di.agui_tot_ing,
            di.agui_tot_egr,
            di.agui_sal_net,
            di.agui_estado,
            di.agui_sal_bas,
            sum(di.agui_sal_net) AS total
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id = c.cur_id
            JOIN contrato con 
            ON con.func_id = e.func_id
            JOIN aguinaldo di
            ON di.con_id = con.con_id
            
            WHERE di.agui_fecha BETWEEN '" . $_GET['desde'] . "' "
        . "and '" . $_GET['hasta'] . "' and di.agui_estado = 'ANULADO' "
        . " GROUP BY di.agui_id");

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
        <title>INFORME DE LIQUIDACION DE AGUINALDO</title>
        <script src="../../css/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <link href="../../css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">    </head>
    <body style="margin: 30px auto; 
          box-shadow: 1px 1px 10px 5px #999999; padding: 50px;">
        <img src="../../images/membrete.jpg" style="width: 100%;" alt="">
        <h2 style="margin-top: 20px;"><center>INFORME DE LIQUIDACION DE AGUINALDO POR PERIODO</center></h2>
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
                            <th>Total Ingreso</th>
                            <th>Total Egreso</th>
                            <th>Aguinaldo neto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        if ($query->rowCount()) {
                            foreach ($query as $fila) {
                                echo "<tr>";
                                echo "<td>" . $fila['agui_fecha'] . "</td>";
                                echo "<td>" . $fila['personal'] . "</td>";
                                echo "<td>" . $fila['cedula'] . "</td>";
                                echo "<td>" . $fila['agui_sal_bas'] . "</td>";
                                echo "<td>" . $fila['agui_tot_ing'] . "</td>";
                                echo "<td>" . $fila['agui_tot_egr'] . "</td>";
                                echo "<td>" . $fila['agui_sal_net'] . "</td>";

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