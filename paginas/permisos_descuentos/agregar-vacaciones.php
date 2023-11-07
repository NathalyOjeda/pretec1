<input type="text" id="id_vacaciones" value="0" hidden>
<input type="text" id="id_contrato" value="0" hidden>
<h5>Vacaciones</h5>
<hr>
<h6>Datos del empleado</h6>
<div class="row panel-empleado" >
    <div class="col-md-3">
        <label>Cédula</label>
        <input type="number" class="form-control cedula_vacaciones"  id="cedula_contrato_b">
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
<h6>Detalles del funcionario</h6>
<div class="row">

    <div class="col-md-4">
        <label>Fecha de de Ingreso </label>
        <input type="date" class="form-control" id="fecha_ingreso" readonly>
    </div>
    <div class="col-md-4">
        <label>Departamento </label>
        <input type="text" class="form-control" id="departanento" readonly>
    </div>
    <div class="col-md-4">
        <label>Antigüedad </label>
        <input type="text" class="form-control" id="antiguedad" readonly>
    </div>
    <div class="col-md-4">
        <label>Dias Pendientes</label>
        <input type="text" class="form-control" id="dias_pendientes" readonly>
    </div>
    <div class="col-md-4">
        <label>Dias Correspondientes</label>
        <input type="text" class="form-control" id="dias_correspondientes" readonly>
    </div>
    <div class="col-md-4">
        <label>Periodo</label>
        <input type="text" class="form-control" id="periodo" readonly>
    </div>

    <div class="col-md-12">
        <hr>
    </div>
    <div class="col-md-12">

        <h6>Detalles del solicitud</h6>
    </div>
    <div class="col-md-3">
        <label>Desde </label>
        <input type="date" class="form-control" id="fecha_desde_va" >
    </div>
    <div class="col-md-3">
        <label>Hasta </label>
        <input type="date" class="form-control" id="fecha_hasta_va" >
    </div>
    <div class="col-md-3">
        <label>CONTEO DE DIAS </label>
        <input type="text" class="form-control" id="dias_seleccionados" value="0" readonly >
    </div>
    <div class="col-md-3" style="margin-top: 25px;">
        <button onclick="enviarSolicitud(); return false;" class="btn btn-success">Enviar Solicitud</button>
    </div>

    <div class="col-md-12">
        <hr> 
    </div>
    <div class="col-md-12">
        <h6>Solicitudes</h6>
    </div>
    <div class="col-md-12" style="margin-top: 30px;">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Salida</th>
                    <th>Fin</th>
                    <th>Días</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="vacaciones_tb"></tbody>
        </table>
    </div>


</div>


