<input type="text" id="id_contrato" value="0" hidden>
<h3>Generar Planilla de liquidacion de Aguinaldo</h3>
<p>Debes seleccionar un periodo, para generar la planilla</p>
<div class="row">
    
     <div class="col-md-4">
        <label>Año</label>
         <?php
        $cont = date('Y');
        ?>
        <select id="anio" class="form-control">
            <?php while ($cont >= 2000) { ?>
                <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
                <?php $cont = ($cont - 1);
            }
            ?>
        </select>
    </div>
     
     <div class="col-md-4">
        <label>.</label>
        <button class="btn btn-primary form-control" onclick="generarPlanillaAguinaldo(); return false">Generar</button>
    </div>
</div>
