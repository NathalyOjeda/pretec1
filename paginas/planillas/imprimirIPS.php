

<?php
//importaciones de db para conexiones

$desde_anterior = $_GET['desde_anterior'];
$hasta_anterior = $_GET['hasta_anterior'];
$desde_actual = $_GET['desde_actual'];
$hasta_actual = $_GET['hasta_actual'];

require_once '../../conexion/db.php';

$base_datos = new DB();
$query = $base_datos->conectar()->prepare("SELECT 
			
            p.cedula,
            '-' as nro_asegurado,
             CONCAT(p.per_nom,' ',p.per_apell) as personal,
             (SELECT
                count(a.asi_id) as dias 
                FROM asistencia a  
                WHERE a.asi_fech BETWEEN '" . $desde_anterior . "' and '" . $hasta_anterior . "' and a.con_id =  t.con_id ) as dias_anteriores,
                (SELECT
                count(a.asi_id) as dias 
                FROM asistencia a  
                WHERE a.asi_fech BETWEEN '" . $desde_actual . "' and '" . $hasta_actual . "' and a.con_id =  t.con_id ) as dias_actual,
             t.con_salario,
             '-' as categoria
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id  = c.cur_id
            JOIN contrato t 
            ON t.func_id = e.func_id
            where t.con_estado = 1 ");

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
        <title>DETALLE INDIVUAL DE IPS</title>
        <script src="../../css/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <link href="../../css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">    </head>
    <body style="margin: 30px auto; 
          box-shadow: 1px 1px 10px 5px #999999; padding: 50px;">
        <img src="../../images/membrete.jpg" style="width: 100%;" alt="">
        <h2 style="margin-top: 20px;"><center>DETALLE COMPLETO DE PLANILLA DE I.P.S.</center></h2>
        <hr> 
        <div class="container">
            
            <hr>
            <div class="row">
                <div class="col-md-12">

                    <h3>PLANILLA DE I.P.S. SEGUN PERIODO <?= $_GET['periodo_actual'];?></h3>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr> 
                                <th>NRO DE ORDEN</th>
                                <th>CEDULA DE IDENTIDAD</th>
                                <th>NRO DE ASEGURADO</th>
                                <th>APELLIDO Y NOMBRE DEL ASEGURADO</th>
                                <th>DIAS TRABAJA ANTERIOR</th>
                                <th>SALARIO ANTERIOR</th>
                                <th>CATEGORIA</th>
                                <th>DIAS TRABAJADOS ACTUAL</th>
                                <th>SALARIO ACTUAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($query->rowCount()) {

                                    $cantidad = 1;
                                    $total = 0;
                                foreach ($query as $fila) {
                                    ?>

                                    <tr>
                                        <td><?= $cantidad; ?></td>
                                        <td><?= $fila['cedula']; ?></td>
                                        <td><?= $fila['nro_asegurado']; ?></td>
                                        <td><?= $fila['personal']; ?></td>
                                        <td><?= $fila['dias_anteriores']; ?></td>
                                        <td><?= number_format(is_numeric($fila['con_salario']) ? $fila['con_salario'] : 0, 0, ',', '.'); ?></td>
                                        <td><?= $fila['categoria']; ?></td>
                                        <td><?= $fila['dias_actual']; ?></td>
                                        <td><?= number_format(is_numeric($fila['con_salario']) ? $fila['con_salario'] : 0, 0, ',', '.'); ?></td>
                                        <?php 
                                         $cantidad++;
                                         $total += $fila['con_salario'];
                                        ?>
                                    </tr>

                                    <?php
                                }
                                $cantidad--;
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">Total de trabajadores <?= $cantidad; ?></td>
                                <td colspan="5">Total de  de Salarios <?= number_format(is_numeric($total) ? $total : 0, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td colspan="9">Aporte del empleador <?= number_format(round($total * 0.255), 0, ',', '.'); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </body>
</html>

<script>
    
//    window.print();
</script>