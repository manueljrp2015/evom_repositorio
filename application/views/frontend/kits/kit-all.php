<link rel="stylesheet" type="text/css" href="<?php echo base_url(DIR_FRONTEND_CSS) ?>/stylesheets/plans.css"
      media="screen">
<div class="main-inner">

    <div class="container">

        <div class="row">

            <div class="span12">
                <center>
                    <div class="widget">
                        <?php
                        foreach ($kit_alls as $k):
                            ?>
                            <div class="pricing-plans plans-3">
                                <div class="plan-container">
                                    <div class="plan green">
                                        <div class="plan-header" style="background-color: <?php echo $k->_color ?>">

                                            <div class="plan-title">
                                                <?php echo $k->_title ?>
                                            </div>
                                            <!-- /plan-title -->

                                            <div class="plan-price" style="background-color: <?php echo $k->_color ?>">
                                                Bs. <?php echo number_format($k->_precio, 2, ",", ".") ?><span
                                                    class="term">Precio Incluye IVA</span>
                                            </div>
                                            <!-- /plan-price -->

                                        </div>
                                        <!-- /plan-header -->

                                        <div class="plan-features">
                                            <ul>
                                                <li><strong><?php echo $k->_descr ?></li>

                                            </ul>
                                        </div>
                                        <!-- /plan-features -->

                                        <div class="plan-actions">
                                            <?php
                                            foreach ($verify_kit as $v) {
                                                if ($k->id === $v->_producto) {
                                                    echo "<div class='alert alert-success'>Este kits ya ha sido adquirido por usted!. <a href='" . base_url('mis-kits') . "' class='btn btn-success'>Ver Mis Productos</a></a> </div>";
                                                } else {
                                                    ?>
                                                    <a href="<?php echo base_url('kit-pago') . "?qk=" . base64_encode($k->id . ":" . $k->_title . ":" . $k->_precio) ?>"
                                                       class="btn" disabled><i class="fa fa-cart-arrow-down fa-2x"></i>
                                                        Adquirir Ahora!</a>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        <!-- /plan-actions -->

                                    </div>
                                    <!-- /plan -->
                                </div>
                                <!-- /plan-container -->
                            </div>
                        <?php
                        endforeach;
                        ?>
                    </div>
                </center>
            </div>
        </div>
    </div>
