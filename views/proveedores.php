
<div class="container col-md-12 container-proveedor "onload="oCurrentValue.innerText = estado.isContentEditable;">
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
					<table id="example4" class="display" cellspacing="0" width="100%"" class="table-hover">
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
					  <label class="control-label titulos" for="inputTipoProveedores">Tipo:</label>
					  <select class="control-select form-control" id="inputTipoProveedores" name="inputTipoProveedores">
                          <option value="" selected="selected">- selecciona -</option>
                          <option value="1">Proveedor</option>
                          <option value="2">Donatario</option>
                        </select>
					</div>                                                                           
					<div class="form-group">
					  <label class="control-label titulos" for="inputRazonProveedores">Razón Social:</label>
					  <input required type="text" class="form-control" id="inputRazonProveedores">
					</div>
					<h3>Datos Bancarios</h3>
					<div class="form-group">
					  <label class="control-label titulos" for="inputRFCProveedores">RFC:</label>
					  <input required type="text" class="form-control" id="inputRFCProveedores">
					</div>
					<div class="form-group ">
					  <label class="control-label titulos" for="inputCuentaProveedores">Cuenta:</label>
					  <input required type="text" class="form-control" id="inputCuentaProveedores">
					</div>
					<div class="form-group ">
					  <label class="control-label titulos" for="inputBancoProveedores">Banco:</label>
					  <input required type="text" class="form-control" id="inputBancoProveedores">
					</div>
					<div class="form-group ">
					  <label class="control-label titulos" for="inputSucursalProveedores">Sucursal:</label>
					  <input required type="text" class="form-control" id="inputSucursalProveedores">
					</div>
                    <div class="form-group ">
					  <label class="control-label titulos" for="inputPlazaProveedores">Plaza:</label>
					  <input required type="text" class="form-control" id="inputPlazaProveedores">
					</div>                                                                                
					
					<div class="form-group ">
					  <label class="control-label" for="inputReferenciaProveedores">Referencia:</label>
					  <input  type="text" class="form-control" id="inputReferenciaProveedores">
					</div>
                                                                                              
				</form>
                 
                <div hidden id="vista-datos" >
                    <p  class="titulos"><strong>ID</strong></p>
                    <p class="id-datos id" id="vista-id"><strong></strong></p>
                    <p class="titulos"><strong>Tipo:</strong></p>
                    <p id="vista-tipo"></p>               
                    <p class="titulos"><strong>Razón social</strong></p>            
                    <p id="vista-razon"></p>
                    <h3>Datos Bancarios</h3>
                    <p class="titulos"><strong>RFC</strong></p>
                    <p id="vista-rfc"></p>
                    <p class="titulos"><strong>Cuenta</strong></p>            
                    <p id="vista-cuenta"></p>
                    <p class="titulos"><strong>Banco</strong></p>
                    <p id="vista-banco"></p>
                    <p class="titulos"><strong>Sucursal</strong></p>
                    <p id="vista-sucursal"></p>
                    <p class="titulos"><strong>Plaza</strong></p>
                    <p id="vista-plaza"></p>
                    <p class="titulos"><strong>Referencia</strong></p>
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
					  <label class="control-label titulos" for="inputCalleYNumeroProveedores">Calle y Número:</label>
					  <input required type="text" class="form-control" id="inputCalleYNumeroProveedores">
					</div>
                   <div class="form-group ">
					  <label class="control-label titulos" for="inputColoniaProveedores">Colonia:</label>
					  <input required type="text" class="form-control" id="inputColoniaProveedores">
					</div>                              
					<div class="form-group">
					  <label class="control-label titulos" for="inputDelegacionYMunicipioProveedores">Delegación y Municipio:</label>
					  <input required type="text" class="form-control" id="inputDelegacionYMunicipioProveedores">
					</div>
                     <div class="form-group ">
					  <label class="control-label titulos" for="inputEstadoProveedores">Estado:</label>
                                                                                       
                        <select name="state" class="form-control" id="inputEstadoProveedores">
                        <option value="Aguascalientes">Aguascalientes</option>
                        <option value="Baja California">Baja California</option>
                        <option value="Baja California Sur">Baja California Sur</option>
                        <option value="Campeche">Campeche</option>
                        <option value="Chiapas">Chiapas</option>
                        <option value="Chihuahua">Chihuahua</option>
                        <option value="Coahuila">Coahuila</option>
                        <option value="Colima">Colima</option>
                        <option value="Ciudad de México" selected>Ciudad de México</option>
                        <option value="Durango">Durango</option>
                        <option value="Estado de México">Estado de México</option>
                        <option value="Guanajuato">Guanajuato</option>
                        <option value="Guerrero">Guerrero</option>
                        <option value="Hidalgo">Hidalgo</option>
                        <option value="Jalisco">Jalisco</option>
                        <option value="Michoacán">Michoacán</option>
                        <option value="Morelos">Morelos</option>
                        <option value="Nayarit">Nayarit</option>
                        <option value="Nuevo León">Nuevo León</option>
                        <option value="Oaxaca">Oaxaca</option>
                        <option value="Puebla">Puebla</option>
                        <option value="Querétaro">Querétaro</option>
                        <option value="Quintana Roo">Quintana Roo</option>
                        <option value="San Luis Potosí">San Luis Potosí</option>
                        <option value="Sinaloa">Sinaloa</option>
                        <option value="Sonora">Sonora</option>
                        <option value="Tabasco">Tabasco</option>
                        <option value="Tamaulipas">Tamaulipas</option>
                        <option value="Tlaxcala">Tlaxcala</option>
                        <option value="Veracruz">Veracruz</option>
                        <option value="Yucatán">Yucatán</option>
                        <option value="Zacatecas">Zacatecas</option>
                        </select>
                    </div>
                                                                                                
                                                                                                  
					<div class="form-group">
					  <label class="control-label titulos" for="inputPaisProveedores">País:</label>
					  <select class="form-control" id="inputPaisProveedores"  onchange="Proveedores.pais();">
                            <option value="México">México</option>
                            <option value="EUA">EUA</option>
                        </select>
					</div>
					<div class="form-group ">
					  <label class="control-label titulos" for="inputCodigoPostalProveedores">Código Postal:</label>
					  <input required type="text" class="form-control" id="inputCodigoPostalProveedores">
					</div>
                    <div class="form-group ">
					  <label class="control-label titulos" for="inputContactoNombreProveedores">Nombre del contacto:</label>
					  <input type="text" class="form-control" id="inputContactoNombreProveedores">
					</div>
                                                                                                                                   
					<div class="form-group ">
					  <label class="control-label titulos" for="inputContactoProveedores">Email:</label>
					  <input required type="email" class="form-control" id="inputContactoProveedores" placeholder="usuario@fundacion.com">
					</div>
                                                                                                                                         
					<div class="form-group ">
					  <label class="control-label titulos" for="inputNumeroProveedores">Teléfono (10 dígitos) :</label>
					  <input  type="text" class="form-control" id="inputNumeroProveedores" placeholder="Lada + Teléfono">
					</div>

				</form>
                
                <div hidden id="vista-datos2" >
                    <p class="titulos" >Calle y Número</p>
                    <p id="vista-calle"></p>
                    <p class="titulos" >Colonia</p>
                    <p id="vista-colonia"></p>
                    <p class="titulos">Delegación y Municipio</p>
                    <p id="vista-delega"></p>
                    <p class="titulos">Estado:</p>            
                    <p id="vista-entidad"></p>
                    <p class="titulos">País</p>
                    <p id="vista-pais"></p>
                    <p class="titulos">Código Postal:</p>
                    <p id="vista-cp"></p>
                    <p class="titulos">Nombre del contacto:</p>
                    <p id="vista-contacto"></p>
                    <p class="titulos">Email:</p>
                    <p id="vista-correo"></p>
                    <p class="titulos">Teléfono</p>
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
