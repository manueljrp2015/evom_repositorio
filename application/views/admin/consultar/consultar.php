<script>
    $(function() {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url('admin/consultarcontroller/listMilitantes'); ?>',
            beforeSend: function()
            {

            },
            success: function(datos) {
                $("#table_militantes").html(datos);
            }
        });
        $('#frm').validate({
            rules: {
                cedula: {
                    required: true
                }
            },
            messages: {
                cedula: {
                    required: '<span class="label label-warning" style="font-size: 14px">Campos Requerido</span>'
                }
            },
            submitHandler: function() {
                $.ajax({
                    type: $('#frm').attr('method'),
                    url: $('#frm').attr('action'),
                    data: $('#frm').serialize(),
                    beforeSend: function()
                    {
$('#myModalload').modal('show');
                    },
                    success: function(datos) {
                        $('#myModalload').modal('hide');
                        $("#table_militantes").html(datos);
                    }
                });
            }
        });
    });
    function verMilitante(id, email) {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url('admin/consultarcontroller/verMilitante'); ?>',
            data: 'cedula=' + id + "&email=" + email,
            beforeSend: function()
            {
                $('#myModalload').modal('show');
            },
            success: function(datos) {
                if (datos == 'done') {
                    $('#myModalload').modal('hide');
                    location.reload();
                }
            }
        });
    }
</script>
<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading" id="enfasis">Lista de Militantes </div>
        <div class="panel-body">
            <form id="frm" method="post" action="<?php echo base_url('admin/consultarcontroller/consultarCedula') ?>">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2">Cedula:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cedula" maxlength="8">
                    </div>
                    <div class="col-sm-2">
                        <input type="submit" class="btn-sm btn btn-danger" value="Enviar">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading" id="enfasis">Lista de Militantes </div>
        <div class="panel-body" id="table_militantes">

        </div>
    </div>
</div>
<div class="modal fade" id="myModalload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top: 200px">
    <center>
        <img src="<?php echo base_url() . DIR_ADMIN_IMG ?>page/loadingGif.gif" width="60px">
    </center>
</div>

