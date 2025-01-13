<?php

use App\Models\ModeloCoches;
use App\Models\ModeloImagenes;
use App\Models\ModeloVentas;

$modeloImagenes = new ModeloImagenes();
$modeloCoches = new ModeloCoches();
$modeloVentas = new ModeloVentas();
?>
<h2>Nuestros Coches</h2>
<?php foreach ($unidades as $unidad) {
    if ($modeloVentas->enVenta($unidad->matricula)) {?>

        <a href="<?php echo site_url() . '/Unidades/' . $unidad->matricula ?>">
            <div class="fila">
                <img src="<?php echo base_url('/img/') . $modeloImagenes->getImagenes($unidad->matricula)[0]->src; ?>" alt="">
                <div class="datos">
                    <h2>
                        <?php
                        $modelo = $modeloCoches->getModelo($unidad->id_coche);
                        echo $modelo->marca . " " . $modelo->modelo . " " . $modelo->anio_fabricacion;
                        ?>
                    </h2>
                    <h2>
                        <?php echo $unidad->precio; ?>€
                    </h2>
                </div>
            </div>
        </a>
<?php }
} ?>