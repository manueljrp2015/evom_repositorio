<table class="table table-bordered">
    <tr>
        <td>#Municipio</td>
        <td>#Militantes</td>
    </tr>
    <?php
foreach ($lista as $list):
?>
    <tr>
        <td><?php echo $list->municipio ?></td>
        <td><?php echo $list->total_estado ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="<?php echo base_url() ?>admin/pdfcontroller/printmunicipios?estado=<?php echo $estado ?>" target="_blank"><i class="icon-large icon-print"></i> Imprimir</a>
