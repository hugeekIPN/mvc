
<div class="container col-xs-12 container-proveedor "onload="oCurrentValue.innerText = estado.isContentEditable;">
	<div class="form-group col-xs-6 izq">
	        
	        <div class="col-xs-12 registros">
	        	<div class="cont">
					<table id="example1" class="display" cellspacing="0" width="100%"" class="table-hover">
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
					     <?php endforeach;       
                            ?>
                                                                                                    
					   </tbody>
					</table>
	        	</div>
	        </div>
		
	</div>
	<div class="form-group col-xs-6 der">
                                        
		<div class="datos datos2 col-xs-10">
			<div class="datos-bancarios col-xs-10" >
                                                  
                <div class="input">
					<div id="mensajes-server"></div>
				</div>
                                             
			<form class="formulario" action="" id="formulario-especies">
					<div class="form-group ">
                                            
					  <input required type="hidden" class="form-contro titulos" id="inputIDEspecie" >
					</div>
					<div class="form-group datos2">
					  <label class="control-label titulos" for="inputDescripcionEspecie">Descripción:</label>
					  <textarea  class="form-control" id="inputDescripcionEspecie" cols="2" ></textarea>
					</div>
					

				</form>
				
                                                                                           
                  <div hidden id="datos-especies">
					<p class="titulos"><strong>ID</strong></p>		
					<p class="id-datos id" id="view-id-especie"></p>


					<p class="titulos">Descripcion</p>
					<p id="view-descripcion-especie"></p>
				</div>                                                                         

			</div>
			
		</div>
		<div class="iconos col-xs-2">
			<section class="nuevo">
				<button onclick="especies.verFormularioVacio()" id="btn-add-especie">
					<img src="assets/iconos/Recurso 11.png" alt="Editar">
					<small >Nuevo</small>
				</button>
			</section>
			<section >
				<button hidden onclick="especies.editespecie();" id="btn-edit">
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
				<button hidden id="btn-delete" onclick="especies.deleteespecie();">
					<img src="assets/iconos/Recurso 9.png" alt="Borrar">
					<small>Borrar</small>
				</button>
			</section>
			
		</div>
	</div>
</div>