<input type="text" id="id_sancion" value="0" hidden>
<input type="text" id="id_contrato" value="0" hidden>
<h5>Agregar Sanción</h5>
<hr>
    <h6>Datos del empleado</h6>
<div class="row panel-empleado" >
    <div class="col-md-3">
        <label>Cédula</label>
        <input type="number" class="form-control"  id="cedula_contrato_b">
    </div>
     <div class="col-md-6 ">
        <label>Nombre</label>
        <input type="text" class="form-control"  id="nombre_contrato" onkeypress="return soloTexto(event);">
    </div>
    <div class="col-md-2">
        <label>.</label>
        <button class="btn btn-danger form-control cancelar-btn" onclick="limpiarBusqueda(); return false;">Limpiar</button>
    </div>

    <div class="col-md-3">
        <label for="nombre_busqueda">Buscar por nombre</label>
        <input type="text" id="nombre_busqueda_sancion" class="form-control" placeholder="Nombre del empleado">
    </div>
</div>


   
</div>
    <hr>
    <h6>Detalles de la Sanción</h6>
<div class="row">
    
    <div class="col-md-3 mb-2">
        <label>Fecha </label>
        <input type="date" class="form-control" id="fecha_sancion">
    </div>
    
    <div class="col-md-4">
        <label>Motivo</label>
        <select  id="motivo_lst" class="form-control">
            
        </select>
    </div>
    <div class="col-md-3" style="margin-top: 25px;">
        <button class="btn btn-primary" onclick="agregarSancion(); return false;">Agregar</button>
    </div>
    
    
    <div class="col-md-3" style="display: none;">
        <label>Estado</label>
        <select  id="estado_a" class="form-control">
            <option value="ACTIVO">ACTIVO</option>
            <option value="ANULADO">ANULADO</option>
            
        </select>
    </div>
    <div class="col-md-12">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>FECHA</th>
                    <th>MOTIVO</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="sanciones_tb"></tbody>
        </table>
    </div>
    
    
</div>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-4">
        <button class="btn btn-success" onclick="guardarSancion(); return false;">Guardar</button>
    </div>
</div>
