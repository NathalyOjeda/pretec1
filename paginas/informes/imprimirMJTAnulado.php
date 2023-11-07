

<?php
//importaciones de db para conexiones

require_once '../../conexion/db.php';

$base_datos = new DB();
$query = $base_datos->conectar()->prepare("SELECT 
            con.con_id,
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
           di.det_mjt_patrl,
           di.det_mjt_fe_pla,
           di.det_mjt_esta,
           di.det_min_trab_desc
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id = c.cur_id
            JOIN contrato con 
            ON con.func_id = e.func_id
            JOIN det_min_trab di
            ON di.con_id = con.con_id
            WHERE di.det_mjt_fe_pla BETWEEN '" . $_GET['desde'] . "' "
        . "and '" . $_GET['hasta'] . "' and di.det_mjt_esta = 'ANULADO'");

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
        <title>INFORME DE MINITERIO DE JUSTICIA Y TRABAJO</title>
        <script src="../../css/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <link href="../../css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">    </head>
    <body style="margin: 30px auto; 
          box-shadow: 1px 1px 10px 5px #999999; padding: 50px;">
        <img src="../../images/membrete.jpg" style="width: 100%;" alt="">
        <h2 style="margin-top: 20px;"><center>INFORME DE MINITERIO DE JUSTICIA Y TRABAJO POR PERIODO</center></h2>
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
                            <th>Patrol</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        if ($query->rowCount()) {
                            foreach ($query as $fila) {
                                echo "<tr>";
                                echo "<td>" . $fila['det_mjt_fe_pla'] . "</td>";
                                echo "<td>" . $fila['personal'] . "</td>";
                                echo "<td>" . $fila['cedula'] . "</td>";
                                echo "<td>" . $fila['det_mjt_patrl'] . "</td>";
                                echo "<td>" . $fila['det_min_trab_desc'] . "</td>";
                                echo "<td>" . $fila['det_mjt_esta'] . "</td>";

                                echo "</tr>";
                            }
                        } else {
                            echo "NO HAY REGISTROS";
                        }
                        ?>
                    </tbody>
                </table>
                <hr>

            </div>
        </div>

    </body>
</html>

<script>

    window.print();
</script>