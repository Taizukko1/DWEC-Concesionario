<h2 class="text-center text-light">Registro</h2>
<?php echo form_open(); ?>

<table class="w-75 mx-auto">
    <tr>
        <th>DNI</th>
        <td><?php echo form_input('dni', '', ["placeholder" => "DNI", "class" => "form-input"]) ?></td>

        <th>Nombre</th>
        <td><?php echo form_input('nombre', '', ["placeholder" => "Nombre", "class" => "form-input"]) ?></td>
    </tr>
    <tr>
        <th>Apellido 1</th>
        <td><?php echo form_input('ap1', '', ["placeholder" => "Apellido 1", "class" => "form-input"]) ?></td>


        <th>Apellido 2</th>
        <td><?php echo form_input('ap2', '', ["placeholder" => "Apellido 2", "class" => "form-input"]) ?></td>
    </tr>

    <tr>
        <th>Email</th>
        <td><?php echo form_input('email', '', ["placeholder" => "user@mail.com", "class" => "form-input", "type" => "email"]); ?></td>

        <th>Telefono</th>
        <td><?php echo form_input('telefono', '', ["placeholder" => "Telefono", "class" => "form-input"]); ?></td>
    </tr>

    <tr>
        <th>Contraseña</th>
        <td><?php echo form_password('pass', '', ["placeholder" => "Contraseña", "class" => "form-input"]); ?></td>
    </tr>
</table>

<?php echo form_submit('signup', 'Registrarse', ["class" => "submit mx-auto"]); ?>

<?php echo form_close(); ?>