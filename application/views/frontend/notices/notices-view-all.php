<div class="main">
    <div class="main-inner">
        <div class="container">
            <a href="<?php echo base_url('add-miembro') . "/" . $this->session->userdata('Usuario') ?>" class="btn btn-success" target="_blank"><i class="fa fa-user-plus"></i> Agregar Socio</a>
            <br><br>
            <div class="row">
                <div class="span12">
                    <div class="widget widget-nopad">
                        <div class="holder"></div>

                        <div class="widget-content">
                            <ul class="news-items">
                                <div id="itemContainer">
                                <?php
                                if (!$notices_all)
                                {
                                    
                                }
                                else
                                {
                                    $i = 1;
                                    foreach ($notices_all as $n)
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
                                                    if ($date->format("d") === date("d"))
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
                            </ul>
                            
</div>
                                <div class="holder"></div>
                        </div>
                        <!-- /widget-content --> 

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url(DIR_FRONTEND_JS) . '/jpage/jPages.min.js'; ?>"></script>
    <script type="text/javascript">
        $(function () {

            $("div.holder").jPages({
                containerID: "itemContainer",
                previous: "←",
                next: "→",
                perPage: 10,
                midRange: 3,
                direction: "random",
                animation: "fadeIn"
            });
        });
    </script>

