<?php
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$archivo = $_FILES['archivo']['name'];

//Validar IMG
if (isset($archivo) && $archivo != "") {
  //Obtengo datos para comprobacion y posterior inserción a la bd
  $tipo = $_FILES['archivo']['type'];
  $tamano = $_FILES['archivo']['size'];
  $temp = $_FILES['archivo']['tmp_name'];
  //Compruebo que es del...
  if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
    echo "Error extensión o tamaño no valido, solo se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.";
  }
}
  
//Ingresar en bd
session_start();
$conexion=mysqli_connect("localhost","root","","fotos");

if (!$conexion) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO imagenes (nombre, apellido, ruta)
VALUES ('$nombre', '$apellido', '$temp')";

if (mysqli_query($conexion, $sql)) {
    echo " INGRESO EXITOSO";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
}
?>