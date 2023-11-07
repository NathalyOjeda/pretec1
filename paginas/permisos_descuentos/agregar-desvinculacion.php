<input type="text" id="id_desvinculacion" value="0" hidden>
<input type="text" id="id_contrato" value="0" hidden>
<h5>Agregar Desvinculación</h5>
<hr>
<h6>Datos del empleado</h6>
<div class="row panel-empleado" >
    <div class="col-md-3">
        <label>Cédula</label>
        <input type="number" class="form-control cedula_desvinculacion"  id="cedula_contrato_b">
    </div>
    <div class="col-md-6">
        <label>Nombre</label>
        <input type="text" class="form-control"  id="nombre_contrato" onkeypress="return soloTexto(event);">
    </div>
    <div class="col-md-2">
        <label>.</label>
        <button class="btn btn-danger form-control cancelar-btn" onclick="limpiarBusqueda(); return false;">Limpiar</button>
    </div>

</div>
<hr>
<h6>Detalles de la Desvinculación</h6>
<div class="row">

    <div class="col-md-3">
        <label>Fecha inicio </label>
        <input type="date" class="form-control" readonly id="fecha_inicio">
    </div>

    <div class="col-md-3">
        <label>Fecha de desvinculación</label>
        <input type="date" id="fecha_desvinculacion" class="form-control" >
    </div>
    <div class="col-md-2">
        <label>Antigüedad (años)</label>
        <input type="text" id="antiguedad" class="form-control" readonly value="0">
    </div>
    <div class="col-md-4">
        <label>¿Es causa justificada?</label>
        <br><input type="radio" id="si" name="justificacion" > <label for="si">Si</label><br>
        <input type="radio" id="no"  name="justificacion" checked > <label for="no">No</label>
        
    </div>
    <div class="col-md-4">
        <label>Salario Mensual</label>
        <input type="text" class="form-control" readonly id="salario">
        
    </div>
    <div class="col-md-4">
        <label>Salario por día</label>
        <input type="text" class="form-control" readonly id="salario-dia">
        
    </div>
    <div class="col-md-4">
        <label>Trabajado (dias)</label>
        <input type="text" class="form-control" readonly id="trabajado">
        
    </div>
    <div class="col-md-12 desvinculacion-des" hidden>
        <label>Breve descripción de la justificación</label>
        <textarea  id="descripcion" cols="30" rows="5" class="form-control"></textarea>
    </div>

    

    <div class="col-md-12" style="margin-top: 30px;">
        <table class="table table-bordered table-hover">
            <thead>
                <tr align='center'>
                    <th style="width: 70%;">CONCEPTO</th>
                    <th style="width: 30%;" align='right'>MONTO</th>
                </tr>
            </thead>
            <tbody id="desv">
                <tr>
                    <td>Salario por días trabajados</td>
                    <td id="salario_dias_trabajados" align='right'>0</td>
                </tr>
                <tr>
                    <td>Preaviso</td>
                    <td id="preaviso" align='right'>0</td>
                </tr>
                <tr>
                    <td>Indemnización</td>
                    <td id="indemnizacion" align='right'>0</td>
                </tr>
                <tr>
                    <th>SUBTOTAL</th>
                    <td id="subtotal1" align='right' style="font-weight: bolder;">0</td>
                </tr>
                <tr>
                    <td>(-) Descuento por IPS (9%)</td>
                    <td id="ips" align='right'>0</td>
                </tr>
                <tr>
                    <th>SUBTOTAL</th>
                    <td id="subtotal2" align='right' style="font-weight: bolder;">0</td>
                </tr>
                 <tr>
                    <td>Aguinaldo proporcional</td>
                    <td id="aguinaldo" align='right'>0</td>
                </tr>
                <tr>
                    <th>TOTAL</th>
                    <td id="total" align='right' style="font-weight: bolder;">0</td>
                </tr>
                
            </tbody>
        </table>
    </div>
    <div class="col-md-3" style="margin-top: 30px;">
        <button class="form-control btn btn-success" onclick="guardarDesvinculacion(); return false;">Guardar</button>
    </div>
</div>


