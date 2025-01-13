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
                <?php echo form_input('anio_fabricacion', '', ["class" => "form-control", "placeholder" => "Año de fabricacion"]); ?>
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
    echo form_submit('sendnewmodel', 'Añadir Modelo', ["class" => "btn btn-primary"]);
    echo form_close();
    if (isset($err)) { ?>
        <div class="alert alert-warning">
            <p>
                <?php echo $err; ?>
            </p>
        </div>
    <?php } ?>
</div>