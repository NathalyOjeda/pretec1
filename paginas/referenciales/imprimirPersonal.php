

<?php
//importaciones de db para conexiones

require_once '../../conexion/db.php';

$base_datos = new DB();
$query = $base_datos->conectar()->prepare("SELECT `per_id`, `per_apell`, "
        . "`per_nom`, `per_nacim`, `per_direc`, `per_genero`,"
        . " `per_ciud`, `per_nacion`, `per_est_civ`, `per_correo`,"
        . " `per_telfono`, cedula FROM `personal` ORDER BY per_id DESC");

$query->execute();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>INFORME DE PERSONALES</title>
        <script src="../../css/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <link href="../../css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">  
        <style>
            @media print {
                
            }
            @page {
                size: landscape;
            }
            @media print{@page {size: landscape}}
        </style>
    </head>
    <body style="margin: 30px auto; width: 100%;
          box-shadow: 1px 1px 10px 5px #999999; padding: 50px;">
        <img src="../../images/membrete.jpg" style="width: 100%; max-height: 200px;"  alt="">
        <h2>INFORME DE PERSONALES</h2>
        <hr> 

        <hr> 
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>APELLIDO</th>
                            <th>CEDULA DE IDENTIDAD</th>
                            <th>FECHA NACIMIENTO</th>
                            <th>DIRECCION</th>
                            <th>GENERO</th>
                            <th>CIUDAD</th>
                            <th>NACION</th>
                            <th>ESTADO CIVIL</th>
                            <th>CORREO</th>
                            <th>TELEFONO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($query->rowCount()) {

                            foreach ($query as $fila) {
                                ?>
                                <tr> 
                                    <td><?php echo $fila['per_id'] ?></td>
                                    <td><?php echo $fila['per_nom'] ?></td>
                                    <td><?php echo $fila['per_apell'] ?></td>
                                    <td><?php echo $fila['cedula'] ?></td>
                                    <td><?php echo $fila['per_nacim'] ?></td>
                                    <td><?php echo $fila['per_direc'] ?></td>
                                    <td><?php echo $fila['per_genero'] ?></td>
                                    <td><?php echo $fila['per_ciud'] ?></td>
                                    <td><?php echo $fila['per_nacion'] ?></td>
                                    <td><?php echo $fila['per_est_civ'] ?></td>
                                    <td><?php echo $fila['per_correo'] ?></td>
                                    <td><?php echo $fila['per_telfono'] ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


    </body>
</html>

<script>

    window.print();
</script>