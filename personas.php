<?php
session_start();

$nif = "";
$nombre = "";
$direccion = "";
$mensajeExito = "";
$mensajeError = "";

if (isset($_SESSION['mensaje'])) {
	$mensajeExito = $_SESSION['mensaje'];
	unset($_SESSION['mensaje']);
}
if (isset($_SESSION['error'])) {
	$mensajeError = $_SESSION['error'];
	unset($_SESSION['error']);
}

$mensajeBajasExito = "";
if (isset($_SESSION['mensaje2'])) {
	$mensajeBajasExito = $_SESSION['mensaje2'];
	unset($_SESSION['mensaje2']);
}

$personas = isset($_SESSION['personas']) ? $_SESSION['personas'] : [];

?>

<!DOCTYPE html>
<html>

<head>
	<title>PLA03</title>
	<meta charset='UTF-8'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="icon" href="data:,">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script type="text/javascript" src='js/scripts.js'></script>

</head>

<body>
	<main>
		<!-- Seccion titulo -->

		<h1 class='centrar'>PLA03: MANTENIMIENTO PERSONAS</h1>
		<br>

		<!-- Seccion rellenar formulario -->

		<form method='post' action='servicios/alta_persona.php'>
			<div class="row mb-3">
				<label for="nif" class="col-sm-2 col-form-label">Nif</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nif" name='nif'>
				</div>
			</div>
			<div class="row mb-3">
				<label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nombre" name="nombre">
				</div>
			</div>
			<div class="row mb-3">
				<label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="direccion" name="direccion">
				</div>
			</div>
			<label for="nombre" class="col-sm-2 col-form-label"></label>
			<button type="submit" class="btn btn-success" name='alta'>Alta persona</button>

			<?php if (!empty($mensajeExito)) : ?>
				<span class="ms-3 text-success fw-bold"><?= htmlspecialchars($mensajeExito) ?></span>
			<?php endif; ?>
		</form>

		<!-- Seccion donde se muestran los errores del formulario -->

		<?php if (isset($_SESSION['errores'])): ?>
			<div class="alert alert-danger mt-3">
				<ul class="mb-0">
					<?php foreach ($_SESSION['errores'] as $error): ?>
						<li><?= htmlspecialchars($error) ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php unset($_SESSION['errores']); ?>
		<?php endif; ?>

		<br>
		</form>
		<br>

		<!-- Seccion tabla imprimir personas -->

		<table class="table table-striped">
			<tr class='table-dark'>
				<th scope="col">NIF</th>
				<th scope="col">Nombre</th>
				<th scope="col">Dirección</th>
			</tr>

			<!-- Tabla donde imprimimos todos los usuarios registrados -->

			<?php foreach ($personas as $persona): ?>
				<tr>
					<td><?= htmlspecialchars($persona['nif']) ?></td>
					<!-- <td><input type='text' value='<?= htmlspecialchars($persona['nif']) ?>' class='nif'></td> -->
					<td><input type='text' value='<?= htmlspecialchars($persona['nombre']) ?>' class='nombre'></td>
					<td><input type='text' value='<?= htmlspecialchars($persona['direccion']) ?>' class='direccion'></td>
					<td>
						<form method='post' action='servicios/baja_persona.php'>
							<input type='hidden' name='nifBaja' value='<?= htmlspecialchars($persona['nif']) ?>'>
							<button type="submit" class="btn btn-warning" name='bajaPersona'>Baja</button>
						</form>
						<button onclick="transladarDatos(event)" type="button" class="btn btn-primary" name='modiPersona'>Modificar</button>

					</td>
				</tr>
			<?php endforeach; ?>
		</table>

		<!-- Mensaje para confirmar baja usuario -->

		<?php if (isset($_SESSION['mensaje_baja'])): ?>
			<span class="text-success fw-bold"><?= htmlspecialchars($_SESSION['mensaje_baja']) ?></span>
			<?php unset($_SESSION['mensaje_baja']); ?>
		<?php endif; ?>

		<!-- Mensaje para confirmar modificación -->

		<?php if (isset($_SESSION['mensaje_modi'])): ?>
			<span class="text-success fw-bold"><?= htmlspecialchars($_SESSION['mensaje_modi']) ?></span>
			<?php unset($_SESSION['mensaje_modi']); ?>
		<?php endif; ?>

		<!-- Boton y mensaje para borrar todos los datos de la tabla -->

		<form method='post' action='servicios/baja_personas.php' id='formularioBaja'>
			<input type='hidden' id='baja' name='baja'></input>
			<button type="submit" class="btn btn-danger" id='baja' name='baja'>Baja personas</button>
			<?php if (!empty($mensajeBajasExito)) : ?>
				<span class="ms-3 text-success fw-bold"><?= htmlspecialchars($mensajeBajasExito) ?></span>
			<?php endif; ?>
		</form>

		<!-- FORMULARIO OCULTO PARA LA MODIFICACION -->

		<form method='post' action='servicios/modificacion_persona.php' id='formularioModi'>
			<input type='hidden' name='nifModi' id='nifModi'>
			<input type='hidden' name='nombreModi' id='nombreModi'>
			<input type='hidden' name="direccionModi" id='direccionModi'>
			<input type='hidden' name="modificar">
		</form>
	</main>

</body>

</html>