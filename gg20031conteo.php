<?php
$id=$_REQUEST['id'];
$servidor="localhost";
$usuario="root";
$baseDatos="parcial3c";
$password="";

$conexion=mysql_connect($servidor,$usuario,$password) or die ("Problemas en la conexion");

mysql_select_db($baseDatos,$conexion) or die("Problemas en la seleccion de la base de datos");

$registros=mysql_query(
    "SELECT IDPAISLOCAL, COUNT(IDPAISLOCAL) AS CONTEOLOCAL FROM PARTIDO WHERE IDPAISLOCAL='".$id."' group by idpaislocal",$conexion) or die("Problemas en el select:".mysql_error());

$filas=array();

while ($reg=mysql_fetch_assoc($registros)) {
    $filas[]=$reg;
}

echo json_encode($filas);
mysql_close($conexion);
?>