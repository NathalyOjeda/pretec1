<input type="text" id="id_contrato" value="0" hidden>
<h3>Busqueda de Descuentos</h3>
<div class="row">
    <div class="col-md-3">
        <label>Cédula</label>
        <input type="number" class="form-control"  id="cedula_contrato_c">
    </div>
     <div class="col-md-6">
        <label>Nombre</label>
        <input type="text" class="form-control"  id="nombre_contrato_c" onkeypress="return soloTexto(event);">
    </div>
     <div class="col-md-3" style="display: none;">
        <label>Desde</label>
        <input type="date" class="form-control"  id="desde" >
    </div>
    <div class="col-md-3" style="display: none;">
        <label>Hasta</label>
        <input type="date" class="form-control"  id="hasta" >
    </div>
     <div class="col-md-2">
        <label>.</label>
        <button class="btn btn-primary form-control" onclick="buscarDescuento(); return false"><i class="ti ti-search"></i></button>
    </div>
</div>
<table class="table table-hover table-bordered " style="margin-top: 20px;">
    <thead>
        <tr>
            <th>#</th>
            <th>Fecha </th>
            <th>Motivo</th>
            <th>Monto</th>
            <th>Estado</th>
            <th>Operaciones</th>
            
        </tr>
    </thead>
    <tbody id="descuento_tb"></tbody>
</table>