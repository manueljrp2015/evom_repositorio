<script>
    $(function() {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url('admin/aprobarcontroller/listMilitantes'); ?>',
            beforeSend: function()
            {

            },
            success: function(datos) {
                $("#table_militantes").html(datos);
            }
        });
    });
    function aprobarMilitante(id,email) {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url('admin/aprobarcontroller/aprobarMilitante'); ?>',
            data: 'cedula=' + id+"&email="+email,
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

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading" id="enfasis">Aprobacion de Militantes</div>
        <div class="panel-body" id="table_militantes">
        </div>
    </div>
</div>
<div class="modal fade" id="myModalload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top: 200px">
    <center>
        <img src="<?php echo base_url() . DIR_ADMIN_IMG ?>page/loadingGif.gif" width="60px">
    </center>
</div>

