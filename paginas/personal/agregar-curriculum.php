<input type="text" id="id_curriculum" value="0" hidden>
<h5>Agregar Curriculum</h5>
<div class="row">
    
    <div class="col-md-4">
        <label>Fecha</label>
        <input type="date" class="form-control" id="fecha">
    </div>
    <div class="col-md-4">
        <label>Estado</label>
        <select  id="estado" class="form-control">
            <option value="0">SELECCIONA UN ESTADO</option>
            <option value="PENDIENTE">PENDIENTE</option>
            <option value="REVISION">REVISION</option>
            <option value="APROVADO">APROVADO</option>
            <option value="RECHAZADO">RECHAZADO</option>
        </select>
    </div>
    <div class="col-md-4" style="margin-top: 25px;">
        <button class="btn btn-success" onclick="nuevoPersonalDC(); return false;">Nuevo Personal</button>
    </div>
</div>
<div class="row">
    <div class="col-md-1">
        <label>COD</label>
        <input type="text" class="form-control" id="cod_personal">
    </div>
    <div class="col-md-3">
        <label>Nombre</label>
        <input type="text" class="form-control" readonly id="nombre_personal">
    </div>
    <div class="col-md-3">
        <label>Apellido</label>
        <input type="text" class="form-control" readonly id="apellido_personal">
    </div>
    <div class="col-md-3">
        <label>Cédula</label>
        <input type="text" class="form-control" readonly id="cedula_personal">
    </div>
    <div class="col-md-2">
        <label>.</label>
        <button class="btn btn-danger form-control cancelar-btn" onclick="cancelarPersonal(); return false;">Cancelar</button>
    </div>
    <div class="col-md-12" style="margin-top: 30px;">
    <label>Académido</label><br> 
    <hr> 
        
    </div>
    
    <div class="col-md-4">
        <label>Lugar</label>
        <input type="text" class="form-control form-control-sm" id="lugar">
        <label>Periodo</label>
        <input type="text" class="form-control form-control-sm" id="periodo">
        <label>Descripción</label>
        <input type="text" class="form-control form-control-sm" id="descripcion_academico">
        <button class=" btn btn-success form-control form-control-sm" 
                onclick="agregarAcademico();" style="margin-top: 20px;">Agregar</button>
        
    </div>
    <div class="col-md-8">
        <label>Detalles</label>
        
        <table class="table  table-bordered table-hover table-striped table-sm"  style="max-height: 300px; 
               overflow: scroll;">
            <thead>
                <tr>
                    <th>Lugar</th>
                    <th>Periodo</th>
                    <th>Descripcion</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="academico_tb" ></tbody>
        </table>
    </div>
    <div class="col-md-12" style="margin-top: 30px;">
    <label>Referencia Laboral</label><br> 
    <hr> 
        
    </div>
    
    <div class="col-md-4">
        <label>Nombre y Apellido</label>
        <input type="text" class="form-control form-control-sm" id="nombre_apellido_lab">
        <label>Telefono</label>
        <input type="text" class="form-control form-control-sm" id="telefono_lab">
        <label>Descripción</label>
        <input type="text" class="form-control form-control-sm" id="descripcion_lab">
        <button class=" btn btn-success form-control form-control-sm" 
                onclick="agregarRefLaboral();" style="margin-top: 20px;">Agregar</button>
 
    </div>
    <div class="col-md-8">
        <label>Detalles</label>
        <table class="table table-bordered table-hover table-striped table-sm ">
            <thead>
                <tr> 
                    <th>Nombre y Apellido</th>
                    <th>Telefono</th>
                    <th>Descripcion</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="ref_laboral_tb" style="max-height: 500px;"> </tbody>
        </table>
    </div>
    <div class="col-md-12" style="margin-top: 30px;">
    <label>Experiencia Laboral</label><br> 
    <hr> 
        
    </div>
    
    <div class="col-md-4">
        <label>Empresa</label>
        <input type="text" class="form-control form-control-sm" id="empresa_lab">
        <label>Telefono</label>
        <input type="text" class="form-control form-control-sm" id="telefono_exp_lab">
        <label>Descripción</label>
        <input type="text" class="form-control form-control-sm" id="descripcion_exp_lab">
        <button class=" btn btn-success form-control form-control-sm" 
                onclick="agregarExpLaboral();" style="margin-top: 20px;">Agregar</button>
 
    </div>
    <div class="col-md-8">
        <label>Detalles</label>
        <table class="table table-bordered table-hover table-striped table-sm ">
            <thead>
                <tr> 
                    <th>Empresa</th>
                    <th>Telefono</th>
                    <th>Descripcion</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="exp_laboral_tb" style="max-height: 500px;"> </tbody>
        </table>
    </div>
    <div class="col-md-12">
        <label>Descripción</label>
        <textarea  id="descripcion_personal"  class="form-control" rows="10"></textarea>
    </div>
</div>
<div class="row" style="margin-top: 20px;">
    <div class="col-md-4">
        <button class="btn btn-success" onclick="guardarCurriculum(); return false;">Guardar</button>
    </div>
</div>
