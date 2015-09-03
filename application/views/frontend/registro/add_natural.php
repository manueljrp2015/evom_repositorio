<script type="text/javascript">
    $(function () {
	$(function () {
	    $("#imgLoad").hide();
	    $("[data-mask]").inputmask();
	    $('[name=cancel]').click(function () {
		window.location = '<?php echo base_url(); ?>';
	    });
	    $('[name=acepto]').click(function () {
		$(this).attr("class", "btn btn-info");
		$(this).empty().html("Gracias por aceptarme!").attr("disabled", "disabled");
		$("#Email, #id_user, #apodo, #nombre, #apellido, #password, #confirm_password, #telf, #estado, #pais, #Field, #send").removeAttr("disabled");
	    });
	    $('#form-register').validate({rules: {Email: {required: true, email: true}, nombre: {required: true}, apellido: {required: true}, apodo: {required: true}, telf: {required: true}, password: {required: true, maxlength: 15, minlength: 6}, confirm_password: {equalTo: '#password'}, id_user: {number: true, required: true}}, messages: {Email: {required: '<div class="label label-warning">Campo requerido</div>', email: '<div class="label label-warning">Debe colocar un email valido</div>'}, id_user: {number: '<div class="label label-warning">Campo Solo admite numeros</div>', required: '<div class="label label-warning">Campo requerido</div>'}, nombre: {required: '<div class="label label-warning">Campo requerido</div>'}, telf: {required: '<div class="label label-warning">Campo requerido</div>'}, apellido: {required: '<div class="label label-warning">Campo requerido</div>'}, apodo: {required: '<div class="label label-warning">Campo requerido</div>'}, password: {required: '<div class="label label-warning">Campo requerido</div>', maxlength: '<div class="label label-warning">El Password debe contener maximo 15 caracteres</div>', minlength: '<div class="label label-warning">El Password debe contener minimo 6 caracteres</div>'}, confirm_password: {required: '<div class="label label-warning">Campo requerido</div>', maxlength: '<div class="label label-warning">El Password debe contener maximo 15 caracteres</div>', minlength: '<div class="label label-warning">El Password debe contener minimo 6 caracteres</div>', equalTo: '<div class="label label-warning">Las claves no coinciden.</div>'}}, submitHandler: function () {
		    if ($("#Field").is(":checked")) {
			$('#myModal').modal('show');
		    }
		    else {
			$("#msgArea").empty();
			$('<div class="label label-warning">Debe aceptar, los términos y condiciones.</div>').appendTo('#msgArea');
		    }
		}});
	    $('#data').click(function () {
		$('#myModal').modal('hide');
		$.ajax({type: $('#form-register').attr('method'), url: $('#form-register').attr('action'), data: $("#form-register").serialize(), beforeSend: function ()
		    {
			$("#imgLoad").show();
		    }, success: function (datos) {
			if (datos == 'done') {
			    window.location = '<?php echo base_url(); ?>';
			}
			else {
			    $("#imgLoad").hide();
			    $("#msgArea").empty();
			    $("#msgArea").html(' <div class="alert alert-warning alert-dismissable" style="width: auto;" id="message-login"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;</button><strong>Atencion!</strong><br>' + datos + '</div> ');
			}
		    }});
	    });
	});
    });
