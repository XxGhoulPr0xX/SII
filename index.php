<!DOCTYPE HTML>
<html>

<title>SII</title>
<meta charset="utf-8" />
<meta name="SII" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="assets/css/main.css" />

<link type="text/css" rel="Stylesheet" href="assets/css/jquery.validity.css" />
<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/jquery.validity.js"></script>

<script type="text/javascript">
	$.validity.setup({
		outputMode: "label"
	});
	$(function() {
		$("#fstudents").validity(function() {
			$("#usuariostd")
				.require()
				.match("number")
				.nonHtml()
				.range(8100001, 9999999999, "número de control ínvalido");
			$("#passwordstd")
				.require()
				.match("number")
				.nonHtml()
				.range(1000, 9999, "el NIP debe de ser de 4 dígitos");
		});

		$("#fpersonal").validity(function() {
			$("#usuarioemp")
				.require()
				.nonHtml()
				.match(/^[A-Za-z0-9_-]{6,18}$/, "alfanuméricos ó max. 18 caracteres");
			$("#passwordemp")
				.require()
				.nonHtml()
				.match(/^[A-Za-z0-9_-]{6,18}$/, "alfanuméricos ó max. 18 caracteres");
		});

		$('#InsertarA').submit(function(event) {
			event.preventDefault(); // Evita que el formulario se envíe de forma convencional
			var nombre = $('#nombre').val().trim();
			var apellido = $('#apellido').val().trim();
			var edad = $('#edad').val().trim();
			var direccion = $('#direccion').val().trim();

			if (nombre === "" || apellido === "" || edad === "" || direccion === "") {
				alert('Por favor, complete todos los campos del formulario.');
				return;
			}
			var formData = $(this).serialize(); // Obtiene los datos del formulario
			$.ajax({
				type: 'POST',
				url: 'assets/php/controlador.php',
				data: formData,
				success: function(response) {
					alert(response);
				}
			});
		});
		$('#buscarA').submit(function(event) {
			event.preventDefault(); // Evita que el formulario se envíe de forma convencional
			var Buscar = $('#Buscar').val().trim();

			if (Buscar.length !== 9 || !/^\d+$/.test(Buscar)) {
				alert('Matricula Invalida');
				return;
			}
			var formData = $(this).serialize(); // Obtiene los datos del formulario
			$.ajax({
				type: 'POST',
				url: 'assets/php/controlador.php',
				data: formData,
				success: function(response) {
					alert(response);
				}
			});
		});
		$('#DeleteA').submit(function(event) {
			event.preventDefault(); // Evita que el formulario se envíe de forma convencional
			var Delete = $('#Eliminar').val().trim();
			if (Delete.length !== 9 || !/^\d+$/.test(Delete)) {
				alert('Matricula Invalida');
				return;
			}
			var formData = $(this).serialize(); // Obtiene los datos del formulario
			$.ajax({
				type: 'POST',
				url: 'assets/php/controlador.php',
				data: formData,
				success: function(response) {
					alert(response);
				}
			});
		});
		$('#ActualizarA').submit(function(event) {
			event.preventDefault(); // Evita que el formulario se envíe de forma convencional
			var Matricula = $('#Matricula').val().trim();
			var Domicilio = $('#Domicilio').val().trim();

			if (Matricula.length !== 9 || !/^\d+$/.test(Matricula) || Domicilio === "") {
				alert('Matricula Invalida');
				return;
			}
			var formData = $(this).serialize(); // Obtiene los datos del formulario
			$.ajax({
				type: 'POST',
				url: 'assets/php/controlador.php',
				data: formData,
				success: function(response) {
					alert(response);
				}
			});
		});
	});
</script>



<header>
	<!--  validar datos -->
	<h1 id="encabezadotec"><a> href="#"</a></h1>
</header>

