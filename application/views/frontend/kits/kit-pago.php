<div class="main">
    <link href="<?= base_url(DIR_FRONTEND_JS)."/fileupload/dropzone.css" ?>" rel="stylesheet">
    <div class="main-inner">
        <div class="container">
            <div class="row">

                <div class="span6">
                    <div class="widget widget-nopad">
                        <div class="widget-content">
                            <div class="widget big-stats-container">
                                <div class="widget-content">
                                    <div class="padding">
                                        <h4>Declara el pago para adquirir</h4>
                                        <br>

                                        <div class="control-group">
                                            <label>Archivo Soporte</label>
                                            <p>Arrastre el archivo hacia la imagen DROP FILE o de clic sobre la misma</p>
                                            <ul>
                                                Parametros Para carga de Soporte
                                                <li>El Archivo no puede pesar mas de 1Mb.</li>
                                                <li>Solo un archivo soporte.</li>
                                                <li>Solo se aceptan formatos JPG, JPEG, PDF.</li>
                                            </ul>
                                            <div class="controls">
                                                <form action="<?php echo base_url("exec-pago-kits") ?>" class="dropzone" id="MyDrop"></form>
                                            </div>
                                            <!-- /field -->

                                            <div class="msg"></div>
                                        </div>
                                        <form id="fpago">
                                            <div class="control-group">
                                                <label class="muted">Producto</label>

                                                <div class="controls">
                                                    <input type="text" id="_x" name="_x" value="<?php echo $parse[1] ?>"
                                                           onkeypress="return soloLetras(event)" class="span4"
                                                           readonly="readonly"/>
                                                    <input type="hidden" id="_xi" name="_xi" value="<?php echo $parse[0] ?>"
                                                           onkeypress="return soloLetras(event)" class="span4"
                                                           readonly="readonly"/>
                                                </div>
                                                <!-- /field -->
                                            </div>
                                            <div class="control-group">
                                                <label class="muted">Mes a cancelar</label>

                                                <div class="controls">
                                                    <input type="text" id="month" name="month"
                                                           value="<?php
                                                           if (!$status_kits) {
                                                               echo "Inscripción";
                                                           } else {
                                                               echo date("m-M");
                                                           }
                                                           ?>"
                                                           onkeypress="return soloLetras(event)" class="span2"
                                                           readonly="readonly"/>
                                                </div>
                                                <!-- /field -->
                                            </div>
                                            <div class="control-group">
                                                <label class="muted">Monto a pagar</label>

                                                <div class="controls">
                                                    <input type="hidden" id="pg" name="pg"
                                                           value="<?php echo $parse[0] ?>">
                                                    <input type="text" id="nombre" name="nombre"
                                                           value="<?php echo number_format($parse[2], 2, ",", ".") ?>"
                                                           onkeypress="return soloLetras(event)" class="span4"
                                                           disabled="disabled"/>
                                                </div>
                                                <!-- /field -->
                                            </div>
                                            <div class="control-group">
                                                <label class="muted">Fecha de Pago</label>

                                                <div class="controls">
                                                    <div class="col-sm-12">
                                                        <input type="text" id="fecp" name="fecp" value=""
                                                               onkeypress="return soloLetras(event)" class="span2"
                                                               readonly="readonly"/>
                                                    </div>
                                                </div>
                                                <!-- /field -->
                                            </div>
                                            <div class="control-group">
                                                <label class="muted">Forma de Pago</label>

                                                <div class="controls">
                                                    <select name="fp" id="fp" class="span2">
                                                        <?php
                                                        foreach ($fp as $fp):
                                                            ?>
                                                            <option
                                                                value="<?php echo $fp->id ?>"><?php echo $fp->descripcion_pago ?></option>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                                <!-- /field -->
                                            </div>
                                            <div class="control-group">
                                                <label class="muted">Banco de origen</label>

                                                <div class="controls">
                                                    <select name="ent" id="ent" class="span4">
                                                        <?php
                                                        foreach ($entidades as $ent):
                                                            ?>
                                                            <option
                                                                value="<?php echo $ent->id ?>"><?php echo $ent->_entidad ?></option>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                                <!-- /field -->
                                            </div>
                                            <div class="control-group">
                                                <label class="muted">Nro. Transacción</label>

                                                <div class="controls">
                                                    <input type="text" id="trans" name="trans" value="" class="span4"/>
                                                </div>
                                                <!-- /field -->
                                            </div>

                                            <div class="control-group">
                                                <div class="controls">
                                                    <button type="submit"  class="btn btn-success btn-block span4">
                                                        Declarar Pago
                                                    </button>
                                                </div>
                                                <!-- /field -->
                                            </div>
                                            <div class="control-group">
                                                <div class="controls" id="msgArea">

                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url(DIR_FRONTEND_JS) . "/fileupload/dropzone.min.js" ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $('#fecp').datepicker({
            format: 'dd--mm-yyyy'
        });


        $('#fpago').validate({
            rules: {
                fecp: {required: true},
                trans: {required: true}
            },
            messages: {
                fecp: {required: '<div class="label label-warning">Campo requerido</div>'},
                trans: {required: '<div class="label label-warning">Campo requerido</div>'}
            }
            , submitHandler: function () {

                saved();
            }
        });

        Dropzone.autoDiscover = false;

        /* DROP */
        var myDropzone = new Dropzone(".dropzone", {
            url: $("#MyDrop").attr("action"),
            method: "post",
            maxFilesize: 1,
            paramName: "files",
            uploadMultiple: false,
            maxFiles: 1,
            autoProcessQueue: false,
            parallelUploads: 10000,
            acceptedFiles: "image/jpg, image/jpeg ,application/pdf",
            fallback: true,
            accept: function (file, done) {
                done();
            },
            error: function (file, e) {
                myDropzone.removeFile(file);

                var search = e;
                var n = search.search("big");
                var nx = search.search("can't");
                var nxm = search.search("more");
                var ms;
                if (n > 0) {
                    ms = "El archivo es muy pesado y no cumple con los requerimientos mínimos, hasta 1Mb"
                } else if (nx > 0) {
                    ms = "No puedes subir archivos de este tipo."
                } else if (nxm > 0) {
                    ms = "No puedes subir más de un (1) archivo."
                }

                $(".msg").empty().append("<div class='alert alert-danger'><ul><li>"+ms+"</li></ul></div>");
                window.setTimeout(function(){
                    $(".msg").empty();
                },3000);

            },
            sending: function (file, xhr, formData) {
                formData.append("_product", $("#_xi").val());
                formData.append("_month", $("#month").val());
                formData.append("_pg", $("#pg").val());
                formData.append("_fecp", $("#fecp").val());
                formData.append("_fp", $("#fp").val());
                formData.append("_ent", $("#ent").val());
                formData.append("_trans", $("#trans").val());
            },
            complete: function (file) {
            },
            success: function (file) {
                window.location.href = "<?= base_url("mis-kits");  ?>";
            }
        });

        var saved = function(){
            myDropzone.processQueue();
        }
    });
</script>
<script type="text/javascript"
        src="<?php echo base_url(DIR_TERCEROS); ?>/datepicker/js/bootstrap-datepicker.js"></script>
<link href="<?php echo base_url(DIR_TERCEROS) ?>/datepicker/css/datepicker.css" rel="stylesheet">
<script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/validar_caracteres.js" type="text/javascript"></script>