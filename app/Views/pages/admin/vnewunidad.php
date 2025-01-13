<div id="modelo">
    <h2>Nuevo Modelo</h2>
    <?php
    echo form_open(); ?>
    <table class="table">
        <tr>
            <th>
                Marca
            </th>

            <td>
                <?php echo form_input('marca', '', ["class" => "form-control", "placeholder" => "Marca del coche"]); ?>
            </td>
        </tr>

        <tr>
            <th>
                Modelo
            </th>

            <td>
                <?php echo form_input('modelo', '', ["class" => "form-control", "placeholder" => "Modelo del coche"]); ?>
            </td>
        </tr>

        <tr>
            <th>
                Año
            </th>

            <td>
                <?php echo form_input('ani_fabricacion', '', ["class" => "form-control", "placeholder" => "Año de fabricacion"]); ?>
            </td>
        </tr>

        <tr>
            <th>
                Extras
            </th>

            <td>
                <?php echo form_textarea('extras', '', ["class" => "form-control", "placeholder" => "Extras del coche"]); ?>
            </td>
        </tr>
    </table>
    <?php
    echo form_input('sendnewmodel', 'Añadir Modelo', ["class" => "btn btn-primary"]);
    echo form_close(); ?>
</div>

<h2>
    Nueva Unidad
</h2>
<?php echo form_open(); ?>
<table class="table">

    <tr>
        <th>
            Modelo
        </th>
        <td>
            <?php echo form_dropdown('id_coche', $modelos, '', ["class" => "form-control"]) ?>
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
            <?php echo form_input('color', '', ["class" => "form-control", "placeholder" => "1111AAA"]); ?>
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
echo form_submit('sendnewunidad', 'Añadir Unidad', ["class" => "btn btn-primary"]);
echo form_close();
if (isset($err)) { ?>
    <div class="alert alert-warning">
        <p>
            <?php echo $err; ?>
        </p>
    </div>
<?php } ?>