<body>

	<!-- Wrapper ESTA ENVOLTURA CONTIENE EL RESTO DE LA ESTRUCTURA-->
	<div id="wrapper">

		<!-- Navegación del menú -->
		<nav id="nav">
			<a href="#inicio" class="icon fa-home active"><span>Inicio</span></a>
			<a href="#employer" class="icon fa-briefcase"><span>Personal</span></a>
			<a href="#student" class="icon fa-graduation-cap"><span>Estudiantes</span></a>
			<a href="#aspirantes" class="icon fa-users"><span>Aspirantes</span></a>
		</nav>

		<!-- Main -->
		<div id="main">

			<!-- INICIO -->
			<article id="inicio" class="panel">
				<header>
					<h1>SII</h1>
					<p>Sistema Integral de Información </p>
				</header>
				<a href="#student" class="jumplink pic">
					<span class="arrow icon  fa-play"></span>
					<!--<img src="images/me.png" alt=""  width="350" height= "230"  align="bottom"/> -->
				</a>
			</article>

			<!-- Administrativos, empleados o personal -->
			<article id="employer" class="panel">
				<header>
					<h2>Personal</h2>
				</header>
				<form action="indexenter.php" method="post" name="fpersonal" id="fpersonal">
					<div>
						<div class="row">
							<div class="6u 12u$(mobile)">
								<input type="text" id="usuarioemp" name="usuarioemp" placeholder="usuario" />
							</div>
							<div class="6u$ 12u$(mobile)">
								<input type="password" id="passwordemp" name="passwordemp" placeholder="Password" />
								<input type="hidden" id="tipoemp" name="tipoemp" value="p" />
							</div>
							<div class="12u$">
								<input type="submit" value="aceptar" />
							</div>
						</div>
					</div>
				</form>
			</article>

			<!-- LOG ON - Estudiantes -->
			<article id="student" class="panel">
				<header>
					<h2>Estudiantes</h2>
				</header>
				<form action="indexenter.php" method="post" name="fstudents" id="fstudents">
					<div>
						<div class="row">
							<div class="6u 12u$(mobile)">
								<input type="text" id="usuariostd" name="usuariostd" placeholder="usuario " />
							</div>
							<div class="6u$ 12u$(mobile)">
								<input type="password" id="passwordstd" name="passwordstd" placeholder="Password" />
								<input type="hidden" id="tipostd" name="tipostd" value="a" />
							</div>
							<div class="12u$">
								<input type="submit" value="aceptar" />
							</div>
						</div>
					</div>
				</form>
			</article>

			<!-- LOG ON - Estudiantes -->
			<article id="aspirantes" class="panel">
				<header>
					<h2>Aspirantes</h2>
				</header>

				<form method="post" name="InsertarA" id="InsertarA">
					<div>
						<header>
							<h3>Crear aspirantes</h3>
						</header>
						<div class="row">
							<div class="6u 12u$(mobile)">
								<input type="text" id="nombre" name="nombre" placeholder="nombre " />
							</div>
							<div class="6u 12u$(mobile)">
								<input type="text" id="apellido" name="apellido" placeholder="apellido " />
							</div>
							<div class="6u$ 12u$(mobile)">
								<input type="text" id="edad" name="edad" placeholder="edad" />
							</div>
							<div class="6u$ 12u$(mobile)">
								<input type="text" id="direccion" name="direccion" placeholder="direccion" />
							</div>
							<div class="12u$">
								<input type="submit" id="enviarDatos" name="submit" value="create">
							</div>
						</div>
					</div>
				</form>
				<br>

				<form method="post" name="buscarA" id="buscarA">
					<div>
						<header>
							<h3>Buscar aspirante</h3>
						</header>
						<div class="row">
							<div class="6u 12u$(mobile)">
								<input type="text" id="Buscar" name="Buscar" placeholder="Matricula" />
							</div>
							<div class="12u$">
								<input type="submit" name="read" value="read" />
							</div>
						</div>
					</div>
				</form>

				<br>
				<form method="post" name="ActualizarA" id="ActualizarA">
					<div>
						<header>
							<h3>Actualizar</h3>
						</header>
						<div class="row">
							<div class="6u 12u$(mobile)">
								<input type="text" id="Matricula" name="Matricula" placeholder="Matricula " />
							</div>
							<div class="6u$ 12u$(mobile)">
								<input type="text" id="Domicilio" name="Domicilio" placeholder="Domicilio" />
							</div>
							<div class="12u$">
								<input type="submit" name="update" value="update" />
							</div>
						</div>
					</div>
				</form>
				<br>
				<form method="post" name="DeleteA" id="DeleteA">
					<div>
						<header>
							<h3>Eliminar</h3>
						</header>
						<div class="row">
							<div class="6u 12u$(mobile)">
								<input type="text" id="Eliminar" name="Eliminar" placeholder="Matricula " />
							</div>
							<div class="12u$">
								<input type="submit" name="delete" value="delete" />
							</div>
						</div>
					</div>
				</form>
			</article>



		</div> <!-- FIN DEL WRAPPER -->

		<!-- Scripts -->
		<!--<script src="assets/js/jquery.min.js"></script>-->
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/skel-viewport.min.js"></script>
		<script src="assets/js/util.js"></script>
		<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
		<script src="assets/js/main.js"></script>

</body>
<footer>

	<!-- Footer -->
	<div id="footer">
		<ul class="copyright">
			<li>Sistema Integral de Información. &copy; IT-Tláhuac</li>
			<li>Centro de Cómputo</li>
		</ul>
	</div>
</footer>

</html>