
<?php include_once('nav.php');?>

<div class="container col-md-12 captura-apoyos">
	<div class="form-izq col-md-4">
		<form method="post" >
		  <div class="form-group col-md-12">
		    <label for="exampleInputEmail1">ID</label>
		    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
		  </div>
		  <div class="form-group col-md-12">
		  	<label for="select1">Programa:</label>
		    <select class="form-control" id="select1">
  			  <option>1</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			</select>
		  </div>
		  <div class="form-group col-md-12">
		  	<label for="select1">Evento:</label>
		    <select class="form-control" id="select1">
  			  <option>1</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			</select>
		  </div>
		  <div class="form-group col-md-12">
		  	<label for="select1">Frecuencia:</label>
		    <select class="form-control" id="select1">
  			  <option>1</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			</select>
		  </div>
		  <div class="form-group col-md-12">
		  	<label for="select1">Proveedor:</label>
		    <select class="form-control" id="select1">
  			  <option>1</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			</select>
		  </div>
		  <div class="form-group col-md-12">
		  	<label for="select1">Donatario:</label>
		    <select class="form-control input" id="select1">
  			  <option>1</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			</select>
		  </div>
		  <div class="form-group col-md-12">
		  	<label for="select1">Descripción del Apoyo:</label>
		    <textarea class="form-control" rows="2" placeholder="Descripción del Apoyo"></textarea>
			</select>
		  </div>

		</form>
	</div>
	<div class="form-central col-md-4 ">
		<form method="post" >
		  <div class="form-group col-md-12">
		    <label for="exampleInputEmail1">Tipo de Apoyo</label>
		    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
		  </div>
		  <div class="form-group col-md-12">
		    <label for="exampleInputEmail1">Región o País</label>
		    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
		  </div>
		  <div class="form-group col-md-12">
		    <label for="exampleInputEmail1">Estado o Región</label>
		    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
		  </div>
		  <div class="form-group col-md-12">
		    <label for="exampleInputEmail1">Observaciones</label>
		    <textarea class="form-control" rows="2" placeholder="Descripción del Apoyo"></textarea>
			</select>
		  </div>
		  <div class="form-group col-md-12">
		    <label for="exampleInputEmail1">Referencia:</label>
		    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
		  </div>
		  <div class="form-group col-md-12">
		    <label for="exampleInputEmail1">Fecha:</label>
		    <div class='input-group date' id='datetimepicker1'>
                    <input type='date-time' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
             </div>
		  </div>
			<div class="form-group col-md-12">
			    <label for="importe">Importe:</label>
			    <div class="col-md-12">
			    <div class="col-md-8">
			    	<input type="text" class="form-control" id="importe" >
			    </div>
			    
			    <div class="col-md-4">
			    	<select name="import" class="form-control input" id="importe-moneda">
			  			<option value="mn">M.N</option>
			  			<option value="dollar">Dollar</option>
		  			</select>
		  		</div>
		  		</div>
		  	</div>
		  
          
		</form>
		
	</div>
	<div class="form-der col-md-4">
		<div class="col-md-8">
			<div class="form-group">
				<a href="#">
					<img class="img1" src="iconos/Recurso 10.png" alt="Restaurar">
					<p>Restaurar</p>
				</a>
			</div>
			<div class="form-group">
				<a href="#">
					<img src="iconos/Recurso 11.png" alt="Agregar">
					<p>Agregar</p>
				</a>
			</div>
			
		</div>
		<div class="dropdown col-md-4">
		  <button class="dropbtn">
		  <img src="iconos/Recurso 19.png" alt="Herramientas">
		  <p>
			<small>
			  <strong>
			  	Herramientas
			  </strong>
			</small>
		  </p>
		  </button>
		  <div class="dropdown-content">
		    <a href="#">
				<img src="iconos/Recurso 12.png" alt="Herramientas">
				<p>
					<small>
					  <strong>
					  	Herramientas
					  </strong>
					</small>
		  		</p>	
		    </a>
		    <a href="#">
				<img src="iconos/Recurso 13.png" alt="Herramientas">
				<p>
					<small>
					  <strong>
					  	Herramientas
					  </strong>
					</small>
		  		</p>	
		    </a>
		    <a href="#">
				<img src="iconos/Recurso 14.png" alt="Herramientas">
				<p>
					<small>
					  <strong>
					  	Herramientas
					  </strong>
					</small>
		  		</p>	
		    </a>
		    <a href="#">
				<img src="iconos/Recurso 15.png" alt="Herramientas">
				<p>
					<small>
					  <strong>
					  	Herramientas
					  </strong>
					</small>
		  		</p>	
		    </a>
		    <a href="#">
				<img src="iconos/Recurso 16.png" alt="Herramientas">
				<p>
					<small>
					  <strong>
					  	Herramientas
					  </strong>
					</small>
		  		</p>	
		    </a>
		    <a href="#">
				<img src="iconos/Recurso 17.png" alt="Herramientas">
				<p>
					<small>
					  <strong>
					  	Herramientas
					  </strong>
					</small>
		  		</p>	
		    </a>
		  </div>
		</div>

	</div>
	

</div>