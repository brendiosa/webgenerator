<?php
	if (isset($_GET['user'])){
		$mail=$_GET['user'];
		$pass=$_GET['pass'];
		try{
			$sql="SELECT email FROM `usuarios` WHERE email='$mail'";
			
			$con=mysqli_connect('localhost','adm_webgenerator','webgenerator2020','webgenerator');
		
			$query=mysqli_query($con, $sql);
			if(mysqli_num_rows($query)>0){
				echo json_encode('no');
			}else{
				$sql="INSERT INTO `usuarios` (email, password) VALUES ('$mail', '$pass')";
				$query=mysqli_query($con, $sql);
				echo json_encode('si');
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

	<title>Registro</title>
	
</head>
<body bgcolor="darkred">
<font face="Century Gothic" color="white" size="+2">
	<center><h1>Registrarte es simple</h1></center>
	<form action="login.php" id="formRegistro" method="post" accept-charset="utf-8">
		<div class="campo">
			<label for="user">Email: </label>
			<input type="text" id="user" name="user" placeholder="Ejemplo@gmail.com">
		</div>
		<div class="campo">
			<label for="pass">Contraseña: </label>
			<input type="password" id="pass" name="pass" placeholder="******">
		</div>
		<div class="campo">
			<label for="pass2">Repita su contraseña: </label>
			<input type="password" id="pass2" name="pass2" placeholder="******">
		</div>
		<div class="campo">
			<input type="submit" value="Registrar">
		</div>
	</form>
	<br><a href="login.php">Ir a Iniciar Sesión</a>
	<script src="register.js"></script>
</font>
</body>
</html>
		';
	}
?>