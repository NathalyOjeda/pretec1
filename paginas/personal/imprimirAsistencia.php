

<?php
//importaciones de db para conexiones

require_once '../../conexion/db.php';

$base_datos = new DB();
$query = $base_datos->conectar()->prepare("SELECT 
          
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            ca.car_descri as cargo,
            a.asi_hor_entr,
            IF(a.asi_hor_sali is null, 'NO ASIGNADO', a.asi_hor_sali) asi_hor_sali,
            a.asi_fech,
            a.asi_descri
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id  = c.cur_id
            JOIN contrato t 
            ON t.func_id = e.func_id
            JOIN cargos ca 
            ON ca.car_id = t.car_id
            JOIN asistencia a 
            ON a.con_id = t.con_id
            WHERE a.asi_id = " . $_GET['id']);

$arreglo = array();
$query->execute();
if ($query->rowCount()) {

    foreach ($query as $fila) {
        array_push($arreglo, array(
            'personal' => $fila['personal'],
            'cedula' => $fila['cedula'],
            'cargo' => $fila['cargo'],
            'asi_hor_entr' => $fila['asi_hor_entr'],
            'asi_hor_sali' => $fila['asi_hor_sali'],
            'asi_descri' => $fila['asi_descri'],
            'asi_fech' => $fila['asi_fech']
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
        <title>DETALLE DE LA ASISTENCIA</title>
        <script src="../../css/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <link href="../../css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">    </head>
    <body style="margin: 30px auto; width: 700px;
          box-shadow: 1px 1px 10px 5px #999999; padding: 50px;">
        <img src="../../images/membrete.jpg" style="width: 100%;" alt="">
        <h2 style="margin-top: 20px;"><center>DETALLE DE LA ASISTENCIA</center></h2>
        <hr> 
        <div class="row">
            <div class="col-md-12">

                <h3>Datos del personal</h3>
            </div>
            <div class="col-md-4">
                <label>Nombre y Apellido: </label><br> <?php echo $arreglo[0]['personal'] ?>

            </div>
            <div class="col-md-4">
                <label>Cédula: </label><br><?php echo $arreglo[0]['cedula'] ?>

            </div>
            <div class="col-md-4">
                <label>Cargo: </label><br><?php echo $arreglo[0]['cargo'] ?>

            </div>
        </div>
        <div class="row" style="margin-top: 30px;">
            <h4></h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>Fecha</td>
                        <td>Entrada</td>
                        <td>Salida</td>
                        <td>Descripción</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $arreglo[0]['asi_fech'] ?></td>
                        <td><?php echo $arreglo[0]['asi_hor_entr'] ?></td>
                        <td><?php echo $arreglo[0]['asi_hor_sali'] ?></td>
                        <td><?php echo $arreglo[0]['asi_descri'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </body>
</html>

<script>

    window.print();
</script>