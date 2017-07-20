
	
	<script type="text/javascript" src="js/utilerias.js"></script>   
	<script type="text/javascript" src="js/usuarios.js"></script>
    <script type="text/javascript" src="js/especies.js"></script>
    <script type="text/javascript" src="js/proveedores.js"></script>
	<script type="text/javascript" src="js/eventos.js"></script>
    <script type="text/javascript" src="js/programas.js"></script>
    <script type="text/javascript" src="js/subprogramas.js"></script>    
    <script type="text/javascript" src="js/cargo.js"></script> 
    <script type="text/javascript" src="js/apoyos.js"></script> 

	
        <script>
        $(function() {
        $("#example1,#example2,#example3,#example4,#example5,#example6").DataTable();

        }); 
        $(function() {        
        $("#tabla_eventos").DataTable();
        }); 
       
        </script>
     <script>
              $( function() {
                $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd'});
                $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd'});
                $( "#fechacaptura" ).datepicker({ dateFormat: 'yy-mm-dd'});
                $("#fechadoctosalida").datepicker({ dateFormat: 'yy-mm-dd'});
                $("#fecha_referencia").datepicker({ dateFormat: 'yy-mm-dd'});
                $( "#datepicker4" ).datepicker({ dateFormat: 'yy-mm-dd'});
                $( "#datepicker5" ).datepicker({ dateFormat: 'yy-mm-dd'});
                $( "#datepicker6" ).datepicker({ dateFormat: 'yy-mm-dd'});
                $( "#fecha_cambio" ).datepicker({ dateFormat: 'yy-mm-dd'});
                
              } );
              </script>
     <script>
         
         $(document).ready(function(){
            $("#contenedor-apoyos").hide();
            $("#btn-add-apoyo").click(function(){
             $("#datable").hide();
             $("#contenedor-apoyos").show();
            });
            $("#close").click(function(){
             $("#datable").show();
             $("#contenedor-apoyos").hide();
            });
        });
     </script>
    <script src="assets/js/jquery-ui.min.js"></script>

</body>
</html>	