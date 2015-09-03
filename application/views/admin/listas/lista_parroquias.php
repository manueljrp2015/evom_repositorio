<table class="table table-bordered">
    <tr>
        <td>#Parroquia</td>
        <td>#Militantes</td>
    </tr>
    <?php
foreach ($lista as $list):
?>
    <tr>
        <td><?php echo $list->parroquia ?></td>
        <td><?php echo $list->total_estado ?></td>
    </tr>
    <?php endforeach; ?>
</table>


