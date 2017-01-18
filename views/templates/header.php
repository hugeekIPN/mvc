<!DOCTYPE html>
<html lang="es">
<head>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
	<title>Titulo de la pagina desde header</title>
  <!--
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  -->
  <script type="text/javascript" src="assets/js/jquery-3.1.1.js" ></script>
  <!--
  <script type="text/javascript" src="assets/js/bootstrap.js"></script>
-->


  <style>
  ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #0090d2;
  }

  li {
    float: left;
  }

  li a, .dropbtn {
    display: inline-block;
    color: white;
    padding: 14px 16px;
    text-align: center;
    text-decoration: none;
  }

  li a:hover, .dropdown:hover .dropbtn{
    background-color: #004B9C;
  }

  li.dropdown{
    display: inline-block;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  }

  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;  
    text-align: left;  
  }

  .dropdown-content a:hover {
    background-color: #f1f1f1;
  }

  .dropdown:hover .dropdown-content{
    display: block;
  }

  </style>
</head>
<body>

  <ul>
    <li class="dropdown">
      <a class="dropbtn" href="javascript:void(0)">Consultas</a>
      <div class="dropdown-content">
        <a href="#">Especies</a>
        <a href="#">Eventos</a>
        <a href="#">Proveedores/Donatarios</a>
        <a href="index.php?op=users">Usuarios</a>
        <a href="#">Programa</a>        
      </div>
    </li>

    <li class="dropdown">
    <a class="dropbtn" href="javascript:void(0)">Captura</a>
      <div class="dropdown-content">
        <a href="#">menu1</a>
        <a href="#">menu2</a>
        <a href="#">menu3</a>
      </div>
    </li>

    <li class="dropdown">
      <a class="dropbtn" href="javascript:void(0)">Reportes</a>
        <div class="dropdown-content">
          <a href="#">menu1</a>
          <a href="#">menu2</a>
          <a href="#">menu3</a>
        </div>
    </li>

    <li class="dropdown">
      <a class="dropbtn" href="javascript:void(0)">Factura</a>
        <div class="dropdown-content">
          <a href="#">menu1</a>
          <a href="#">menu2</a>
          <a href="#">menu3</a>
        </div>
    </li>

    <li><a href="index.php?op=logout">Salir</a></li>
  </ul> 