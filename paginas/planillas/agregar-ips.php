<input type="text" id="id_ips" value="0" hidden>
<input type="text" id="id_contrato" value="0" hidden>
<h5>Agregar a planila de I.P.S.</h5>
<hr>
<h6>Datos del empleado</h6>
<div class="row panel-empleado" >
    <div class="col-md-3">
        <label>Cédula</label>
        <input type="number" class="form-control"  id="cedula_contrato_i">
    </div>
    <div class="col-md-3">
        <label>Nombre</label>
        <input type="text" class="form-control"  id="nombre_contrato" onkeypress="return soloTexto(event);">
    </div>
    <div class="col-md-3">
        <label>Salario actual</label>
        <input type="text" class="form-control"  readonly id="salario">
    </div>
    <div class="col-md-3">
        <label>.</label>
        <button class="btn btn-danger form-control cancelar-btn" onclick="limpiarBusquedaIPS(); return false;">Limpiar</button>
    </div>

</div>
<hr>
<h6>Detalles del I.P.S.</h6>
<div class="row">

    <div class="col-md-3">
        <label>Fecha </label>
        <input type="month" class="form-control" id="fecha">
    </div>

    <div class="col-md-3">
        <label>Aporte</label>
        <input type="number" class="form-control" id="aporte" readonly>
    </div>
    <div class="col-md-3">
        <label>Estado</label>
        <select  id="estado_a" class="form-control">
            <option value="ACTIVO">ACTIVO</option>
            <option value="ANULADO">ANULADO</option>

        </select>
    </div>

    <div class="col-md-12">
        <label>Descripción</label>
        <textarea  id="descripcion" cols="30" rows="10" 
                   class="form-control"></textarea>
    </div>

</div>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-4">
        <button class="btn btn-success" onclick="guardarIPS(); return false;">Guardar</button>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <h3>Grilla de funcionarios registrados</h3>
        
    </div>
    <div class="col-md-12">
        <table class="table table-bordered table-striped">
            
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha Aporte</th>
                    <th>Funcionario</th>
                    <th>Cédula</th>
                    <th>Cargo</th>
                    <th>Sueldo</th>
                    <th>Aporte</th>
                    <th>Estado</th>
                    <th>Operaciones</th>
                </tr>
            </thead>
            <tbody id="grilla_ips"></tbody>
        </table>
    </div>
</div>
