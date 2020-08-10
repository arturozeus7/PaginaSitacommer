<?php

$host_db = "localhost";
$user_db = "root";
$pass_db = "";
$db_name = "usuariositacom";
$tbl_name = "usuario";
$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);


$nombre = $_POST['nombre'];
$apellidopaterno = $_POST['apellidopaterno'];
$apellidomaterno = $_POST['apellidomaterno'];



if ($conexion->connect_error) {
   die("La conexion falló: " . $conexion->connect_error);
}

$buscarUsuario = "SELECT * FROM $tbl_name
WHERE correo = '$_POST[correo]' ";
$result = $conexion->query($buscarUsuario);
$count = mysqli_num_rows($result);

if ($count == 1) {
  echo "<br />". "El Correo ya a sido tomado." . "<br />";
  echo "<a href='index.html'>Por favor escoga otro Correo</a>";
}
else{
  $form_pass = $_POST['password'];
  $hash = password_hash($form_pass, PASSWORD_BCRYPT);

  $query = "INSERT INTO usuario (correo, contrasena, NombreUsuario, ApelliPaterno, ApelliMaterno) VALUES ('$_POST[correo]', '$hash', '$nombre','$apellidopaterno','apellidomaterno')";

  if ($conexion->query($query) === TRUE) {
     echo "<br />" . "<h2>" . "Usuario Creado Exitosamente!" . "</h2>";
     echo "<h4>" . "Bienvenido: " . $_POST['username'] . "</h4>" . "\n\n";
     echo "<h5>" . "Hacer Login: " . "<a href='login.html'>Login</a>" . "</h5>";
  }
  else {
     echo "Error al crear el usuario." . $query . "<br>" . $conexion->error;
  }
}
mysqli_close($conexion);

?>


