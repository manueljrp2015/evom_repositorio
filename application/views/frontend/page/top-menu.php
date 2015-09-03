<div class="navbar navbar-fixed-top">
    <div class="navbar-inner bg-green-gradient">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="<?php echo base_url('ini-panel') ?>">
                <img src="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/logo.png" width="60px" height="80px">				
            </a>		
            <div class="nav-collapse">
                <ul class="nav pull-right">
                    <li class="dropdown">						
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <h3><i class="icon-cog"></i>
                            Configuraci&oacute;n
                            <b class="caret"></b></h3>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('config-pwd') ?>">Cambiar clave</a></li>
                        </ul>						
                    </li>
                    <li class="dropdown">						
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <h3><i class="icon-user"></i> 
                            <?php echo $this->session->userdata("Email") ?>
                                <b class="caret"></b></h3>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('profile') ?>">Perfil</a></li>
                            <li><a href="<?php echo base_url('frontend/initcontroller/close') ?>">Logout</a></li>
                        </ul>						
                    </li>
                </ul>
            </div><!--/.nav-collapse -->	
        </div> <!-- /container -->	
    </div> <!-- /navbar-inner -->
</div> <!-- /navbar -->