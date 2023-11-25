<?php
session_start();

require_once 'conexion.php';
$nombre = $_SESSION['nombre'];
$correo = $_SESSION['correo'];
$telefono = $_SESSION['telefono'];
$fechaNacimiento = $_SESSION['fechaNacimiento'];
if(!isset($_SESSION['correo'])){
    header('Location:index.php');
}
if(isset($_POST['logout'])){
    session_destroy();
    header('Location:index.php');
}
if (isset($_POST['desactiva'])) 
{
    if($_POST['correo'] == $_SESSION['correo']){
        $alerta = "<div class='alerta'>No puedes bloquearte a ti mismo</div>";
    }else{
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
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/admin.css">
    <title>Vista admin</title>
</head>
<body>
<nav class='nav-bar'>
        <a href="./admin.php">
            <div class='logo'> 
                <img src="./assets/icons8-meeting.svg" alt="logo"class='logo'>
                <p>Party Owner</p>
            </div>
        </a>
        <div class="contenedor-name">
            <a href="./admin.php">
                <p>
                Hola <?php echo $nombre;  ?>
            </p>
            </a>
            <form action="admin.php" method="post">
                <input class="btn-cerrar-sesion" type="submit" name="logout" value="Cerrar sesion">
            </form>
        </div>
        
</nav>
<div class="container">
    <div class="contenedor-bloquear">
        <form class="form-correo" method="POST">
        <label class="label-correo" for="correo">Ingresa un correo para bloquear</label>
        <input class="input-correo" type="text" name="correo" placeholder="Ingresa el correo">
        <button type="submit" name="desactiva" class="btn-bloquear">Bloquear</button>
        <?php echo isset($alerta) ? $alerta : ''; ?>
    </form>
    </div>
</div>

  <div class="container-tabla">
    <h1 class="">Usuarios</h1>
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
</div>
</body>
</html>