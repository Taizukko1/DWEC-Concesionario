<div class="unidad w-75 mx-auto">
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <?php for ($i = 0; $i < sizeof($imagenes); $i++) { ?>
                <button type="button" <?php echo $i === 0 ? "class='active' aria-current='true'" : ""; ?> data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i; ?>" aria-label="Slide <?php echo $i; ?>"></button>
            <?php } ?>
        </div>
        <div class="carousel-inner">
            <?php
            $i = 0;
            foreach ($imagenes as $imagen) { ?>
                <div class="carousel-item border border-3 <?php echo $i === 0 ? "active" : ""; ?>">
                    <img src="<?php echo base_url('img/') . $imagen->src; ?>" class="d-block w-100" alt="...">
                </div>
            <?php
                $i++;
            } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="row">
        <h2 class="col-9 mt-3"><?php echo $coche->marca . " " . $coche->modelo . " " . $coche->anio_fabricacion; ?></h2>
        <h2 class="col-3 mt-3"><?php echo $unidad->precio; ?>€</h2>
    </div>
    <a class="compra w-25 float-end text-center" href="<?php echo site_url("Comprar/") . $unidad->matricula; ?>" <?php if (!isset($_SESSION["user"])) echo "disabled"; ?>>Comprar Ahora</a>
</div>