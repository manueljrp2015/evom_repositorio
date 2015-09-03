<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span8">
                    <div class="widget">
                        <div class="widget-header"> <i class="icon-money"></i>
                            <h3> Unilevel</h3>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">
                            <div class="widget big-stats-container">
                                <div class="widget-content">
                                    <h6 class="bigstats">Socios por niveles</h6>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th> Niveles</th>
                                                <th> T. Socios</th>
                                                <th> Ganacia</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($redAnalisis as $red):
                                                foreach ($factores as $factor):
                                                    ?>
                                                    <tr>
                                                        <td align="center">Nivel 1 (<?php echo $factor->nivel1 ?>%)</td>
                                                        <td> <?php echo $red->numero_nivel_1 ?> </td>
                                                        <td> <?php echo number_format($factor->aporte * $red->numero_nivel_1 * ($factor->nivel1 / 100), 2, ',', '.'); ?></td>

                                                    </tr>
                                                    <tr>
                                                        <td align="center">Nivel 2 (<?php echo $factor->nivel2 ?>%)</td>
                                                        <td> <?php echo $red->numero_nivel_2 ?> </td>
                                                        <td> <?php echo number_format($factor->aporte * $red->numero_nivel_2 * ($factor->nivel2 / 100), 2, ',', '.'); ?></td>

                                                    </tr>
                                                    <tr>
                                                        <td align="center">Nivel 3 (<?php echo $factor->nivel3 ?>%)</td>
                                                        <td> <?php echo $red->numero_nivel_3 ?> </td>
                                                        <td> <?php echo number_format($factor->aporte * $red->numero_nivel_3 * ($factor->nivel3 / 100), 2, ',', '.'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center">Nivel 4 (<?php echo $factor->nivel4 ?>%)</td>
                                                        <td> <?php echo $red->numero_nivel_4 ?> </td>
                                                        <td> <?php echo number_format($factor->aporte * $red->numero_nivel_4 * ($factor->nivel4 / 100), 2, ',', '.'); ?></td>

                                                    </tr>
                                                    <tr align="center">
                                                        <td align="center">Nivel 5 (<?php echo $factor->nivel5 ?>%)</td>
                                                        <td> <?php echo $red->numero_nivel_5 ?> </td>
                                                        <td> <?php echo number_format($factor->aporte * $red->numero_nivel_5 * ($factor->nivel5 / 100), 2, ',', '.'); ?></td>

                                                    </tr>
                                                    <tr align="center">
                                                        <td align="center">Nivel 6 (<?php echo $factor->nivel6 ?>%)</td>
                                                        <td > <?php echo ($red->numero_nivel_6) ?> </td>
                                                        <td> <?php echo number_format($factor->aporte * ($red->numero_nivel_6) * ($factor->nivel6 / 100), 2, ',', '.'); ?></td>                                                     
                                                    </tr>
                                                    <tr>
                                                        <td><div id="big_stats" class="cf"><div class="stat"><span class="value">Socios:</span></div></div></td></td>
                                                        <td><div id="big_stats" class="cf"><div class="stat"><span class="value"><?php
                                                                        echo $red->numero_nivel_1 +
                                                                        $red->numero_nivel_2 +
                                                                        $red->numero_nivel_3 +
                                                                        $red->numero_nivel_4 +
                                                                        $red->numero_nivel_5 +
                                                                        $red->numero_nivel_6
                                                                        ?></span></div></div></td></td>

                                                        <td><div id="big_stats" class="cf"><div class="stat"><span class="value"><?php
                                                                        $n1 = $factor->aporte * $red->numero_nivel_1 * ($factor->nivel1 / 100);
                                                                        $n2 = $factor->aporte * $red->numero_nivel_2 * ($factor->nivel2 / 100);
                                                                        $n3 = $factor->aporte * $red->numero_nivel_3 * ($factor->nivel3 / 100);
                                                                        $n4 = $factor->aporte * $red->numero_nivel_4 * ($factor->nivel4 / 100);
                                                                        $n5 = $factor->aporte * $red->numero_nivel_5 * ($factor->nivel5 / 100);
                                                                        $n6 = $factor->aporte * ($red->numero_nivel_6) * ($factor->nivel6 / 100);
                                                                        echo number_format($n1 + $n2 + $n3 + $n4 + $n5 + $n6, 2, ',', '.');
                                                                        $t = $n1 + $n2 + $n3 + $n4 + $n5 + $n6;
                                                                        ?></span></div></div></td>
                                                    </tr>
                                                    <?php
                                                endforeach;
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="span4">
                    <div class="widget ">
                        <div class="widget-header"> <i class="icon-money "></i>
                            <h3>Bono Inicio</h3>
                        </div>
                        <div class="widget-content">
                            <table class="table table-condensed table-striped">
                                <thead>
                                    <tr>
                                        <?php
                                        foreach ($balanceBonosInicio as $boni):
                                            ?>
                                            <td><div id="big_stats" class="cf"><div class="stat"><span class="value"><?php echo $boni->total_bonos ?></span></div></div></td>
                                            <td><div id="big_stats" class="cf"><div class="stat"><span class="value"><?php echo number_format($boni->bono_ini, 2, ",", ".") ?></span></div></div></td>
                                            <?php
                                        endforeach;
                                        ?>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="span4">
                    <div class="widget ">
                        <div class="widget-header"> <i class="icon-money "></i>
                            <?php
                            foreach ($balanceAutoConsumo as $ac):
                                ?>
                                <h3>Auto Consumo del periodo <?php echo $ac->periodo ?></h3>
                            </div>
                            <div class="widget-content">
                                <table class="table table-condensed table-striped">
                                    <thead>
                                        <tr>

                                            <td><div ><div class="stat"><span class="value"></span></div></div></td>
                                            <td><div id="big_stats" class="cf"><div class="stat"><span class="value"><?php echo number_format($ac->auto_consumo, 2, ",", ".") ?></span></div></div></td>
                                            <?php
                                        endforeach;
                                        ?>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="span4">
                    <div class="widget ">
                        <div class="widget-header"> <i class="icon-money "></i>
                            <h3>Total</h3>
                        </div>
                        <div class="widget-content">
                            <table class="table table-condensed table-striped">
                                <thead>
                                    <tr>
                                        <?php
                                        foreach ($balanceAutoConsumo as $ac):
                                            foreach ($balanceBonosInicio as $boni):
                                                ?>
                                                <td><div id="big_stats" class="cf"><div class="stat"><span class="value"><?php echo number_format($t + $boni->bono_ini+$ac->auto_consumo, 2, ",", ".") ?></span></div></div></td>
                                                            <?php
                                                        endforeach;
                                                    endforeach;
                                                    ?>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
