<input type="text" id="id_contrato" value="0" hidden>
<h3>Busqueda de Asistencias</h3>
<div class="row">
    <div class="col-md-2">
        <label>Cédula</label>
        <input type="number" class="form-control"  id="cedula_contrato_c">
    </div>
     <div class="col-md-3">
        <label>Nombre</label>
        <input type="text" class="form-control"  id="nombre_contrato_c" onkeypress="return soloTexto(event);">
    </div>
     <div class="col-md-3">
        <label>Desde</label>
        <input type="date" class="form-control"  id="desde" >
    </div>
     <div class="col-md-3">
        <label>Hasta</label>
        <input type="date" class="form-control"  id="hasta" >
    </div>
     <div class="col-md-1">
        <label>.</label>
        <button class="btn btn-primary form-control" onclick="buscarAsistencias(); return false"><i class="ti ti-search"></i></button>
    </div>
</div>
<table class="table table-hover table-bordered" style="margin-top: 20px;">
    <thead>
        <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Hora entrada</th>
            <th>Hora salida</th>
            <th>Descripcion</th>
            <!--<th>Operaciones</th>-->
            
        </tr>
    </thead>
    <tbody id="asistencia_tb"></tbody>
</table>