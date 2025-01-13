<?php

use App\Models\ModeloImagenes;
use App\Models\ModeloVentas;

$modeloImagenes = new ModeloImagenes();
$modeloVentas = new ModeloVentas();

?>
<h2>
    Unidades
</h2>

<table class="table">
    <thead>
        <th>
            Unidad
        </th>

        <th>
            Imagen
        </th>

        <th>
            KMs
        </th>

        <th>
            Precio
        </th>

        <th colspan="2">
            Accion
        </th>
    </thead>
    <tbody>
        <?php foreach ($unidades as $unidad) { ?>
            <tr class="<?php echo $modeloVentas->enVenta($unidad->matricula) ? "" : "table-success"; ?>">
                <td>
                    <?php echo $unidad->matricula; ?>
                </td>

                <td>
                    <img width="120px" src="<?php echo base_url('img/') . $modeloImagenes->getImagenes($unidad->matricula)[0]->src ?>" alt="imagen de <?php echo $unidad->matricula; ?>">
                </td>

                <td>
                    <?php echo $unidad->kilometraje; ?>
                </td>

                <td>
                    <?php echo $unidad->precio; ?>€
                </td>


                <td><a href="<?php echo site_url('admin/Unidades/Actualizar/') . $unidad->matricula ?>"><i class="bi bi-pencil"></i> Editar</a></td>
                <td><a href="<?php echo site_url('admin/Unidades/Borrar/') . $unidad->matricula ?>"><i class="bi bi-x-circle-fill text-danger"></i> Eliminar</a></td>

            </tr>
        <?php } ?>
    </tbody>
</table>

<a href="<?php echo site_url('admin/Unidades/Add'); ?>"><i class="bi bi-plus-circle-fill"></i> Nueva Unidad</a>