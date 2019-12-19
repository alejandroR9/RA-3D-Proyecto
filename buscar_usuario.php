<?php 

	if ($_SESSION['rol'] !=1)
	 {
		header("location: ./");

		}

  include "../conexion.php";

  
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
	<title>Lista De Usuarios</title>
</head>
<body>
	<?php include"includes/header.php" ?>
	<section id="container">
		<?php 

			$busqueda = strtolower($_REQUEST['busqueda']);
			if (empty($busqueda))
			 {
				header("location: lista_usuario.php");
				// AQUIIIII CERRE CONEXION mysqli_close($conection);

			}

		?>


		<h1>Lista De Usuarios</h1>
		<a href="registro_usuario.php" class="btn_new">Crear usuario</a>

		<form action="buscar_usuario.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda;?>">
			<input type="submit" value="Buscar" class="btn_search">

		</form>


		<table>
			<tr>
				<th>UsuarioID</th>
				<th>Nombre</th>
				<th>Email</th>
				<th>Usuario</th>
				<th>Rol</th>
				<th>Acciones</th>
			</tr>
			<?php 
			//PAGINADOR 

			$Rol ='';
			if ($busqueda == 'administrador') 
			{
				$Rol = " OR Rol LIKE '%1%'";

			}else if ($busqueda == 'Docente'){

				$Rol = "OR Rol LIKE '%2%'";

			}else if($busqueda =='Alumno'){

				$Rol = "OR Rol LIKE '%3%'";
			}

			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) total_registro FROM Usuario 
													WHERE ( UsuarioID LIKE '%$busqueda%' OR 
																Nombre LIKE '%$busqueda%' OR
																 Email LIKE '%$busqueda%' OR 
																 Usuario LIKE '%$busqueda%' 
																 $Rol) 
															AND Estatus=1");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];


			$por_pagina = 4 ; 

			if (empty($_GET['pagina'])) {

				$pagina=1;

				# code...
			}else{
				$pagina=$_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);


			$query = mysqli_query($conection,"SELECT u.UsuarioID , u.Nombre,u.Email,u.Usuario,r.Rol FROM Usuario u INNER JOIN Rol r ON u.Rol= r.RolID 
											WHERE 
											( u.UsuarioID LIKE '%$busqueda%' OR 
												u.Nombre LIKE '%$busqueda%' OR
												 u.Email LIKE '%$busqueda%' OR 
												 u.Usuario LIKE '%$busqueda%' OR
												 u.Rol LIKE '%$busqueda%')

											AND 
											Estatus = 1 ORDER BY u.UsuarioID ASC LIMIT $desde,$por_pagina
				");
			// AQUIIIII CERRE CONEXION mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if ($result > 0) {
				# code...
				while ($data = mysqli_fetch_array($query)) {
					# code...
			

            ?>

			    <tr>
				 <td><?php  echo $data["UsuarioID"]; ?></td>
				 <td><?php  echo $data["Nombre"]; ?></td>
				 <td><?php  echo $data["Email"];?></td>
				 <td><?php  echo $data["Usuario"];?></td>
				 <td><?php  echo $data["Rol"]; ?></td>
				 <td>
					<a class="link_edit" href="editar_usuario.php?id=<?php  echo $data["UsuarioID"]; ?>">Editar</a>
					<?php if($data["UsuarioID"]!=1){ ?>
					|
					<a class="link_delete" href="eliminar_confirmar_usuario.php?id=<?php  echo $data["UsuarioID"]; ?>">Eliminar</a>

				<?php } ?>

				</td>

			</tr>

		  <?php
		    
		       }
			      }



			?>

		</table>

		<?php 

		if ($total_registro != 0) {
		
		?>


		<div class="paginador">
			<ul>
		<?php 
				if ($pagina !=1)
				 {
					
				
				 ?>

				<li><a href="?pagina=<?php echo 1;  ?>&busqueda=<?php echo $busqueda; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>&busqueda<?php echo $busqueda; ?>"><<</a></li>
				<?php  

				}

				for ($i=1; $i <= $total_paginas; $i++) { 

					if ($i == $pagina) {

						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
					}
					
				}
				if ($pagina !=$total_paginas) 

				{

				?>

					<li><a href="?pagina=<?php echo  $pagina + 1; ?>&busqueda=<?php echo $busqueda; ?>">>></a></li>
					<li><a href="?pagina=<?php echo $total_paginas; ?>&busqueda=<?php echo $busqueda; ?>">>|</a></li>

				<?php } ?>

			</ul>
		</div>
		<?php } ?>
    </section>
	

     <?php include"includes/footer.php" ?>

</body>
</html>
