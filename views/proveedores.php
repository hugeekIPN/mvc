
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
					         <th>Registros</th>
					      </tr>
					   </thead>
					   <tbody>
                                                                                                         
                         <?php foreach ($proveedores as $proveedor): ?>
					      <tr onclick="Proveedores.verProveedor(<?php echo $proveedor['id_proveedor']; ?>);">
					      	 <td><?php echo $proveedor['id_proveedor'] ?></td>
					         <td><?php echo $proveedor['razon_social'] ?></td>
					      </tr>	             
                         <?php endforeach; ?>                 
                                             
					   </tbody>
					</table>
	        	</div>
	        </div>
		
	</div>
	<div class="form-group col-md-6 der">
		<div class="datos col-md-10">
			<div class="datos-bancarios col-md-6" >
				<form class="formulario" action="" id="Proveedores">
					<div class="form-group ">
					  <input required type="hidden" class="form-control" id="inputIDProveedores">
					</div>
                     <div class="form-group">
					  <label class="control-label" for="inputTipoProveedores">Tipo:</label>
					  <select id="inputTipoProveedores" name="inputTipoProveedores">
                          <option value="" selected="selected">- selecciona -</option>
                          <option value="1">Proveedor</option>
                          <option value="2">Donatario</option>
                        </select>
					</div>                                                                           
					<div class="form-group">
					  <label class="control-label" for="inputRazonProveedores">Razón Social:</label>
					  <input required type="text" class="form-control" id="inputRazonProveedores">
					</div>
					<h3>Datos Bancarios</h3>
					<div class="form-group">
					  <label class="control-label" for="inputRFCProveedores">RFC:</label>
					  <input required type="text" class="form-control" id="inputRFCProveedores">
					</div>
					<div class="form-group ">
					  <label class="control-label" for="inputCuentaProveedores">Cuenta:</label>
					  <input required type="text" class="form-control" id="inputCuentaProveedores">
					</div>
					<div class="form-group ">
					  <label class="control-label" for="inputBancoProveedores">Banco:</label>
					  <input required type="text" class="form-control" id="inputBancoProveedores">
					</div>
					<div class="form-group ">
					  <label class="control-label" for="inputSucursalProveedores">Sucursal:</label>
					  <input required type="text" class="form-control" id="inputSucursalProveedores">
					</div>
                    <div class="form-group ">
					  <label class="control-label" for="inputPlazaProveedores">Plaza:</label>
					  <input required type="text" class="form-control" id="inputPlazaProveedores">
					</div>                                                                                
					
					<div class="form-group ">
					  <label class="control-label" for="inputReferenciaProveedores">Referencia:</label>
					  <input  type="text" class="form-control" id="inputReferenciaProveedores">
					</div>
                                                                                              
				</form>
                 
                <div hidden id="vista-datos" >
                    <p ><strong>ID</strong></p>
                    <p class="id-datos id" id="vista-id"><strong></strong></p>
                    <p>Tipo:</p>
                    <p id="vista-tipo"></p>               
                    <p>Razón social</p>
                    <p id="vista-razon"></p>
                    <p>Datos Bancarios</p>
                    <p>RFC</p>
                    <p id="vista-rfc"></p>
                    <p>Cuenta</p>            
                    <p id="vista-cuenta"></p>
                    <p>Banco</p>
                    <p id="vista-banco"></p>
                    <p>Sucursal</p>
                    <p id="vista-sucursal"></p>
                    <p>Plaza</p>
                    <p id="vista-plaza"></p>
                    <p>Referencia</p>
                    <p id="vista-referencia"></p>
			     </div>         
                                            
			</div>
			<div class="datos-generales col-md-6" >
                                                 
				<div class="input">
					<div id="mensajes-server"></div>
				</div>
                                             
				<h3>Datos Generales</h3>
				<form action="" id="ProveedoresDos">
                     <div class="form-group ">
					  <label class="control-label" for="inputColoniaProveedores">Colonia:</label>
					  <input required type="text" class="form-control" id="inputColoniaProveedores">
					</div>                              
					<div class="form-group ">
					  <label class="control-label" for="inputCalleYNumeroProveedores">Calle y Número:</label>
					  <input required type="text" class="form-control" id="inputCalleYNumeroProveedores">
					</div>
					<div class="form-group">
					  <label class="control-label" for="inputDelegacionYMunicipioProveedores">Delegacion Y Municipio:</label>
					  <input required type="text" class="form-control" id="inputDelegacionYMunicipioProveedores">
					</div>
					<div class="form-group">
					  <label class="control-label" for="inputPaisProveedores">País:</label>
					  <input required type="text" class="form-control" id="inputPaisProveedores">
					</div>
					<div class="form-group ">
					  <label class="control-label" for="inputEstadoProveedores">Estado:</label>
					  <input required type="text" class="form-control" id="inputEstadoProveedores">
					</div>
					<div class="form-group ">
					  <label class="control-label" for="inputCodigoPostalProveedores">Código Postal:</label>
					  <input required type="text" class="form-control" id="inputCodigoPostalProveedores">
					</div>
                    <div class="form-group ">
					  <label class="control-label" for="inputContactoNombreProveedores">Contacto:</label>
					  <input type="text" class="form-control" id="inputContactoNombreProveedores">
					</div>
                                                                                                                                   
					<div class="form-group ">
					  <label class="control-label" for="inputContactoProveedores">Email:</label>
					  <input required type="email" class="form-control" id="inputContactoProveedores" placeholder="usuario@fundacion.com">
					</div>
                                                                                                                                         
					<div class="form-group ">
					  <label class="control-label" for="inputNumeroProveedores">Teléfono:</label>
					  <input  type="text" class="form-control" id="inputNumeroProveedores">
					</div>

				</form>
                
                <div hidden id="vista-datos2" >
                    <p >Colonia</p>
                    <p id="vista-colonia"></p>
                    <p >Calle y Número</p>
                    <p id="vista-calle"></p>
                    <p>Delegación y Municipio</p>
                    <p id="vista-delega"></p>
                    <p>País</p>
                    <p id="vista-pais"></p>
                    <p>Estado:</p>            
                    <p id="vista-entidad"></p>
                    <p>Código Postal:</p>
                    <p id="vista-cp"></p>
                    <p>Contacto:</p>
                    <p id="vista-contacto"></p>
                    <p>Email:</p>
                    <p id="vista-correo"></p>
                    <p>Teléfono</p>
                    <p id="vista-numero"></p>
			     </div>         
                                                                                          
			</div>
		</div>
		<div class="iconos col-md-2">
			<section class="nuevo">

				<button onclick="location.reload();">
					<img src="assets/iconos/Recurso 11.png" alt="Editar">

					<small >Nuevo</small>
				</button>
			</section>
			<section >
				<button hidden onclick="Proveedores.editproveedor();" id="btn-edit-user">
					<img src="assets/iconos/Recurso 7.png" alt="Editar">
					<small >Editar</small>
				</button>
			</section>
			<section >
				<button onclick="Proveedores.addproveedor();" id="btn-add-proveedor">
					<img src="assets/iconos/Recurso 8.png" alt="Guardar">
					<small>Guardar</small>
				</button>
			</section>
			<section >
				<button hidden onclick="Proveedores.deleteproveedor();" id="btn-delete-proveedor">
					<img src="assets/iconos/Recurso 9.png" alt="Borrar">
					<small>Borrar</small>
				</button>
			</section>
			
		</div>
	</div>
</div>
