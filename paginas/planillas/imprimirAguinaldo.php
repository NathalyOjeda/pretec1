

<?php
//importaciones de db para conexiones

require_once '../../conexion/db.php';

$base_datos = new DB();
$query = $base_datos->conectar()->prepare("SELECT 
            CONCAT(p.per_nom,' ',p.per_apell) as personal,
            p.cedula,
            car.car_descri,
            a.agui_sal_bas,
            a.agui_tot_ing,
            a.agui_tot_egr,
            a.agui_sal_net,
            a.agui_estado,
            a.agui_id,
            a.agui_fecha,
            a.agui_nic,
            a.agui_ruc,
            a.agui_di_trab,
            a.agui_q_horas,
            a.agui_bnf_fli,
            a.agui_ips,
            a.agui_anticip
            FROM curriculum c 
            JOIN personal p 
            ON p.per_id = c.per_id
            JOIN empleados e 
            ON e.cur_id  = c.cur_id
            JOIN contrato t 
            ON t.func_id = e.func_id
            JOIN cargos car 
            ON car.car_id = t.car_id
            JOIN aguinaldo a 
            ON a.con_id = t.con_id
            WHERE a.agui_id = " . $_GET['id']);

$arreglo = array();
$query->execute();
if ($query->rowCount()) {

    foreach ($query as $fila) {
        array_push($arreglo, array(
            'agui_id' => $fila['agui_id'],
            'personal' => $fila['personal'],
            'cedula' => $fila['cedula'],
            'car_descri' => $fila['car_descri'],
            'agui_sal_bas' => $fila['agui_sal_bas'],
            'agui_fecha' => $fila['agui_fecha'],
            'agui_tot_ing' => $fila['agui_tot_ing'],
            'agui_tot_egr' => $fila['agui_tot_egr'],
            'agui_sal_net' => $fila['agui_sal_net'],
            'agui_di_trab' => $fila['agui_di_trab'],
            'agui_q_horas' => $fila['agui_q_horas'],
            'agui_nic' => $fila['agui_nic'],
            'agui_ruc' => $fila['agui_ruc'],
            'agui_bnf_fli' => $fila['agui_bnf_fli'],
            'agui_ips' => $fila['agui_ips'],
            'agui_anticip' => $fila['agui_anticip'],
            'agui_estado' => $fila['agui_estado']
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
        <title>RESUMEN DE LIQUIDACION AGUINALDO</title>
        <script src="../../css/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <link href="../../css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">    </head>
    <body style="margin: 30px auto; width: 700px;
          box-shadow: 1px 1px 10px 5px #999999; padding: 50px;">
        <img src="../../images/membrete.jpg" style="width: 100%;" alt="">
        <h2 style="margin-top: 20px;"><center>RESUMEN DE LIQUIDACION AGUINALDO</center></h2>
        <hr> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h3>Datos del empleado</h3>
                </div>
                <div class="col-md-4">
                    <label>Nombre y Apellido: </label><br> <?php echo $arreglo[0]['personal'] ?>

                </div>
                <div class="col-md-4">
                    <label>Cédula: </label><br><?php echo $arreglo[0]['cedula'] ?>

                </div>
                <div class="col-md-4">
                    <label>Cargo: </label><br><?php echo $arreglo[0]['car_descri'] ?>

                </div>

            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">

                    <h3>Detalles de liquidación</h3>
                </div>
                <div class="col-md-3">
                    <label>Fecha </label><br> <?php echo $arreglo[0]['agui_fecha'] ?>

                </div>


                
              
                <div class="col-md-3">
                    <label>Estado: </label><br><?php echo $arreglo[0]['agui_estado'] ?>

                </div>
                <div class="col-md-12"><hr></div>
                <div class="col-md-6">
                    <label>Dias Trabajados: </label><br><?php echo $arreglo[0]['agui_di_trab'] ?>

                </div>
                <div class="col-md-6">
                    <label>Horas Trabajadas: </label><br><?php echo $arreglo[0]['agui_q_horas'] ?>

                </div>
                <div class="col-md-6">
                    <label>Salario Básico: </label><br><?php echo $arreglo[0]['agui_sal_bas'] ?>

                </div>
                <div class="col-md-6">
                    <label>Bonificaciones: </label><br><?php echo $arreglo[0]['agui_bnf_fli'] ?>

                </div>
                <div class="col-md-6">
                    <label>Total Ingreso: </label><br><?php echo $arreglo[0]['agui_tot_ing'] ?>

                </div>
                <div class="col-md-6">
                    <label>Total descuentos: </label><br><?php echo $arreglo[0]['agui_tot_egr'] ?>

                </div>
                
                
                <div class="col-md-12"><hr></div>
                <div class="col-md-12">
                    <label>Aguinaldo Neto : </label><br><?php echo $arreglo[0]['agui_sal_net'] ?>

                </div>

            </div>
        </div>

    </body>
</html>

<script>

    window.print();
</script>