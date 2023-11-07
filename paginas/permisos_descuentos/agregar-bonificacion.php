<input type="text" id="id_bonificacion" value="0" hidden>
<input type="text" id="id_contrato" value="0" hidden>
<h5>Agregar Sanción</h5>
<hr>
<h6>Datos del empleado</h6>
<div class="row panel-empleado" >
    <div class="col-md-3">
        <label>Cédula</label>
        <input type="number" class="form-control cedula_bonificacion"  id="cedula_contrato_b">
    </div>
    <div class="col-md-6">
        <label>Nombre</label>
        <input type="text" class="form-control"  id="nombre_contrato" onkeypress="return soloTexto(event);">
    </div>
    <div class="col-md-2">
        <label>.</label>
        <button class="btn btn-danger form-control cancelar-btn" onclick="limpiarBusqueda(); return false;">Limpiar</button>
    </div>

</div>
<hr>
<h6>Detalles de la Bonificación</h6>
<div class="row">

    <div class="col-md-4">
        <label>Fecha de pago </label>
        <input type="date" class="form-control" id="fecha_pago_bonificacion">
    </div>

    <div class="col-md-2">
        <label>Total de hijos</label>
        <input type="text" id="total_hijos" class="form-control" readonly value="0">
    </div>
    <div class="col-md-2">
        <label>Hijos Menores</label>
        <input type="text" id="total_hijos_menores" class="form-control" readonly value="0">
    </div>
    <div class="col-md-4">
        <label>Monto total a recibir</label>
        <input type="text" id="monto" class="form-control" readonly value="0">
    </div>

    <hr>
    <div class="col-md-12">
        <h6>Detalles de hijos</h6>
    </div>
    <div class="col-md-5">
        <label>Nombre y Apellido</label>
        <input type="text" class="form-control" id="nombre_hijo">
    </div>
    <div class="col-md-3">
        <label>Año de Nacimiento</label>
        <input type="date" class="form-control" id="fecha_nacimiento_hijo">
    </div>
    <div class="col-md-4" style="margin-top: 25px;">
        <button class="btn btn-success" onclick="agregarHijo(); return false;">Agregar Hijo</button>
    </div>

    <div class="col-md-12">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Nombre y apellido</th>
                    <th>Fecha de Nacimiento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="hijos_tb"></tbody>
        </table>
    </div>


</div>


