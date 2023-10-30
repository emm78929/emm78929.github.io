<html>

<head>
	<title>BD porteria</title>
</head>

<body>

<?php
$server = "localhost"; 
$user = "root";
$password = ""; 
$database = "porteria";
$conexion = new mysqli($server, $user, $password, $database);
if ($conexion->connect_error) {
    die("Error al conectar con la base de datos " . $conexion->connect_error);
}
	//echo "<h1>Porteros</h1>";

	$idportero = $_POST['idportero'];
	$nombreportero = $_POST['nombreportero'];
	$horarioportero = $_POST['horarioportero'];
	
	//Comprobando existencia del portero
	$existente = false;
	$reg_porteros = mysqli_query($conexion, "select * from Porteros") or
    die("Problemas en el select:" . mysqli_error($conexion));
	while ($reg = mysqli_fetch_array($reg_porteros)) {
		if ($reg['idPortero']==$idportero){
			$existente = true;
		}
	}
	if($existente == true){
		echo "ERROR: Ya existe un portero con esta ID";
		include 'tablas_portero.php';
	}else if($nombreportero=="" || $horarioportero==""){
		echo "ERROR: No deje vacíos los campos requeridos";
		$conexion->close();
	}else{
		$conexion->query("insert into Porteros(idPortero, nombrePortero, horarioPortero) values ($idportero,'$nombreportero','$horarioportero')");
		echo "Registro agregado correctamente" . $conexion->error;
		include 'tablas_portero.php';
	}
	

?>


</html>




