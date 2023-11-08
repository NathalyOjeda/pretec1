<input type="text" id="id_contrato" value="0" hidden>
<h3>Generar Planilla Ministerio de Justicia y Trabajo. por periodo</h3>
<p>Debes seleccionar un periodo, para generar la planilla</p>
<div class="row">
    
     <div class="col-md-4">
        <label>Desde</label>
        <input type="date" class="form-control"  id="desde" >
    </div>
     <div class="col-md-4">
        <label>Hasta</label>
        <input type="date" class="form-control"  id="hasta" >
    </div>
     <div class="col-md-4">
        <label>.</label>
        <button class="btn btn-primary form-control" onclick="generarPlanillaMinisterio(); return false">Generar</button>
    </div>
</div>
