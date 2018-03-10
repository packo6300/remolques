<script type="text/javascript" src="modulos/Config/js/ConfiguracionListar.js"></script>
<div class="panel panel-primary">
    <div class="panel-heading">
        <label>Configuraciones</label>
    </div>
    <div class="panel-body">
        <div class="col-sm-2">
            <form id="renta">
            <label>Folio de Renta:</label>
            <input name="folioRenta" class="form-control" value="{$folioRenta}">
            <button type="button" class="btn btn-default" onclick="actualizarFolio();"><span class="glyphicon glyphicon-save"></span> Guardar</button>
            </form>
        </div>
        <div class="col-sm-2">
            <form id="iva">
            <label>IVA:</label>
            <input name="iva" type="number" class="form-control" value="{$iva}">
            <button type="button" class="btn btn-default" onclick="actualizarIVA();"><span class="glyphicon glyphicon-save"></span> Guardar</button>
            </form>
        </div>
    </div>
</div>
