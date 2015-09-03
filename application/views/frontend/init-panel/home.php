<link href="<?php echo base_url(DIR_FRONTEND_CSS) ?>/stylesheets/morris.css" media="all" rel="stylesheet" type="text/css" />
<div class="main">
    <div class="main-inner">
        <div class="container">
            <a href="<?php echo base_url('add-miembro') . "/" . $this->session->userdata('Usuario') ?>" class="btn btn-success" target="_blank"><i class="fa fa-user-plus"></i> Agregar Socio</a>
            <br><br>
            <div class="row">
                <div class="span7">
                    <div class="widget widget-nopad">
                        <div class="widget-header"> <i class="icon-list-alt"></i>
                            <h3> Sumario</h3>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">
                            <div class="widget big-stats-container">
                                <div class="widget-content">
                                    <h6 class="bigstats">link de Invitación compartelo <a href="<?php echo base_url('add-miembro') . "/" . $this->session->userdata('Usuario') ?>" target="_blank"><?php echo base_url('add-miembro') . "/" . $this->session->userdata('Usuario') ?></a></h6>
                                    <?php
                                    foreach ($redAnalisis as $red):
                                        foreach ($factores as $factor):
                                            ?>
                                            <div id="big_stats" class="cf">
                                                <div class="stat"> <i class="fa fa-users"></i> <span class="value"><?php
                                                        echo $red->numero_nivel_1 +
                                                        $red->numero_nivel_2 +
                                                        $red->numero_nivel_3 +
                                                        $red->numero_nivel_4 +
                                                        $red->numero_nivel_5 +
                                                        $red->numero_nivel_6 +
                                                        $red->numero_nivel_7
                                                        ?></span> </div>
                                                <div class="stat"> <i class="fa fa-money"></i> <span class="value"><?php
                                                        $n1 = $factor->aporte * $red->numero_nivel_1 * ($factor->nivel1 / 100);
                                                        $n2 = $factor->aporte * $red->numero_nivel_2 * ($factor->nivel2 / 100);
                                                        $n3 = $factor->aporte * $red->numero_nivel_3 * ($factor->nivel3 / 100);
                                                        $n4 = $factor->aporte * $red->numero_nivel_4 * ($factor->nivel4 / 100);
                                                        $n5 = $factor->aporte * $red->numero_nivel_5 * ($factor->nivel5 / 100);
                                                        $n6 = $factor->aporte * ($red->numero_nivel_6 + $red->numero_nivel_7) * ($factor->nivel6 / 100);
                                                        echo number_format($n1 + $n2 + $n3 + $n4 + $n5 + $n6, 2, ',', '.');
                                                        ?></span> </div>
                                            </div>
                                            <?php
                                        endforeach;
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>
                <div class="span5">
                    <div class="widget ">
                        <div class="widget-header"> <i class="icon-share-alt "></i>
                            <h3>Tu Código QR</h3>
                        </div>
                        <div class="widget-content">
                            <div class="shortcuts"> 

                                <?php
                                echo '<img src="' . base_url(DIR_FRONTEND_IMG) . '/qrcode/qrcode_' . $this->session->userdata("Usuario") . '.png" class="img-responsive"/>';
                                ?>
                                <div class="alert alert-success">Con tu teléfono inteligente escanea tu código QR asociado y podrás registrar socios, o si lo prefieres guárdalo y compártelo en las redes sociales.</div>
                            </div>
                        </div>
                    </div>

                    <!-- /widget --> 
                </div>
                <!-- /span6 -->
                <div class="span6">
                    <div class="widget">
                        <div class="widget-header"> <i class="icon-bar-chart "></i>
                            <h3> Grafica De  Socios</h3>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">
                            <div id="container" style="min-width: auto; height: 300px; margin: 0 auto"></div>
                            <!-- /area-chart --> 
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="widget widget-nopad">
                        <div class="widget-header"> <i class="icon-list-alt"></i>
                            <h3> Noticias</h3>
                        </div>
                        <!-- /widget-header -->

                        <div class="widget-content">
                            <ul class="news-items">
                                <?php
                                if (!$noticias)
                                {
                                    
                                }
                                else
                                {
                                    $i = 1;
                                    foreach ($noticias as $n)
                                    {
                                        ?>
                                        <li>

                                            <div class="news-item-date"> 
                                                <?php
                                                $date = new DateTime($n->_date_create);
                                                ?>
                                                <span class="news-item-day"><?php echo $date->format("d") ?></span> 
                                                <span class="news-item-month"><?php echo $date->format("M") ?></span> 
                                            </div>
                                            <div class="news-item-detail"> 
                                                <?php 
                                                if($date->format("d") === date("d"))
                                                {
                                                ?>
                                                <p><span  class="label label-success">Articulo Reciente</span ></p>
                                                <?php
                                                }
                                                else
                                                {
                                                    
                                                }
                                                ?>
                                                <h3><?php echo $n->_title ?></h3>
                                                <p class="news-item-preview"> <?php echo $n->_notice ?> </p>
                                            </div>

                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                                        <li>
                                            <a href="<?php echo base_url("noticias") ?>" class="news-item-title">Ver todas las noticias</a>
                                        </li>
                            </ul>
                        </div>
                        <!-- /widget-content --> 

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
	$(function () {

	    $('#container').highcharts({
		chart: {type: 'column'},
		title: {text: 'Socios de su red', x: -20},
		credits: {enabled: false},
		subtitle: {text: 'Recurso: Evom', x: -20},
		xAxis: {categories: ['Nivel 1', 'Nivel 2', 'Nivel 3', 'Nivel 4', 'Nivel 5', 'Nivel 6']},
		yAxis: {
		    min: 0,
		    title: {
			text: 'Total de socios'
		    },
		    stackLabels: {
			enabled: true,
			style: {
			    fontWeight: 'bold',
			    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
			}
		    }
		}, tooltip: {valueSuffix: ''},
		plotOptions: {
		    series: {
			colorByPoint: true
		    },
		    column: {
			stacking: 'normal',
			dataLabels: {
			    enabled: false,
			    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
			    style: {
				textShadow: '0 0 3px black, 0 0 3px black'
			    }
			}
		    }
		}, series: [{name: 'Socios', data: [<?php
                                foreach ($redAnalisis as $chart)
                                {
                                    echo $chart->numero_nivel_1 . ',' . $chart->numero_nivel_2 . ',' . $chart->numero_nivel_3 . ',' . $chart->numero_nivel_4 . ',' . $chart->numero_nivel_5 . ',' . ($chart->numero_nivel_6) . '';
                                }
                                ?>]}]});
	});
    </script><!-- /Calendar -->
    <script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/highchart/highcharts.js"></script>
    <script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/highchart/modules/exporting.js"></script>
