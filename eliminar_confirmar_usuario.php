<?php 

	if ($_SESSION['rol'] !=1)
	 {
		header("location: ./");

		}
	
	include "../conexion.php";

	if(!empty($_POST))

	{ 
		//ESTO SE AGREGO ULTIMO XD 
		if($_POST['UsuarioID'] == 1 ){

			header("location: lista_usuarios.php");
// AQUIIIII CERRE CONEXION mysqli_close($conection);			exit;

		}

		$usuarioid = $_POST['UsuarioID'];

		//$query_delete = mysqli_query($conection,"DELETE FROM Usuario WHERE UsuarioID = $usuarioid");
		$query_delete = mysqli_query($conection,"UPDATE Usuario SET Estatus = 0 WHERE UsuarioID = $usuarioid");
	// AQUIIIII CERRE CONEXION mysqli_close($conection);


		if ($query_delete) {
			
			header("location: lista_usuarios.php");

		}else{
			echo "Error al Eliminar";
		}
	}

	if (empty($_REQUEST['id']) || $_REQUEST['id'] == 1 ) 
	{
			
 		header("location: lista_usuarios.php");
 		// AQUIIIII CERRE CONEXION mysqli_close($conection);


	}else{
		

		$usuarioid = $_REQUEST['id'];

		$query = mysqli_query($conection,"SELECT U.Nombre,u.Usuario,r.Rol
											FROM Usuario u
											INNER JOIN 
											Rol r 
											ON u.Rol= r.RolID
											WHERE u.UsuarioID = $usuarioid ");
		// AQUIIIII CERRE CONEXION mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0 ){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$nombre = $data['Nombre'];
				$user = $data['Usuario'];
				$rol = $data['Rol'];
			}
		}else{
			header("location: lista_usuarios.php");
		}

	}






?>





<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
	<title>Eliminar Usuario</title>
</head>
<body>
	<?php include"includes/header.php" ?>
	<section id="container">
		<div class="data_delete">
			<h2> ¿Estas Seguro de ELIMINAR Ctm el Siguiente Registro?</h2>
			<p>Nombre: <span><?php echo $nombre; ?></span></p>
			<p>Usuario: <span><?php echo $user; ?></span></p>
			<p>Tipo Usuario: <span><?php echo $rol; ?></span></p>

			<form method="post" action="">

				<input type="hidden" name="UsuarioID" value="<?php echo $usuarioid; ?>">	
				<a href="lista_usuarios.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>




		</div>




    </section>
     <?php include"includes/footer.php" ?>

</body>
</html>
