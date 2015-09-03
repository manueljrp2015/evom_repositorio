<script>
    $(function () {
        $("#tableRedes").dataTable();
    });
</script>
<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="widget">
                        <div class="widget-header"> <i class="icon-user"></i>
                            <h3> Su red de Socios</h3>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">
                            <div class="widget big-stats-container">
                                <div class="widget-content">
                                    <h6 class="bigstats">Red ordenada por niveles</h6>
                                    <table class="table table-striped table-bordered" id="tableRedes">
                                        <thead>
                                            <tr>
                                                <th> Socio</th>
                                                <th> Nivel</th>
                                                <th> Estado</th>
                                                <th> Jerarquía</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if(!$redListada){
                                                
                                            }
                                            else{
                                            foreach ($redListada as $red):
                                                ?>
                                                <tr>
                                                    <td> <?php echo $red->numero_nivel_1 ?> </td>
                                                    <td> <?php echo $red->nivel ?> </td>
                                                    <td> 
                                                        <?php
                                                        if ($red->estado  === 'Suspendido')
                                                        {
                                                            $ima = base_url(DIR_FRONTEND_IMG_PAGE) . '/inactive.png';
                                                            $titleIma = 'Usuario Inactivo';
                                                        }
                                                        else if ($red->estado  === 'Activo')
                                                        {
                                                            $ima = base_url(DIR_FRONTEND_IMG_PAGE) . '/active.png';
                                                            $titleIma = 'Usuario Activo';
                                                        }
                                                        ?>
                                                        <img src="<?php echo $ima ?>" class="img-circle" width="25px" title="<?php echo $titleIma ?>" style="padding-top: 10px"></td>
                                                    <td> <?php echo $red->membresia ?></td>
                                                </tr>
                                                <?php
                                            endforeach;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/datatables/dataTables.bootstrap.js" type="text/javascript"></script>