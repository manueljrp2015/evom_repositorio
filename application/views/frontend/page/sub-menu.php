<div class="subnavbar">
    <?php
    $ci = &get_instance();
    $ci->load->model("frontend/parametros/parametrosmodel");
    $fa = $ci->parametrosmodel->getKitsActive();
    ?>
    <div class="subnavbar-inner">
        <div class="container">
            <ul class="mainnav">
                <li>
                    <a href="javascript: void(0);">
                        <?php
                        if ($this->session->userdata('estado') === '0')
                        {
                            $ima = base_url(DIR_FRONTEND_IMG_PAGE) . '/inactive.png';
                            $titleIma = 'Usuario Inactivo';
                        }
                        else if ($this->session->userdata('estado') === '1')
                        {
                            $ima = base_url(DIR_FRONTEND_IMG_PAGE) . '/active.png';
                            $titleIma = 'Usuario Activo';
                        }
                        ?>
                        <img src="<?php echo $ima ?>" class="img-circle" width="40px" title="<?php echo $titleIma ?>" style="padding-top: 10px">
                    </a>	    				
                </li>
                <li>
                    <a href="<?php echo base_url('ini-panel') ?>">
                        <i class="fa fa-home"></i>
                        <span>Home</span>
                    </a>	    				
                </li>
                <li>
                    <a href="<?php echo base_url('noticias') ?>">
                        <i class="fa fa-newspaper-o"></i>
                        <span>Noticias </span>
                    </a>	    				
                </li>
                <li class="dropdown">
                    <a href="javascript: void(0)" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-users"></i>
                        <span>Redes</span>
                    </a>  
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('red-view') ?>">Red de Socios</a></li>
                        <li><a href="<?php echo base_url('analisis-red-view') ?>">Plan de Compensación</a></li>
                    </ul>                     
                </li>

                <li class="dropdown">
                    <a href="javascript: void(0)" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-suitcase"></i>
                        <span>Kits Evom</span>
                    </a> 

                    <ul class="dropdown-menu">
                        <?php
                        foreach ($fa as $g):
                            ?>
                        <li><a href="<?php echo base_url('get-kit')."?exec=".  base64_encode($g->id.":".$g->_title) ?>"><?php echo $g->_title ?></a></li>
                            <?php
                        endforeach;
                        ?>
                    </ul> 
                </li>
                <li class="dropdown">
                    <a href="<?php echo base_url('mis-kits') ?>" >
                        <i class="fa fa-cart-arrow-down"></i>
                        <span>Paquetes Adquiridos</span>
                    </a>

                </li>
            </ul>
        </div>
    </div>
</div>