<script src="<?php echo base_url() ?>assets/js/admin/highcharts.js"></script>
<script src="<?php echo base_url() ?>assets/js/admin/modules/exporting.js"></script>
<script src="<?php echo base_url() ?>assets/js/admin/modules/data.js"></script>
<script src="<?php echo base_url() ?>assets/js/admin/modules/drilldown.js"></script>
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
                    text: 'Total de Registrados por Mes'
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
                text: 'Registrados'
            },
            subtitle: {
                text: 'Recurso: Evom'
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
                    data: [],
                    connectEnds: true
                }],
            exporting: {
                filename: 'resultados'
            }
        });

    });</script>
<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading bg-green-gradient" id="enfasis">Resumen Finanzas</div>
        <div class="panel-body">
            <div id="container_pie" ></div>
        </div>
    </div>
</div>

<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading bg-green-gradient" id="enfasis">Analisis de Registrados</div>
        <div class="panel-body" id="graph_municipio">
            <div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
    </div>
</div>

