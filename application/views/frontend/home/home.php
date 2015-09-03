<link rel="stylesheet" href="<?php echo base_url(DIR_FRONTEND_CSS) ?>/stylesheets/jquery.realperson.css">
<script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/jquery.plugin.min.js" type="text/javascript" ></script>
<script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/jquery.realperson.min.js" type="text/javascript" ></script>
<script type="text/javascript">
    (function () {
	$(document).ready(function () {
	    $("#_send").click(function () {
		$("#form-init").validate({rules: {_email: {email: true, required: true}, _pwd: {required: true}, _captchaval: {required: true}}, messages: {_email: {email: "<span class='label label-danger'>debes ingresar un email valido</label>", required: "<span class='label label-danger'>debes ingresar un usuario</label>"}, _pwd: {required: "<span class='label label-danger'>debes ingresar un password</label>"}, _captchaval: {required: "<span class='label label-danger'>debes ingresar el captcha</label>"}}, submitHandler: function () {
			$.ajax({type: $("#form-init").attr('method'), url: $("#form-init").attr('action'), data: $("#form-init").serialize(), beforeSend: function ()
			    {
				$('<img src="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/loading.gif" width="200px"  id="imgLoad">').appendTo('#msgArea');
			    }, success: function (datos) {
				if (datos == 'done') {
				    window.location = '<?php echo base_url('ini-panel'); ?>';
				}
				else {
				    $("#msgArea").empty().html(' <div class="alert alert-warning alert-dismissable" style="width: auto;" id="message-login"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;</button><strong>Atencion!</strong><br>' + datos + '</div> ');
				}
			    }});
		    }});
	    });
	    $("#_recv").bind("click", function () {
		if ($("#_ced").val() == "" || $("#_ced").val() == null) {
		    $("#m").append('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Campo Vacio o invalido!</strong></div>');
		    return false;
		}
		$.ajax({type: $("#form-recv").attr('method'), url: $("#form-recv").attr('action'), data: $("#form-recv").serialize(), beforeSend: function ()
		    {
			$('<img src="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/loading.gif" width="200px"  id="imgLoad">').appendTo('#m');
		    }, success: function (datos) {
			if (datos == 'done') {
                            $("#m").empty().append(' <div class="alert alert-success alert-dismissable" style="width: auto;" id="message-login"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;</button><strong>Hemos enviado un correo electrónico a su cuenta de email, por favor revisar.</strong></div> ');;
                            $("#_ced").empty();
                            setInterval(function(){
                                $("#myModal").modal('hide');
                            },5000);
			    
			}
			else {
			    $("#m").empty().append(' <div class="alert alert-warning alert-dismissable" style="width: auto;" id="message-login"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;</button><strong>Atencion!</strong><br>' + datos + '</div> ');
			}
		    }});
	    });
	});

    }).call(this);
</script>
<script>
    $(function () {
	$('#_captchaval').realperson();
    });
</script>
<div class="account-container">
    <div class="content clearfix">
        <form action="<?php echo base_url('frontend/home/scry') ?>" method="post" id="form-init">
            <h1>Entrada  De Socios</h1>		
            <div class="login-fields">
                <p>Por Favor Indique Su Informacion</p>
                <div class="field">
                    <label for="email">Email</label>
                    <input type="text" id="_email" name="_email" value="<?php ?>" placeholder="Email" class="login username-field" />
                </div> 
                <div class="field">
                    <label for="password">Clave:</label>
                    <input type="password" id="_pwd" name="_pwd" value="" placeholder="Clave" class="login password-field"/>
                </div>
                <p>Captcha:</p>
                <div class="field">
                    <p></p>
                    <input type="text" id="_captchaval" class="login username-field" name="_captchaval">
                </div>
                <div class="field"  id="msgArea">
                </div>
            </div>
            <div class="login-actions">
                <span class="login-checkbox">
                    <a href="#myModal" role="button" class="btn btn-warning btn-sm" data-toggle="modal"><i class="fa fa-lock"></i> Recuperar Clave</a>
                </span>
                <input type="submit" class="button btn btn-success btn-sm" value="Ingresar" id="_send">
            </div> <!-- .actions -->
        </form>
    </div> <!-- /content -->
</div> 

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Recuperar Clave</h3>
    </div>
    <div class="modal-body">
        <form action="<?php echo base_url('frontend/home/update') ?>" method="post" id="form-recv">
            <p>Para recuperar clave ingrese su número de cédula y recibirá un correo electrónico con sus datos…</p>
            <div class="form-group">
                <label for="email">Cédula</label>
                <input type="text" id="_ced" name="_ced" value="<?php ?>" placeholder="Cédula" class="form-control" />
                <div id="m"></div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
        <button class="btn btn-primary" id="_recv">Enviar</button>
    </div>
</div>
</div> <!-- /controls -->	
</div> <!-- /control-group -->
<script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/jquery.validate.js" type="text/javascript"></script>
</body>
</html>
