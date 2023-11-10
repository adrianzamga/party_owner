hola <?php
session_start();
if(isset($_POST['logout'])){
    session_destroy();
    header('Location:index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/icons8-meeting.svg">
    
    <title>Inicio</title>
</head>
<body>
    <nav></nav>
</body>
</html>
<form action="bienvenido.php" method="post">
    <input type="submit" name="logout" value="Cerrar sesion">
</form>