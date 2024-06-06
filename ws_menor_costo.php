<?php 
$servidor="localhost"; 
$usuario="root"; 
$baseDatos="parcial01"; 
$password=""; 
$mysqli = new mysqli($servidor, $usuario, $password, $baseDatos);
// Check connection 
if ($mysqli->connect_error) { 
    die("Connection failed: " . $mysqli->connect_error); 
} 
$consulta ="SELECT T.IDTIPOPROD, T.NOMTIPOPROD, MIN(P.COSTO) AS COSTOMIN FROM PRODUCTO P JOIN TIPOPROD T ON P.IDTIPOPROD = T.IDTIPOPROD GROUP BY T.IDTIPOPROD, T.NOMTIPOPROD ";
if ($resultado = $mysqli->query($consulta)) { 
    $filas=array(); 
    /* obtener un array asociativo */ 
    while ($reg = $resultado->fetch_assoc()) { 
        $filas[]=$reg; 
    } 
     echo json_encode($filas); 
    /* liberar el conjunto de resultados */ 
    $resultado->free(); 
} 
/* cerrar la conexión */ 
$mysqli->close(); 
?>