<?php
require_once 'conexion.php';

ob_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


if(isset($_POST['crear_cuenta'])){
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];
    $fechaNacimiento = $_POST['fecha_nacimiento'];
    $size = getimagesize($_FILES["foto"]["tmp_name"]);
    $isActive = 'si';

    if(!empty($nombre) && !empty($correo) && !empty($telefono) && !empty($fechaNacimiento) && !empty($password) && $_POST['password'] == $_POST['password2'] && $size != false){

        $cargarImagen = $_FILES['foto']['tmp_name'];
        $foto = fopen($cargarImagen,'rb');
        
        $idUsuario = uniqid();


        $sql=$cnnPDO->prepare("INSERT INTO usuarios
            (idUsuario, nombre, correo,password, telefono, fechaNacimiento,  foto, isActive) VALUES (:idUsuario, :nombre, :correo,:password, :telefono, :fechaNacimiento,  :foto, :isActive)");

        //Asignar el contenido de las variables a los parametros
        $sql->bindParam(':idUsuario',$idUsuario);
        $sql->bindParam(':nombre',$nombre);
        $sql->bindParam(':correo',$correo);
        $sql->bindParam(':password',$password);
        $sql->bindParam(':telefono',$telefono);
        $sql->bindParam(':fechaNacimiento',$fechaNacimiento);
        $sql->bindParam(':isActive',$isActive);
        
        $sql->bindParam(':foto',$foto, PDO::PARAM_LOB);

        //Ejecutar la variable $sql
        $sql->execute();
        $mail = new PHPMailer(true); 
        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'partyowner18@gmail.com'; //  tu correo donde se mandará
            $mail->Password = 'ttxy nwhx onii vfla'; //  tu contraseña de aplicaciones
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $imagen_url0 = "https://jaircamacho.000webhostapp.com/icons8-meeting-96.png";

            $mail->setFrom('partyowner18@gmail.com', 'Party Owner'); 
            $mail->addAddress($correo);
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = '¡Gracias por ser parte de nosotros!';
            $mail->Body =  '
            <div style="background-color: #fff;">
            <div style="background-color: #fff; padding: 10px; text-align: center;">
                <img src="' . $imagen_url0 . '" alt="" style="display:block; margin:0 auto; width: 100px;">
                <h1 style="font-size: 24px; color: #black;">Gracias por registrarte en Party Owner. Verificamos que este es tu correo: ' . $correo . '</h1>
                <div class="text-center">
                </div>
            </div>
        </div>';
        
           
            $mail->send();
            unset($sql);
            unset($cnnPDO);
            header('Location: ./iniciar_sesion.php'); 
        } catch (Exception $e) {
            $notificacion = "<div class='alert alert-danger' role='alert'>
                <b>El registro no pudo ser realizado<br> Revisa tu conexión y vuelve a intentarlo</b>
            </div>";
        }
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
    <link rel="icon" href="./assets/icons8-meeting.svg">
    <link rel="stylesheet" href="./Styles/crear_cuenta.css">
    <title>Crear Cuenta</title>
</head>
<body>
    <nav class='nav-bar'>
        <a href="./index.php">
            <div class='logo'> 
                <img src="./assets/icons8-meeting.svg" alt="logo"class='logo'>
                <p>Party Owner</p>
            </div>
        </a>
    </nav>
    <div class='container'>
        <div class="formulario">
        <form method='post'enctype='multipart/form-data'>
            <h2>Crear Cuenta</h2>
            
            <label for="foto">Foto</label>
            <input class='foto'type="file" name="foto" id="foto" accept='image/jpg'>
            <label for="nombre">Nombre</label>
            <input class="campo" type="text" name="nombre" placeholder="Nombre Completo" id="nombre" required>
            <label for="correo">Correo</label>
            <input class="campo" type="email" name="correo" placeholder="Correo" id="correo" required>
            <label for="telefono">Telefono</label>
            <input class="campo" type="text" name="telefono" placeholder="Telefono" id="telefono" required>
            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input class="campo" type="date" name='fecha_nacimiento' id="fecha_nacimiento">
            <label for="password">Contraseña</label>
            <input class="campo" type="password" name="password" placeholder="Contraseña" id="password"required>
            <label for="password2">Confirma Contraseña</label>
            <input class="campo" type="password" name="password2" placeholder="Confirmar contraseña" id="password2" required>
            <input class="btn-registrar"action="crear_cuenta" type="submit" name="crear_cuenta" value="Crear Cuenta">
        </form>
        </div>
        <p>¿Ya tienes una cuenta? <a href="./iniciar_sesion.php">Inicia sesion</a></p>
    </div>
</body>
</html>