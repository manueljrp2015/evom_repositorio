<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <h2>Mis kits Evom Adquiridos</h2>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <td class="text-center">#</td>
                            <td class="text-center">Kits</td>
                            <td class="text-center">Status del Kit</td>
                            <td class="text-center">Link</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (!$my_kits) {
                                echo "<div class='alert alert-info'>Usted no ha adquirido ninguno de nuestros productos, le invitamos a que conozca nuestro stock de beneficios. </div>";
                        } else {
                            foreach ($my_kits as $myk) { ?>
                                <tr>
                                    <td><?= sprintf("%09d", $myk->id) ?></td>
                                    <td><?= $myk->_title ?></td>
                                    <td class="center"><?php
                                        switch ($myk->_status) {
                                            case 1:
                                                echo "<a href='#' class='btn btn-warning'> <i class='fa fa-car fa-2x' title='Pendiente Por Aprobación'></i>
</a>";
                                                break;
                                        }
                                        ?></td>
                                    <td><?php

                                        switch ($myk->_status) {
                                            case 1:
                                                echo "<a href='#' class='btn btn-danger' disabled='disabled'> <i class='fa fa-unlink '></i> Producto no disponible!
</a>";
                                                break;
                                            case 3:
                                                echo "<a href='#' class='btn btn-success'> <i class='fa fa-link'></i> Visitar mi producto
</a>";
                                                break;
                                        }

                                        ?></td>
                                </tr>
                            <?php }
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>