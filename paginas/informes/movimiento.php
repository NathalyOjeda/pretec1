<input type="text" id="id_cargo" hidden value="0">
<input type="text" id="nombre_antiguo_cargo" hidden value="0">
<div class="card" style="padding: 20px;">

    <h4>Informes de movimientos</h4>
    <hr> 
    <div class="row">
        <div class="col-md-12">
            <label>Tipo de Movimiento</label>
            <select  id="tipo" class="form-control">
                <option value="">Selecciona un tipo</option>
                <option value="Permisos">Permisos</option>
                <option value="Sanciones">Sanciones</option>
                <option value="Descuento">Descuento</option>
                <option value="I.P.S">I.P.S</option>
                <option value="MJT">Ministerio de Justicia y Trabajo</option>
                <option value="Salario">Salario</option>
                <option value="Aguinaldo">Aguinaldo</option>
            </select>
        </div>
        <div class="col-md-12">
            <label>Especificacion</label>
            <select  id="especificacion" class="form-control">
                 <option value="0">Selecciona tipo</option>
            </select>
        </div>
        <div class="col-md-12">
            <label>Periodo</label>
        </div>
        <div class="col-md-6">
            <label>Desde</label>
            <input type="date" id="desde" class="form-control">
        </div>
        <div class="col-md-6">
            <label>Hasta</label>
            <input type="date" id="hasta" class="form-control">
        </div>
        <div class="col-md-12" style="margin-top: 20px;">
            <button class="form-control btn btn-success" onclick="imprimirInformeMovimiento();">Imprimir informe</button>
        </div>
    </div>
    
    
</div>
