<input type="text" id="id_salario" value="0" hidden>
<input type="text" id="id_contrato" value="0" hidden>
<h5>Agregar Salario</h5>
<hr>
<h6>Persona</h6>
<div class="row">
    
    <div class="col-md-4">
        <label>Cédula de Identidad</label>
        <input type="text" class="form-control" id="cedula_b">
    </div>
    <div class="col-md-5">
        <label>Nombre Apellido</label>
        <input type="text" class="form-control" readonly id="nombre_personal">
    </div>
   
   
    <div class="col-md-3">
        <label> </label>
        <button class="btn btn-danger form-control cancelar-btn" onclick="cancelarJusMov(); return false;">Cancelar</button>
    </div>
    
   
</div>
    <hr>
    <h6>Detalles del salario</h6>
<div class="row">
    
    <div class="col-md-6">
        <label>Fecha</label>
        <input type="date" class="form-control" id="fecha">
    </div>
   
    
     <div class="col-md-6">
        <label>Salario</label>
        <input type="text" class="form-control"  id="salario">
    </div>
    
    
    
    
</div>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-4">
        <button class="btn btn-success" onclick="guardarHistorialSalario(); return false;">Guardar</button>
    </div>
</div>
