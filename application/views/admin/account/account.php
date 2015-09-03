<script type="text/javascript">
    $(function () {
        $('#frm_account').validate({
            rules: {
                usr: {
                    required: true
                },
                pwd: {
                    required: true
                }
            },
            messages: {
                usr: {
                    required: '<div><font color="red">Campo requerido</font></div>'
                },
                pwd: {
                    required: '<div><font color="red">Campo requerido</font></div>'
                }
            },
            submitHandler: function () {
                $.ajax({
                    type: $('#frm_account').attr('method'),
                    url: $('#frm_account').attr('action'),
                    data: $('#frm_account').serialize(),
                    statusCode: {
                        404: function () {
                            alert("archivo de clase no encontrado!");
                        }
                    },
                    beforeSend: function () {

                    },
                    success: function (data) {
                        if (data === '1') {
                            location.reload();
                        }
                        else if (data == '0') {
                            alert('error de validacion');
                        }
                        else if (data == '2') {
                            alert('error de autenticacion');
                        }
                    }
                });
            }
        });
    });
</script>
<div class="panel panel-default">
    <div class="panel-body">
        <form class="form-horizontal" role="form" id="frm_account" method="post" action="<?php echo base_url() ?>index.php/admin/account/validaUsr">
            <div class="form-group">
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="usr" name="usr" placeholder="Usuario">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4">
                    <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Clave">
                </div>
            </div>
            <div class="col-sm-4">
                <input type="submit" class="btn bg-green-gradient btn-sm" value="Loggin">
                <h5>Ingrese su usuario y clave para ingresar!</h5>
            </div>
        </form>
    </div>
</div>