

<?php
//importaciones de db para conexiones

require_once '../../conexion/db.php';

$base_datos = new DB();
$query = $base_datos->conectar()->prepare("SELECT 
c.cur_id,
c.cur_fecha,
c.cur_des,
c.estado,
p.per_apell,
p.per_nom,
p.cedula,
p.per_nacim,
p.per_direc,
p.per_genero,
p.per_ciud,
p.per_nacion,
p.per_est_civ,
p.per_correo,
p.per_telfono
FROM curriculum c 
JOIN personal p
ON p.per_id = c.per_id
WHERE c.cur_id = " . $_GET['id']);

$arreglo = array();
$query->execute();
if ($query->rowCount()) {

    foreach ($query as $fila) {
        array_push($arreglo, array(
            'cur_id' => $fila['cur_id'],
            'cur_fecha' => $fila['cur_fecha'],
            'cur_des' => $fila['cur_des'],
            'estado' => $fila['estado'],
            'per_apell' => $fila['per_apell'],
            'per_nom' => $fila['per_nom'],
            'cedula' => $fila['cedula'],
            'per_nacim' => $fila['per_nacim'],
            'per_direc' => $fila['per_direc'],
            'per_genero' => $fila['per_genero'],
            'per_ciud' => $fila['per_ciud'],
            'per_nacion' => $fila['per_nacion'],
            'per_est_civ' => $fila['per_est_civ'],
            'per_correo' => $fila['per_correo'],
            'per_telfono' => $fila['per_telfono']
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
        <title>DETALLE DEL CURRICULUM</title>
        <script src="../../css/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <link href="../../css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">    </head>
    <body style="margin: 30px auto; width: 700px;
          box-shadow: 1px 1px 10px 5px #999999; padding: 50px;">
        <img src="../../images/membrete.jpg" style="width: 100%;" alt="">
        <h2 style="margin-top: 20px;"><center>DETALLE DEL CURRICULUM</center></h2>
        <hr> 
        <h4>Detalles Especificos</h4>
        <hr> 
        <div class="row">
            <div class="col-md-4">
                <label>#</label><br>
                <span><?php echo $arreglo[0]['cur_id'] ?></span>
            </div>
            <div class="col-md-4">
                <label>Fecha de recepción</label><br>
                <span><?php echo $arreglo[0]['cur_fecha'] ?></span>
            </div>
            <div class="col-md-4">
                <label>Estado</label><br>
                <span><?php echo $arreglo[0]['estado'] ?></span>
            </div>
        </div>
        <hr> 
        <h4>Detalles del Personal</h4>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <label>Nombre</label><br>
                <span><?php echo $arreglo[0]['per_nom'] ?></span>
            </div>
            <div class="col-md-6">
                <label>Apellido</label><br>
                <span><?php echo $arreglo[0]['per_apell'] ?></span>
            </div>
            <div class="col-md-6">
                <label>Cédula de identidad</label><br>
                <span><?php echo $arreglo[0]['cedula'] ?></span>
            </div>
            <div class="col-md-6">
                <label>Fecha de nacimiento</label><br>
                <span><?php echo $arreglo[0]['per_nacim'] ?></span>
            </div>
            <div class="col-md-6">
                <label>Dirección</label><br>
                <span><?php echo $arreglo[0]['per_direc'] ?></span>
            </div>
            <div class="col-md-6">
                <label>Ciudad</label><br>
                <span><?php echo $arreglo[0]['per_ciud'] ?></span>
            </div>
            <div class="col-md-6">
                <label>Género</label><br>
                <span><?php echo $arreglo[0]['per_genero'] ?></span>
            </div>
            <div class="col-md-6">
                <label>Nación</label><br>
                <span><?php echo $arreglo[0]['per_nacion'] ?></span>
            </div>
            <div class="col-md-6">
                <label>Estado Civil</label><br>
                <span><?php echo $arreglo[0]['per_est_civ'] ?></span>
            </div>
            <div class="col-md-6">
                <label>Correo</label><br>
                <span><?php echo $arreglo[0]['per_correo'] ?></span>
            </div>
            <div class="col-md-6">
                <label>Teléfono</label><br>
                <span><?php echo $arreglo[0]['per_telfono'] ?></span>
            </div>

        </div>
        <hr> 
        <div class="row">
            <div class="col-md-12">
                <label>Datos Académicos</label>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Lugar</th>
                            <th>PERIODO</th>
                            <th>DESCRIPCION</th>
                        </tr>
                    </thead>
                    <?PHP
                    $query = $base_datos->conectar()->prepare("SELECT  `lugar`, `periodo`, `descripcion` 
                    FROM `curriculum_academico` 
                    WHERE `cur_id` = " . $_GET['id']);

                    $arreglo = array();
                    $query->execute();
                    if ($query->rowCount()) {

                        foreach ($query as $fila) {
                            echo "<tr>";
                            echo "<td>".$fila['lugar']."</td>";
                            echo "<td>".$fila['periodo']."</td>";
                            echo "<td>".$fila['descripcion']."</td>";
                            echo "</tr>";
                        }
                    } else {
                        
                    }
                    ?>
                </table>
            </div>
        </div>
        <hr> 
        <div class="row">
            <div class="col-md-12">
                <label>Referencias laborales</label>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>NOMBRE Y APELLIDO</th>
                            <th>TELEFONO</th>
                            <th>DESCRIPCION</th>
                        </tr>
                    </thead>
                    <?PHP
                    $query = $base_datos->conectar()->prepare("SELECT  `nombre_apellido`, `telefono`, `descripcion` 
                FROM `curriculum_ref_laboral` 
                WHERE `cur_id` =   " . $_GET['id']);

                    $arreglo = array();
                    $query->execute();
                    if ($query->rowCount()) {

                        foreach ($query as $fila) {
                            echo "<tr>";
                            echo "<td>".$fila['nombre_apellido']."</td>";
                            echo "<td>".$fila['telefono']."</td>";
                            echo "<td>".$fila['descripcion']."</td>";
                            echo "</tr>";
                        }
                    } else {
                        
                    }
                    ?>
                </table>
            </div>
        </div>


    </body>
</html>

<script>

    window.print();
</script>