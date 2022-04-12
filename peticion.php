<?php 
include 'conexion.php';

$consulta = "SELECT * FROM generador_contrasena";

if (!$resultado = $mysqli->query($consulta)) {
    echo "Lo sentimos, no se pudo realizar la consulta.";
    exit;
}

while ($array_registro = $resultado->fetch_assoc()) {
    if($array_registro['Nombre']=="Consonantes"){
    	$consonantes = $array_registro['Caracteres'];
    	$minimo_consonantes = $array_registro['Minimo_caracteres'];
    }
    if($array_registro['Nombre']=="Vocales"){
    	$vocales = $array_registro['Caracteres'];
    	$minimo_vocales = $array_registro['Minimo_caracteres'];
    }
    if($array_registro['Nombre']=="Numeros"){
    	$numeros = $array_registro['Caracteres'];
    	$minimo_numeros = $array_registro['Minimo_caracteres'];
    }
}

$longitud = $_POST['longitud'];

$contrasena = "";
for($x=0; $x<$longitud; $x++){
	$permitted_chars = $consonantes.$vocales.$numeros;
	$caracter_seleccionado = substr(str_shuffle($permitted_chars), 0, 1);	
	$contrasena .= $caracter_seleccionado;
}
//echo $contrasena;

$contador=0;
for($x=0; $x<$minimo_consonantes; $x++){
	$contrasena[$contador] = substr(str_shuffle($consonantes), 0, 1);
	$contador++;
}
for($x=0; $x<$minimo_vocales; $x++){
	$contrasena[$contador] = substr(str_shuffle($vocales), 0, 1);
	$contador++;
}
for($x=0; $x<$minimo_numeros; $x++){
	$contrasena[$contador] = substr(str_shuffle($numeros), 0, 1);
	$contador++;
}
//echo $contrasena;

$contrasena2 = str_shuffle($contrasena);
echo json_encode($contrasena2);

?>