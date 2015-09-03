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
                    text: 'Total de Militantes por Municipio'
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
                text: 'Militantes por Municipio'
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
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function() {
                                var mystr = this.name;
                                var myarr = mystr.split(":");
                                graphParrq(myarr[0]);
                            }
                        }
                    }
                }
            },
            series: [{
                    data: [<?php
foreach ($analisis_municipio as $amun):
    ?>
                        ['<?php echo $amun->codigo_municipio . ':' . $amun->municipio ?>',<?php echo $amun->total_estado ?>],
<?php endforeach; ?>],
                    connectEnds: true
                }],
            exporting: {
                filename: 'resultados'
            }
        });

    });</script>
<div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

