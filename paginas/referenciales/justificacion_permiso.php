<input type="text" id="id_justificacion_permiso" hidden value="0">
<input type="text" id="nombre_antiguo_justificacion_permiso" hidden value="0">
<div class="card" style="padding: 20px;">

    <h4>Justificación de Permiso</h4>
    <hr> 
    <div class="row">
        <div class="col-md-5">
            <label>Descripción</label>
            <input type="text" class="form-control" id="justificacion_permiso_descripcion">
        </div>
        <div class="col-md-3">
            <label>Estado</label>
            <select  id="justificacion_permiso_estado" class="form-control">
                <option value="1">ACTIVO</option>
                <option value="0">INACTIVO</option>
            </select>
        </div>
        <div class="col-md-4">
            <label>Operaciones</label>
            <button class="btn btn-success form-control" onclick="guardarJustificacionPermiso(); return false;">Guardar</button>
        </div>
    </div>
    <hr> 
    <div class="row" id="tabla">
        <div class="col-md-6">
            <label>Busqueda por nombre</label>
            <input type="text" class="form-control" id="b_nombre_justificacion_permiso">
        </div>
        <div class="col-md-2">
            <label>.</label>
            <button class="btn btn-primary form-control">Buscar</button>
        </div>
        <div class="col-md-3">
            <label>.</label>
            <button class="btn btn-primary form-control" onclick="imprimirReporteJustificacionDePermiso(); return false;" >Reporte</button>
        </div>
        <table class="table table-hover table-bordered" style="margin:40px auto;" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DESCRIPCION</th>
                    <th>OPERACIONES</th>
                </tr>
            </thead>
            <tbody id="justificacion_permiso_tb"></tbody>
        </table>
    </div>
</div>