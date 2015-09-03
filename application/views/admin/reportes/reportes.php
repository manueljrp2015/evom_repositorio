<script>
    $(function() {
        $('#Estado').bind('change click', function() {

            if ($('#Estado').val() == '...') {
                var miselect = $("#parroquia");
                miselect.find('option').remove().end().append('').val('');
                
                var miselects = $("#Municipio");
                miselects.find('option').remove().end().append('').val('');
                return false;
            }

            var miselect = $("#parroquia");
            miselect.find('option').remove().end().append('').val('');
            $.post("<?php echo base_url() ?>admin/reportescontroller/getMunicipios", {id: $(this).val()}, function(data) {
                $('#Municipio').html(data);
            });
        });

        $('#Municipio').bind('change click', function() {
            $.post("<?php echo base_url() ?>admin/reportescontroller/getParroquia", {id: $(this).val()}, function(data) {
                $('#parroquia').html(data);
            });
        });
    });

    function estadoPDF() {
        if ($('#Estado').val() == '...') {
            return false;
        }
        else {
            window.open('<?php echo base_url() ?>admin/pdfcontroller/estadosPDF?estado=' + $('#Estado').val(), '_blank');
        }
    }

    function municipioPDF() {
        if (document.getElementById('Municipio').value.length==0) {
            return false;
        }
        else {
            window.open('<?php echo base_url() ?>admin/pdfcontroller/municipioPDF?municipio=' + $('#Municipio').val(), '_blank');
        }
    }

    function parroquiaPDF() {
        if (document.getElementById('parroquia').value.length==0) {
            return false;
        }
        else {
            window.open('<?php echo base_url() ?>admin/pdfcontroller/parroquiaPDF?parroquia=' + $('#parroquia').val(), '_blank');
        }
    }
</script>

<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading" id="enfasis">Reporte Por Estado </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2">Estado:</label>
                <div class="col-sm-6">
                    <select class="form-control" id="Estado" name="Estado">
                        <option>...</option>
                        <?php foreach ($estados as $estado): ?>
                            <option value="<?php echo $estado->codigo_estado ?>"><?php echo $estado->estado ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <a href="#" class="btn-sm btn-danger" onclick="estadoPDF()">Generar PDF</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading" id="enfasis">Reporte Por Municipio </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2">Municipio:</label>
                <div class="col-sm-6">
                    <select class="form-control" id="Municipio" name="Municipio">
                        <?php foreach ($tipoid as $tipid): ?>
                            <option value="<?php echo $tipid->prefijo ?>"><?php echo $tipid->prefijo ?></option>
                        <?php endforeach; ?>
                        <option></option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <a href="#" class="btn-sm btn-danger" onclick="municipioPDF()">Generar PDF</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading" id="enfasis">Reporte Por Parroquia </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2">Parroquia:</label>
                <div class="col-sm-6">
                    <select class="form-control" id="parroquia" name="parroquia">
                        <?php foreach ($tipoid as $tipid): ?>
                            <option value="<?php echo $tipid->prefijo ?>"><?php echo $tipid->prefijo ?></option>
                        <?php endforeach; ?>
                        <option></option>
                    </select>

                </div>
                <div class="col-sm-4">
                    <a href="#" class="btn-sm btn-danger" onclick="parroquiaPDF()">Generar PDF</a>
                </div>
            </div>
        </div>
    </div>
</div>

