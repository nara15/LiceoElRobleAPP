

<?php
      	  if (strcmp($_COOKIE["nombre"],crypt("user","Usuario"))) { // seguir por el hecho de la cockie
      	    	echo  "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=index.php'> " ;
      	  }
?>


<div>
	<div id="head">
		<div class="line">
		   <h1>Noticias</h1>
		</div>
    </div>
    
    <div id="content" class="left-align">
		<div class="line">
			<div class="margin s-12 service-add">
				<div class="line">
			    	<form id="create_news_form" method="post">
			    		<label for="newsName">Eliminar Usuarios</label>
    					
						</br>
    					</br>
    					<label for="newsName">Usuarios Disponibles:</label>
    					</br>
    					<ul>
		                   <li ng-repeat="usuariosLinks in usuariosLinks"> <input type="checkbox" name="UsuariosChecked" id= {{usuariosLinks.Usua}}>  {{usuariosLinks.Usua}}</li> 
		                </ul>
		                </br>
						<input class="button" type="button" onclick="eliminarAgregarUsuarios('2')" value="Eliminar usuarios">
					</form>
					
			    <hr>
		         
		         
		         <div class="line">
			    
			 		<label for="newUser">Agregar Usuarios: </label>
		         
		         </br>
		         <form class="customform" action="">
		            <div class="s-12 l-8"><input id="Usuario" placeholder="Usuario" title="Usuario" type="text" /></div>
		            <div class="s-12 l-8"><input id="Contraseña" placeholder="Contraseña" title="Contraseña" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" />
		            <input id="ContraseñaRep" placeholder="Repita la Contraseña" title="Contraseña" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"/>
		            </div></br><hr>
		            <div class=" l-2"></br></br><button onclick="eliminarAgregarUsuarios('1')" type="button">Agregar usuario</button></div>
		         </form>
		         
		         
			    </div>
			</div>
		</div>
    </div>

</div>
</div>