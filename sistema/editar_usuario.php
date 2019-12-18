<?php  

  if ($_SESSION['rol'] !=1)
   {
    header("location: ./");

    }

   include "../conexion.php";

   if (!empty($_POST)) 
   {
   
   	$alert='';
   	if (empty($_POST['Nombre']) || empty($_POST['Email']) ||empty($_POST['Usuario']) || empty($_POST['Rol'])) 
   	{
   		$alert='<p class="msg_error">Todos los Campos son Obligatorios Ctm.</p>';
   	}else{
   		
      $usuarioid = $_POST['UsuarioID'];
   		$nombre = $_POST['Nombre'];
   		$email  = $_POST['Email'];
   		$user   = $_POST['Usuario'];
   		$pass   = md5($_POST['Password']);
   		$rol    =$_POST['Rol'];



   		$query = mysqli_query($conection," SELECT * FROM  Usuario 
                                                 WHERE  (Usuario = '$user' AND UsuarioID != $usuarioid ) 
                                                 OR (Email ='$email' AND UsuarioID != $usuarioid)");
   	  $result = mysqli_fetch_array($query);

   		if ($result > 0) {

   			$alert='<p class="msg_error">El Correo o Usuario ya Existen Ctm :V.</p>';
   		}else{

        if (empty($_POST['Password']))
         {

          $sql_update = mysqli_query($conection,"UPDATE Usuario

                                                SET Nombre = '$nombre', Email = '$email',Usuario='$user',Rol='$rol'
                                                WHERE UsuarioID = $usuarioid");

          
        }else{
          $sql_update = mysqli_query($conection,"UPDATE Usuario

                                                SET Nombre = '$nombre', Email = '$email',Usuario='$user',Password = '$pass',Rol='$rol'
                                                WHERE UsuarioID = $usuarioid");


        }


   			if($sql_update){

   			 $alert='<p class="msg_save">Usuario Actualizado Correctamente Ctm :3.</p>';

   			}else{
   				$alert='<p class="msg_error">Error al Actualizar el Usuario  Ctm ;).</p>';
   			}
   		}

   	}
   // AQUIIIII CERRE CONEXION mysqli_close($conection);
   }
  
   //Mostrar Datos

   if (empty($_GET['id'])) {
   
     header('Location: lista_usuarios.php');
     // AQUIIIII CERRE CONEXION mysqli_close($conection);
   }
   $iduser = $_GET['id'];
   $sql = mysqli_query($conection,"SELECT u.UsuarioID,u.Nombre,u.Email,u.Usuario,(u.Rol) as RolID,(r.Rol) as Rol

                                            FROM Usuario u 
                                            INNER JOIN Rol r
                                            on u.Rol = r.RolID
                                            WHERE UsuarioID=$iduser");
   // AQUIIIII CERRE CONEXION mysqli_close($conection);

   $result_sql = mysqli_num_rows($sql);

   if ($result_sql == 0) {
     header('Location: lista_usuarios.php');


   }else{
      $option ='';

     while ($data = mysqli_fetch_array($sql)) {
       # code...

      $iduser = $data['UsuarioID'];
      $nombre = $data['Nombre'];
      $email = $data['Email'];
      $usuario = $data['Usuario'];
      $rolid = $data['RolID'];
      $rol = $data['Rol'];

      if ($rolid ==1 ) {
        $option = '<option value="'.$rolid.'"select>'.$rol.'</option>';
      }elseif ($rolid ==2) {
          $option = '<option value="'.$rolid.'"select>'.$rol.'</option>';
      }elseif ($rolid ==3) {
          $option = '<option value="'.$rolid.'"select>'.$rol.'</option>';
         
      }




     }
   } 



?>

<!DOCTYPE html>
<html lang="en">

<head>
  
	<meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
	<title>Actualizar Usuario</title>
</head>
<body>
	<?php include"includes/header.php" ?>
	<section id="container">
          <div class="form_register"> 
          	<h1>Actualizar Usuario</h1>
          	<hr>
          	<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

          	<form action="" method="post">
              <input type="hidden" name="UsuarioID" value="<?php echo $iduser; ?>">

          		<label for="Nombre">Nombre</label>
          		<input type="text" name="Nombre" id="Nombre" placeholder="Nombre Completo" value="<?php echo $nombre; ?>">  
          		<label for="Email">Email</label>
          		<input type="text" name="Email" id="Email" placeholder="Email" value="<?php echo $email; ?>">
          		<label for="Usuario">Usuario</label>
          		<input type="text" name="Usuario" id="Usuario" placeholder="Usuario" value="<?php echo $usuario; ?>">
          		<label for="Password">Password</label>
          		<input type="text" name="Password" id="Password" placeholder="Password de acceso"rol>Tipo Usuario</label>

          		<?php  
               //include "../conexion.php";
          		$query_rol = mysqli_query($conection,"SELECT*FROM Rol");
      // AQUIIIII CERRE CONEXION mysqli_close($conection);
          		$result_rol = mysqli_num_rows($query_rol);

          		?>

          		<select name="Rol" id="Rol" class="notItemOne">
          			<?php
                  echo $option;

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
          		<input type="submit" value="Actualizar Usuario" class="btn_save">


          	</form>




          </div>



    </section>
	

     <?php include"includes/footer.php" ?>

</body>
</html>
