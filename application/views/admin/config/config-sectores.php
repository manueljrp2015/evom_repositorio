<script>
    $(function () {
        $('#loading').hide();
        $("#_nuevo_sector").attr("disabled", "disabled");
        $('#Estado').bind('change click', function () {
            var miselect = $("#parroquia");
            miselect.find('option').remove().end().append('').val('');
            var miselect2 = $("#dir_sector");
            miselect2.find('option').remove().end().append('').val('');
            $.post("<?php echo base_url() ?>admin/configcontroller/getMunicipios", {id: $(this).val()}, function (data) {
                $('#Municipio').removeAttr("disabled");
                $('#Municipio').html(data);
            });
        });
        $('#Municipio').bind('change click', function () {
            $.post("<?php echo base_url() ?>admin/configcontroller/getParroquia", {id: $(this).val()}, function (data) {
                $('#parroquia').removeAttr("disabled");
                $('#parroquia').html(data);
            });
        });
        $('#parroquia').bind('change click', function () {
            $.post("<?php echo base_url() ?>admin/configcontroller/getSector", {id: $(this).val()}, function (data) {
                $('#dir_sector').removeAttr("disabled");
                $('#dir_sector').html(data);
            });
        });
        $('#dir_sector').bind('change click', function () {
            $('#_id_sector').val($('#dir_sector').val());
            $('#_nuevo_sector').removeAttr("disabled").val($('#dir_sector option:selected').html());
        });
        $("#bt").click(function () {
            if($('#_nuevo_sector').val()=="" || $('#_nuevo_sector').val()=="Nuevo Sector"){
                $('#_nuevo_sector').css("border","1px solid red").val().focus();
                return false;
            }
            
            $.ajax({
                type: $('#frm_sector').attr('method'),
                url: $('#frm_sector').attr('action'),
                data: $('#frm_sector').serialize(),
                beforeSend: function ()
                {
                    $('#loading').show();
                },
                success: function (datos) {
                    if (datos == 'done') {
                        $('#loading').hide();
                        window.location.href = "<?php echo base_url() ?>admin/sectores";
                    }
                    else {
                        $('#loading').hide();
                        $('#mensaje').html(datos);
                    }
                }
            });
        });
    });
</script>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading bg-red-gradient" id="enfasis">Agregar Sectores de Venezuela</div>
        <div class="panel-body" id="tb_org">
            <form id="frm_sector" class="form-horizontal" role="form" method="post" action="<?php echo base_url('admin/configcontroller/putSector') ?>">
                <div class="form-group">
                    <label for="Estado" class="col-sm-3">Estado.</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="Estado" name="Estado">
                            <?php foreach ($estados as $estado): ?>
                                <option value="<?php echo $estado->codigo_estado ?>"><?php echo $estado->estado ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Municipio" class="col-sm-3">Municipio.</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="Municipio" name="Municipio" disabled="disabled">
                            <?php foreach ($tipoid as $tipid): ?>
                                <option value="<?php echo $tipid->prefijo ?>"><?php echo $tipid->prefijo ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3">Parroquia.</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="parroquia" name="parroquia" disabled="disabled">
                            <?php foreach ($tipoid as $tipid): ?>
                                <option value="<?php echo $tipid->prefijo ?>"><?php echo $tipid->prefijo ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dir_2" class="col-sm-3">Sector</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="dir_sector" name="dir_sector" disabled="disabled">
                            <?php foreach ($tipoid as $tipid): ?>
                                <option value="<?php echo $tipid->prefijo ?>"><?php echo $tipid->prefijo ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dir_2" class="col-sm-3">Editar Sector</label>
                    <div class="col-sm-8">
                        <input type="hidden"  id="_id_sector" name="_id_sector">
                        <input type="text" class="form-control" id="_nuevo_sector" name="_nuevo_sector">
                    </div>
                </div>

                <div class="form-group" >
                    <label for="dir_2" class="col-sm-3"></label>
                    <div class="col-sm-offset-2 col-sm-2">
                        <input type="button" class="btn bg-blue-gradient btn-sm" value="Guardar" id="bt">
                    </div>
                    <div class="col-sm-5">
                        <IMG src="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/loadingGif.gif"  width="40px" id="loading" class="img-responsive">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

