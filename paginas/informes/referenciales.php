<input type="text" id="id_cargo" hidden value="0">
<input type="text" id="nombre_antiguo_cargo" hidden value="0">
<div class="card" style="padding: 20px;">

    <h4>Informes de referenciales</h4>
    <hr> 
    <h5 style="margin-top: 30px;">Personales</h5>
    <div class="row">
        <div class="col-md-3" style="" onclick="imprimirReportePersonal(); return false;">
            <button class="btn btn-outline-dark btn-icon-text">
                <i class="ti-user btn-icon-prepend"></i>
                <span class="d-inline-block text-left">
                    <small class="font-weight-light d-block">Referenciales personales</small>
                    Personal
                </span>
            </button>
        </div>
    </div>
    <h5 style="margin-top: 30px;">Sectores</h5>
    <div class="row">
        <div class="col-md-3" style="" onclick="imprimirReporteDepartamento(); return false;">
            <button class="btn btn-outline-dark btn-icon-text">
                <i class="ti-package btn-icon-prepend"></i>
                <span class="d-inline-block text-left">
                    <small class="font-weight-light d-block">Referenciales sectores</small>
                    Departamento
                </span>
            </button>
        </div>
        <div class="col-md-3" style="" onclick="imprimirReporteCargo(); return false;">
            <button class="btn btn-outline-dark btn-icon-text">
                <i class="ti-shift-right btn-icon-prepend"></i>
                <span class="d-inline-block text-left">
                    <small class="font-weight-light d-block">Referenciales sectores</small>
                    Cargo
                </span>
            </button>
        </div>
        <div class="col-md-3" style="" onclick="imprimirReportePersonal(); return false;">
            <button class="btn btn-outline-dark btn-icon-text">
                <i class="ti-home btn-icon-prepend"></i>
                <span class="d-inline-block text-left">
                    <small class="font-weight-light d-block">Referenciales sectores</small>
                    Sucursal
                </span>
            </button>
        </div>
    </div>
    <h5 style="margin-top: 30px;">Adicionales</h5>
    <div class="row">
        <div class="col-md-3" style="" onclick="imprimirReporteMotivoSancion(); return false;">
            <button class="btn btn-outline-dark btn-icon-text">
                <i class="ti-shortcode btn-icon-prepend"></i>
                <span class="d-inline-block text-left">
                    <small class="font-weight-light d-block">Referenciales Adicionales</small>
                    Motivo Sanción
                </span>
            </button>
        </div><div class="col-md-3" style="" onclick="imprimirReporteJustificacionDePermiso(); return false;">
            <button class="btn btn-outline-dark btn-icon-text">
                <i class="ti-help-alt btn-icon-prepend"></i>
                <span class="d-inline-block text-left">
                    <small class="font-weight-light d-block">Referenciales Adicionales</small>
                    Justi. de permiso
                </span>
            </button>
        </div>
        
        
    </div>
    
</div>
