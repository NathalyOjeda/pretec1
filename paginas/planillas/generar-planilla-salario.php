<input type="text" id="id_contrato" value="0" hidden>
<h3>Generar Planilla de Liquidación de Salarios</h3>
<p>Debes seleccionar un periodo, para generar la planilla</p>
<div class="row">
    
     <div class="col-md-4">
        <label>Desde</label>
        <input type="month" class="form-control"  id="desde" >
    </div>
     <div class="col-md-4">
        <label>Hasta</label>
        <input type="month" class="form-control"  id="hasta" >
    </div>
     <div class="col-md-4">
        <label>.</label>
        <button class="btn btn-primary form-control" onclick="generarPlanillaSalario(); return false">Generar</button>
    </div>
</div>
