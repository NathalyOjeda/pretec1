<input type="text" id="id_descuento" value="0" hidden>
<input type="text" id="id_contrato" value="0" hidden>
<h5>Agregar Descuento</h5>
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
    <h6>Detalles del descuento</h6>
<div class="row">
    
    <div class="col-md-3">
        <label>Fecha </label>
        <input type="date" class="form-control" id="fecha_descuento">
    </div>
    
    <div class="col-md-3">
        <label>Motivo de descuento</label>
        <select  id="motivo_lst" class="form-control">
            
        </select>
    </div>
    
    
    
    <div class="col-md-3">
        <label>Monto</label>
        <input type="number" class="form-control" id="monto">
    </div>
    <div class="col-md-3">
        <button class="btn btn-primary" onclick="agregarDescuento(); return false;">Agregar</button>
    </div>
    <div class="col-md-3" style="display: none;">
        <label>Estado</label>
        <select  id="estado_a" class="form-control">
            <option value="ACTIVO">ACTIVO</option>
            <option value="ANULADO">ANULADO</option>
            
        </select>
    </div>
    <hr>
    <div class="col-md-12">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Descripcion</th>
                    <th>Monto</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="descuentos_tb"></tbody>
        </table>
    </div>
    
    
</div>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-4">
        <button class="btn btn-success" onclick="guardarDescuento(); return false;">Guardar</button>
    </div>
</div>
