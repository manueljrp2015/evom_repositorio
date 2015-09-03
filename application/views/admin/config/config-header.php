<script>
    $(function () {
        $('#loading').hide();
        $('#frm_organo').validate({
            rules: {
                _org: {
                    required: true
                },
                _dir: {
                    required: true
                },
                _resp: {
                    required: true
                },
                _desc: {
                    required: true
                }
            },
            messages: {
                _org: {
                    required: '<font color="red">campo requerido</font>'
                },
                _dir: {
                    required: '<font color="red">campo requerido</font>'
                },
                _resp: {
                    required: '<font color="red">campo requerido</font>'
                },
                _desc: {
                    required: '<font color="red">campo requerido</font>'
                }
            },
            submitHandler: function () {
                $.ajax({
                    type: $('#frm_organo').attr('method'),
                    url: $('#frm_organo').attr('action'),
                    data: $('#frm_organo').serialize(),
                    beforeSend: function ()
                    {
                        $('#loading').show();
                    },
                    success: function (datos) {
                        if (datos == 'done') {
                            $('#loading').hide();
                            window.location.href = "<?php echo base_url() ?>admin/organizacion";
                            //$('#mensaje').html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Exito!</strong> Punto de venta creado!.</div>');
                        }
                        else {
                            $('#loading').hide();
                            $('#mensaje').html(datos);
                        }
                    }
                });
            }
        });

        $("#tborg").dataTable({
            "oLanguage": {
                "oAria": {
                    "sSortAscending": " - click/return to sort ascending"
                },
                "sLengthMenu": 'Mostrar <select>' +
                        '<option value="5">5</option>' +
                        '<option value="10">10</option>' +
                        '<option value="20">20</option>' +
                        '<option value="30">30</option>' +
                        '<option value="40">40</option>' +
                        '<option value="50">50</option>' +
                        '<option value="-1">Todos</option>' +
                        '</select> Registros'
            }
        });
    });
    function block(id, correlativo, pwd) {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url('admin/configcontroller/deleteOrgano') ?>',
            data: '_id=' + id,
            beforeSend: function ()
            {
                $('#td_' + correlativo).html('<IMG src="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/loader-vinoteca.gif"   id="loading" class="img-responsive">');
            },
            success: function (datos) {
                if (datos == 'done') {
                    $('#td_' + correlativo).html('');
                     window.location.href = "<?php echo base_url() ?>admin/organizacion";
                }
                else {
                    $('#td_' + correlativo).html('');
                    $('#mensaje').html(datos);
                }
            }
        });
    }
    function update(id, correlativo, org, dir, resp, desc) {
        if ($('#_org' + correlativo).val() == '') {
            $('#_org' + correlativo).css('border-color', 'red').focus();
            return false;
        }
        if ($('#_dir' + correlativo).val() == '') {
            $('#_dir' + correlativo).css('border-color', 'red').focus();
            return false;
        }
        if ($('#_resp' + correlativo).val() == '') {
            $('#_resp' + correlativo).css('border-color', 'red').focus();
            return false;
        }
        if ($('#_desc' + correlativo).val() == '') {
            $('#_desc' + correlativo).css('border-color', 'red').focus();
            return false;
        }
        $.ajax({
            type: 'post',
            url: '<?php echo base_url('admin/configcontroller/updateOrgano') ?>',
            data: '_id=' + id + '&_org=' + org + '&_dir=' + dir + '&_resp=' + resp + '&_desc=' + desc,
            beforeSend: function ()
            {
                $('#td_' + correlativo).html('<IMG src="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/loader-vinoteca.gif"   id="loading" class="img-responsive">');
            },
            success: function (datos) {
                if (datos == 'done') {
                    $('#td_' + correlativo).html('');
                     window.location.href = "<?php echo base_url() ?>admin/organizacion";
                }
                else {
                    $('#td_' + correlativo).html('');
                    $('#mensaje').html(datos);
                }
            }
        });
    }
</script>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading bg-red-gradient" id="enfasis">Configuraci&oacute;n de Organizaciones</div>
        <div class="panel-body" id="tb_org">
            <form id="frm_organo" class="form-horizontal" role="form" method="post" action="<?php echo base_url('admin/configcontroller/putOrgano') ?>">
                <div class="row">
                    <label for="inputEmail3" class="col-sm-2"></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="_org" name="_org" placeholder="Organizaci&oacute;n">
                    </div>
                </div>
                <div class="row">
                    <label for="inputPassword3" class="col-sm-2"></label>

                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="_dir" name="_dir" placeholder="Direcci&oacute;n">
                    </div>
                </div>
                <div class="row">
                    <label for="inputPassword3" class="col-sm-2"></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="_resp" name="_resp" placeholder="Responzable">
                    </div>
                </div>
                <div class="row">
                    <label for="rif" class="col-sm-2"></label>
                    <div class="col-sm-6">
                        <textarea class="form-control" id="_desc" name="_desc"  placeholder="Descripci&oacute;n del &oacute;rgano"></textarea>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-sm-offset-2 col-sm-2">
                        <input type="submit" class="btn bg-blue-gradient btn-sm" value="Guardar">
                    </div>
                    <div class="col-sm-5">
                        <IMG src="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/loadingGif.gif"  width="40px" id="loading" class="img-responsive">
                    </div>
                </div>
            </form>
            <div id="mensaje"></div>
            <hr>
            <table id="tborg" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <td>#id</td>
                        <td>Organizaci&oacute;n</td>
                        <td>Direcci&oacute;n</td>
                        <td>Responzable</td>
                        <td>Descripci&oacute;n</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($org == 'vacio')
                    {
                        
                    } else
                    {
                        $i = 1;
                        foreach ($org as $org)
                        {
                            ?>

                            <tr id="tr_<?php echo $i ?>">
                                <td><form><?php echo $org->id ?></td>
                                <td><input type="hidden" name="cor" value="<?php echo $i ?>"><input type="text" id="_org<?php echo $i ?>" class="form-control" name="_org" value="<?php echo $org->organizacion ?>"></td>
                                <td><input type="text" id="_dir<?php echo $i ?>" class="form-control" name="_dir" value="<?php echo $org->direccion ?>"></td>
                                <td><input type="text" id="_resp<?php echo $i ?>" class="form-control" name="_resp" value="<?php echo $org->responzable ?>"></td>
                                <td><input type="text" id="_desc<?php echo $i ?>" class="form-control" name="_desc" value="<?php echo $org->descripcion ?>"></td>
                                <td>
                                    <input type="hidden" name="id" value="<?php echo $org->id ?>">
                                    <button onclick="block(this.form.id.value, this.form.cor.value, this.form.id.value);
                                                    return false;" class="btn bg-red-gradient btn-sm" title="Borrar Organizaci&oacute;n"><i class="fa fa-lock"></i></button>  
                                </td>
                                <td>
                                    <button onclick="update(this.form.id.value, this.form.cor.value, this.form._org.value, this.form._dir.value, this.form._resp.value, this.form._desc.value);
                                                    return false;" class="btn bg-blue-gradient btn-sm" title="Actualizar Organizaci&oacute;n"><i class="fa fa-edit"></i></button> 
                                    </form>
                                </td>
                                <td id="td_<?php echo $i ?>"></td>
                            </tr>

                            <?php
                            $i++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
