<input type="text" id="id_salario" value="0" hidden>
<input type="text" id="id_contrato" value="0" hidden>
<input type="text" id="id_ips" value="0" hidden>
<div class="row">
    <div class="col-md-4">
        <h5>Liquidación de Salario segun mes</h5>
    </div>
    <div class="col-md-4">
        <input type="month" class="form-control" id="mes_liquidacion">
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
        <input type="number" class="form-control"  id="cedula_contrato_s">
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
<h6>Detalles de la liquidación</h6>
<div class="row">
    <div class="col-md-12">
        <p>Liquidación según el mes seleccionado, en la parte de meses</p>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr style="text-align: center;">
                <th>Descripción</th>
                <th>Ingreso</th>
                <th>Egreso</th>
            </tr>
        </thead>
        <tbody id="liquidacion_tb" style="max-height: 500px; overflow: scroll;">
            <tr>
                <td>Salario Actual</td>
                <td><input type="text" readonly class="form-control ingreso" id="salario_actual" value="0"></td>
                <td>-</td>
            </tr>
            <tr>
                <td>Bonificación Familiar</td>
                <td><input type="text" readonly class="form-control ingreso" min="0" id="bonificacion" value="0"></td>
                <td>-</td>
            </tr>
            <tr>
                <td>Extras</td>
                <td><input type="text" readonly class="form-control ingreso" min="0" id="extra" value="0"></td>
                <td>-</td>
            </tr>
            <tr>
                <td>I.P.S Aporte</td>
                <td>-</td>
                <td><input type="text" readonly class="form-control egreso" id="ips" value="0"></td>
            </tr>

        </tbody>
        <tfooter>
            <tr style="text-align: right;">
                <th style="text-align: left;">TOTALES</th>
                <th id="total_ingreso">0</th>
                <th id="total_egreso">0</th>
            </tr>
            <tr>
                <th>Sueldo Neto</th>
                <th colspan="2" style="text-align: right;" id="suelto_neto">0</th>

            </tr>
        </tfooter>
    </table>

</div>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-4">
        <button class="btn btn-success" onclick="guardarLiquidacion(); return false;">Guardar</button>
    </div>
</div>
