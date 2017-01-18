
<!-- estilo con datatable de bootstrap -->

<table>
	<tr>
		<th>Id</th>
		<th>Nombre de usuario</th>
		<th>Acci&oacute;n</th>
		<th>Acci&oacute;n</th>
	</tr>

	<?php foreach ($users as $user): ?>
		<tr>
			<td><?php echo $user['usuarioId'] ?></td>
			<td><?php echo $user['username'] ?></td>
			<td><button onclick="usuarios.editUser(<?php echo $user['usuarioId']; ?>);">Editar</button></td>
			<td><button>Eliminar</button></td>
		</tr>
	<?php endforeach; ?>
	
</table>

<!-- fin datatable -->


<!-- Formulario para nuevo usuario -->

<br><br>
<button id="btn-add-user">Nuevo Usuario</button>
<div id="errores"></div>
<form id="form-add-usuario">
	<input type="hidden" name="idUsuario" id="idUsuario">
	<label for="username">Nombre de usuario</label>
	<input type="text" name="username" id="username">
	<label for="password">Password</label>
	<input type="password" name="password" id="password">
	<label for="password-confirm">Confirmar password</label>
	<input type="password" name="password-confirm" id="password-confirm">

	<input id="btn-submit" type="submit" value="Guardar">

</form>






