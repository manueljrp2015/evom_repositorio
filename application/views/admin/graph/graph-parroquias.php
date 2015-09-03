<script>
    $(function() {

        var chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container2',
                type: 'column',
                margin: 75,
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -15,
                    align: 'right',
                    style: {
                        fontSize: '10px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total de Militantes por Parroquia'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: 'gray'
                    }
                }
            },
            legend: {
                enabled: false
            },
            title: {
                text: 'Militantes por Parroquias'
            },
            subtitle: {
                text: 'Recurso: VBR'
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    depth: 25
                },
                series: {
                    colorByPoint: true,
                }

            },
            series: [{
                    data: [<?php
foreach ($analisis_municipio as $amun):
    ?>
                        ['<?php echo $amun->parroquia ?>',<?php echo $amun->total_estado ?>],
<?php endforeach; ?>],
                    connectEnds: true
                }],
            exporting: {
                filename: 'resultados'
            }
        });

    });</script>
<div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

