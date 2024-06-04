<?php

	session_start();
	$alert = ' ';
	if(!empty($_SESSION['act']))
	{
		header ('location: /sis_venta');
	}else{

		if(!empty($_POST))
		{
			if(empty($_POST['Usuario']) || empty ($_POST['Contraseña']))
			{
				$alert = 'Ingrese su usuario y su Contraseña';
			}else{

				if($_POST['Usuario']  == 'admin' || $_POST['Contraseña'] =='abc') 
				{
					header('location: /sis_venta');
					session_destroy();
				}else{
					$alert = 'El usuario y la contraseña son incorrectos';
					session_destroy();
				}
				
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login | Sistema Facturación</title>
	<link rel="stylesheet" type="text/css" href="style2.css"> 
</head>
<body>
	<section id="container">
	
		<form action="" method="post">
	
			<h3>Iniciar Sesión</h3>
			<img src="img/block.png" width="100" height="100" alt="Login">
		
			<input type="text" name="Usuario" placeholder="Usuario"> 
			<input type="password" name="Contraseña" placeholder="Contraseña">
			<div class="alert"><?php echo isset($alert)? $alert : '' ;?> </div>

			<Input type="submit" value="INGRESAR">
		</form>
	</section>
</body>
</html>