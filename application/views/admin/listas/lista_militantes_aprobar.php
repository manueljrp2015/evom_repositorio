<table class="table table-bordered">
    <tr>
        <td>#Nacionalidad</td>
        <td>#Cedula</td>
        <td>#Nombre</td>
        <td>#Apellido</td>
        <td>#Celular</td>
        <td>#Email</td>
        <td>#Procedencia</td>
        <td>#</td>
    </tr>
    <?php
    if ($datalist == 'vacio')
    {
        echo '<div class="alert alert-warning" role="alert"><font size="4">no hay resultados que mostrar!</font></div>';
    }
    else
    {
        foreach ($datalist as $val):
            ?>
            <tr>
                <td><?php echo $val->nacionalidad ?></td>
                <td><?php echo $val->cedula ?></td>
                <td><?php echo $val->nombre_primario ?></td>
                <td><?php echo $val->apellido_primario ?></td>
                <td><?php echo $val->telefono_celular ?></td>
                <td><?php echo $val->email ?></td>
                <td><?php echo $val->estado . ' / ' . $val->municipio . ' / ' . $val->parroquia ?></td>
                <td><form><input type="hidden" value="<?php echo $val->cedula ?>" id="militante" name="militante"><input type="hidden" value="<?php echo $val->email ?>" id="email" name="email"><input type="button" value="aprobar" class="btn btn-danger btn-sm" onclick="aprobarMilitante(this.form.militante.value, this.form.email.value)"></form></td>
            </tr>
            <?php
        endforeach;
    }
    ?>
</table>
<?= $paginacion ?>
