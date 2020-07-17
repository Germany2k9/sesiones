<?php 
	session_start();
		if(isset($_POST)){
		$usuario = $_POST['usuario'];
		$password = $_POST['password'];

		// if ($usuario == "prueba" && $password == "prueba1") {
		// 	$_SESSION["logedin"] = true;
		// 	$_SESSION["usuario"] = $usuario;
		// 	$_SESSION["rol"] = "admin";
		// }

	 
	//Preparo las variables con los datos de conexion 
	$host="localhost";
	$usuario ="root";
	$clave ="";
	$db="usuarios";
	
	//conectarse a la base de datos
	$conn= mysql_connect($host, $usuario, $clave, $db);

	//preparo la sentencia con los comeodines ?
	$sql="SELECT user, rol FROM usuarios WHERE user=? AND password =? ";

	//preparo la consulta
	$pre= mysqli_prepare($conn, $sql);

	//incdico los datos a remplazar con su tipo.
	msqli_stmt_bind_param($pre,"ss", $usuario, $password);

	//Ejecuto la consulta.
	mysqli_stmt_execute($pre);
	//Asocio los nombre s de campo a nombres de variables.
	mysqli_stmt_bind_result($pre, $user, $rol);
	
	#capturo los resultados y los guardo en un array.
	$registros[]=null;
	while (mysqli_stmt_fecth($pre)) {
		$registros[] = array(
			'user'=>$id,
			'rol'=>$rol,
		);
	}


	if($registros != null){
		$_SESSION['loggedin']=true;
		$_SESSION['rol']=$rol;

		header('Location: index.php');

	}
	#cierro la consulta y la conexion.
	mysqli_stmt_close($pre);
	mysqli_close($conn);

}




 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie-edge">
	<link rel="stylesheet"  type="text/css" href="css/bootstrap.css">
  	<link rel="stylesheet"  type="text/css" href="css/style.css">
  	<link rel=”shortcut icon” type=”image/png” href=”img/favicon.png”/>
   	<link rel="stylesheet"  type="text/css" href="css/alertify.min.css">
	<!-- <link rel="stylesheet"  type="text/css" href="css/bootstrap.min.css"> -->
	<title>Document</title>
</head>
<body>
  

  

	 <script src="js/jquery-3.4.1.min.js"></script>
	 <script src="js/popper.min.js"></script>
	 <script src="js/bootstrap.min.js"></script>
  	 <script src="js/alertify.min.js"></script>
   	 <script src="alertify/alertify.min.js"></script>
   	 <script src="moment/moment-with-locales.js"></script>
	 <script>
	 	$( document ).ready(function() {
 	 	console.log("Are /you READY!!");
      
   		 });
 
	</script>
  <script src="https://kit.fontawesome.com/a03bedb3c1.js" crossorigin="anonymous"></script>
</body>
</html>