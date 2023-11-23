<?php
require_once 'conexion.php';

if(isset($_POST['crear_cuenta'])){
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];
    $fechaNacimiento = $_POST['fecha_nacimiento'];
    $size = getimagesize($_FILES["foto"]["tmp_name"]);

    if(!empty($nombre) && !empty($correo) && !empty($telefono) && !empty($fechaNacimiento) && !empty($password) && $_POST['password'] == $_POST['password2'] && $size != false){

        $cargarImagen = $_FILES['foto']['tmp_name'];
        $foto = fopen($cargarImagen,'rb');
        
        $idUsuario = uniqid();


        $sql=$cnnPDO->prepare("INSERT INTO usuarios
            (idUsuario, nombre, correo,password, telefono, fechaNacimiento,  foto) VALUES (:idUsuario, :nombre, :correo,:password, :telefono, :fechaNacimiento,  :foto)");

        //Asignar el contenido de las variables a los parametros
        $sql->bindParam(':idUsuario',$idUsuario);
        $sql->bindParam(':nombre',$nombre);
        $sql->bindParam(':correo',$correo);
        $sql->bindParam(':password',$password);
        $sql->bindParam(':telefono',$telefono);
        $sql->bindParam(':fechaNacimiento',$fechaNacimiento);
        
        $sql->bindParam(':foto',$foto, PDO::PARAM_LOB);

        //Ejecutar la variable $sql
        $sql->execute();
        unset($sql);   
        header('Location: ./iniciar_sesion.php');

    }else{
        echo "<script>alert('Faltan campos por llenar')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/icons8-meeting.svg">
    <link rel="stylesheet" href="./Styles/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" href="./assets/icons8-meeting.svg">
    <title>Crear Cuenta</title>
    <link rel="stylesheet" href="./Styles/formulario2.css">
</head>
<body style="background-image: url(./Images/copas.jpeg);">
    <nav class='nav-bar'>
        <a href="./index.php">
            <div class='logo'> 
                <img src="./assets/icons8-meeting.svg" alt="logo"class='logo'>
                <p>Party Owner</p>
            </div>
        </a>
    </nav>
    <section class="form-main">
        <div class='form-content'>
            <div class="box">
                <form method='post' enctype='multipart/form-data'>
                    <h3>Crear Cuenta</h3>
                    <div class="foto-div">
                        <input class='foto_circular' type="file" name="foto" id="foto"
                         accept='image/jpg'>
                    </div>

                    <div>
                        <input class="input-control" type="text" name="nombre" placeholder="Nombre Completo" id="nombre" required>
                    </div>

                    <div>
                        <input class="input-control" type="email" name="correo" placeholder="Correo" id="correo" required>
                    </div>

                    <div>
                        <input class="input-control" type="text" name="telefono" placeholder="Telefono" id="telefono" required>
                    </div>

                    <div>
                        <input class="input-control"type="date" name='fecha_nacimiento' id="fecha_nacimiento">
                    </div>

                    <div>
                        <input class="input-control"type="password" name="password" placeholder="Contraseña" id="password"required>
                    </div>

                    <div>
                        <input class="input-control"type="password" name="password2" placeholder="Confirmar contraseña" id="password2" required>
                    </div> <br>
                        <button type="submit" name="crear_cuenta" class="btn">Crear Cuenta</button>
                </form>
            </div>
            <div>
                <p style="color: wheat;">¿Ya tienes una cuenta? <a href="./iniciar_sesion.php">Inicia sesión</a></p>
            </div>
        </div>
    </section>
</body>
</html>
