

<?php

// Composer's auto-loading functionality
require '../autoload.inc.php';
use Dompdf\Dompdf;

$html = '<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="Especialidad de electronica de ESIME Zacatenco" >
    <meta name="author" content="Esteban Cureño">

    <title>Electronica ESIME Zacatenco</title>

    <!-- Nucleo Bootstrap CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tema CSS -->
    <link href="css/agency.css" rel="stylesheet">
</head>

<body id="page-top" class="index">

    <!-- Navegacion -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
            <!-- Brand y toggle agrupados para el telefono -->

            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Menu de navegacion</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">ESIME ZACATENCO</a>
            </div>

            <!-- Links de navegacion -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Objetivos</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Asignaturas</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#team">Equipo</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Academia de Electronica</div>
                <div class="intro-heading">Bienvenido</div>
                <a href="#services" class="page-scroll btn btn-xl">Sobre nosotros</a>
            </div>
        </div>
    </header>

    <!-- Seccion de infomracion general-->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Ingenieria en comunicaciones y electronica</h2>
                    <h3 class="section-subheading text-muted">Especialidad en electronica</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Objetivo</h4>
                    <p class="text-muted">Formar profesionistas con alto sentido ético y de compromiso con su comunidad en el campo tecnológico de la electrónica y las comunicaciones, capaces de: abordar y tomar decisiones con creatividad, orden y método, en relación a problemas tecnológicos, capaces de diseñar, construir y evaluar, desde diferentes puntos de vista y con fundamentos científico-tecnológicos, dispositivos o sistemas que resuelvan problemas del área.Con formación pertinente para comunicar sus ideas mediante el lenguaje e integrar proyectos que incluyan impacto y viabilidad. Que valoren la importancia del trabajo en equipo, promoviendo la cooperación, la tolerancia, la solidaridad y la responsabilidad, así mismo que analicen y valoren los efectos que el desarrollo tecnológico provoca en el mundo del trabajo, el medio socioeconómico y el medio ambiente.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Requisitos Académicos</h4>
                    <p class="text-muted">
                        Cumplir en tiempo y forma con cada una de las etapas del Proceso de Admisión señaladas en la convocatoria de ingreso al Nivel Superior Sistema Escolarizado del IPN. Tales como:                     
                        Certificado oficial de estudios de nivel medio superior.
                        Certificado de estudios de secundaria.
                        Clave única de registro de Población CURP.
                        Acta de nacimiento.
                        Aprobar el examen de ingreso.
                        6 fotografías tamaño infantil.
                   </p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Perfil del Aspirante</h4>
                    <p class="text-muted">
                        Debe poseer los conocimientos tanto teóricos como prácticos en las Ciencias Física, Química y Matemáticas, así como herramientas computacionales ya que forman parte  de las utilizadas como futuro ingeniero. Habilidad manual para armar circuitos o para verificar el producto de su ingenio al diseñar. Conocer la estructura de un reporte técnico y los conocimientos pertinentes para realizar e interpretar el dibujo técnico. Capacidad para resolver situaciones nuevas; desarrollo de criterios a la solución de problemas de la profesión mediante el análisis y síntesis; tener el espíritu de observación para investigar el cómo y el porqué de los fenómenos. Creatividad para resolver un problema planteado o diseñar un nuevo producto. Cualidades personales; seriedad, moral,  respeto y deseos de superación,  capacidad para coordinar y expresar apropiadamente sus ideas y un alto sentido común que le permita discernir conceptos y criterios ingenieriles. Capacidad para integrarse en forma interdisciplinaria.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- PAsignaturas -->
    <section id="portfolio" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Asignaturas</h2>
                    <h3 class="section-subheading text-muted">Especialidad de electronica</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/roundicons.png" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Electrónica Lineal</h4>
                        <p class="text-muted">Diseño de fuentes de voltaje</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/startup-framework.png" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Instrumentación I</h4>
                        <p class="text-muted">Diseño de instrumentacion</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/treehouse.png" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Instrumentación II </h4>
                        <p class="text-muted">Protocolos de comunicacion</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/golden.png" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Electrónica de Potencia I</h4>
                        <p class="text-muted">Convertidores básicos de potencia</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/escape.png" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Transmisores</h4>
                        <p class="text-muted">Diseño de transmisores de RF</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/dreams.png" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Electrónica de Potencia II </h4>
                        <p class="text-muted">Diseño de Convertidores</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Nuestro asombroso equipo</h2>
                    <h3 class="section-subheading text-muted">Profesores de la especialidad</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="img/team/1.jpg" class="img-responsive img-circle" alt="">
                        <h4>NOMBRE</h4>
                        <p class="text-muted">GRADO</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="img/team/1.jpg" class="img-responsive img-circle" alt="">
                        <h4>Nombre</h4>
                        <p class="text-muted">GRADO</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="img/team/1.jpg" class="img-responsive img-circle" alt="">
                        <h4>Nombre</h4>
                        <p class="text-muted">GRADO</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <p class="large text-muted">
                        <quote>Si tienes que poner alguien en un pedestal, pon a los maestros. Son los héroes de la sociedad.<footer>Guy Kawasaki</footer></quote></p>
                </div>
            </div>
        </div>
    </section>
       <footer>
        <div class="container-fluid bg-light-gray">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; ESIME ZACATENCO 2016</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="#">Politica de privacidad</a>
                        </li>
                        <li><a href="#">Terminos de uso</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Portfolio Modals -->
    <!-- Use the modals below to showcase details about your portfolio projects! -->

    <!-- Portfolio Modal 1 -->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Electronica Lineal</h2>
                                <p class="item-intro text-muted">SEPTIMO SEMESTRE</p>
                                <!--
                                      <img class="img-responsive img-centered" src="img/portfolio/roundicons-free.png" alt="">
                                -->
                                <iframe width="640" height="360" src="https://www.youtube.com/embed/NuLjqR3mE20" frameborder="0" allowfullscreen></iframe>
                                <p>El alumno aplicará los dispositivos electrónicos más comunes en el diseño de circuitos típicos lineales,
                                teniendo como fundamento el comportamiento de los mismos, sus limitaciones y las características de las
                                fuentes de alimentación que los polarizan y distinguirá cuándo alguna aplicación se sale de la linealidad, se
                                descontrola o bien es francamente no lineal. </p>
                                   <p><a href="http://www.esimez.ipn.mx/OfertaEducativa/Documents/ingenieria_en_comunicaciones_y_electronica/pe_6to_semestre/electronica_lineal.pdf" target="_blank"> PROGRAMA SINTÉTICO 
                                </a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> REGRESAR</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 2 -->
    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <h2>Instrumentacion I</h2>
                                <p class="item-intro text-muted">OCTAVO SEMESTRE</p>
                                <!--
                                        <img class="img-responsive img-centered" src="img/portfolio/startup-framework-preview.png" alt="">
                                -->
                                <iframe width="640" height="360" src="https://www.youtube.com/embed/7s4C9FoMroY" frameborder="0" allowfullscreen></iframe>
                                <p>El alumno diseñará y construirá circuitos electrónicos básicos para mediciones
                                    electrónicas considerando las características de los sensores más usuales y el tratamiento de señales a través de procesadores analógicos. 
                                </p>
                                <p><a href="http://www.esimez.ipn.mx/OfertaEducativa/Documents/ingenieria_en_comunicaciones_y_electronica/optativas_octavo_sem/opcion_electronica/instrumentacion_uno.pdf" target="_blank">PROGRAMA SINTÉTICO 
                                </a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> REGRESAR</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 3 -->
    <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Instrumentacion II</h2>
                                <p class="item-intro text-muted">OCTAVO SEMESTRE.</p>
                                <!--    <img class="img-responsive img-centered" src="img/portfolio/treehouse-preview.  png" alt="">
                                -->
                                <iframe width="640" height="360" src="https://www.youtube.com/embed/RrlI0hguBSI" frameborder="0" allowfullscreen></iframe>
                                <p>El alumno seleccionará los medios de comunicación entre instrumentos de medición para conectar las señales
                                que se obtienen en la medición electrónica, desde el sensor hasta el exhibidor o presentador del resultado del
                                parámetro bajo medición así como a través de Internet, aplicando estándares a interfases de adquisición de
                                datos. 
                                </p>
                                <p> <a href="http://www.esimez.ipn.mx/OfertaEducativa/Documents/ingenieria_en_comunicaciones_y_electronica/optativas_octavo_sem/opcion_electronica/instrumentacion_dos.pdf" target="_blank">Programa sintetico</a>
                                </p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Regresar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 4 -->
    <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Electronica de potencia I</h2>
                                <p class="item-intro text-muted">OCTAVO SEMESTRE.</p>
                                    <!--<img class="img-responsive img-centered" src="img/portfolio/golden-preview.png" alt="">
                                    -->
                                <iframe width="640" height="360" src="https://www.youtube.com/embed/0qHVhFTkm90" frameborder="0" allowfullscreen></iframe>
                                <p>El alumno diseñará y construirá circuitos convertidores básicos de potencia para el control de la energía
                                eléctrica y experimentará en aplicaciones de electrónica de potencia utilizando controladores lógicos
                                programables PLCs. 
                                </p>
                                <p><a href="http://www.esimez.ipn.mx/OfertaEducativa/Documents/ingenieria_en_comunicaciones_y_electronica/optativas_octavo_sem/opcion_electronica/electronica_potencia_uno.pdf">Programa sintetico</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times" target="_blank"></i>Regresar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 5 -->
    <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Transmisores</h2>
                                <p class="item-intro text-muted">OCTAVO SEMESTRE</p>
                                <!--<img class="img-responsive img-centered" src="img/portfolio/escape-preview.png" alt="">-->
                                <iframe width="640" height="360" src="https://www.youtube.com/embed/AoeF0WeSJqY" frameborder="0" allowfullscreen></iframe>
                                <p>El alumno diseñará transmisores de radio frecuencia (RF) y microondas así como los circuitos de las etapas que
                                los componen: osciladores, moduladores, amplificadores, redes de acoplamiento aplicando elementos discretos y
                                circuitos integrados. 
                                </p>
                                <p><a href="http://www.esimez.ipn.mx/OfertaEducativa/Documents/ingenieria_en_comunicaciones_y_electronica/optativas_octavo_sem/opcion_electronica/transmisores.pdf" target="_blank">Programa sintetico</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i>Regresar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Electronica de potencia II</h2>
                                <p class="item-intro text-muted">NOVENO</p>
                                <!--<img class="img-responsive img-centered" src="img/portfolio/dreams-preview.png" alt="">-->
                                <iframe width="640" height="360" src="https://www.youtube.com/embed/mCqGXOnKiO4" frameborder="0" allowfullscreen></iframe>
                                <p>El alumno diseñará y construirá diferentes circuitos convertidores modulados por ancho de pulso PWM,
                                Inversores resonantes, fuentes conmutadas y cicloconvertidores para control de motores de C.A. y C.D. así
                                como fuentes de poder No-Interrumpibles (UPS). 
                                </p>
                                <p><a href="http://www.esimez.ipn.mx/OfertaEducativa/Documents/ingenieria_en_comunicaciones_y_electronica/optativas_noveno_sem/opcion_electronica/electronica_potencia_dos.pdf" target="_blank">Programa sintetico</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i>Regresar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/agency.min.js"></script>

</body>

</html>
';

//generate some PDFs!
$dompdf = new DOMPDF();  //if you use namespaces you may use new \DOMPDF()
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream("sample.pdf", array("Attachment"=>0));





/*

require_once '../autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml('hello world');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landsce');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
//$dompdf->stream();

*/

?>