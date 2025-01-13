<table class="table">
    <thead>
        <th>
            id
        </th>

        <th>
            Unidad
        </th>

        <th>
            Cliente
        </th>

        <th>
            Vendedor
        </th>

        <th>
            Estado
        </th>

        <th>
            Fecha
        </th>
    </thead>

    <tbody>
        <?php foreach ($ventas as $venta) { ?>
            <tr class="<?php echo $venta->estado === 'cancelada' ? "table-danger" : ""; ?>">
                <td>
                    <?php echo $venta->id_venta; ?>
                </td>

                <td>
                    <?php echo $venta->matricula; ?>
                </td>

                <td>
                    <?php echo $venta->uid_cliente; ?>
                </td>

                <td>
                    <?php echo $venta->uid_vendedor; ?>
                </td>

                <td>
                    <?php echo $venta->estado; ?>
                </td>

                <td>
                    <?php echo $venta->fecha_venta; ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<a href="<?php echo site_url('admin/Ventas/Canceladas/Borrar');?>"><i class="bi bi-x-circle-fill text-danger"></i> Eliminar Canceladas</a>