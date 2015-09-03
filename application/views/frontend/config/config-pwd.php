<script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/validar_caracteres.js" type="text/javascript"></script>
<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <form action="<?php echo base_url('frontend/configcontroller/rcvPwd') ?>" method="post" id="frm_rcv">
                    <div class="span4">
                        <div class="widget widget-nopad">
                            <!-- /widget-header -->
                            <div class="widget-content">
                                <div class="widget big-stats-container">
                                    <div class="widget-content">
                                        <div class="padding">
                                            <h3>Cambiar Clave</h3>
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <td>Clave Actual</td>
                                                        <td>
                                                            <div class="controls">
                                                                <input type="password" class="span2 login" id="pa" name="pa" onkeypress="return soloLetrasN(event)" >
                                                            </div> 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nueva Clave</td>
                                                        <td>
                                                            <div class="controls">
                                                                <input type="password" class="span2 login" id="nc" name="nc"  onkeypress="return soloLetrasN(event)" >
                                                            </div> 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Repetir Clave</td>
                                                        <td>
                                                            <div class="controls">
                                                                <input type="password" class="span2 login" id="rpc" name="rpc" onkeypress="return soloLetrasN(event)" >
                                                            </div> 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            <div class="controls">
                                                                <button type="submit" class="btn btn-primary">Cambiar Clave</button>
                                                            </div> 
                                                        </td>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <div class="controls"  id="msgArea">
                                            </div>
                                            <div class="alert alert-info">
                                                <strong>Información!</strong> <small>Para cambiar la clave coloque la clave temporal que le fue enviado a su cuenta de correo respetando las mayúsculas y minúsculas o para una mejor ejecución del cambio cópiela y pégala.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
	$("#frm_rcv").validate({
	    rules: {
		pa: {
		    required: true
		},
		nc: {
		    required: true,
		    maxlength: 15,
		    minlength: 6
		},
		rpc: {
		    required: true,
		    equalTo: '#nc'
		}
	    },
	    messages: {
		pa: {
		    required: "<div class='label label-warning'>Campo requerido</div>"
		},
		nc: {
		    required: "<div class='label label-warning'>Campo requerido</div>",
		    maxlength: '<div class="label label-warning">El Password debe contener maximo 15 caracteres</div>',
		    minlength: '<div class="label label-warning">El Password debe contener minimo 6 caracteres</div>'
		},
		rpc: {
		    required: "<div class='label label-warning'>Campo requerido</div>",
		    equalTo: '<div class="label label-warning">Las claves no coinciden.</div>'
		}
	    },
	    submitHandler: function () {
		$.ajax({type: $('#frm_rcv').attr('method'), url: $('#frm_rcv').attr('action'), data: $("#frm_rcv").serialize(), beforeSend: function ()
		    {
			$("#msgArea").empty().append('<img src="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/loading.gif" width="200px">');
		    }, success: function (datos) {
                        $("#pa, #nc, #rpc").val('');
			$("#msgArea").empty().append(datos);
		    }});
	    }
	});
    });
</script>