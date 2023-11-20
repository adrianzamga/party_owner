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

function crearId(){
    global $cnnPDO;
    $query = $cnnPDO->prepare('SELECT * FROM invitados');
    $query->execute();
    $contador=1;
    while($campo = $query->fetch()){
        $contador = $contador + 1; 
    }
    return $contador;
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

if(isset($_POST['agregarInvitado'])){           
    $idInvitado = crearId();
    $nombreInvitado = $_POST['nombreInvitado'];
    $telefonoInvitado = $_POST['telefonoInvitado'];
    $idEvento = $_SESSION['idEvento'];
    $size = getimagesize($_FILES["qr"]["tmp_name"]);
    echo '<script>alert("Hola");</script>';
    
    
    if(!empty($nombreInvitado) && !empty($telefonoInvitado) && $size != false){
        $cargarImagen = $_FILES['qr']['tmp_name'];
        $qr = fopen($cargarImagen,'rb');

        $sql = $cnnPDO->prepare("INSERT INTO invitados (idInvitado, nombreInvitado, telefonoInvitado, idEvento, qr) VALUES (:idInvitado, :nombreInvitado, :telefonoInvitado, :idEvento, :qr)");
        $sql->bindParam(':idInvitado',$idInvitado);
        $sql->bindParam(':nombreInvitado',$nombreInvitado);
        $sql->bindParam(':telefonoInvitado',$telefonoInvitado);
        $sql->bindParam(':idEvento',$idEvento);
        $sql->bindParam(':qr',$qr, PDO::PARAM_LOB);
        $sql->execute();
        unset($sql);
        unset($cnnPDO);
        echo '<script>alert("Invitado agregado correctamente");</script>';
        header('Location:invitados.php');
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/invitados.css">
    <title>Inivitados</title>
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
            <form action="bienvenido.php" method="post">
                <input class="btn-cerrar-sesion" type="submit" name="logout" value="Cerrar sesion">
            </form>
        </div>
        
</nav>
<div class="container">    
    <h1> <?php echo $_SESSION['nombreEvento']; ?> </h1>
    <div class="card">
    <h2>Fecha del evento: <?php echo $_SESSION['fechaEvento']; ?></h2>
    <h2>Hora del evento: <?php echo $_SESSION['hora_evento']; ?></h2>
    <h2>Ubicacion del evento: <?php echo $_SESSION['ubicacionEvento']; ?></h2>
    <form action="" enctype='multipart/form-data' method="post">
        <label for="ivitado">Nombre Invitado</label>
        <input type="text" name="nombreInvitado" placeholder="Nombre Invitado" id="invitado">
        <label for="tel-invitado">telefono Invitado</label>
        <input type="text" name="telefonoInvitado" id="tel-invitado" placeholder="Telefono invitado">
        <label for="foto">qr</label>
        <input type="file" name="qr" id="foto">
        <input name='agregarInvitado' action="agregarInvitado" type="submit" value="Agregar lista inviatdos">
    </form>
    </div>
    <div class="card">
        <h2>Lista de invitados</h2>
        <table>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Telefono</th>
            </tr>
            <?php
                $idEvento = $_SESSION['idEvento'];
                $sql = $cnnPDO->prepare("SELECT * FROM invitados WHERE idEvento = '$idEvento'");
                $sql->execute();
                while($campo = $sql->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr>';
                    echo '<td>' . $campo['idInvitado'] . '</td>';
                    echo '<td>' . $campo['nombreInvitado'] . '</td>';
                    echo '<td>' . $campo['telefonoInvitado'] . '</td>';
                    echo '</tr>';
                }
            ?>
        </table>
</div>
</body>
</html>