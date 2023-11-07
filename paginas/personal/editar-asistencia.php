<input type="text" id="id_asistencia" value="0" hidden>
<h3>Editar asistencia</h3>
<div class="row">
    
    <div class="col-md-4">
        <label>Fecha</label>
        <input type="date" class="form-control" id="fecha">
    </div>
    <div class="col-md-4">
        <label>Entrada</label>
        <input type="time" class="form-control" id="entrada">
    </div>
    <div class="col-md-4">
        <label>Salida</label>
        <input type="time" class="form-control" id="salida">
    </div>
    <div class="col-md-12">
        <label>Descripión</label>
        <textarea  id="descripcion" cols="30" rows="10" class="form-control"></textarea>
    </div>
    
</div>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-4">
        <button class="btn btn-success" onclick="actualizarAsistencia(); return false;">Actualizar</button>
    </div>
</div>
