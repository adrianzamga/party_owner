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
    <title>Inivitados</title>
</head>
<body>
    Hola
    <?php 
    echo $_SESSION['idEvento'];
    echo $_SESSION['nombreEvento'];
    echo $_SESSION['fechaEvento'];
    echo $_SESSION['hora_evento'];
    echo $_SESSION['ubicacionEvento'];
    ?>

</body>
</html>