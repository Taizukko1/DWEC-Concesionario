<h2 class="text-center">Registro</h2>
<?php
$values = ['dni'=>"", 'nombre'=>"", 'ap1'=>"", 'ap2'=>"", 'email'=>"", 'telefono'=>""]; 
if(isset($form)) {
$values = $form;
}
echo form_open(); ?>

<table class="w-75 mx-auto">
    <tr>
        <th>DNI</th>
        <td><?php echo form_input('dni', $values['dni'], ["placeholder" => "DNI", "class" => "form-input"]) ?></td>

        <th>Nombre</th>
        <td><?php echo form_input('nombre', $values['nombre'], ["placeholder" => "Nombre", "class" => "form-input"]) ?></td>
    </tr>
    <tr>
        <th>Apellido 1</th>
        <td><?php echo form_input('ap1', $values['ap1'], ["placeholder" => "Apellido 1", "class" => "form-input"]) ?></td>


        <th>Apellido 2</th>
        <td><?php echo form_input('ap2', $values['ap2'], ["placeholder" => "Apellido 2", "class" => "form-input"]) ?></td>
    </tr>

    <tr>
        <th>Email</th>
        <td><?php echo form_input('email',$values['email'], ["placeholder" => "user@mail.com", "class" => "form-input", "type" => "email"]); ?></td>

        <th>Telefono</th>
        <td><?php echo form_input('telefono',$values['telefono'], ["placeholder" => "Telefono", "class" => "form-input"]); ?></td>
    </tr>

    <tr>
        <th>Contraseña</th>
        <td><?php echo form_password('pass', '', ["placeholder" => "Contraseña", "class" => "form-input"]); ?></td>
    </tr>
</table>

<?php
echo form_submit('signup', 'Registrarse', ["class" => "submit mx-auto"]);
echo form_close();

if (isset($err)) { ?>
    <div class="alert alert-warning">
        <p><?php echo $err; ?></p>
    </div>
<?php } ?>