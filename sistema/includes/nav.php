<nav>
			<ul>
				<li><a href="#">INICIO</a></li>
			<?php 
				if ($_SESSION['rol'] == 1) {

				 ?>
				<li class="principal">
					<a href="#">Usuarios</a>
					<ul>
						<li><a href="registro_usuario.php">Nuevo Usuarios</a></li>
						<li><a href="lista_usuarios.php">Lista De Usuarios</a></li>
					</ul>
				</li>

			<?php } ?>
				<li class="principal">
					<a href="#">Alumnos</a>
					<ul>
						<li><a href="">Nuevo Alumno</a></li>
						<li><a href="#">Lista De Alumno</a></li>
					</ul>
				</li>
				<li class="principal">
					<a href="#">Docentes</a>
					<ul>
						<li><a href="#">Nuevo Docente</a></li>
						<li><a href="#">Lista De Docentes</a></li>
					</ul>
				</li>
				<li class="principal">
					<a href="#">Areas</a>
					<ul>
						<li><a href="#">Nueva Area</a></li>
						<li><a href="#">Lista De Areas</a></li>
					</ul>
				</li>
				<li class="principal">
					<a href="#">Temas</a>
					<ul>
						<li><a href="#">Nuevo Tema</a></li>
						<li><a href="#">Lista De Temas</a></li>
					</ul>
				</li>
			</ul>
		</nav>