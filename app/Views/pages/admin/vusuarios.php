<table class="table">
    <tr>
        <td class="table-warning">
            Admin
        </td>

        <td class="table-info">
            Vendedor
        </td>

        <td>
            Cliente
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
                    <td><a href="#"><i class="bi bi-x-circle-fill tex-danger"></i></a></td>
                    <td><a href="#"><i class="bi bi-pencil"></i></a></td>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
</table>
<a href="<?php echo site_url('admin/Usuarios/Add')?>"><i class="bi bi-plus-circle-fill"></i></a>