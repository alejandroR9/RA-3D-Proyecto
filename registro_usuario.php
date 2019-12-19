<?php  

   include "../conexion.php";

   if (!empty($_POST)) 
   {
   
   	$alert='';
   	if (empty($_POST['Nombre']) || empty($_POST['Email']) ||empty($_POST['Usuario']) ||empty($_POST['Password']) || empty($_POST['Rol'])) 
   	{
   		$alert='<p class="msg_error">Todos los Campos son Obligatorios Ctm.</p>';
   	}else{
   		

   		$nombre = $_POST['Nombre'];
   		$email  = $_POST['Email'];
   		$user   = $_POST['Usuario'];
   		$pass   = md5($_POST['Password']);
   		$rol    =$_POST['Rol'];



   		$query = mysqli_query($conection," SELECT * FROM  Usuario WHERE  Usuario = '$user' OR Email ='$email'");
   		$result = mysqli_fetch_array($query);

   		if ($result > 0) {

   			$alert='<p class="msg_error">El Correo o Usuario ya Existen Ctm :V.</p>';
   		}else{

   			$query_insert = mysqli_query($conection,"INSERT INTO Usuario(Nombre,Email,Usuario,Password,Rol)

   			                                                    VALUES ('$nombre','$email','$user','$pass','$rol ')");

   			if($query_insert){

   			 $alert='<p class="msg_save">Usuario creado Correctamente Ctm :3.</p>';

   			}else{
   				$alert='<p class="msg_error">Error al Crear el Usuario  Ctm ;).</p>';
   			}
   		}

   	}

   }




?>






<!DOCTYPE html>
<html lang="en">

<head>
  
	<meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
	<title>Registro Usuario</title>
</head>
<body>
	<?php include"includes/header.php" ?>
	<section id="container">
          <div class="form_register"> 
          	<h1>Registro Usuario</h1>
          	<hr>
          	<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

          	<form action="" method="post">
          		<label for="Nombre">Nombre</label>
          		<input type="text" name="Nombre" id="Nombre" placeholder="Nombre Completo">
          		<label for="Email">Email</label>
          		<input type="text" name="Email" id="Email" placeholder="Email">
          		<label for="Usuario">Usuario</label>
          		<input type="text" name="Usuario" id="Usuario" placeholder="Usuario">
          		<label for="Password">Password</label>
          		<input type="text" name="Password" id="Password" placeholder="Password de acceso">
          		<label for="rol">Tipo Usuario</label>

          		<?php  

          		$query_rol = mysqli_query($conection,"SELECT*FROM Rol");
          		$result_rol = mysqli_num_rows($query_rol);

          		?>

          		<select name="Rol" id="Rol">
          			<?php
          			if ($result_rol > 0 ) {

          			while ( $rol = mysqli_fetch_array($query_rol)) {
          			?>

          			       <option value="<?php echo $rol["RolID"];  ?>"><?php echo $rol["Rol"]?></option>
          			<?php 
          		}

          		} 
          			 ?>
          			
          			
          			<option value="2">Docente</option>
          			<option value="3">Alumno</option>

          		</select>
          		<input type="submit" value="Crear Usuario" class="btn_save">


          	</form>




          </div>



    </section>
	

     <?php include"includes/footer.php" ?>

</body>
</html>
