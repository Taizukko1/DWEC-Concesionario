<?php

use App\Models\ModeloImagenes;
$modeloImagenes = new ModeloImagenes();
?>
<h2>
    Unidades Rebajables
</h2>
<?php echo form_open();?>
<table class="table">
    <thead>
        <th>
            Seleccionar
        </th>

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
    </thead>
    <tbody>
        <?php foreach ($disponibles as $disponible) { ?>
            <tr>
                <td>
                    <input type="checkbox" value="<?php echo $disponible->matricula; ?>" name="matriculas[]">
                </td>

                <td>
                    <?php echo $disponible->matricula; ?>
                </td>

                <td>
                    <img width="120px" src="<?php echo base_url('img/') . $modeloImagenes->getImagenes($disponible->matricula)[0]->src ?>" alt="imagen de <?php echo $disponible->matricula; ?>">
                </td>

                <td>
                    <?php echo $disponible->kilometraje; ?>
                </td>

                <td>
                <?php echo $disponible->precio; ?>€
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<input type="number" name="descuento">
<span>%</span>
<input class="btn btn-info" type="submit" name="rebajar" value="REBAJAR">

<?php echo form_close();?>
