<?php

	session_start();
    require_once("../../database/connection.php");
    $db = new Database();
    $connection = $db->conectar();

	$sql =$connection->prepare( "SELECT * FROM user,type_user WHERE  username ='".$_SESSION['usuario']."' AND user.id_type_user = type_user.id_type_user");
    $sql->execute();
    $usua=$sql->fetch(PDO::FETCH_ASSOC);
?>


    <!----CONSULTAS SQL TIPO USUARIOS, GENERO, PAIS, CIUDAD Y ESTADO---->
<?php

    $control=$connection->prepare ("SELECT * FROM category");
    $control->execute();
    $category=$control->fetch(PDO::FETCH_ASSOC);

    
    $select_state=$connection->prepare("SELECT * FROM state");
    $select_state->execute();
    $state=$select_state->fetch(PDO::FETCH_ASSOC);


    $date_products=$connection->prepare("SELECT *  FROM products INNER JOIN category INNER JOIN state ON products.id_category = category.id_category AND products.id_state=state.id_state");
    $date_products->execute();
    $vali_products=$date_products->fetchAll(PDO::FETCH_ASSOC);


?>


<?php
    if((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))

    {
        // DECLARACION DE LOS VALORES DE LAS VARIABLES DEPENDIENDO DEL TIPO DE CAMPO QUE TENGA EN EL FORMULARIO

        $cedula = $_POST['document'];
        $nombre = $_POST['name'];
        $usuario = $_POST['username'];
        $clave= $_POST['password'];
        $telefono = $_POST['telephone'];
        $email = $_POST['email'];
        $idusu= $_POST['id_type_user'];
        $id_gender=$_POST['id_gender'];
        $id_pais=$_POST['id_pais'];
        $id_ciudad=$_POST['id_ciudad'];
        $id_state=$_POST['id_state'];

        // CONSULTA SQL PARA VERIFICAR SI EL USUARIO YA EXISTE EN LA BASE DE DATOS
        $examinar=$con ->prepare("SELECT * FROM user WHERE document='$cedula' or username='$usuario'");
        $examinar -> execute();
        $register_validation=$examinar->fetchAll();

        // CONDICIONALES DEPENDIENDO EL RESULTADO DE LA CONSULTA
        if ($register_validation){

            // SI SE CUMPLE LA CONSULTA ES PORQUE EL USUARIO YA EXISTE

            echo '<script> alert ("// DOCUMENTO O USUARIO NO EXISTEN, CAMBIELOS //");</script>';
            echo '<script> windows.location= "register_usu.php"</script>';

        }
        else if ($cedula=="" || $nombre==""  || $usuario=="" || $clave=="" || $telefono=="" || $email=="" || $id_ciudad=="" || $id_pais=="" || $id_gender=="" || $id_ciudad=="")
        {
            // CONDICIONAL DEPENDIENDO SI EXISTEN ALGUN CAMPO VACIO EN EL FORMULARIO DE LA INTERFAZ
            echo '<script> alert (" EXISTEN DATOS VACIOS");</script>';
            echo '<script> windows.location= "registro_usu.php"</script>';
        }else
        {
            $register_user=$connection->prepare("INSERT INTO user(document,name,telephone,email,id_type_user,id_gender,id_pais,id_ciudad,password,username,id_state) VALUES('$cedula','$nombre','$telefono','$email','$idusu','$id_gender','$id_pais','$id_ciudad','$clave', '$usuario','$id_state')" );
            if($register_user->execute()){
                echo '<script>alert ("Registro Exitoso en la base de datos, Gracias");</script>';
                echo '<script>windows.location="login.php"</script>';
            }

        }


    }



?>
<!-- ESTRUCTURA HTML MENU DE ADMINISTRADOR -->

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>MENU PRINCIPAL ADMINISTRADOR</title>
	    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../../controller/CSS/bootstrap.min.css">
	    <!----css3---->
        <link rel="stylesheet" href="../../controller/CSS/custom.css">
		<!--google fonts -->
	    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
		<link rel="shortcut icon" href="../../controller/image/favicon.png" type="image/x-icon">
	
	   <!--google material icon-->
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">

  </head>
  <body>
  
