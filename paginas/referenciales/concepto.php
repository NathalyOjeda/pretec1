<input type="text" id="id_concepto" hidden value="0">
<input type="text" id="nombre_antiguo_concepto" hidden value="0">
<div class="card" style="padding: 20px;">

    <h4>Concepto</h4>
    <hr> 
    <div class="row">
        <div class="col-md-5">
            <label>Descripción</label>
            <input type="text" class="form-control" id="concepto_descripcion">
        </div>
        <div class="col-md-5">
            <label>Monto</label>
            <input type="text" class="form-control" id="monto_descripcion">
        </div>
        <div class="col-md-3">
            <label>Estado</label>
            <select  id="concepto_estado" class="form-control">
                <option value="1">ACTIVO</option>
                <option value="0">INACTIVO</option>
            </select>
        </div>
        <div class="col-md-4">
            <label>Operaciones</label>
            <button class="btn btn-success form-control" onclick="guardarConcepto(); return false;">Guardar</button>
        </div>
    </div>
    <hr> 
    <div class="row" id="tabla">
        <div class="col-md-6">
            <label>Busqueda por nombre</label>
            <input type="text" class="form-control" id="b_nombre_concepto">
        </div>
        <div class="col-md-2">
            <label>.</label>
            <button class="btn btn-primary form-control">Buscar</button>
        </div>
        <div class="col-md-3">
            <label>.</label>
            <button class="btn btn-primary form-control" onclick="imprimirReporteConcepto(); return false;" >Reporte</button>
        </div>
        <table class="table table-hover table-bordered" style="margin:40px auto;" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DESCRIPCION</th>
                    <th>MONTO</th>
                    <th>OPERACIONES</th>
                </tr>
            </thead>
            <tbody id="concepto_tb"></tbody>
        </table>
    </div>
</div>