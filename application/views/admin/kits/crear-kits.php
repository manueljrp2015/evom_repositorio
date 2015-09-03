
<script src="<?php echo base_url(DIR_ADMIN_JS) ?>/formater/jquery.price_format.min.js" type="text/javascript"></script>
<script>
    $(function () {
        $('#tableListKits').dataTable({"scrollY": "200px", "scrollCollapse": true, "paging": false, 'iDisplayLength': 6});
        $('#frm').validate({
            rules: {
                _tit: {
                    required: true
                },
                _pre: {
                    required: true
                }
                ,
                _cont: {
                    required: true
                }
            },
            messages: {
                _tit: {
                    required: '<span class="label label-danger" style="font-size: 14px">Campos Requerido</span>'
                },
                _pre: {
                    required: '<span class="label label-danger" style="font-size: 14px">Campos Requerido</span>'
                }
                ,
                _cont: {
                    required: '<span class="label label-danger" style="font-size: 14px">Campos Requerido</span>'
                }
            },
            submitHandler: function () {
                $.ajax({
                    type: $('#frm').attr('method'),
                    url: $('#frm').attr('action'),
                    data: $('#frm').serialize(),
                    beforeSend: function ()
                    {
                        $('#myModalload').modal('show');
                    },
                    success: function (datos) {
                        window.location.href = "<?php echo base_url("admin/kits") ?>";
                    }
                });
            }
        });
    });

    function inact(element, id)
    {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('admin/kitscontroller/inKits') ?>",
            data: "id=" + id,
            beforeSend: function ()
            {
                $('#myModalload').modal({
                    keyboard: false,
                    backdrop: 'static'
                });
            },
            success: function (datos) {
                window.location.href = "<?php echo base_url("admin/kits") ?>";
            }
        });
    }
</script>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading bg-green-gradient" id="enfasis">Crear Kits evom </div>
        <div class="panel-body">
            <form id="frm" method="post" action="<?php echo base_url('admin/kitscontroller/crearKits') ?>">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-12">Titulo:</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="_tit" name="_tit" placeholder="Titulo" maxlength="254">
                    </div>
                    <label for="inputEmail3" class="col-sm-12">Color distintivo:</label>
                    <div class="col-sm-2">
                        <input type="color" class="form-control" id="_color" name="_color">
                    </div>
                    <label for="inputEmail3" class="col-sm-12">Precio:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="_pre" name="_pre" placeholder="Precio" maxlength="254">
                    </div>
                    <label for="inputEmail3" class="col-sm-12">Descripción:</label>
                    <div class="col-sm-12">
                        <textarea class="form-control" id="_cont" name="_cont" placeholder="Contenido"> </textarea>
                    </div>
                    <div class="col-sm-12">
                        <input type="submit" class="btn-sm btn-block btn btn-warning" value="Enviar">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-hover table-striped table-bordered" id="tableListKits">
                <thead>
                    <tr>
                        <td>#Noticia</td>
                        <td>#Titulo</td>
                        <td>#Precio</td>
                        <td>#Descr</td>
                        <td>#Fecha</td>
                        <td>#</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!$kit_all)
                    {
                        
                    }
                    else
                    {
                        $i = 1;
                        foreach ($kit_all as $n)
                        {
                            ?>
                            <tr id="<?php echo "tr_" . $i ?>">
                                <td><?php echo sprintf("%09d", $n->id) ?></td>
                                <td><?php echo $n->_title ?></td>
                                <td><?php echo number_format($n->_precio,2,",",".") ?></td>
                                <td><?php echo $n->_descr ?></td>
                                <td>
                                    <?php
                                    $date = new DateTime($n->_date_create);
                                    echo $date->format("D, d-m-Y")
                                    ?>
                                </td>
<td align="center"><form><input type="hidden" value="<?php echo $i ?>" name="element"><input type="hidden" value="<?php echo $n->id ?>" name="id_s"><button class="btn btn-sm btn-danger" onclick="inact(this.form.element.value, this.form.id_s.value);
        	return false;"> <i class="fa fa-trash fa-2x"></i></button></form></td>
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
<div class="modal fade" id="myModalload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top: 200px">
    <center>
        <img src="<?php echo base_url() . DIR_ADMIN_IMG ?>page/loadingGif.gif" width="60px">
    </center>
</div>
<script>
    $(function () {
        /*FORMATEA*/
        $('#_pre').priceFormat({
            prefix: '',
            thousandsSeparator: ''
        });
    });
</script>