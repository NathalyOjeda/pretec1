<input type="text" id="id_preaviso" hidden value="0">
<input type="text" id="nombre_antiguo_preaviso" hidden value="0">
<input type="text" id="id_contrato" value="0" hidden>
<div class="card" style="padding: 20px;">

    <h4>Pre-Aviso</h4>
    <hr> 
    <div class="row">
        <div class="col-md-12">
            <label>Tipo</label><br> 
            <input type="radio"  name="tipo" id="empresa" checked> <label for="tipo">Empresa</label> <br>
            <input type="radio"  name="tipo" id="empleado"> <label for="tipo">Empleado</label> <br>

        </div>
        <div class="col-md-3">
            <label>Cédula</label>
            <input type="number" class="form-control cedula_preaviso"  id="cedula_contrato_b">
        </div>
        <div class="col-md-6">
            <label>Nombre</label>
            <input type="text" class="form-control"  id="nombre_contrato" onkeypress="return soloTexto(event);">
        </div>
        <div class="col-md-2">
            <label>.</label>
            <button class="btn btn-danger form-control cancelar-btn" onclick="limpiarBusqueda(); return false;">Limpiar</button>
        </div>
        <div class="col-md-4">
            <label>Motivo Desvinculación</label>
            <select  id="motivo_desvinculacion" class="form-control">
              
            </select>
        </div>
        <div class="col-md-4">
            <label>Antigüedad</label>
            <input type="text" readonly id="antiguedad" class="form-control">
        </div>
        <div class="col-md-4">
            <label>Cantidad Días</label>
            <input type="text" readonly id="dias" class="form-control">
        </div>
        <div class="col-md-4">
            <label>Desde</label>
            <input type="date"  id="desde_preaviso" class="form-control">
        </div>
        <div class="col-md-4">
            <label>Hasta</label>
            <input type="date" readonly id="hasta" class="form-control">
        </div>
        <div class="col-md-4">
            <label>Operaciones</label>
            <button class="btn btn-success form-control" onclick="guardarPreaviso(); return false;">Guardar</button>
        </div>
    </div>
    <hr> 
    <div class="row" id="tabla">
<!--        <div class="col-md-6">
            <label>Busqueda por nombre</label>
            <input type="text" class="form-control" id="b_nombre_preaviso">
        </div>
        <div class="col-md-2">
            <label>.</label>
            <button class="btn btn-primary form-control">Buscar</button>
        </div>-->
        <!--        <div class="col-md-3">
                    <label>.</label>
                    <button class="btn btn-primary form-control" onclick="imprimirReporteMotivoSancion(); return false;" >Reporte</button>
                </div>-->
        <table class="table table-hover table-bordered" style="margin:40px auto;" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>MOTIVO</th>
                    <th>DIAS</th>
                    <th>DESDE</th>
                    <th>HASTA</th>
                    <th>ESTADO</th>
                    <th>OPERACIONES</th>
                </tr>
            </thead>
            <tbody id="preaviso_tb"></tbody>
        </table>
    </div>
</div>