<input type="text" id="id_personal" hidden value="0">
<input type="text" id="nombre_antiguo_personal" hidden value="0">
<div class="card" style="padding: 20px;">

    <h4>Personal</h4>
    <hr> 
    <div class="row">
        <div class="col-md-4">
            <label>Nombre</label>
            <input type="text" class="form-control" id="personal_nombre">
        </div>
        <div class="col-md-4">
            <label>Apellido</label>
            <input type="text" class="form-control" id="personal_apellido">
        </div>
        <div class="col-md-4">
            <label>Cédula de Identidad</label>
            <input type="number" min="0" class="form-control" id="personal_cedula">
        </div>
        <div class="col-md-4">
            <label>Fecha de nacimiento</label>
            <input type="date" class="form-control" id="personal_fecha_nacimiento">
        </div>
        <div class="col-md-4">
            <label>Dirección</label>
            <input type="text" class="form-control" id="personal_direccion">
        </div>
        <div class="col-md-4">
            <label>Género</label>
            <select  id="personal_genero" class="form-control">
                <option value="MASCULINO">MASCULINO</option>
                <option value="FEMENINO">FEMENINO</option>
            </select>
        </div>
        <div class="col-md-4">
            <label>Ciudad</label>
            <input type="text" class="form-control" id="personal_ciudad">
        </div>
        <div class="col-md-4">
            <label>Nación</label>
            <input type="text" class="form-control" id="personal_nacion">
        </div>
        
        <div class="col-md-4">
            <label>Estado Civil</label>
            <select  id="personal_estado_civil" class="form-control">
                <option value="SOLTERO">SOLTERO</option>
                <option value="CASADO">CASADO</option>
                <option value="DIVORCIADO">DIVORCIADO</option>
            </select>
        </div>
        <div class="col-md-4">
            <label>Correo</label>
            <input type="email" class="form-control" id="personal_correo">
        </div>
        
        <div class="col-md-4">
            <label>Teléfono</label>
            <input type="tel" class="form-control" id="personal_telefono">
        </div>
       
        <div class="col-md-4">
            <label>Operaciones</label>
            <button class="btn btn-success form-control" onclick="guardarPersonal(); return false;">Guardar</button>
        </div>
    </div>
    <hr> 
    <div class="row" id="tabla">
        <div class="col-md-6">
            <label>Busqueda por nombre</label>
            <input type="text" class="form-control" id="personal_busqueda_nombre">
        </div>
        <div class="col-md-2">
            <label>.</label>
            <button class="btn btn-primary form-control">Buscar</button>
        </div>
        <div class="col-md-3">
            <label>.</label>
            <button class="btn btn-primary form-control" onclick="imprimirReportePersonal(); return false;">Reporte</button>
        </div>
        <table class="table table-hover table-bordered table-responsive" style="margin:40px auto;" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th>CEDULA DE IDENTIDAD</th>
                    <th>FECHA NACIMIENTO</th>
                    <th>DIRECCION</th>
                    <th>GENERO</th>
                    <th>CIUDAD</th>
                    <th>NACION</th>
                    <th>ESTADO CIVIL</th>
                    <th>CORREO</th>
                    <th>TELEFONO</th>
                    <th>OPERACIONES</th>
                </tr>
            </thead>
            <tbody id="personal_tb"></tbody>
        </table>
    </div>
</div>