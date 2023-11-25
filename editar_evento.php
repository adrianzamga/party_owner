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
    <title>Invitados</title>
</head>
<body>
    <nav class='nav-bar'>
        <a href="./bienvenido.php">
            <div class='logo'> 
                <img src="./assets/icons8-meeting.svg" alt="logo" class='logo'>
                <p>Party Owner</p>
            </div>
        </a>
        <div class="contenedor-name">
            <a href="./perfil.php">
                <p>Hola <?php echo $nombre; ?></p>
                <?php echo '<img class="foto-perfil" src="data:foto/png;base64,' . base64_encode($foto) . '"/>' ?>
            </a>
            <a href="./bienvenido.php">
                <button class='btn1'>Regresar</button>
            </a>
            <form action="" method="post">
                <input class="btn2" type="submit" name="logout" value="Cerrar sesión">
            </form>
        </div>  
    </nav>
    <main>
    <br>
    <h1 style="color: #2b2c34">Detalles del Evento</h1> <br>
        <div class="contenedor-evento">
            <div class="cards">
                <div class="parrafo">
                    <p>ID del Evento: <?php echo $_SESSION['idEvento']; ?></p>
                    <p>Nombre del Evento: <?php echo $_SESSION['nombreEvento']; ?></p>
                    <p>Fecha del Evento: <?php echo $_SESSION['fechaEvento']; ?></p>
                    <p>Hora del Evento: <?php echo $_SESSION['hora_evento']; ?></p>
                    <p>Ubicación del Evento: <?php echo $_SESSION['ubicacionEvento']; ?></p>
                </div> 
                <div class="contenedor-btns">
                    <form method="post">
                        <input class="btn-editar" type="submit" value="Guardar" name="editar">
                    </form> 
                    <form method="post">
                        <input class="btn-eliminar" type="submit" value="Eliminar Evento" name="eliminar">
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
