<input type="text" id="id_empleado" value="0" hidden>
<h5>Agregar Empleado</h5>
<div class="row">
    
    <div class="col-md-4">
        <label>Fecha ingreso</label>
        <input type="date" class="form-control" id="fecha_ingreso">
    </div>
    <div class="col-md-4">
        <label>Fecha</label>
        <input type="date" class="form-control" id="fecha_baja">
    </div>
    <div class="col-md-4">
        <label>Sucursal</label>
        <select  id="sucursal_lst" class="form-control">
           
        </select>
    </div>
    <div class="col-md-2">
        <label>COD</label>
        <input type="text" class="form-control" id="cod_curriculum">
    </div>
    <div class="col-md-5">
        <label>Nombre Apellido</label>
        <input type="text" class="form-control" readonly id="nombre_personal">
    </div>
   
    <div class="col-md-3">
        <label>Cédula</label>
        <input type="text" class="form-control" readonly id="cedula_personal">
    </div>
    <div class="col-md-2">
        <label>.</label>
        <button class="btn btn-danger form-control cancelar-btn" onclick="cancelarCurriculum(); return false;">Cancelar</button>
    </div>
    <div class="col-md-4">
        <label>Estado</label>
        <select  id="estado" class="form-control">
            <option value="1">ACTIVO</option>
            <option value="0">INACTIVO</option>
        </select>
    </div>
</div>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-4">
        <button class="btn btn-success" onclick="guardarEmpleado(); return false;">Guardar</button>
    </div>
</div>
