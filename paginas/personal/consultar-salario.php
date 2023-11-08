<input type="text" id="id_contrato" value="0" hidden>
<h3>Busqueda de salarios</h3>
<div class="row">
   <div class="col-md-6">
        <label>Cédula de Identidad</label>
        <input type="text" class="form-control" id="cedula_b">
    </div>
    <div class="col-md-6">
        <label>Nombre Apellido</label>
        <input type="text" class="form-control" readonly id="nombre_personal">
    </div>
    <div class="col-md-4">
        <label>Desde</label>
        <input type="date" class="form-control"  id="desde_dt">
    </div>
    <div class="col-md-4">
        <label>Hasta</label>
        <input type="date" class="form-control"  id="hasta_dt">
    </div>
    <div class="col-md-4">
        <label>.</label>
        <button class="btn btn-primary form-control" onclick="buscarHistorialSalario(); return false;">Buscar</button>
    </div>
   
</div>
<table class="table table-hover table-bordered" style="margin-top: 20px;">
    <thead>
        <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Salario</th>
            <th>Estado</th>
            <th>Operaciones</th>
            
        </tr>
    </thead>
    <tbody id="salario_tb"></tbody>
</table>