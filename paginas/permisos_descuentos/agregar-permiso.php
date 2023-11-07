<input type="text" id="id_permiso" value="0" hidden>
<input type="text" id="id_contrato" value="0" hidden>
<h5>Agregar Permiso</h5>
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
    <h6>Detalles del Permiso</h6>
<div class="row">
    
    <div class="col-md-3">
        <label>Fecha de solicitud</label>
        <input type="date" class="form-control" id="fecha_solicitud">
    </div>
    
    <div class="col-md-3" style="display: none;">
        <label>Justificación</label>
        <select  id="justificacion_lst" class="form-control">
            
        </select>
    </div>
    <div class="col-md-3">
        <label>Fecha desde</label>
        <input type="date" class="form-control" id="fecha_desde">
    </div>
    <div class="col-md-3">
        <label>Fecha hasta</label>
        <input type="date" class="form-control" id="fecha_hasta">
    </div>
    
    <div class="col-md-3" style="display: none;">
        <label>Estado</label>
        <select  id="estado_a" class="form-control">
            <option value="ACTIVO">ACTIVO</option>
            <option value="ANULADO">ANULADO</option>
            
        </select>
    </div>
    <div class="col-md-12">
        <label>Descripción</label>
        <textarea  id="descripcion" cols="30" rows="10" class="form-control"></textarea>
    </div>
    
    
</div>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-4">
        <button class="btn btn-success" onclick="guardarPermiso(); return false;">Guardar</button>
    </div>
</div>
