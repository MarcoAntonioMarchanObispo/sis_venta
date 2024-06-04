<?php

	session_start();
	$alert = ' ';
	if(!empty($_SESSION['active']))
	{
		header ('location: sis_venta/sistema/');
	}else{

		if(!empty($_POST))
		{
			if(empty($_POST['usuario']) || empty ($_POST['clave']))
			{
				$alert = 'Ingrese su usuario y su Contraseña ';
			}else{

				require_once "conexion.php";

				$user = mysqli_real_escape_string($conexion,$_POST['usuario']);
				$pass = md5(mysqli_real_escape_string($conexion,$_POST['clave']));

				$query = mysqli_query($conexion,"SELECT * FROM usuario WHERE usuario = '$user' AND clave = '$pass'");
				$result = mysqli_num_rows($query);


					if($result > 0)
					{		
					
						$data = mysqli_fetch_array($query);
						$_SESSION['active'] = true;
						$_SESSION['idUser'] = $data['idusuario'];
						$_SESSION['nombre'] = $data['nombre'];
						$_SESSION['email'] =  $data['correo'];
						$_SESSION['user']  =  $data['usuario'];
						$_SESSION['rol']  =  $data['rol'];
				
						header('location: sistema/');
					}else{
					
						$alert = 'El usuario y la contraseña son incorrectos ';
						session_destroy();
					}
				
			}
		}
	}
?>


<?php
	if ($_POST){
		//Incrementamos el valor
		$conta = $_POST["conta"] + 1;
	}else{
		//Valor inicial
		$conta = 0;
	}
	$inte = ' Intentos ';
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login | Sistema Facturación</title>
	<link rel="stylesheet" type="text/css" href="style3.css"> 
</head>
<body>
	<section id="container">
			<div class="form-box">
            <div class="form-value">
                <form action="" method="post" autocomplete="off">
                    <h2>Iniciar sesión</h2>

					
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="text" name="usuario"  required> 
                        <label for="">Usuario</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="clave"  required>
                        <label for="">Contraseña</label>
                    </div>
		
					<div class="alert"><?php echo isset($alert)? $alert : '' ; ?> </div>
					<div class="alert"><?php echo isset($inte)? $inte : '' ; echo isset($conta)? $conta : '' ; ?> </div>

					<form name="f1" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
					<input type="hidden" name="conta" value="<?=$conta?>">
					<Input type="submit" value="INGRESAR">


					<?php 
						if($conta == 3 )
						{
							$_SESSION['block'] = true;
							header ('location: admin.php');
						}else{

						}	
						if(!empty($_SESSION['block']))
						{
							header ('location: admin.php');
						}else{

						}	
					?>
				</form>



		</form>
	</section>
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>