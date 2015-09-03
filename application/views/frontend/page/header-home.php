<!DOCTYPE html>
<html>
    <?php
    if (isset($datosSponsor))
    {
        foreach ($datosSponsor as $v)
        {
            $nombre = $v->nombre;
            $apellido = $v->apellido;
            $cedulaSponsor = $v->identificacion;
            $usr = $v->login;
            $emailSponsor = $v->email;
        }
        $title = TITULO_PAGE;
        $description = strtoupper($nombre) . " " . strtoupper($apellido) . " (" . strtoupper($usr) . ") te invita a ser miembro de evom la tierra sin limites.";
        $ima = base_url(DIR_FRONTEND_IMG_PAGE) . "/logo-facebook.jpg";
        $link = base_url('add-miembro') . "/" . $usr;
    }
    else
    {

        $title = TITULO_PAGE;
        $description = "Se miembro de evom la tierra sin limites.";
        $ima = base_url(DIR_FRONTEND_IMG_PAGE) . "/logo-facebook.jpg";
        $link = base_url();
    }
    ?>
    <head>
        <meta charset="UTF-8">
        <title>.: Evom :.</title>
        <meta property="og:locale" content="es_ES" />
        <meta property="og:title" content="<?php echo $title ?>" />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="<?php echo $link ?>" />
        <meta property="og:image" content="<?php echo $ima ?>" />
        <meta property="og:description" content="<?php echo $description ?>" />


        <meta itemprop="name" content="<?php echo $title ?>">
        <meta itemprop="description" content="<?php echo $description ?>">
        <meta itemprop="image" content="<?php echo $ima ?>">

        <meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="@publisher_handle">
        <meta name="twitter:title" content="<?php echo $title ?>">
        <meta name="twitter:description" content="<?php echo $description ?>">
        <meta name="twitter:creator" content="@manueljrp">
        <meta name="twitter:image" content="<?php echo $ima ?>">

        <meta name="author" content="MR Developer & Pixelbites">
        <meta name="application-name" content="Evom">
        <meta name="description" content="Darle una opcion a nuestros usuarios, una oportunidad de tener ingresos extra. Va dirigido a todas ésas personas que desean solventar su situacion economica y quieren mejorarla, en esta empresa todos tienen oportunidades y la empresa los ayudara a que tengan todo para lograrlo.">
        <meta name="keywords" content="redes, clientes, multinivel, oportunidad, ingresos, economia, logros">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
        <meta name="apple-mobile-web-app-capable" content="yes"> 
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/favicon-16x16.png">
        <link rel="manifest" href="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo base_url(DIR_FRONTEND_IMG_PAGE) ?>/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" media="all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(DIR_FRONTEND_CSS) ?>/stylesheets/jquery.mCustomScrollbar.css" media="all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(DIR_FRONTEND_CSS) ?>/stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(DIR_FRONTEND_CSS) ?>/stylesheets/bootstrap-responsive.min.css" media="all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(DIR_FRONTEND_CSS) ?>/stylesheets/font-awesome.css" media="all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(DIR_FRONTEND_CSS) ?>/stylesheets/style.css" media="all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(DIR_FRONTEND_CSS) ?>/stylesheets/dashboard.css" media="all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(DIR_FRONTEND_CSS) ?>/stylesheets/signin.css" media="all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(DIR_FRONTEND_CSS) ?>/stylesheets/datatables/dataTables.bootstrap.css" media="all" rel="stylesheet" type="text/css" />
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
            <?php
        $ci = &get_instance();
        $ci->load->library('minify');
        $ci->minify->css(array(
            '/stylesheets/morris.css'));
        echo $ci->minify->deploy_css(TRUE);
        ?>
        <?php
        $ci->minify->js(array(
            'superjs.js',
            'superphp.js',
            'signin.js',
            '/javascripts/morris.min.js',
            '/javascripts/raphael.min.js'));
        echo $ci->minify->deploy_js();
        ?>
        <script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/chart.min.js"></script>
        <script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/excanvas.min.js"></script>

        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" media="screen" >
    </head>
    <body>