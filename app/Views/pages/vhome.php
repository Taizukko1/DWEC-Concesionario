<?php 
$message = "Esta es la pagina de inicio del concesionario. Inicia sesión para acceder a las funcionalidades del sitio.";
if (isset($_SESSION['user'])) {
    $message = "Haz clic en Nuestros Coches para ver nuestra oferta de vehiculos de segunda mano.";
}

if (isset($_SESSION['vendedor'])) {
    $message = "Mensaje para vendedor.";
}

if (isset($_SESSION['admin'])) {
    $message = "Mensaje para administrador.";
}
?>

<h2>
    Bienvenido!
</h2>
<p>
    <?php echo $message ?>
</p>