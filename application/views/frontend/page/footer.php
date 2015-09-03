<link rel="stylesheet" type="text/css" href="<?php echo base_url(DIR_FRONTEND_JS) ?>/jqueryfancybox/jquery.fancybox.css?v=2.1.5" media="screen" >
<link rel="stylesheet" type="text/css" href="<?php echo base_url(DIR_FRONTEND_JS) ?>/jqueryfancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5" media="screen" >
<script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/jqueryfancybox/jquery.fancybox.js?v=2.1.5"  type="text/javascript" /></script>
<script src="<?php echo base_url(DIR_FRONTEND_JS) ?>/jqueryfancybox/helpers/jquery.fancybox-media.js?v=1.0.6" type="text/javascript"></script>
<script>
    $(function(){
        $('.fancybox-media')
                .attr('rel', 'media-gallery')
                .fancybox({
                    openEffect: 'none',
                    closeEffect: 'none',
                    prevEffect: 'none',
                    nextEffect: 'none',
                    arrows: false,
                    helpers: {
                        media: {},
                        buttons: {}
                    }
                });
    });
</script>
<div class="extra">
    <div class="extra-inner">
        <div class="container">
            <div class="row">
                <div class="span3">
                    <h4>
                        Soporte</h4>
                    <ul>
                        <li><a href="<?php echo base_url("preguntas-frecuentes") ?>">Preguntas Frecuentes</a></li>
                        <li><a class="fancybox-media" href="https://www.youtube.com/embed/DCy4rzg9DS4">Video Tutorial</a></li>
                        <li><a class="fancybox-media" href="https://www.youtube.com/embed/zID9tQIaN84">Que es evom?</a></li>
                    </ul>
                </div>
                <!-- /span3 -->
                <div class="span3">
                    <h4>
                        Aspecto Legal</h4>
                    <ul>
                        <li><a href="javascript:;">T&eacute;rminos de Uso</a></li>
                        <li><a href="javascript:;">Pol&iacute;tica de Privacidad</a></li>
                    </ul>
                </div>
            </div>
            <!-- /row --> 
        </div>
        <!-- /container --> 
    </div>
    <!-- /extra-inner --> 
</div>
<!-- /extra -->
<center>
    <div class="footer">
        <div class="footer-inner">
            <div class="container">
                <div class="row">
                    <div class="span12"> &copy; 2015 Evom C.A, Desarrollando Futuro.. </div>
                </div>
                <!-- /row --> 
            </div>
            <!-- /container --> 
        </div>
        <!-- /footer-inner --> 

    </div>
</center>

</body>
</html>