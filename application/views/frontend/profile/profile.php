    <?php 
            function formatFecha($date) {
                if (!$date)
                {
                    return NULL;
                }
                else
                {
                    $explode = explode("-", $date);
                    return $explode[2] . '-' . $explode[1] . '-' . $explode[0];
                }
            }
    ?>
<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span4">
                    <div class="widget widget-nopad">
                        <!-- /widget-header -->
                        <div class="widget-content">
                            <div class="widget big-stats-container">
                                <div class="widget-content">
                                    <div class="padding">
                                        <h3>Información de Patrocinante</h3>
                                        <table class="table table-hover">
                                            <thead>
                                                <?php
                                                foreach ($infoSponsor as $f):
                                                    ?>
                                                    <tr>
                                                        <td><h4><?php echo $f->login ?></h4></td>
                                                    </tr>
                                                    <tr>
                                                        <td><h4><?php echo $f->nombre . " " . $f->apellido ?></h4></td>
                                                    </tr>
                                                    <tr>
                                                        <td><h4><?php echo $f->email ?></h4></td>
                                                    </tr>
                                                    <tr>
                                                        <td><h4><?php echo $f->telefono ?></h4></td>
                                                    </tr>
                                                </thead>
                                                <?php
                                            endforeach;
                                            ?>
                                        </table>
                                        <hr />
                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                    <div class="span4">
                    <form action="<?php echo base_url('frontend/profilecontroller/updateProfileBase') ?>" method="post" id="frmUpdateProfileBase">
                        <div class="widget widget-nopad">
                            <!-- /widget-header -->
                            <div class="widget-content">
                                <div class="widget big-stats-container">
                                    <div class="widget-content">
                                        <div class="padding">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <?php
                                                    foreach ($infoUser as $in):
                                                        ?>
                                                        <tr>
                                                            <td>Primer Nombre</td>
                                                            <td>
                                                                <div class="controls">
                                                                    <input type="text" class="span2 login" id="pn" name="pn" value="<?php echo $in->nombre ?>" onkeypress="return soloLetrasN(event)" >
                                                                </div> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Segundo Nombre</td>
                                                            <td>
                                                                <div class="controls">
                                                                    <input type="text" class="span2 login" id="sn" name="sn" value="<?php echo $in->segundo_nombre ?>" onkeypress="return soloLetrasN(event)" >
                                                                </div> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Primer Apellido</td>
                                                            <td>
                                                                <div class="controls">
                                                                    <input type="text" class="span2 login" id="pa" name="pa" value="<?php echo $in->apellido ?>" onkeypress="return soloLetrasN(event)" >
                                                                </div> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Segundo Apellido</td>
                                                            <td>
                                                                <div class="controls">
                                                                    <input type="text" class="span2 login" id="sa" name="sa" value="<?php echo $in->segundo_apellido ?>" onkeypress="return soloLetrasN(event)" >
                                                                </div> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td>
                                                                <div class="controls">
                                                                    <?php echo $in->email ?>
                                                                </div> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cédula</td>
                                                            <td>
                                                                <div class="controls">
                                                                    <?php echo $in->identificacion ?>
                                                                </div> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Serial</td>
                                                            <td>
                                                                <div class="controls">
                                                                    <?php echo $in->serial ?>
                                                                </div> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td>
                                                                <div class="controls">
                                                                    <button type="submit" class="btn btn-primary" >Actualizar</button> 
                                                                </div> 
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </table>
                                            <div class="controls"  id="msgArea">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form> 
                    </div>
                <div class="span4">
                 <form action="<?php echo base_url('frontend/profilecontroller/updateProfileComp') ?>" method="post" id="frmUpdateProfileComp">
                    <div class="widget widget-nopad">
                        <!-- /widget-header -->
                        <div class="widget-content">
                            <div class="widget big-stats-container">
                                <div class="widget-content">
                                    <div class="padding">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <?php
                                                foreach ($infoUser as $in):
                                                    ?>
                                                    <tr>
                                                        <td>Dirección</td>
                                                        <td>
                                                            <div class="controls">
                                                                <input type="text" class="span2 login" id="dir" name="dir" value="<?php echo $in->direccion ?>" onkeypress="return soloLetrasN(event)">
                                                            </div> 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Teléfono</td>
                                                        <td>
                                                            <div class="controls">
                                                                <input type="text" class="span2 login" id="tel" name="tel"  value="<?php echo $in->telefono ?>" data-inputmask='"mask": "9999-999-9999"' data-mask />
                                                            </div> 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Fec/Nacimiento</td>
                                                        <td>
                                                            <div class="controls">
                                                                <input type="text" class="span2 login" id="fec" name="fec"  value="<?php echo formatFecha($in->fecha_nacimiento) ?>" data-inputmask='"mask": "99-99-9999"' data-mask />
                                                            </div> 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Twitter</td>
                                                        <td>
                                                            <div class="controls">
                                                                <input type="text" class="span2 login" id="twt" name="twt"   value="<?php echo $in->twitter ?>"  />
                                                            </div> 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Facebook</td>
                                                        <td>
                                                            <div class="controls">
                                                                <input type="text" class="span2 login" id="face" name="face"   value="<?php echo $in->facebook ?>"  />
                                                            </div> 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Instagram</td>
                                                        <td>
                                                            <div class="controls">
                                                                <input type="text" class="span2 login" id="inst" name="inst"   value="<?php echo $in->instagram ?>"  />
                                                            </div> 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            <div class="controls">
                                                                <button type="submit" class="btn btn-primary" >Actualizar</button> 
                                                            </div> 
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <?php
                                            endforeach;
                                            ?>
                                        </table>
                                        <div class="controls"  id="msgAreaTwo">
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

            var frmUpdateProfileBase = $("#frmUpdateProfileBase");
            var frmUpdateProfileComp = $("#frmUpdateProfileComp");
            var mascaraInput = $("[data-mask]");
            var inputDate = $('#fec');

            mascaraInput.inputmask();
            inputDate.datepicker({format:'dd-mm-yyyy',todayBtn:'linked',autoclose:true});

            frmUpdateProfileBase.validate({
                rules: {
                    pn: {
                        required: true
                    },
                    sn: {
                        required: true
                    },
                    pa: {
                        required: true
                    },
                    sa: {
                        required: true
                    }
                },
                messages: {
                    pn: {
                        required: "<div class='label label-warning'>Campo requerido</div>"
                    },
                    sn: {
                        required: "<div class='label label-warning'>Campo requerido</div>"
                    },
                    pa: {
                        required: "<div class='label label-warning'>Campo requerido</div>"
                    },
                    sa: {
                        required: "<div class='label label-warning'>Campo requerido</div>"
                    }
                },
                submitHandler: function () {
                    $.ajax({type: frmUpdateProfileBase.attr('method'), url: frmUpdateProfileBase.attr('action'), data: frmUpdateProfileBase.serialize(), beforeSend: function ()
                        {
                            $("#msgArea").empty().append('<img src="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/loading.gif" width="200px">');
                        }, success: function (datos) {
                            $("#msgArea").empty().append(datos);
                            setInterval(function(){
                            window.location.href = '<?php echo base_url("profile") ?>';
                            },3000);
                        }});
                }
            });

            frmUpdateProfileComp.validate({
                rules: {
                    dir: {
                        required: true
                    },
                    tel: {
                        required: true
                    },
                    fec: {
                        required: true
                    }
                },
                messages: {
                    dir: {
                        required: "<div class='label label-warning'>Campo requerido</div>"
                    },
                    tel: {
                        required: "<div class='label label-warning'>Campo requerido</div>"
                    },
                    fec: {
                        required: "<div class='label label-warning'>Campo requerido</div>"
                    }
                },
                submitHandler: function () {
                    $.ajax({type: frmUpdateProfileComp.attr('method'), url: frmUpdateProfileComp.attr('action'), data: frmUpdateProfileComp.serialize(), beforeSend: function ()
                        {
                            $("#msgAreaTwo").empty().append('<img src="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/loading.gif" width="200px">');
                        }, success: function (datos) {
                            $("#msgAreaTwo").empty().append(datos);
                            setInterval(function(){
                            window.location.href = '<?php echo base_url("profile") ?>';
                            },3000);
                        }});
                }
            });
        });
    </script>
    <link href="<?php echo base_url(DIR_FRONTEND_JS) ?>/bootstrap-datepicker/css/datepicker.css" rel="stylesheet">
    <script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src ="<?php echo base_url(DIR_FRONTEND_JS) ?>/jquery.validate.js" type="text/javascript"></script>
    <script src ="<?php echo base_url(DIR_FRONTEND_JS) ?>/validar_caracteres.js" type="text/javascript"></script>
    <script src ="<?php echo base_url(DIR_FRONTEND_JS) ?>/javascripts/jquery.inputmask.min.js" type="text/javascript"></script>
    <script src ="<?php echo base_url(DIR_FRONTEND_JS) ?>/javascripts/jquery.inputmask.extensions.js" type="text/javascript"></script>
