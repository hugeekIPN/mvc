<div class="container container-proveedor "onload="oCurrentValue.innerText = estado.isContentEditable;">
	<div class="form-group col-md-6 izq">
	       
	        <div class="col-md-12 registros">
	        	<div class="cont">
					<table id="example" class="display" cellspacing="0" >
					   <thead>
					      <tr>
					      	 <th>ID</th>
					         <th>Nombre</th>
					      </tr>
					   </thead>
					   <tbody>
<<<<<<< HEAD
					       <tr>
					      	 <td><a href="#">60</a></td>
					         <td><a href="#" >Bicicletas para los atletas</a></td>
					      </tr>
					      <tr>
					      	 <td><a href="#">21</a></td>
					         <td><a href="#" >Dibujando sonrisas</a></td>
					      </tr>
					       <tr>
					      	 <td><a href="#">60</a></td>
					         <td><a href="#" >Bicicletas para los atletas</a></td>
					      </tr>
					      <tr>
					      	 <td><a href="#">21</a></td>
					         <td><a href="#" >Dibujando sonrisas</a></td>
					      </tr>
					       <tr>
					      	 <td><a href="#">60</a></td>
					         <td><a href="#" >Bicicletas para los atletas</a></td>
					      </tr>
					      <tr>
					      	 <td><a href="#">21</a></td>
					         <td><a href="#" >Dibujando sonrisas</a></td>
					      </tr>
					       <tr>
					      	 <td><a href="#">60</a></td>
					         <td><a href="#" >Bicicletas para los atletas</a></td>
					      </tr>
					      <tr>
					      	 <td><a href="#">21</a></td>
					         <td><a href="#" >Dibujando sonrisas</a></td>
					      </tr>
					       <tr>
					      	 <td><a href="#">60</a></td>
					         <td><a href="#" >Bicicletas para los atletas</a></td>
					      </tr>
					      <tr>
					      	 <td><a href="#">21</a></td>
					         <td><a href="#" >Dibujando sonrisas</a></td>
					      </tr>
					       <tr>
					      	 <td><a href="#">60</a></td>
					         <td><a href="#" >Bicicletas para los atletas</a></td>
					      </tr>
					      <tr>
					      	 <td><a href="#">21</a></td>
					         <td><a href="#" >Dibujando sonrisas</a></td>
					      </tr>
					       <tr>
					      	 <td><a href="#">60</a></td>
					         <td><a href="#" >Bicicletas para los atletas</a></td>
					      </tr>
					      <tr>
					      	 <td><a href="#">21</a></td>
					         <td><a href="#" >Dibujando sonrisas</a></td>
					      </tr>
					      					      <tr>
					      	 <td><a href="#">21</a></td>
					         <td><a href="#" >Dibujando sonrisas</a></td>
					      </tr>
					      					      <tr>
					      	 <td><a href="#">21</a></td>
					         <td><a href="#" >Dibujando sonrisas</a></td>
					      </tr>					      <tr>
					      	 <td><a href="#">21</a></td>
					         <td><a href="#" >Dibujando sonrisas</a></td>
					      </tr>
					      					      <tr>
					      	 <td><a href="#">21</a></td>
					         <td><a href="#" >Dibujando sonrisas</a></td>
					      </tr>
					      
=======
					   		<?php foreach ($subprogramas as $subprograma): ?>
					   		<tr onclick="subprogramas.verPrograma(<?php echo $subprograma['id_subprograma']; ?>);">
					   			<td> <?php echo $subprograma['id_subprograma']; ?>
					   			</td>

					   			<td>
					   				<?php echo $subprograma['nombre']; ?>
					   			</td>
					   		</tr>	
					   		<?php endforeach ?>
>>>>>>> a5780440509a4e74a037e406778e73da164cb0ff
					   </tbody>
					</table>
	        	</div>
	        </div>
		
	</div>

	<!-- contenedor derecho -->
	<div class="form-group col-md-6 der">

		<!-- contenedor formulario y visualizacion de datos en texto plano  -->
		<div class="datos datos2 col-md-10 eventos">
			

				<div class="input">
					<div id="mensajes-server"></div>
				</div>
				
				<!-- formulario -->
				<form id="formulario-subprogramas">
					<input type="hidden" name="id-subprograma" id="id-subprograma">

					<div class="input form-group">
					  <label class="control-label" for="inputNombreProgramas">Nombre:</label>
					  <input required type="text" class="form-control" id="inputNombreProgramas">
					</div>
					<div class="input form-group">
					  <label class="control-label" for="inputDescripcionProgramas">Descripción:</label>
					  <textarea  class="form-control" id="inputDescripcionProgramas" cols="2" ></textarea>
					</div>

				</form>
				<!-- fin formulario -->

				<!-- datos a mostrar en texto plano -->
				<div hidden id="datos-subprogramas">
					<p><strong>ID</strong></p>		
					<p class="id-datos id" id="view-id-subprograma"></p>

					<p>Nombre</p>	
					<p id="view-nombre-subprograma"></p>

					<p>Descripcion</p>
					<p id="view-descripcion-subprograma"></p>
				</div>
				<!-- fin datos a mostrar para subprogramas -->					
		</div>
		<!-- fin contenedor formulario y datos -->

		<!-- contenedor iconos -->
		<div class="iconos col-md-2">
			<section class="nuevo">
				<button id="btn-add-subprograma" onclick="location.reload();">
					<img src="assets/iconos/Recurso 11.png" alt="Editar">
					<small >Nuevo</small>
				</button>
			</section>
			<section >
				<button onclick="subprogramas.editPrograma();" hidden id="btn-edit">
					<img src="assets/iconos/Recurso 7.png" alt="Editar">
					<small >Editar</small>
				</button>
			</section>
			<section >
				<button id="btn-save" onclick="subprogramas.add();"  >
					<img src="assets/iconos/Recurso 8.png" alt="Guardar">
					<small>Guardar</small>
				</button>
			</section>
			<section >
				<button onclick="subprogramas.deletePrograma();" hidden id="btn-delete">
					<img src="assets/iconos/Recurso 9.png" alt="Borrar">
					<small>Borrar</small>
				</button>
			</section>
			
		</div>
	</div>
</div>