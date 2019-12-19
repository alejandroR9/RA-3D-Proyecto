<?php 



     if(empty($_SESSION['active']))
     {
	  header('location: ../');
     }




 ?>	
	<header>
		<div class="header">
			<h1>Sistema Realidad Aumentada</h1>
			<div  class="optionsBar">
				<p>Peru,<?php echo fechaC(); ?></p>
				<span>|</span>
				<span class="user"><?php echo $_SESSION['user'].'-'.$_SESSION['rol']; ?></span>
				<img class="photouser" src="img/user.png" alt="Usuario">
				<a href="Salir.php"><img class="close" src="img/Salir.png" alt="Salir del Sistema" title="Salir"></a>
			</div>
		</div>
		<?php include"nav.php";?>
	</header>
