<input type="text" id="id_cargo" hidden value="0">
<input type="text" id="nombre_antiguo_cargo" hidden value="0">
<div class="card" style="padding: 20px;">

    <h4>Cargo</h4>
    <hr> 
    <div class="row">
        <div class="col-md-5">
            <label>Nombre del cargo</label>
            <input type="text" class="form-control" id="cargo_descripcion" onkeypress="return soloTexto(event)">
        </div>
        <div class="col-md-5">
            <label>Salario</label>
            <input type="number" class="form-control" id="cargo_salario" min="0">
        </div>
        <div class="col-md-3">
            <label>Estado</label>
            <select  id="cargo_estado" class="form-control">
                <option value="1">ACTIVO</option>
                <option value="0">INACTIVO</option>
            </select>
        </div>
        <div class="col-md-4">
            <label>Operaciones</label>
            <button class="btn btn-success form-control" type="submit" onclick="guardarCargo(); return false;">Guardar</button>
        </div>
    </div>
    <hr> 
    <div class="row" id="tabla">
        <div class="col-md-6">
            <label>Busqueda por nombre de cargo</label>
            <input type="text" class="form-control" id="b_nombre_cargo">
        </div>
        <div class="col-md-2">
            <label>.</label>
            <button class="btn btn-primary form-control">Buscar</button>
        </div>
        <div class="col-md-3">
            <label>.</label>
            <button class="btn btn-primary form-control" onclick="imprimirReporteCargo(); return false;">Reporte</button>
        </div>
        <table class="table table-hover table-bordered" style="margin:40px auto;" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DESCRIPCION</th>
                    <th>MONTO</th>
                    <th>ESTADO</th>
                    <th>OPERACIONES</th>
                </tr>
            </thead>
            <tbody id="cargo_tb"></tbody>
        </table>
    </div>
</div>