<?php
	session_start();
	if (isset($_SESSION['user'])){
		header('location:panel.php');
	}else{
		if (isset($_GET['user'])){
			$mail=$_GET['user'];
			$pass=$_GET['pass'];
			try{
				$sql="SELECT idUsuario,email,password FROM `usuarios` WHERE email='$mail' and password='$pass'";
			$con=mysqli_connect('localhost','adm_webgenerator','webgenerator2020','webgenerator');
				$query=mysqli_query($con, $sql);
				if(mysqli_num_rows($query)>0){
					$fila=mysqli_fetch_array($query, MYSQLI_ASSOC);
					/*print_r($fila);*/
					$_SESSION['user']=$mail;
					$_SESSION['pass']=$pass;
					$_SESSION['id']=$fila['idUsuario'];
					echo json_encode('si');
				}else{
					echo json_encode('no');
				}
				mysqli_close($con);
			}catch (Exception $e){
				echo 'Error del catch del PHP: '.$e->message();
			}
		}else{
			echo '
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<!--<meta http-equiv="Expires" content="0">
 
	<meta http-equiv="Last-Modified" content="0">
	 
	<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	 
	<meta http-equiv="Pragma" content="no-cache">-->

	<title>Inicio de sesión</title>
	
</head>
<body bgcolor="darkred">
<font face="Century Gothic" color="white" size="+2">
	<center><h1>Webgenerator</h1></center>
	<form action="panel.php" id="formInicio" method="post" accept-charset="utf-8">
		<div class="campo">
			<label for="user">Email: </label>
			<input type="text" id="user" name="user" placeholder="Ejemplo@gmail.com">
		</div>
		<div class="campo">
			<label for="pass">Contraseña: </label>
			<input type="text" id="pass" name="pass" placeholder="******">
		</div>
		<div class="campo">
			<input type="submit" value="Ingresar">
		</div>
	</form>
	<a href="register.php">No tiene una cuenta? Registrese!</a>
	<script src="login.js"></script>
</font>
</body>
</html>
			';
		}
	}
?>