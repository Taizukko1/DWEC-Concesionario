<?php
echo form_open(); ?>
<h2>Editar Usuario</h2>
<table class="table">
    <tr>
        <th>DNI</th>
        <th>Nombre</th>
        <th>Apellido 1</th>
        <th>Apellido 2</th>
    </tr>

    <tr>
        <td>
            <?php echo form_input('dni', $edited->dni, ['class' => "form-control", "placeholder" => "DNI"]); ?>
        </td>

        <td>
            <?php echo form_input('nombre', $edited->nombre, ['class' => "form-control", "placeholder" => "Nombre"]); ?>
        </td>

        <td>
            <?php echo form_input('ap1', $edited->ap1, ['class' => "form-control", "placeholder" => "Apellido 1"]); ?>
        </td>

        <td>
            <?php echo form_input('ap2', $edited->ap2, ['class' => "form-control", "placeholder" => "Apellido 2"]); ?>
        </td>
    </tr>
    <tr>
        <th>Email</th>
        <th>Telefono</th>
        <th>Tipo</th>
        <th><?php echo $edited->attr; ?></th>
    </tr>
    <tr>
        <td>
            <?php echo form_input('email', $edited->email, ['class' => "form-control", "placeholder" => "user@mail.com"]); ?>
        </td>

        <td>
            <?php echo form_input('telefono', $edited->telefono, ['class' => "form-control", "placeholder" => "Telefono"]); ?>
        </td>

        <td>
            <?php echo form_dropdown('tipo', ['admin' => "admin", 'cliente' => 'cliente', 'vendedor' => 'vendedor'], $edited->tipo, ['class' => "form-control"]); ?>
        </td>

        <td>
            <?php echo form_input($edited->attr, $edited->value, ["class" => "form-control"]); ?>
        </td>
    </tr>
</table>
<?php
echo form_submit('updateuser', 'Actualizar', ["class" => "btn btn-primary"]);
echo form_close();
if (isset($form)) {
    echo var_dump($form);
}
if (isset($err)) {
    echo '<p style="color:red;">' . $err . '</p>';
} ?>