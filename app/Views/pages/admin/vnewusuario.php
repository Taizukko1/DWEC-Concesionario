<?php echo form_open(); ?>
<h2>Nuevo Usuario</h2>
<table class="table">
    <thead>
        <th>DNI</th>
        <th>Nombre</th>
        <th>Apellido 1</th>
        <th>Apellido 2</th>
        <th>Email</th>
        <th>Telefono</th>
        <th>Tipo</th>
    </thead>
    <tbody>
        <td>
            <?php echo form_input('dni', '', ['class' => "form-control", "placeholder" => "DNI"]); ?>
        </td>

        <td>
            <?php echo form_input('nombre', '', ['class' => "form-control", "placeholder" => "Nombre"]); ?>
        </td>

        <td>
            <?php echo form_input('ap1', '', ['class' => "form-control", "placeholder" => "Apellido 1"]); ?>
        </td>

        <td>
            <?php echo form_input('ap2', '', ['class' => "form-control", "placeholder" => "Apellido 2"]); ?>
        </td>

        <td>
            <?php echo form_input('email', '', ['class' => "form-control", "placeholder" => "user@mail.com"]); ?>
        </td>

        <td>
            <?php echo form_input('telefono', '', ['class' => "form-control", "placeholder" => "Telefono"]); ?>
        </td>

        <td>
            <?php echo form_dropdown('tipo', ['cliente', 'admin', 'vendedor'], ['class' => "form-control"]); ?>
        </td>


    </tbody>
</table>
<?php
echo form_submit('adduser', 'Añadir', ["class" => "btn btn-primary"]);
echo form_close(); 
if(isset($data)) {
    echo var_dump($data);
}?>