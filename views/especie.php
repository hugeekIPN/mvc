<div class="container container-proveedor "onload="oCurrentValue.innerText = estado.isContentEditable;">
	<div class="form-group col-md-6 izq">
	        <div class="col-md-8 ">
	           <!-- <form action="" class="search-form">
	                <div class="form-group has-feedback">
	            		<input type="text" class="form-control" name="search" id="search" placeholder="Buscar...">
	              		<span class="glyphicon glyphicon-search form-control-feedback"></span>
	            	</div>
	            </form> -->
	        </div>
	        <div class="col-md-12 registros">
	        	<div class="cont">
					<table id="example" class="display" cellspacing="0" width="100%"" class="table-hover">
					   <thead>
					      <tr>
					      	 <th>ID</th>
					         <th>Especie</th>
					      </tr>
					   </thead>
					   <tbody>
                            <?php foreach ($especies as $especie): ?>  
					       <tr onclick="especies.verespecie(<?php echo $especie['id_especie']; ?>);">
					      	 <td><?php echo $especie['id_especie']; ?></td>
					         <td><?php echo $especie['descripcion']; ?></td>
					      </tr>
					     <?php endforeach; ?>  
					   </tbody>
					</table>
	        	</div>
	        </div>
		
	</div>
	<div class="form-group col-md-6 der">
                                        
		<div class="datos datos2 col-md-10">
			<div class="datos-bancarios col-md-10" >
                                                  
                <div class="input">
					<div id="mensajes-server"></div>
				</div>
                                             
			<form action="" id="formulario-especies">
					<div class="form-group has-warning">
					  <label class="control-label" for="inputIDEspecie">ID:</label>
					  <input required type="text" class="form-control" id="inputIDEspecie" disabled>
					</div>
					<div class="form-group">
					  <label class="control-label" for="inputDescripcionEspecie">Descripción:</label>
					  <textarea  class="form-control" id="inputDescripcionEspecie" cols="2" ></textarea>
					</div>
					

				</form>
				
                                                                                           
                  <div hidden id="datos-especies">
					<p><strong>ID</strong></p>		
					<p class="id-datos id" id="view-id-especie"></p>


					<p>Descripcion</p>
					<p id="view-descripcion-especie"></p>
				</div>                                                                         

			</div>
			
		</div>
		<div class="iconos col-md-2">
			<section class="nuevo">
				<button onclick="location.reload()" id="btn-add-especie">
					<img src="assets/iconos/Recurso 11.png" alt="Editar">
					<small >Nuevo</small>
				</button>
			</section>
			<section >
				<button onclick="especies.editespecie();" id="btn-edit">
					<img src="assets/iconos/Recurso 7.png" alt="Editar">
					<small >Editar</small>
				</button>
			</section>
			<section >
				<button id="btn-save" onclick="especies.add();">
					<img src="assets/iconos/Recurso 8.png" alt="Guardar">
					<small>Guardar</small>
				</button>
			</section>
			<section >
				<button id="btn-delete" onclick="especies.deleteespecie();">
					<img src="assets/iconos/Recurso 9.png" alt="Borrar">
					<small>Borrar</small>
				</button>
			</section>
			
		</div>
	</div>
</div>