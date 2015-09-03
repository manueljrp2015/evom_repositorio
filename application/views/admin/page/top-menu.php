<!-- Header -->
<div id="top-nav" class="navbar navbar-inverse navbar-static-top bg-green-gradient">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url() ?>admin">Panel de Control</a>
        </div>
        <div id="navbar-collapse-1" class="navbar-collapse collapse " style="vertical-align: middle">
            <ul class="nav navbar-nav">
                <!-- Classic list -->
                <li class="dropdown">
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url() ?>admin" data-toggle="dropdown" class="dropdown-toggle">Principal</a>
                        </li>
                    </ul>
                </li>
                <!-- Accordion demo -->
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle"> Consultas<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                        <li><a tabindex="-1" href="<?php echo base_url('admin/redes') ?>"><span class="fa fa-users fa-1x"></span> Redes</a></li>
                        <li><a tabindex="-1" href="<?php echo base_url('admin/view_redes') ?>"><span class="fa fa-user fa-1x"></span> Usuarios</a></li>
                    </ul>
                </li>
                 <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle"> Noticias<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                        <li><a tabindex="-1" href="<?php echo base_url('admin/notices') ?>"><span class="fa fa-newspaper-o fa-1x"></span> Ver Noticias</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle"> Kits Evom<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                        <li><a tabindex="-1" href="<?php echo base_url('admin/kits') ?>"><span class="fa fa-cogs fa-1x"></span> Crear Kits</a></li>
                    </ul>
                </li>
                <!-- Classic dropdown -->
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-gears"></i> Configuraci&oacute;n<b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a tabindex="-1" href="<?php echo base_url('admin/config-header') ?>"><i class="fa fa-gears"></i> Header </a></li>
                        <li><a tabindex="-1" href="<?php echo base_url('admin/config-footer') ?>"><i class="fa fa-gears"></i> Footer </a></li>
                        <li><a tabindex="-1" href="<?php echo base_url('admin/config-create-users') ?>"><i class="fa fa-gears"></i> Crear Usuarios Admin </a></li>
                    </ul>
                </li>

                <ul class="nav navbar-nav navbar-right">

                    <li><?php
                        if (!@$usuario)
                        {
                            
                        }
                        else
                        {
                            ?> <a href="<?php echo base_url(); ?>admin/home/close"> <i class="fa fa-lock"></i> <?php
                            echo @$usuario;
                        }
                        ?></a></li>
                </ul>
            </ul>
        </div>
    </div><!-- /container -->
</div>
<!-- /Header -->

<!-- Main -->
<div class="container">
    <div class="row">