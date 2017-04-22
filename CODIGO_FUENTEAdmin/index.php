<!DOCTYPE html>
<html lang="en-US" ng-app="liceoRobleApp">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Liceo EL ROBLE - Administración</title>

      <!-- FRAMEWORK STYLE -->
      <link rel="stylesheet" href="css/components.css">
      <link rel="stylesheet" href="css/icons.css">
      <link rel="stylesheet" href="css/responsee.css">
      
      <!-- CUSTOM STYLE -->
      <link rel="stylesheet" href="css/template-style.css"> 
      <link rel="stylesheet" href="css/admin-style.css" type="text/css" />
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

      <!--MODALES-->
      <script type="text/javascript" src="../SERVICE/modal/model.js"></script>
      <link rel="stylesheet" href="../SERVICE/modal/style.css" type="text/css" />
      
      <!-- UPLOAD-->
      <link rel="stylesheet" href="../SERVICE/upload/style.css" type="text/css" />
      <script type="text/javascript" src="../SERVICE/upload/upload.js"></script>
      
      <!-- ANGULARJS -->
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.2/angular.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.2/angular-route.js"></script>
      <script src="script.js"></script>
      
      <!-- CONTROLLERS -->
      <script type="text/javascript" src="../CONTROLLER/coneccion.js"></script> 
      
      <!--JQUERY---->
      <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript" src="js/jquery-ui.min.js"></script>   
      
      <!--EDITABLE TABLE -->
      <script type="text/javascript" src="bower_components/tinymce/tinymce.js"></script>
      <script type="text/javascript" src="bower_components/angular-ui-tinymce/src/tinymce.js"></script>
      
   </head>


   <body class="size-1140">
      
      
      <?php
      	  if (strcmp($_COOKIE["user"],crypt("si","Secreta"))) { // seguir por el hecho de la cockie
      	      echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=Login/index.html'> " ;
      	  }
	   ?>
      
         <!-- El Modal -->
        <div id="notificationModal" class="modal">
            <!-- The modal content-->
            <div class="modal-content" id="modalContent">
                <div class="modal-header" id="modalHeader">
                    <span id="closeModal" class="close">&times;</span>
                    <h2>Modificación</h2>
                </div>
                <div class="modal-body" id="modalBody">
                    <p>Some text</p>
                </div>
                <div class="modal-footer">
                    <button class="btn" id="bntGuardar">Guardar</button>
                </div>
            </div>
        </div>
      
      
      <header>
         <nav>
            <div class="line">
               <div class="top-nav">              
                  <div class="logo hide-l">

                     <a href="index.html">Centro Educativo<br /><strong>El Roble</strong></a>

                     <a href="index.html">LICEO <br /><strong>EL ROBLE</strong></a>

                  </div>                  
                  <p class="nav-text">MENÚ</p>

                     
                  <div class="top-nav s-12 l-5">
                     <ul class="right top-ul chevron">
                        <li><a href="#!">Inicio</a>
                        </li>
                        <li>
                           <a href="#!misionvision">Nuestra Institución</a>
                        </li>
                        
                        
                        
                        <li>
                           <a>Servicios</a>
                           <ul>
                           <li><a  href="#!servicio" >Agregar</a>
                              <li><a href="#!servicioEd" >Editar</a></li>
                           </ul>
                           </li>
                        </li>
                        
                        
                        
                        
                        
                        
                        
                        
                     </ul>
                  </div>
                  
                  <ul class="s-12 l-2">
                     
                     <li class="logo hide-s hide-m">
                        
                  <a class = "buttonSalir" href="Login/logOut.php">Salir</a>
                     </li>
                  </ul>
                  
                  <div class="top-nav s-12 l-5">
                     <ul class="top-ul chevron">
                        <li>
                           <a>Galería</a>
                           <ul>
                              <li><a href="#!galeria">Agregar fotografías</a></li>
                              <li><a href="#!galeriaVer">Ver galería</a></li>
                           </ul>
                        </li>
                        
                        <li>
                           <a>Noticias</a>
                           <ul>
                           <li><a href="#!noticia">Agregar</a>
                              <li><a href="#!noticiasEliminar" >Eliminar</a></li>
                           </ul>
                           </li>
                        </li>
                        
                        <li><a href="#!usuario">Manejo de usuarios</a>
                        </li>
                     </ul> 
                  </div>
               </div>
            </div>
         </nav>
      </header>
      <section>
         <div ng-view></div>
      </section>
      <!-- FOOTER  -->
      <footer>
         <div class="line">
            <div class="s-12 l-6">
                
               <p>Copyright 2017, Vision Design - graphic zoo
               </p>
            </div>
            <div class="s-12 l-6">
               <p class="right">
                  <a class="right" href="http://www.myresponsee.com" title="Responsee - lightweight responsive framework">Design and coding by Responsee Team</a>
               </p>
            </div>
         </div>
      </footer>
      

      <script type="text/javascript" src="js/responsee.js"></script> 
      
   </body>
</html>