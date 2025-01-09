<h2>
    Ventas En Espera
</h2>
<table class="table">
    <thead>
        <th>
            Id
        </th>

        <th>
            Modelo
        </th>

        <th>
            Precio
        </th>

        <th>
            Cliente
        </th>

        <th>
            Accion
        </th>
    </thead>
    <tbody>
        <tr>

            <td>
                0
            </td>

            <td>
                marca modelo año
            </td>

            <td>
                0000€
            </td>

            <td>
                nombre ap1 ap2
            </td>

            <td>
                <a href="<?php echo site_url("admin/Ventas/Aceptar/idVenta")?>">X</a>
                <a href="<?php echo site_url("admin/Ventas/Cancelar/idVenta")?>">V</a>
            </td>
        </tr>
    </tbody>
</table>