<?php
$idproducto=$_REQUEST['idproducto'];
$nomproducto=$_REQUEST['nomproducto'];
///variable
$servidor="localhost";
$usuario="root";
$baseDatos="parcial02";
$password="";
$respuesta=array('resultado'=>0);
json_encode($respuesta);
// Create connection
$conn = new mysqli($servidor, $usuario, $password, $baseDatos);
// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}
$sql = "UPDATE producto SET nomproducto='".$nomproducto."' WHERE idproducto='".$idproducto."'";
if ($conn->query($sql) === TRUE) {
 echo "{resultado:}";
} else {
 echo "Error: " . $sql . "<br>" . $conn->error;
}
echo $nomproducto;
$conn->close();
?>