<div class="wrapper">
     
	  <div class="body-overlay"></div>
	 
	 <!-------sidebar--design------------>
	 
	 <div id="sidebar">
	    <div class="sidebar-header">
		   <h3><img src="../../controller/image/favicon.png" class="img-fluid"/><span><?php echo $usua['type_user']?> <span><?php echo $usua['name']?></span></h3>
		   <h3><span></span></h3>
		</div>
		<ul class="list-unstyled component m-0">
		  <li class="active">
		  <a href="index.php" class="dashboard"><i class="material-icons">dashboard</i>Menu Principal </a>
		  </li>

		  <li class="dropdown">
		   	<a href="crear_usu.php"class="dropdown-toggle">
		  		<i class="material-icons">aspect_ratio</i>Crear Usuario
		  	</a>
		  <ul class="collapse list-unstyled menu" id="homeSubmenu1">
		     <!-- <li><a href="crear_usu.php">Crear Nuevo Usuario</a></li>
			 <li><a href="#">layout 2</a></li>
			 <li><a href="#">layout 3</a></li> -->
		  </ul>
		  </li>
		  
		  
		   <li class="dropdown">
				<a href="crear_tipo.php" class="dropdown-toggle">
					<i class="material-icons">apps</i>Crear Tipo de Usuario
				</a>
				<ul class="collapse list-unstyled menu" id="homeSubmenu2">
					<li><a href="#">Apps 1</a></li>
					<li><a href="#">Apps 2</a></li>
					<li><a href="#">Apps 3</a></li>
				</ul>
		  </li>

		   <li class="dropdown">
		  <a href="#homeSubmenu3" data-toggle="collapse" aria-expanded="false" 
		  class="dropdown-toggle">
		  <i class="material-icons">equalizer</i>Listas de Usuarios
		  </a>
		  <ul class="collapse list-unstyled menu" id="homeSubmenu3">
		     <li><a href="#">Lista Equipo de trabajo</a></li>
			 <li><a href="#">Lista de clientes</a></li>
			 <li><a href="#">Lista de motos registradas</a></li>
			 <li><a href="#">Lista de tipos de usuarios</a></li>
		  </ul>
		  </li>
		  
		  

		  
		   <li class="dropdown">
		  <a href="#homeSubmenu5" data-toggle="collapse" aria-expanded="false" 
		  class="dropdown-toggle">
		  <i class="material-icons">border_color</i>Lista Tipo Usuarios
		  </a>
		  <ul class="collapse list-unstyled menu" id="homeSubmenu5">
		     <li><a href="#">Pages 1</a></li>
			 <li><a href="#">Pages 2</a></li>
			 <li><a href="#">Pages 3</a></li>
		  </ul>
		  </li>
		  
		  <li class="dropdown">
		  <a href="#homeSubmenu6" data-toggle="collapse" aria-expanded="false" 
		  class="dropdown-toggle">
		  <i class="material-icons">grid_on</i>Cambiar contraseña
		  </a>
		  <!-- <ul class="collapse list-unstyled menu" id="homeSubmenu6">
		     <li><a href="#">table 1</a></li>
			 <li><a href="#">table 2</a></li>
			 <li><a href="#">table 3</a></li>
		  </ul> -->
		  </li>
		  
		  
		  <li class="dropdown">
		  		<a href="#homeSubmenu7" data-toggle="collapse" 
				class="dropdown-toggle">
					<i class="material-icons">content_copy</i>Copia de seguridad
				</a>
		
		  <ul class="collapse list-unstyled menu" id="homeSubmenu7">
		     <li><a href="respaldo/respaldo.php">Hacer copia</a></li>
			 <li><a href="#">Pages 2</a></li>
			 <li><a href="#">Pages 3</a></li>
		  </ul>
		  </li>
		  
		   
		  <li class="">
		  <a href="#" class=""><i class="material-icons">date_range</i>copy </a>
		  </li>
		  <li class="">
		  <a href="#" class=""><i class="material-icons">library_books</i>calender </a>
		  </li>
		
		</ul>
	 </div>
	 
   <!-------sidebar--design- close----------->
   
   
   
      <!-------page-content start----------->
   
      <div id="content">
	     
		  <!------top-navbar-start-----------> 
		     
		  <div class="top-navbar">
		     <div class="xd-topbar">
			     <div class="row">
				     <div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
					    <div class="xp-menubar">
						    <span class="material-icons text-white">signal_cellular_alt</span>
						</div>
					 </div>
					 
					 <div class="col-md-5 col-lg-3 order-3 order-md-2">
					     <div class="xp-searchbar">
						     <form>
							    <div class="input-group">
								  <input type="search" class="form-control"
								  placeholder="Search">
								  <div class="input-group-append">
								     <button class="btn" type="submit" id="button-addon2">Go
									 </button>
								  </div>
								</div>
							 </form>
						 </div>
					 </div>
					 
					 
					 <div class="col-10 col-md-6 col-lg-8 order-1 order-md-3">
					     <div class="xp-profilebar text-right">
						    <nav class="navbar p-0">
							   <ul class="nav navbar-nav flex-row ml-auto">
							   <li class="dropdown nav-item active">
							     <a class="nav-link" href="#" data-toggle="dropdown">
								  <span class="material-icons">notifications</span>
								  <span class="notification">4</span>
								 </a>
								  <ul class="dropdown-menu">
								     <li><a href="#">You Have 4 New Messages</a></li>
									 <li><a href="#">You Have 4 New Messages</a></li>
									 <li><a href="#">You Have 4 New Messages</a></li>
									 <li><a href="#">You Have 4 New Messages</a></li>
								  </ul>
							   </li>
							   
							   <li class="nav-item">
							     <a class="nav-link" href="#">
								   <span class="material-icons">question_answer</span>
								 </a>
							   </li>
							   
							   <li class="dropdown nav-item">
							     <a class="nav-link" href="#" data-toggle="dropdown">
								  <img src="../../controller/image/favicon.png" style="width:40px; border-radius:50%;"/>
								  <span class="xp-user-live"></span>
								 </a>
								  <ul class="dropdown-menu small-menu">
								     <li><a href="#">
									 <span class="material-icons">person_outline</span>
									 Profile
									 </a></li>
									 <li><a href="#">
									 <span class="material-icons">settings</span>
									 Settings
									 </a></li>
									 <li><a name="btncerrar" href="../../index.php">
									 <span class="material-icons">logout</span>
									 Log-out
									 </a></li>
									 
								  </ul>
							   </li>
							   
							   
							   </ul>
							</nav>
						 </div>
					 </div>
					 
				 </div>
				 
				 <div class="xp-breadcrumbbar text-center">
				    <h4 class="page-title"><span>Bienvenido <?php echo $usua['type_user']?> <?php echo $usua['name']?></span></h4>
					<ol class="breadcrumb">
					  <li class="breadcrumb-item"><a href="#">Interfaz</a></li>
					  <li class="breadcrumb-item active" aria-curent="page">Admnistrador</li>
					</ol>
				 </div>
				 
				 
			 </div>
		  </div>
		  <!------top-navbar-end-----------> 
		  
		  
		   <!------main-content-start-----------> 
		     
		      <div class="main-content">
			     <div class="row">
				    <div class="col-md-12">
					   <div class="table-wrapper">
					     
					   <div class="table-title">
					     <div class="row">
						     <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
							    <h2 class="ml-lg-2">Lista de Usuarios</h2>
							 </div>
							 <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
							   <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
							   <i class="material-icons">&#xE147;</i>
							   <span>Agregar nuevo usuario</span>
							   </a>

							   </a>
							 </div>
					     </div>
					   </div>
					   
					   <table class="table table-striped table-hover">
					      <thead>
						     <tr>

								<label for="selectAll"></label></th>
								<th >Actions</th>
                                <th>N.</th>
								<th>Nombre</th>
								<th>Precio</th>
								<th>Categoria</th>
								<th>Estado</th>
							 </tr>
						  </thead>
						  
						  <tbody>


						  	<?php
								foreach($vali_products as $products){

							?>
									<tr>

									
									<th>
										<form method="get" action="actualizar_usu.php">

											<input type="hidden" name="documento" value="<?=$products['id_product']?>">
											<button class="button button_actu"  type="submit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></button>

										</form>

										<form method="get" action="eliminar_usu.php">
											<input type="hidden" name="documento" value="<?=$products['id_product']?>">
											<button class="button" onclick="return confirm('¿Desea eliminar el registro de usuario seleccionado?');" type="submit"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></button>
                                		</form>
									
										</a>
									</th>

									<th><?= $products["id_product"]?></th>                               
									<th><?= $products["name_product"]?></th>
                                    <th><?= $products["precio"]?></th>
									<th><?= $products["category"]?></th>
									<th><?= $products["state"]?></th>	
                                    								
									</tr>

								<?php
								
								}
								?>
							
						
						  </tbody>
						
					   </table>
					   <div class="clearfix">
					     <div class="hint-text">showing <b>5</b> out of <b>25</b></div>
					     <ul class="pagination">
						    <li class="page-item disabled"><a href="#">Anterior</a></li>
							<li class="page-item "><a href="#"class="page-link">1</a></li>
							<li class="page-item "><a href="#"class="page-link">2</a></li>
							<li class="page-item active"><a href="#"class="page-link">3</a></li>
							<li class="page-item "><a href="#"class="page-link">4</a></li>
							<li class="page-item "><a href="#"class="page-link">5</a></li>
							<li class="page-item "><a href="#" class="page-link">Siguiente</a></li>
						 </ul>
					   </div>
					   
				
					   </div>
					</div>
					
					
		<!----add-modal start--------->




		<div class="modal fade" tabindex="-1" id="addEmployeeModal" role="dialog">
			<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Registrar Usuario</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="container">
				<form method="POST" name="formreg" action="" autocomplete="off" id="formulario" class="formulario">

					<!-- Group: Document -->
					<div class="formulario__grupo" id="grupo__document">
						<label for="document" class="formulario__label">Numero de documento</label>
						<div class="formulario__grupo-input">
							<input type="number" class="formulario__input" name="document" id="document" required placeholder="Ingrese su numero de documento">
							<i class="formulario__validacion-estado fas fa-times-circle"></i>
						</div>
						<!-- <p class="formulario__input-error">El numero de documento debe ser de 6 a 10 numeros.</p> -->
					</div>


					<!-- Group: Nombre -->
					<div class="formulario__grupo" id="grupo__name">
						<label for="name" class="formulario__label">Nombre completo</label>
						<div class="formulario__grupo-input">
							<input type="text" class="formulario__input" name="name" required id="name" placeholder="Ingrese sus nombres">
							<i class="formulario__validacion-estado fas fa-times-circle"></i>
						</div>
						<!-- <p class="formulario__input-error">Debe ingresar su nombre completo, o en preferencia su primer nombre y apellido.</p> -->
					</div>

					<!-- Group: Username -->
					<div class="formulario__grupo" id="grupo__username">
						<label for="username" class="formulario__label">Nombre de Usuario</label>
						<div class="formulario__grupo-input">
							<input type="text" class="formulario__input" name="username" required id="username" placeholder="Ingrese su nombre">
							<i class="formulario__validacion-estado fas fa-times-circle"></i>
						</div>
						<!-- <p class="formulario__input-error">El usuario tiene que ser de 4 a 10 dígitos y solo puede contener numeros, letras y guion bajo.</p> -->
					</div>

					
			
					<!-- Group: Password -->

					<div class="formulario__grupo" id="grupo__password">
						<label for="password" class="formulario__label">Contraseña de Usuario</label>
						<div class="formulario__grupo-input">
							<input type="password" class="formulario__input" name="password" required id="password"placeholder="Ingrese su contraseña">
							<i class="formulario__validacion-estado fas fa-times-circle"></i>
						</div>
						<!-- <p class="formulario__input-error">La contraseña tiene que ser de 4 a 10 dígitos y solo puede contener numeros, letras y guion bajo.</p> -->
					</div>

					<!-- Group: Password 2 -->

					<div class="formulario__grupo" id="grupo__password2">
						<label for="password2" class="formulario__label">Repetir Contraseña</label>
						<div class="formulario__grupo-input">
							<input type="password" class="formulario__input" name="password2" required id="password2"placeholder="Repita su contraseña">
							<i class="formulario__validacion-estado fas fa-times-circle"></i>
						</div>
						<!-- <p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p> -->
					</div>


					<!-- Group: telephone -->

					<div class="formulario__grupo" id="grupo__telephone">
						<label for="telephone" class="formulario__label">Numero de Telefono</label>
						<div class="formulario__grupo-input">
							<input type="text" class="formulario__input" name="telephone" required id="telephone" placeholder="Ingrese su numero de contacto">
							<i class="formulario__validacion-estado fas fa-times-circle"></i>
						</div>
						<!-- <p class="formulario__input-error">El nombre tiene que ser de 4 a 20 dígitos y solo puede contener numeros, letras y guion bajo.</p> -->
					</div>


					<!-- Group: email -->
					<div class="formulario__grupo" id="grupo__email">
						<label for="email" class="formulario__label">Correo Electronico</label>
						<div class="formulario__grupo-input">
							<input type="text" class="formulario__input" name="email" required id="email" placeholder="Ingrese su correo electronico">
							<i class="formulario__validacion-estado fas fa-times-circle"></i>
						</div>
						<!-- <p class="formulario__input-error">El nombre tiene que ser de 4 a 20 dígitos y solo puede contener numeros, letras y guion bajo.</p> -->
					</div>


					<!-- Group Type User -->
					
					<div class="formulario__grupo select" >
						<label for="tipousuario" class="formulario__label label">Tipo de Categoria</label>
						<div class="formulario__grupo__input">
							<select name="id_type_user"  class="formulario__input">
								<option value="">Seleccione Tipo de Usuario</option>

									<?php
									do{
									?>

									<option value="<?php echo($category['id_category'])?>"><?php echo($category['category'])?></option>


								<?php
									} while($category=$control->fetch(PDO::FETCH_ASSOC));
									?>
							</select>
						</div>
					</div>

					<!-- Group Type Gender -->  

					<div class="fomulario__grupo container_gender">
						<label for="" class="formulario__label label"><option value="">Tipo de Estado</option></label>
						<div class="formulario__grupo__input formulario__input">
								<?php
								do{

								?>
								<input class="gender" name="id_gender" type="radio" value="<?php echo($state['id_state'])?>"> <?php echo($state['state'])?></input>
								<?php    

									} while($state=$select_state->fetch(PDO::FETCH_ASSOC));
								?>
						</div>
					</div>





					<!-- Group: State_user -->
					<div class="state">
						<input class="cajas" type="hidden" value="2" name="id_state" placeholder="Ingrese su estado">  
					</div>

					<!-- Group: Terminos y Condiciones
					<div class="formulario__grupo formulario__checkbox" id="grupo__terminos">
						<label class="formulario__label">
							<input type="checkbox" name="terminos" id="terminos">
							Acepto los Terminos y Condiciones <br> para el uso de mis datos
						</label>    
					</div> -->

				<div class="formulario__grupo formulario__grupo-btn-enviar">
					<input type="submit" name="validar" value="Registrarme" class="formulario__btn"></input>
					<input type="hidden" name="MM_insert" value="formreg">
					<a href="login.php" data-dismiss="modal"  class="return">Regresar</a>
					<!-- <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p> -->
				</div>
			</div>
		</form>
		</div>
