<h2>
    Nueva Unidad
</h2>
<?php echo form_open(); ?>
<table class="table">
    <tr>
        <th>
            Matricula
        </th>
    </tr>

    <tr>
        <th>
            Modelo
        </th>
    </tr>

    <tr id="nuevoModelo" style="display: none;">
        <th>Marca</th>
        <th>Modelo</th>
        <th>Año de Fabricacion</th>
        <th>Extras</th>
    </tr>
    <script>
        let mySelect = document.querySelector("#modelo");
    </script>

    <tr>
        <th>
            Kilometraje
        </th>
    </tr>

    <tr>
        <th>
            Color
        </th>
    </tr>

    <tr>
        <th>
            Precio
        </th>
    </tr>
</table>
<?php echo form_close(); ?>