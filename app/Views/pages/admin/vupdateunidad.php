<h2>
    Actualizar Unidad
</h2>
<?php echo form_open(); ?>
<table class="table">

    <tr>
        <th>
            Modelo
        </th>
        <td>
            <?php  echo form_dropdown('id_coche', $modelos, '', ["class" => "form-control"]) ?>
        </td>
    </tr>

    <tr>
        <th>
            Matricula
        </th>

        <td>
            <?php echo form_input('matricula', '', ["class" => "form-control", "placeholder" => "1111AAA"]); ?>
        </td>
    </tr>

    <tr>
        <th>
            Kilometraje
        </th>
        <td>
            <?php echo form_input('kilometraje', '', ["class" => "form-control", "type" => "number"]); ?>
        </td>
    </tr>

    <tr>
        <th>
            Color
        </th>
        <td>
            <?php echo form_input('color', '', ["class" => "form-control", "placeholder" => "Color del coche"]); ?>
        </td>
    </tr>

    <tr>
        <th>
            Precio
        </th>
        <td>
            <?php echo form_input('precio', '', ["class" => "form-control", "type" => "number"]); ?>
        </td>
    </tr>

    <tr>
        <th>
            Imagenes
        </th>

        <td>
            <input type="file" name="imagenes[]" multiple>
        </td>


    </tr>
</table>

<?php
echo form_submit('sendupdatedunidad', 'Actualizar Unidad', ["class" => "btn btn-primary"]);
echo form_close();
if (isset($err)) { ?>
    <div class="alert alert-warning">
        <p>
            <?php echo $err; ?>
        </p>
    </div>
<?php } ?>