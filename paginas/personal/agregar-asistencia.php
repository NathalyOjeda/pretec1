<input type="text" id="id_contrato" value="0" hidden>
<input type="text" id="id_asistencia" value="0" hidden>
<h5>Agregar Asistencia</h5>
<hr>
    <h6>Datos del empleado</h6>
<div class="row">
    
    <div class="col-md-12" style="margin-bottom: 20px;"> 
        <H2>Identifiquese</H2>
        <p>Realiza una busqueda por cedula o nombre según lo requiera, para luego realizar
        la marcación de asistencia</p>
    </div>
    
    <div class="col-md-3">
        <label>Cédula</label>
        <input type="number" class="form-control"  id="cedula_contrato">
    </div>
     <div class="col-md-6">
        <label>Nombre</label>
        <input type="text" class="form-control"  id="nombre_contrato" onkeypress="return soloTexto(event);">
    </div>
    <div class="col-md-2">
        <label>.</label>
        <button class="btn btn-danger form-control cancelar-btn" onclick="limpiarAsistencia(); return false;">Limpiar</button>
    </div>
   
</div>
    <hr>
    <h6>Asistencia</h6>
<div class="row">
    
    <div class="col-md-12" style="text-align: center;">
        <label style="font-size: 30px;">TIPO DE MARCACION DE HORARIO</label><br> 
        <h1 style="font-size: 50px;" id="tipo_marcacion">-</h1><br>
        <div style="font-size: 40px;" ><span id="fecha_actual"> </span></div><br>
        <div style="font-size: 40px;" ><span id="hora_actual"> </span> HS.</div><br>
    </div>
    <div class="col-md-12">
        <button class="btn btn-success form-control" id="marcar_btn" onclick="guardarAistencia();">Confirmar</button>
    </div>
    
    
    
    
</div>


