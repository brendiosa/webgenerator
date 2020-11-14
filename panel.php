<?php
	session_start();
	$con=mysqli_connect('localhost','adm_webgenerator','webgenerator2020','webgenerator');
	if(isset($_POST['borrar'])){
		$sql="DELETE FROM `webs`";
		$query=mysqli_query($con, $sql);
		shell_exec('rm -r webs');
		$sql="SELECT dominio FROM `webs`";
		$query=mysqli_query($con, $sql);
		$fila=mysqli_fetch_array($query, MYSQLI_ASSOC);
		if(mysqli_num_rows($query)==0){
			echo json_encode('anduvo perfecto');
		}
	}else{
		if (!(isset($_SESSION['user']))){
			header('location:login.php');
		}else{
			$id=$_SESSION['id'];
			$user=$_SESSION['user'];
			$pass=$_SESSION['pass'];
			if(isset($_GET['name'])){
				$dominio=$_SESSION['id']."".$_GET['name'];
				$sql="SELECT dominio FROM `webs` WHERE dominio='$dominio'";
				$query=mysqli_query($con, $sql);
				if (mysqli_num_rows($query)>0){
					echo json_encode('no');
				}else{
					$newsql="INSERT INTO `webs` (idUsuario, dominio) VALUES ($id, '$dominio')";
					$newquery=mysqli_query($con, $newsql);
					$query=mysqli_query($con, $sql);
					$fila=mysqli_fetch_array($query, MYSQLI_ASSOC);
					echo json_encode($fila);
					shell_exec("bash wix.sh $dominio $user $pass");
					shell_exec("zip -r webs/$dominio webs/$dominio");
				}
			}else{
				echo '
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Panel</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body bgcolor="darkred">
<font face="Century Gothic" color="white" size="+2">
	<center><h1>Bienvenido a tu panel</h1></center>
	<a href="logout.php">Cerrar sesión de ' .$id.'</a><br>
	<h2>Generar Web de:</h2><br>
	<form method="get" id="formWeb">
		<input type="text" name="nombre"><br>
		<button type="submit">Crear web</button>
	</form>

				';
				$sql;
				if($user=='admin@server'){
					$sql="SELECT dominio FROM `webs`";
					echo '

	<br><button type="button" id="borrar">Borrar todas las webs</button>

					';
				}else{
					$sql="SELECT dominio FROM `webs` WHERE idUsuario=".$id;
				}
				$query=mysqli_query($con, $sql);
				echo '

	<div class="webs" id="webs">

				';
				if(mysqli_num_rows($query)>0){
					while ($fila=mysqli_fetch_array($query)) {
						echo '


		<div class="enlaces">
			<a class="web" target="_blank" href="webs/'.$fila['dominio'].'">'.$fila['dominio'].'</a><a href="webs/'.$fila['dominio'].'.zip" target="_blank"> Descargar web</a>
		</div>

						';
					}
				}
				echo '

	</div>
	<script src="panel.js"></script>
</font>
</body>
</html>

				';
			}
		}
	
	}
	mysqli_close($con);
?>