<input type="text" id="id_cargo" hidden value="0">
<input type="text" id="nombre_seleccionado" hidden value="0">
<input type="text" id="nombre_antiguo_cargo" hidden value="0">
<div class="card" style="padding: 20px;">

    <h4>Perfiles</h4>
    <p>Agregar perfiles para cargos, que servirán para completar formulario de contrato</p>
    <hr> 
    <div class="row " hidden>
        <div class="col-md-4">
            <label>Descripción</label>
            <input type="text" class="form-control" id="cargo_descripcion">
        </div>
        <div class="col-md-4">
            <label>Salario</label>
            <input type="number" class="form-control" id="cargo_salario" min="0">
        </div>
        <div class="col-md-4">
            <label>Estado</label>
            <select  id="cargo_estado" class="form-control">
                <option value="1">ACTIVO</option>
                <option value="0">INACTIVO</option>
            </select>
        </div>
        <hr>

    </div>
    <div class="row agregar-perfil" hidden >
        <div class="col-md-6">
            <label>Descripción</label>
            <input type="text" id="descripcion_perfil" class="form-control">
        </div>
        <div class="col-md-3" style="margin-top: 25px;">
            <button class="btn btn-success form-control" onclick="agregarPerfilDirecto(); return false;">Agregar</button>
        </div>
        <div class="col-md-3" style="margin-top: 25px;">
            <button class="btn btn-primary form-control" onclick="imprimirPerfiles(); return false;">Imprimir Todo</button>
        </div>
    </div>
    <hr>
    <div class="col-md-12 agregar-perfil" hidden>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td>#</td>
                    <td>DESCRIPCION</td>
                    <td></td>
                </tr>
            <tbody id="perfiles_tb">

            </tbody>
            </thead>
        </table>
        <!--        <div class="col-md-4">
                    <label>Operaciones</label>
                    <button class="btn btn-success form-control" onclick="guardarCargo(); return false;">Guardar</button>
                </div>-->
    </div>
    <hr> 
    <div class="row" id="tabla">
        <div class="col-md-6">
            <label>Busqueda por nombre</label>
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