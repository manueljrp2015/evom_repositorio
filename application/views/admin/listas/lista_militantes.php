<style>
    .td{

    }
</style>
<?= $paginacion ?>
<?php
if($datalist == 'vacio'){
    echo '<div class="alert alert-warning" role="alert"><font size="4">no hay resultados, o el militante no ha sido aprobado!</font></div>';
}
else{
foreach ($datalist as $val):
    ?>
    <table class="table table-bordered">
        <tr>
            <td id="enfasis">#Nacionalidad</td><td><b><?php echo $val->nacionalidad ?></b></td>
            <td id="enfasis">#Cedula</td><td><b><?php echo $val->cedula ?></b></td>
        </tr>
        <tr>
            <td id="enfasis">#Nombre</td><td><b><?php echo $val->nombre_primario ?></b></td>
            <td id="enfasis">#Segundo Nombre</td><td><b><?php echo $val->nombre_secundario ?></b></td>
        </tr>
        <tr>
            <td id="enfasis">#Apellido</td><td><b><?php echo $val->apellido_primario ?></b></td>
            <td id="enfasis">#Segundo Apellido</td><td><b><?php echo $val->apellido_secundario ?></b></td>
        </tr>
        <tr>
            <td id="enfasis">#Celular</td><td><b><?php echo $val->telefono_celular ?></b></td>
            <td id="enfasis">#Tel.: HAB</td><td><b><?php echo $val->telefono_residencia ?></b></td>
        </tr>
        <tr>
            <td id="enfasis">#Email</td><td><b><?php echo $val->email ?></b></td>
            <td id="enfasis">#Procedencia</td> <td><b><?php echo $val->estado . ' / ' . $val->municipio . ' / ' . $val->parroquia ?></b></td>
        </tr>
        <tr>
            <td id="enfasis">#Direccion 1</td><td><b><?php echo $val->direccion_1 ?></b></td>
            <td id="enfasis">#Direccion 2</td><td><b><?php echo $val->direccion_2 ?></b></td>
        </tr>
        <tr>
            <td><a href="<?php echo base_url() ?>admin/pdfcontroller/printmilitante?cedula=<?php echo $val->cedula ?>" target="_blank" class="btn-sm btn btn-success"><i class="icon-print"</i> Impimir</a></td>
        </tr>
    </table>
    <?php
endforeach;
}
?>



