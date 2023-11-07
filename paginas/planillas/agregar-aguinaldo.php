<input type="text" id="id_aguinaldo" value="0" hidden>
<input type="text" id="id_contrato" value="0" hidden>
<div class="row">
    <div class="col-md-4">
        <h5>Liquidación de Aguinaldo segun año</h5>
    </div>
    <div class="col-md-4">
        <?php
        $cont = date('Y');
        ?>
        <select id="anio" class="form-control">
            <?php while ($cont >= 2000) { ?>
                <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
                <?php $cont = ($cont - 1);
            } ?>
        </select>
    </div>
    <div class="col-md-4">
        <button class="btn btn-success" onclick="calcularLiquidacion();">Calcular</button>
    </div>
</div>
<hr>
<h6>Datos del empleado</h6>
<div class="row panel-empleado" >
    <div class="col-md-3">
        <label>Cédula</label>
        <input type="number" class="form-control"  id="cedula_contrato_a">
    </div>
    <div class="col-md-3">
        <label>Nombre</label>
        <input type="text" class="form-control"  id="nombre_contrato" onkeypress="return soloTexto(event);">
    </div>
    <div class="col-md-3">
        <label>Salario actual</label>
        <input type="text" class="form-control"  readonly id="salario">
    </div>
    <div class="col-md-3">
        <label>.</label>
        <button class="btn btn-danger form-control cancelar-btn" onclick="limpiarBusquedaIPS(); return false;">Limpiar</button>
    </div>

</div>
<hr>
<h6>Detalles del aguinaldo</h6>
<div class="row">

    <div class="col-md-3" hidden>
        <label for=" ">NIC</label>
        <input type="text" class="form-control" id="nic" value="0">
    </div>
    <div class="col-md-3" hidden>
        <label for=" ">RUC</label>
        <input type="text" class="form-control" id="ruc" value="6356672-3">
    </div>
    <div class="col-md-3">
        <label for=" ">Dias trabajados</label>
        <input type="text" readonly class="form-control" id="dias" value="0">
    </div>
    <div class="col-md-3">
        <label for=" ">Salario básico</label>
        <input type="text" readonly class="form-control" id="salario_basico" value="0">
    </div>
    <div class="col-md-3">
        <label for=" ">Horas trabajadas</label>
        <input type="text" readonly class="form-control" id="horas" value="0">
    </div>
    <div class="col-md-3">
        <label for=" ">Bonificacion</label>
        <input type="text" readonly  class="form-control" id="bonificacion" value="0">
    </div>
    <div class="col-md-3">
        <label for=" ">Total en vacaciones</label>
        <input type="number" readonly class="form-control" id="vacaciones" value="0">
    </div>
    <div class="col-md-3">
        <label for=" ">Total extra</label>
        <input type="text" readonly class="form-control" id="extra" value="0">
    </div>
    <div class="col-md-3" hidden>
        <label for=" ">Total I.P.S.</label>
        <input type="text" readonly class="form-control" id="ips" value="0">
    </div>
    <div class="col-md-3" hidden>
        <label for=" ">Aguinaldo anticipado</label>
        <input type="number" min="0" class="form-control" id="anticipo" value="0">
    </div>
    <div class="col-md-3">
        <label for=" ">Total de egreso</label>
        <input type="text" readonly class="form-control" id="egresos" value="0">
    </div>
    <div class="col-md-3">
        <label for=" ">Aguinaldo Neto</label>
        <input type="text" readonly class="form-control" id="aguinaldo_neto" value="0">
    </div>

</div>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-4">
        <button class="btn btn-success" onclick="guardarAguinaldo(); return false;">Guardar</button>
    </div>
</div>
