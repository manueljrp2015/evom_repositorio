<!DOCTYPE html>
<?php
foreach ($infoHeader as $header):
    ?>
<html lang="<?php echo $header->meta_lang ?>">
    <head>
        <meta charset="<?php echo $header->meta_charset ?>">
        <title><?php echo $header->title ?></title>
        <meta name="author" content="MR Developer & Pixelbites">
        <meta name="application-name" content="<?php echo $header->meta_application_name ?>">
        <meta name="description" content="<?php echo $header->meta_description ?>">
        <meta name="keywords" content="<?php echo $header->meta_keywords ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
            <?php
        endforeach;
        ?>
        <meta name="apple-mobile-web-app-capable" content="yes"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" type="text/css" rel="stylesheet">
        <script src="<?php echo base_url(DIR_ADMIN_JS) ?>/jquery.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url(DIR_ADMIN_JS); ?>/bootstrap/bootstrap.js"></script>
        <link href="<?php echo base_url(DIR_ADMIN_CSS); ?>/style/bootstrap.min.css" type="text/css" rel="stylesheet">
        <link href="<?php echo base_url(DIR_ADMIN_CSS); ?>/style/property.css" type="text/css" rel="stylesheet"> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(DIR_ADMIN_CSS) ?>/AdminLTE.css" media="screen" >
        <script type="text/javascript" src="<?php echo base_url(DIR_ADMIN_JS); ?>/jqueryvalidate/validar_caracteres.js"></script>
        <link href="<?php echo base_url(DIR_FRONTEND_IMG_PAGE); ?>/favicon.ico" type="image/x-icon" rel="shortcut icon"/>
        <script src="<?php echo base_url(DIR_ADMIN_JS) ?>/jqueryvalidate/jquery.validate.js" type="text/javascript"></script>
        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" media="screen" >
    </head>
<body>