</script>
<?php
foreach ($datosSponsor as $v)
{
    $nombre = $v->nombre;
    $apellido = $v->apellido;
    $cedulaSponsor = $v->identificacion;
    $usr = $v->login;
    $emailSponsor = $v->email;
}
?>
<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span6">
                    <div class="widget widget-nopad">
                        <div class="widget-content">
                            <div class="widget big-stats-container">
                                <div class="widget-content">
                                    <div class="content-youtube">
                                        <iframe width="540" height="330" src="https://www.youtube.com/embed/zID9tQIaN84" frameborder="0" allowfullscreen></iframe>
                                        <h3>Iniciamos en:</h3> <h3 id="count"></h3>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="<?php echo base_url('frontend/registrocontroller/procesar'); ?>" method="post" id="form-register">
                    <div class="span3">
                        <div class="widget widget-nopad">
                            <div class="widget-content">
                                <div class="widget big-stats-container">
                                    <div class="widget-content">
                                        <div class="padding">
                                            <h4>Forma parte de nuestra familia</h4>
                                            <div class="control-group">	
                                                <div class="controls">
                                                    <strong> <?php echo strtoupper($nombre . ' ' . $apellido . ' (' . $usr . ') ') ?></strong> te invita a formar parte de su red de afiliados <button class="btn btn-success btn-sm" name="acepto" onclick="javascript: return false;">Aceptas!</button>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <input type="text" id="nombre" name="nombre" value="" placeholder="Primer Nombre"  onkeypress="return soloLetras(event)" class="span2" disabled="disabled"/>
                                                </div> <!-- /field -->
                                            </div>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <input type="text" id="apellido" name="apellido" value="" placeholder="Primer Apellido"  onkeypress="return soloLetras(event)" class="span2" disabled="disabled"/>
                                                </div> <!-- /field -->
                                            </div>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <input type="text" id="Email" name="Email" value="" placeholder="Email (Correo)" class="span2 login" disabled="disabled"/>
                                                </div> <!-- /field -->
                                            </div>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <input type="text" id="apodo" name="apodo" value=""  placeholder="Apodo (Nickname)" onkeypress="return soloLetrasN(event)" class="span2" disabled="disabled"/>
                                                </div> <!-- /field -->
                                            </div>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <input type="text" id="telf" name="telf" value="" placeholder="Telef" data-inputmask='"mask": "9999-999-9999"' data-mask class="span2" disabled="disabled" />
                                                </div> <!-- /field --> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="span3">
                        <div class="widget widget-nopad">
                            <div class="widget-content">
                                <div class="widget big-stats-container">
                                    <div class="widget-content">
                                        <div class="padding">
                                            <div class="control-group">
                                                <div class="controls">
                                                    <select id="pais" name="pais"  class="span2" disabled="disabled">
                                                        <?php
                                                        foreach ($listaPaises as $listaPaises):
                                                            ?>
                                                            <option value="<?php echo $listaPaises->id_pais ?>"><?php echo $listaPaises->Pais ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div> <!-- /field -->
                                            </div>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <select id="estado" name="estado" value="" class="span2" disabled="disabled">
                                                        <?php
                                                        foreach ($estadoVzla as $estadoVzla):
                                                            ?>
                                                            <option value="<?php echo $estadoVzla->codigo_estado ?>"><?php echo $estadoVzla->estado ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div> <!-- /field -->
                                            </div>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <input type="text" id="id_user" name="id_user" value=""  placeholder="Cédula o Pasaporte" onkeypress="return soloNumeros(event)" class="span2" disabled="disabled"/>
                                                    <input type="hidden" class="login" name="hiddem-url" id="hiddem-url" value="<?php echo $cedulaSponsor; ?>">
                                                    <input type="hidden" class="login" name="hiddem-email" id="hiddem-email" value="<?php echo $emailSponsor; ?>">
                                                </div> <!-- /field -->
                                            </div>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <input type="password" id="password" name="password" value="" placeholder="Password" class="span2" disabled="disabled"/>
                                                </div> <!-- /field -->
                                            </div>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <input type="password" id="confirm_password" name="confirm_password" value="" placeholder="Confirm Password" class="span2" disabled="disabled"/>
                                                </div> <!-- /field -->
                                            </div>
                                            <div class="control-group">
                                                <div class="controls"  id="msgArea">
                                                    <img src="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/loading.gif" width="200px"  id="imgLoad">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <span class="login-checkbox">
                                                        <input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="si" tabindex="4" disabled="disabled" />
                                                        <label class="choice" for="Field">Acepto los términos y condiciones!.</label>
                                                    </span>
                                                    <button class="button btn btn-primary btn-large"  disabled="disabled" id="send">Registrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <?php
                        foreach ($ultimoRegistrado as $ult):
                            foreach ($countRegistrado as $count):
                                ?>
                        <h3 class="bigstats">Ultimo socio registrado <a href="#" style="color: #0073b7;"><?php
                                        echo $ult->participante
                                        ?></a>, ya somos <a href="#" style="color: #0073b7;"><?php
                                        echo ($count->t -2)
                                        ?></a> socios. </h3>
                                    <?php
                                endforeach;
                            endforeach;
                            ?>
                    </div>
            </div>
        </form>
    </div>
</div>
</div>

<!-- ventana modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Gracias por preferirnos!</h3>
    </div>
    <div class="modal-body">
        <p>En plena posesi&oacute;n de mis facultades, y el pleno ejercicio de mis derechos civiles, por su propia voluntad, a trav&eacute;s del presente ACUERDO DE T&Eacute;RMINO Y ASOCIACI&Oacute;N, después de haber sido introducido en el "lanzamiento de Evom" por otra persona ya legalmente asociada, autorizado y activo, que he venido para declarar inter&eacute;s en ser patrocinada por la que se asocia a presentar mi membres&iacute;a a Evom, y por lo tanto  declararo mi convencimiento y el libre albedr&iacute;o para ser admitido como miembro asociado.</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
        <button class="btn btn-primary" id="data">Procesar Solicitud</button>
    </div>
</div>
<script>
    $(function () {
	$('#count').countdown({until: new Date(2015, 08 - 1, 1), padZeroes: true, format: 'WdHMS'});
    });
</script>
<script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/validar_caracteres.js" type="text/javascript"></script>
<script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/javascripts/jquery.inputmask.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/javascripts/jquery.inputmask.extensions.js" type="text/javascript"></script>
<link href="<?php echo base_url(DIR_FRONTEND_JS); ?>/countdown/jquery.countdown.css" type="text/css" rel="stylesheet">
<script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/countdown/jquery.plugin.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/countdown/jquery.countdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/countdown/jquery.countdown-es.js" type="text/javascript"></script>