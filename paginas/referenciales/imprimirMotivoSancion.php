

<?php
//importaciones de db para conexiones

require_once '../../conexion/db.php';

$base_datos = new DB();
$query = $base_datos->conectar()->prepare("SELECT `mot_san_id`, `mot_san`,"
            . "IF(`estado` = 1, 'ACTIVO','INACTIVO') as estado "
            . "FROM `mot_sancion` ORDER BY mot_san_id DESC");

$query->execute();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>INFORME DE MOTIVOS DE SANCION</title>
        <script src="../../css/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <link href="../../css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">    </head>
    <body style="margin: 30px auto; width: 700px;
          box-shadow: 1px 1px 10px 5px #999999; padding: 50px;">
        <img src="../../images/membrete.jpg" style="width: 100%;" alt="">
        <h2>INFORME DE MOTIVOS DE SANCION</h2>
        <hr> 

        <hr> 
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>DESCRIPCION</th>
                            <th>ESTADO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($query->rowCount()) {

                            foreach ($query as $fila) {
                                ?>
                                <tr> 
                                    <td><?php echo $fila['mot_san_id'] ?></td>
                                    <td><?php echo $fila['mot_san'] ?></td>
                                    <td><?php echo $fila['estado'] ?></td>
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