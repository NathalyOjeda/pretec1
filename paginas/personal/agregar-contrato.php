<input type="text" id="id_contrato" value="0" hidden>
<h5>Agregar Contrato</h5>
<hr>
    <h6>Datos del empleado</h6>
<div class="row">
    <div class="col-md-1">
        <label>COD</label>
        <input type="text" class="form-control" id="cod_empleado">
    </div>
    <div class="col-md-6">
        <label>Nombre</label>
        <input type="text" class="form-control" readonly id="nombre_personal">
    </div>
    
    <div class="col-md-3">
        <label>Cédula</label>
        <input type="text" class="form-control" readonly id="cedula_personal">
    </div>
    <div class="col-md-2">
        <label>.</label>
        <button class="btn btn-danger form-control cancelar-btn" onclick="cancelarPersonal(); return false;">Cancelar</button>
    </div>
   
</div>
    <hr>
    <h6>Detalles del contrato</h6>
<div class="row">
    
    <div class="col-md-6">
        <label>Fecha de inicio</label>
        <input type="date" class="form-control" id="fecha_inicio">
    </div>
    <div class="col-md-6">
        <label>Fecha fin</label>
        <input type="date" class="form-control" id="fecha_fin">
    </div>
    
   
    <div class="col-md-3">
        <label>Cargo</label>
        <select  id="cargo_lst" class="form-control ">
            
        </select>
    </div>
     <div class="col-md-3">
        <label>Salario</label>
        <input type="text" class="form-control" readonly id="salario">
    </div>
    <div class="col-md-3">
        <label>Departamento</label>
        <select  id="departamento_lst" class="form-control">
            
        </select>
    </div>
    <div class="col-md-3">
        <label>Tipo</label><br> 
        <input type="radio" name="tipo" id="obrero"   /> <label for="obrero">OBRERO</label> <br> 
        <input type="radio" name="tipo" id="empleado"  checked /> <label for="empleado">EMPLEADO</label>
    </div>
    <div class="col-md-3" hidden>
        <label>Estado</label>
        <select  id="estado_a" class="form-control">
            <option value="1" selected>ACTIVO</option>
            <option value="0">INACTIVO</option>
            
        </select>
    </div>
    
    <div class="col-md-12">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>DESCRIPCION</th>
                    <th>Selección</th>
                </tr>
            </thead>
            <tbody id="perfil_tb">
                
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        <label>Claupsulas</label>
        <div  id="clausula" style="width: 100%; height: 300px;
              overflow: scroll; max-height: 300px;"></div>
    </div>
    
    
</div>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-4">
        <button class="btn btn-success" onclick="guardarContrato(); return false;">Guardar</button>
    </div>
</div>