</div>



					   <!----edit-modal end--------->
					   
					   
					   
					   
					   
				   <!----edit-modal start--------->
		<div class="modal fade" tabindex="-1" id="editEmployeeModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Employees</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
		    <label>Name</label>
			<input type="text" class="form-control" required>
		</div>
		<div class="form-group">
		    <label>Email</label>
			<input type="emil" class="form-control" required>
		</div>
		<div class="form-group">
		    <label>Address</label>
			<textarea class="form-control" required></textarea>
		</div>
		<div class="form-group">
		    <label>Phone</label>
			<input type="text" class="form-control" required>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success">Save</button>
      </div>
    </div>
  </div>
</div>

					   <!----edit-modal end--------->	   
					   
					   
					 <!----delete-modal start--------->
		<div class="modal fade" tabindex="-1" id="deleteEmployeeModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Employees</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this Records</p>
		<p class="text-warning"><small>this action Cannot be Undone,</small></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success">Delete</button>
      </div>
    </div>
  </div>
</div>

					   <!----edit-modal end--------->   
					   
					
					
				 
			     </div>
			  </div>
		  
		    <!------main-content-end-----------> 
		  
		 
		 
		 <!----footer-design------------->
		 
		 <footer class="footer">
		    <div class="container-fluid">
			   <div class="footer-in">
			      <p class="mb-0">&copy 2023 Luis Alejandro Muñoz Garcia . All Rights Reserved.</p>
			   </div>
			</div>
		 </footer>
		 
		 
		 
		 
	  </div>
   
</div>



<!-------complete html----------->

  
     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="./js/jquery-3.3.1.slim.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/jquery-3.3.1.min.js"></script>
  
  
  	<script type="text/javascript">
       $(document).ready(function(){
	      $(".xp-menubar").on('click',function(){
		    $("#sidebar").toggleClass('active');
			$("#content").toggleClass('active');
		  });
		  
		  $('.xp-menubar,.body-overlay').on('click',function(){
		     $("#sidebar,.body-overlay").toggleClass('show-nav');
		  });
		  
	   });
  	</script>
  
</body>
  
</html>


