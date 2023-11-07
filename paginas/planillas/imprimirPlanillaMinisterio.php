

<?php
//importaciones de db para conexiones

require_once '../../conexion/db.php';

$base_datos = new DB();
$query = $base_datos->conectar()->prepare("SELECT 
			CONCAT(p.cedula,'-', t.con_id) as nro_patronal,
            p.per_nom,
            p.per_apell,
            p.cedula,
            t.con_salario,
            car.car_descri,
            if(p.per_genero = 'FEMEMINO', 'F', 'M') AS sexo,
            if(p.per_est_civ = 'SOLTERO', 'S', 'C') as estado_civil,
            p.per_nacion,
            p.per_direc,
            p.per_nacim,
            t.profesion,
             (SELECT
        COUNT(db.bon_id) as cantidad
        FROM  det_bonif db 
        JOIN bonif_filia b 
        WHERE b.con_id = t.con_id 
        and YEAR(CURDATE())-YEAR(db.fecha_nacimiento)  < 18) as hijos,
        if(t.con_fin is null, '-' , t.con_fin ) as con_fin,
        if(t.motivo_salida is null, '-', t.motivo_salida) as motivo_salida,
        t.con_emis
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id  = c.cur_id
            JOIN contrato t 
            ON t.func_id = e.func_id
            join cargos car 
            ON car.car_id = t.car_id");

$arreglo = array();
$query->execute();
?>
<!doctype html>
<html lang="es">
    <style>
        
    </style>
    <head>
        <meta charset="UTF-8">
        <title>PLANILLA DEL MINISTERIO DE JUSTICIA Y TRABAJO</title>
        <script src="../../css/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <link href="../../css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">    </head>
    <body style="">
        <img src="../../images/membrete.jpg" style="width: 100%;" alt="">
        <h2 style="margin-top: 20px;"><center>PLANILLA DEL MINISTERIO DE JUSTICIA Y TRABAJO</center></h2>
        <hr> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h3>Empleados activos y registrados en el  MINISTERIO DE JUSTICIA Y TRABAJO</h3>
                </div>



            </div>
            <hr>
            <div class="row">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nro Patronal</th>
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Sexo</th>
                            <th>Estado Civil</th>
                            <th>Fecha Nacimiento</th>
                            <th>Nacionalidad</th>
                            <th>Domicilio</th>
                            <th>Hijos Menores</th>
                            <th>Cargo</th>
                            <th>Profesion</th>
                            <th>Fecha de entrada</th>
                            <th>Fecha de Salida</th>
                            <th>Motivo de Salida</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        if ($query->rowCount()) {
                            foreach ($query as $fila) {
                                echo "<tr>";
                                echo "<td>" . $fila['nro_patronal'] . "</td>";
                                echo "<td>" . $fila['cedula'] . "</td>";
                                echo "<td>" . $fila['per_nom'] . "</td>";
                                echo "<td>" . $fila['per_apell'] . "</td>";
                                echo "<td>" . $fila['sexo'] . "</td>";
                                echo "<td>" . $fila['estado_civil'] . "</td>";
                                echo "<td>" . $fila['per_nacim'] . "</td>";
                                echo "<td>" . $fila['per_nacion'] . "</td>";
                                echo "<td>" . $fila['per_direc'] . "</td>";
                                echo "<td>" . $fila['hijos'] . "</td>";
                                echo "<td>" . $fila['car_descri'] . "</td>";
                                echo "<td>" . $fila['profesion'] . "</td>";
                                echo "<td>" . $fila['con_emis'] . "</td>";
                                echo "<td>" . $fila['con_fin'] . "</td>";
                                echo "<td>" . $fila['motivo_salida'] . "</td>";

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
    var css = '@page { size: landscape; }',
            head = document.head || document.getElementsByTagName('head')[0],
            style = document.createElement('style');

    style.type = 'text/css';
    style.media = 'print';

    if (style.styleSheet) {
        style.styleSheet.cssText = css;
    } else {
        style.appendChild(document.createTextNode(css));
    }

    head.appendChild(style);
    window.print();
</script>