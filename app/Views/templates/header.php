<?php 
$user_type = "";
if (isset($_SESSION['admin'])) { 
    $user_type = "ADMIN";
} else if(isset($_SESSION['vendedor'])) {
    $user_type = "VENDEDOR";
}?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url(); ?>style.css">
    <title>Concesionario CJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div id="container">
        <header>
            <h1>
                CCJ
            </h1>

                <h1><?php echo $user_type?></h1>

            <?php if (isset($_SESSION['user']) || isset($_SESSION['vendedor']) || isset($_SESSION['admin'])) { ?>
                <a href="<?php echo site_url() . "/Logout" ?>">Logout</a>
            <?php } else { ?>
                <a href="<?php echo site_url() . "/Login" ?>">Login</a>
            <?php } ?>
        </header>
        <main>
            <aside>
                <nav>
                    <ul class="p-0">
                        <li><a href="<?php echo site_url() ?>">Home</a></li>
                        <?php if (!isset($_SESSION['vendedor']) && !isset($_SESSION['admin'])) { ?>
                            <li><a href="<?php echo site_url("Unidades") ?>">Nuestros Coches</a></li>
                        <?php } ?>
                        <?php if (isset($_SESSION['vendedor'])) { ?>
                            <li><a href="<?php echo site_url("admin/Ventas") ?>">Gestion Ventas</a></li>
                        <?php } ?>

                        <?php if (isset($_SESSION['admin'])) { ?>
                            <li><a href="<?php echo site_url('admin/Unidades'); ?>">Gestion Unidades</a></li>
                            <li><a href="<?php echo site_url('admin/Usuarios'); ?>">Gestion Usuarios</a></li>
                            <li><a href="#">Ranking</a></li>
                        <?php } ?>
                    </ul>
                </nav>
            </aside>
            <section>