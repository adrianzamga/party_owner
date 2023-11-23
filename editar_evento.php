<?php
session_start();
require_once("conexion.php");

if(!isset($_SESSION['correo'])){
    header('Location:index.php');
}
if(isset($_POST['logout'])){
    session_destroy();
    header('Location:index.php');
}
$idUsuario = $_SESSION['idUsuario'];
$nombre = $_SESSION['nombre'];
$correo = $_SESSION['correo'];
$telefono = $_SESSION['telefono'];
$fechaNacimiento = $_SESSION['fechaNacimiento'];
$foto = $_SESSION['foto'];

$_SESSION['idEvento'];
$_SESSION['nombreEvento'];
$_SESSION['fechaEvento'];
$_SESSION['hora_evento'];
$_SESSION['ubicacionEvento'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/editar_evento.css">
    <title>Editar Eventos</title>
</head>
<body>
<nav class='nav-bar'>
        <a href="./bienvenido.php">
            <div class='logo'> 
                <img src="./assets/icons8-meeting.svg" alt="logo"class='logo'>
                <p>Party Owner</p>
            </div>
        </a>
        <div class="contenedor-name">
            <a href="./perfil.php">
                <p>
                Hola <?php echo $nombre;  ?>
            </p>
            <?php echo '<img class="foto-perfil" src="data:foto/png;base64,' . base64_encode($foto) . '"/>'?>
            </a>
            <a href="./bienvenido.php">
                <button class='btn1'>Regresar</button>
            </a>
            <form action="" method="post">
                <input class="btn2" type="submit" name="logout" value="Cerrar sesion">
            </form>
        </div>  
</nav>
<main>
    <?php
    $sql = $conexion->prepare("SELECT * FROM eventos WHERE idEvento = :idEvento");
    ?>
    <div class="contenedor">
        <form action="" method="post">

        </form>
    </div>
</main>
</body>
</html>