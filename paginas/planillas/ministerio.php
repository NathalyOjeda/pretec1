<div class="card" style="padding: 20px;">

    <h4>Ministerio de Justicia y Trabajo</h4>
    <hr> 
    <div class="row">

<!--        <div class="col-md-4">
            <button class="btn btn-success form-control" 
                    onclick="mostrarAgregarMinisterio(); return false;">Agregar</button>
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary form-control" 
                    onclick="mostrarConsultarMinisterio(); return false;">Consultar</button>
        </div>
        <div class="col-md-4">
            <button class="btn btn-warning form-control" 
                    onclick="mostrarGenerarPlanillaMinisterio(); return false;">Generar Planilla</button>
        </div>-->

    </div>
    <hr> 
    <div class="container-fluid" id="contenido-ministerio2">
        <div class="row">
            <div class="col-md-4">
                <label>Tipo</label>
                <select id="tipo_ministerio" class="form-control">
                    <option value="1">Empleados y Obreros</option>
                    <option value="2">Sueldos y Jornales</option>
                    <option value="3">Resumen General</option>
                </select>
            </div>
            <div class="col-md-2" >
                <label>Año</label>
                <input type="text" class="form-control" id="anio" readonly >
            </div>
            <div class="col-md-3" style="margin-top: 25px;">
                <button class="btn btn-success form-control" onclick="generarPlanillaMinisterio2(); return false;">Generar Planilla</button>
            </div>
            <div class="col-md-3" style="margin-top: 25px;">
                <button class="btn btn-primary form-control" onclick="generarXMLPlanillaMinisterio2(); return false;">Generar XML</button>
            </div>
            
        </div>
    </div>

</div>




