<?php
require_once 'conexion.php';

function crearId(){
    global $cnnPDO;
    $query = $cnnPDO->prepare('SELECT * FROM usuarios');
    $query->execute();
    $contador=1;
    while($campo = $query->fetch()){
        $contador = $contador + 1; 
    }
    return $contador;
}


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
        
        $idUsuario = crearId();


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