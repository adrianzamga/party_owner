<?php
session_start();

require_once 'conexion.php';
$nombre = $_SESSION['nombre'];
$correo = $_SESSION['correo'];
$telefono = $_SESSION['telefono'];
$fechaNacimiento = $_SESSION['fechaNacimiento'];
$foto = $_SESSION['foto'];
if(!isset($_SESSION['correo'])){
    header('Location:index.php');
}
if(isset($_POST['logout'])){
    session_destroy();
    header('Location:index.php');
}
if (isset($_POST['desactiva'])) 
{
 
    $correo =$_POST['correo'];
    $act ='no';

    $sql = $cnnPDO->prepare(
            'UPDATE usuarios SET isActive =:act WHERE correo =:correo');
        $sql->bindParam(':act',$act);
        $sql->bindParam(':correo',$correo);
        $sql->execute();
        header('location:admin.php');
        exit();
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista admin</title>
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
<div class="container text-center">
    <h1 class="display-1">USUARIOS</h1>
    <br>
    <form method="POST">
    <input type="text" name="correo" placeholder="Ingresa el username">
    <button type="submit" name="desactiva" class="btn btn-danger">Bloquear</button>
    </form>
    </div>
<?php
  $sql = $cnnPDO->prepare("SELECT * FROM usuarios");
  $sql->execute();
  ?>
 <table class='table'>
  <tr>
    <th class="text-white"><b>ID</b></th>
    <th class="text-white"><b>Correo</b></th>
    <th class="text-white"><b>Nombre</b></th>
    <th class="text-white"><b>EMAIL</b></th>
    <th class="text-white"><b>PASSWORD</b></th>
    <th class="text-white"><b>ACTIVO</b></th>
  </tr>
  <?php
  while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td class='text-white'>" . $row['idUsuario'] . "</td>";
    echo "<td class='text-white'>" . $row['correo'] . "</td>";
    echo "<td class='text-white'>" . $row['nombre'] . "</td>";
    echo "<td class='text-white'>" . $row['correo'] . "</td>";
    echo "<td class='text-white'>" . $row['password'] . "</td>";
    echo "<td class='text-white'>" . $row['isActive'] . "</td>";
    echo "</tr>";
  }
  ?>
</table> 
</body>
</html>