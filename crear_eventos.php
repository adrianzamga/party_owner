<?php
session_start();

function crearId(){
    global $cnnPDO;
    $query = $cnnPDO->prepare('SELECT * FROM eventos');
    $query->execute();
    $contador=1;
    while($campo = $query->fetch()){
        $contador = $contador + 1; 
    }
    return $contador;
}

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



if(isset($_POST['crear_evento'])){
    $idEvento = crearId();
    $nombreEvento = $_POST['nombreEvento'];
    $fechaEvento = $_POST['fecha'];
    $hora_evento = $_POST['hora_evento'];
    $ubicacionEvento = $_POST['ubicacionEvento'];

    if(!empty($nombreEvento) && !empty($fechaEvento) && !empty($hora_evento) && !empty($ubicacionEvento)){
        $idEvento = crearId();
        $sql=$cnnPDO->prepare("INSERT INTO eventos
            (idEvento, nombreEvento, fechaEvento, hora_evento, ubicacionEvento, idUsuario) VALUES (:idEvento, :nombreEvento, :fechaEvento, :hora_evento, :ubicacionEvento, :idUsuario)");

        //Asignar el contenido de las variables a los parametros
        $sql->bindParam(':idEvento',$idEvento);
        $sql->bindParam(':nombreEvento',$nombreEvento);
        $sql->bindParam(':fechaEvento',$fechaEvento);
        $sql->bindParam(':hora_evento',$hora_evento);
        $sql->bindParam(':ubicacionEvento',$ubicacionEvento);
        $sql->bindParam(':idUsuario',$idUsuario);

        //Ejecutar la variable $sql
        $sql->execute();
        unset($sql);   
        header('Location: ./bienvenido.php');

    }else{
        echo "<script>alert('Faltan campos por llenar')</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/crear_eventos.css">
    <title>Crear eventos</title>
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
        <div class="contenedor">
            <form method="post">
                <div class="contenedor-form">
                <h1>Crear evento</h1>
                <label for="nombre">Nombre del evento</label>
                <input type="text" name="nombreEvento" id="nombre" placeholder="Nombre del evento">
                <label for="fecha">Fecha del evento</label>
                <input type="date" name="fecha" id="fecha">
                <label for="hora">Hora del evento</label>
                <input type="time" name="hora_evento" id="hora">
                <label for="lugar">Lugar del evento</label>
                <input type="text" name="ubicacionEvento" id="lugar" placeholder="Lugar del evento">
                <input type="submit" name="crear_evento" action="crear_evento"  value="Crear evento">
                </div>
                
            </form>
            
        </div>
    </main>

</body>
</html>