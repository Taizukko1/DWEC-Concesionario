<table class="table">
    <tr>
        <td class="table-warning">
            <a class="link-underline link-underline-opacity-0" href="<?php echo site_url('admin/Usuarios/Tipo/0') ?>">Admin</a>
        </td>

        <td class="table-info">
            <a class="link-underline link-underline-opacity-0" href="<?php echo site_url('admin/Usuarios/Tipo/1') ?>">Vendedor</a>
        </td>

        <td>
            <a class="link-underline link-underline-opacity-0" href="<?php echo site_url('admin/Usuarios/Tipo/2') ?>">Cliente</a>
        </td>
    </tr>
</table>
<table class="table">
    <thead>
        <th>
            id
        </th>

        <th>
            dni
        </th>

        <th>
            nombre
        </th>

        <th>
            email
        </th>

        <th>
            telefono
        </th>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario) {
            $bg_class = "";
            switch ($usuario->tipo) {
                case 'admin':
                    $bg_class = "table-warning";
                    break;
                case 'vendedor':
                    $bg_class = "table-info";
                    break;
            } ?>
            <tr class="<?php echo $bg_class; ?>">
                <td>
                    <?php echo $usuario->uid; ?>
                </td>

                <td>
                    <?php echo $usuario->dni; ?>
                </td>

                <td>
                    <?php echo "$usuario->nombre $usuario->ap1 $usuario->ap2"; ?>
                </td>

                <td>
                    <?php echo $usuario->email; ?>
                </td>

                <td>
                    <?php echo $usuario->telefono; ?>
                </td>

                <?php if ($usuario->tipo != 'admin') { ?>
                    <?php if ($usuario->tipo === 'vendedor') { ?>
                        <th>Ventas</th>
                        <td><?php echo $usuario->ventas; ?></td>
                    <?php } ?>
                    <?php if ($usuario->tipo === 'cliente') { ?>
                        <th>Gastado</th>
                        <td><?php echo $usuario->gastado; ?>€</td>
                    <?php } ?>
                    <td><a href="<?php echo site_url('admin/Usuarios/Actualizar/') . $usuario->uid?>"><i class="bi bi-pencil"></i> Editar</a></td>
                    <td><a href="<?php echo site_url('admin/Usuarios/Borrar/') . $usuario->uid?>"><i class="bi bi-x-circle-fill text-danger"></i> Eliminar</a></td>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
</table>
<a href="<?php echo site_url('admin/Usuarios/Add') ?>"><i class="bi bi-plus-circle-fill"></i> Nuevo Usuario</a>