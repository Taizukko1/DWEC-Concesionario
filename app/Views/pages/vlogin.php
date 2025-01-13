<div id="login">
    <?php
    echo form_open();
    ?>


    <table id="log-table" class="w-75 mx-auto">
        <tr>
            <th>
                Email
            </th>

            <td>
                <?php echo form_input('email', '', ["placeholder" => "user@mail.com", "class" => "form-input"]) ?>
            </td>
        </tr>

        <tr>
            <th>
                Contraseña
            </th>

            <td>
                <?php echo form_password('pass', '', ["placeholder" => "contraseña", "class" => "form-input"]) ?>
            </td>
        </tr>

        <tr>
            <td>
                <?php echo form_submit('loginsubmit', 'Login', ["class" => "submit"]); ?>
            </td>

            <td>
                <a class="submit" href="<?php echo site_url() . "/Signup" ?>">Registrarse</a>
            </td>
        </tr>
    </table>

    <?php
    echo form_close();
    ?>

    <?php if (isset($err)) { ?>
        <div class="error">
            <?php echo $err; ?>
        </div>
    <?php } ?>
</div>