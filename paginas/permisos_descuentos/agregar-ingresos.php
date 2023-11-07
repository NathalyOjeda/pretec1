<input type="text" id="id_ingresos" value="0" hidden>
<input type="text" id="id_contrato" value="0" hidden>
<h5>Agregar Ingresos</h5>
<hr>
<h6>Datos del empleado</h6>
<div class="row panel-empleado" >
    <div class="col-md-3">
        <label>Cédula</label>
        <input type="number" class="form-control"  id="cedula_contrato_b">
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
<h6>Detalles de la Ingresos</h6>
<div class="row">
    <div class="col-md-3">
        <label>Fecha</label>
        <input type="date" class="form-control" id="fecha">
    </div>
    
    
    <div class="col-md-2">
        <label>Concepto</label>
        <select id="concepto_lst" class="form-control"></select>
    </div>
    <div class="col-md-2">
        <label>Horas</label>
        <input type="number" class="form-control" id="horas" value="1" min="1">
    </div>
    <div class="col-md-2">
        <label>Monto</label>
        <input type="text" class="form-control" id="monto" readonly>
    </div>
    <div class="col-md-3" style="margin-top: 25px;">
        <button class="btn btn-success" onclick="agregarIngreso(); return false;">Agregar</button>
    </div>
    <div class="col-md-12" style="margin-top: 25px;">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Concepto</th>
                    <th>Horas</th>
                    <th>Monto por hora</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="ingresos_tb"></tbody>
        </table>
    </div>
</div>
<div class="row" style="margin-top: 25px;">
    <div class="col-md-3">
        <button class="btn btn-success" onclick="guardarIngresos(); return false;">Guardar</button>
    </div>
</div>


