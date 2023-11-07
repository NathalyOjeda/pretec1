

<?php
//importaciones de db para conexiones

require_once '../../conexion/db.php';

$base_datos = new DB();
$query = $base_datos->conectar()->prepare("SELECT 
            con.con_id,
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            per.perm_fec_hasta,
            j.just_per_de,
            per.perm_fec_desde,
            per.perm_fec_solic,
            per.perm_estado
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id = c.cur_id
            JOIN contrato con 
            ON con.func_id = e.func_id
            JOIN permiso per 
            ON per.con_id = con.con_id
            JOIN justi_perm j 
            ON j.jus_per_id = per.jus_per_id
            WHERE per.perm_fec_solic BETWEEN '".$_GET['desde']."' and '".$_GET['hasta']."' "
        . "AND per.perm_estado = 'ACTIVO'");

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
        <title>INFORME DE PERMISOS</title>
        <script src="../../css/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <link href="../../css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">    </head>
    <body style="margin: 30px auto; 
          box-shadow: 1px 1px 10px 5px #999999; padding: 50px;">
        <img src="../../images/membrete.jpg" style="width: 100%;" alt="">
        <h2 style="margin-top: 20px;"><center>INFORME DE PERMISOS POR PERIODO</center></h2>
        <hr> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h3>PERIODOS DE</h3>
                    <h4>DESDE <?php echo  $_GET['desde'];?></h4>
                    <h4>HASTA <?php echo  $_GET['hasta'];?></h4>
                </div>



            </div>
            <hr>
            <div class="row">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Fecha de solicitud</th>
                            <th>Empleado</th>
                            <th>Cédula de Identidad</th>
                            <th>Justificación</th>
                            <th>Fecha desde</th>
                            <th>Fecha hasta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        if ($query->rowCount()) {
                            foreach ($query as $fila) {
                                echo "<tr>";
                                echo "<td>" . $fila['perm_fec_solic'] . "</td>";
                                echo "<td>" . $fila['personal'] . "</td>";
                                echo "<td>" . $fila['cedula'] . "</td>";
                                echo "<td>" . $fila['just_per_de'] . "</td>";
                                echo "<td>" . $fila['perm_fec_desde'] . "</td>";
                                echo "<td>" . $fila['perm_fec_hasta'] . "</td>";
                               
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