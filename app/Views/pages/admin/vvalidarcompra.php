<h2>
    Ventas En Espera
</h2>
<table class="table">
    <thead>
        <th>
            Id
        </th>

        <th>
            Modelo
        </th>

        <th>
            Precio
        </th>

        <th>
            Cliente
        </th>

        <th>
            Fecha Peticion
        </th>

        <th>
            Accion
        </th>
    </thead>
    <tbody>
        <?php foreach ($ventas as $venta) { ?>
            <tr>

                <td>
                    <?php echo $venta->id_venta; ?>
                </td>

                <td>
                    <?php echo $venta->unidad->modelo->marca . " " . $venta->unidad->modelo->modelo . " " . $venta->unidad->modelo->anio_fabricacion; ?>
                </td>

                <td>
                    <?php echo $venta->unidad->precio; ?>€
                </td>

                <td>
                    <?php echo $venta->cliente->nombre . " " . $venta->cliente->ap1 . " " . $venta->cliente->ap2; ?>
                </td>

                <td>
                    <?php echo $venta->fecha_venta; ?>
                </td>

                <td>
                    <a href="<?php echo site_url("admin/Ventas/Aceptar/$venta->id_venta") ?>"><i class="bi bi-check-circle-fill text-success"></i></a>
                    <a href="<?php echo site_url("admin/Ventas/Cancelar/$venta->id_venta") ?>"><i class="bi bi-x-circle-fill text-danger"></i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php if (isset($err)) { ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $err; ?>
    </div>
<?php } ?>

<?php if (isset($aceptar)) { ?>
    <div class="alert alert-success" role="alert">
        <?php echo $aceptar; ?>
    </div>
<?php } ?>

<?php if (isset($cancelar)) { ?>
    <div class="alert alert-warning" role="alert">
        <?php echo $cancelar; ?>
    </div>
<?php } ?>