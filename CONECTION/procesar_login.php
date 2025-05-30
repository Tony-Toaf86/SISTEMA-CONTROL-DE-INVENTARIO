<?php
try{

	$base = new PDO("mysql:host=localhost; dbname=GESTOR" , "root", "root");

	$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "SELECT * FROM USUARIOS WHERE USUARIO = :login AND PASS = :password";


	$resultado = $base->prepare($sql);


		// rescatando las variables del login 
	$login = htmlentities(addslashes($_POST["usuario"]));
	$password = htmlentities(addslashes($_POST["password"]));

		// adginando valores a los marcadores

	$resultado->bindValue(":login", $login);
	$resultado->bindValue(":password", $password);

		// ejecutando la operacion 
	$resultado->execute();


		// verificando si el usuario existe en la base de datos

	$numero_registro=$resultado->rowCount();

	if ($numero_registro !=0 ) {  //iniciar la secion 

		session_start(); // incia la secion

		$_SESSION['usuario']=$_POST['usuario'];

		header("Location:../vistas/home.php");

	}else{
		header("Location:../index.php"); //si no permanece en esta ruta

	}

}catch(Exception $e){ //en caso de error


	die("Error: " . $e->getMessage());


}
?>