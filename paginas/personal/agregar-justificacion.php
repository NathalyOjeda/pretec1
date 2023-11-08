<input type="text" id="id_contrato" value="0" hidden>
<input type="text" id="id_justificacion_permiso" value="0" hidden>
<h5>Agregar Empleado</h5>
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
   
    <div class="col-md-12">
        <hr>
    </div>
     <div class="col-md-6">
        <label>Inicio de día de permiso</label>
        <input type="date" class="form-control"  id="fecha">
    </div>
     <div class="col-md-6">
        <label>Justificación</label>
        <select  id="justificacion_lst" class="form-control" ></select>
    </div>
     <div class="col-md-6">
        <label>Descripción</label>
        <textarea  id="descripcion" cols="30" rows="10" class="form-control"></textarea>
    </div>
     <div class="col-md-6">
         <input type="checkbox" id="documentos" style="margin-top: 30px;"> <label for="documentos">Entrego Documentos?</label> 
         <input type="file" accept=".pdf" id="file" readonly class="form-control"> 
        
    </div>
    
    
    
</div>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-4">
        <button class="btn btn-success" onclick="guardarJustificacionMovPermiso(); return false;">Guardar</button>
    </div>
</div>
