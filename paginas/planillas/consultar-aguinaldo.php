<input type="text" id="id_contrato" value="0" hidden>
<h3>Busqueda de Aguinaldo</h3>
<div class="row">
    <div class="col-md-2">
        <label>Cédula</label>
        <input type="number" class="form-control"  id="cedula_contrato_c">
    </div>
    <div class="col-md-3">
        <label>Nombre</label>
        <input type="text" class="form-control"  id="nombre_contrato_c" onkeypress="return soloTexto(event);">
    </div>
    <div class="col-md-4">
        <label>Año</label>

        <?php
        $cont = date('Y');
        ?>
        <select id="anio" class="form-control">
            <?php while ($cont >= 2000) { ?>
                <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
                <?php $cont = ($cont - 1);
            }
            ?>
        </select>

    </div>

    <div class="col-md-1">
        <label>.</label>
        <button class="btn btn-primary form-control" onclick="buscarSalario(); return false"><i class="ti ti-search"></i></button>
    </div>
</div>
<table class="table table-hover table-bordered  table-responsive" style="margin-top: 20px;">
    <thead>
        <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Funcionario </th>
            <th>Salario Actual</th>
            <th>Total Ingreso</th>
            <th>Total Egreso</th>
            <th>Sueldo Neto</th>
            <th>Estado</th>
            <th>Operaciones</th>

        </tr>
    </thead>
    <tbody id="aguinaldo_tb">

    </tbody>
</table>