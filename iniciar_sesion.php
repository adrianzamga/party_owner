<?php
session_start();
require_once 'conexion.php';
$error = '<div></div>';
if (isset($_POST['validar'])) {
    $correo = $_POST['correo'];
    $password = $_POST['password'];


    $query = $cnnPDO->prepare('SELECT * FROM usuarios where 
        correo=:correo AND password=:password');

    $query->bindParam(':correo', $correo);
    $query->bindParam(':password', $password);

    $query->execute();

    $count = $query->rowCount();
    $campo = $query->fetch();


    if ($count) {
        $_SESSION['correo'] = $correo;
        $_SESSION['nombre'] = $campo['nombre'];
        $_SESSION['telefono'] = $campo['telefono'];
        $_SESSION['fechaNacimiento'] = $campo['fechaNacimiento'];
        $_SESSION['foto'] = $campo['foto'];
        header('Location:bienvenido.php');
    } else {
        $error = '
        <div class="alert alert-danger" role="alert">
            Usuario o contraseña incorrectos';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/icons8-meeting.svg">
    <link rel="stylesheet" href="./Styles/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" href="./assets/icons8-meeting.svg">
    <link rel="stylesheet" href="./Styles/iniciar_sesion.css">
    <title>Formulario</title>
</head>
<body style="background-image: url(./Images/rrr.avif);">
<!-- Empieza Navbar -->
<nav class='nav-bar'>
        <a href="./index.php">
            <div class='logo'> 
                <img src="./assets/icons8-meeting.svg" alt="logo"class='logo'>
                <p>Party Owner</p>
            </div>
        </a>
        
        <div class='nav-btn'>
            <button onclick='window.location="./crear_cuenta.php";' class='btn2'>Crear cuenta</button>
        </div>
    </nav>
    </div>
    <br><br>
    <!-- Empieza Formulario -->
    <section class="form-main">
    <div class="form-content">
      <div class="box">
        <h3>Bienvenido</h3>
        <form action="iniciar_sesion.php" method='post'>
          <div class="input-box">
            <input type="text"name='correo' placeholder="Ingresa tu correo" class="input-control" >
          </div>
          <div class="input-box">
            <input type="password" name='password' placeholder="Ingresa tu contraseña" class="input-control">
          </div>
          <button type="submit"name="validar" class="btn">Iniciar Sesión</button>
        </form>
        <?php echo isset($error) ? $error : ''; ?>
      </div>
    </div>
  </section>  
  <footer>
        <div class='footer-container'>
            <div class='footer-logo'>
            <div class='logo'> 
                <img src="./assets/icons8-meeting.svg" alt="logo"class='logo'>
                <p>Party Owner</p>
            </div>
            </div>
            <div class='footer-links'>
                <a href="#">Acerca de</a>
                <a href="#">Contacto</a>
                <a href="#">Politicas de privacidad</a>
                <a href="#">Terminos y condiciones</a>
            </div>
        </div>
    </footer>
</body>
</html>

