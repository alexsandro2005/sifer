<?php
    // SE DEBE INCLUIR EL ARCHIVO DE CONEXION A LA BASE DE DATOS
    require_once("../../database/connection.php");
    // VARIABLES QUE CONTIENE LA CLASE CON LOS PARAMETROS DE CONEXION A LA BASE DE DATOS
    $database = new Database();
    // VARIABLE QUE CONTIENE LA CONEXION A LA BASE DE DATOS SIFER-APP
    $connection = $database->conectar();
    // CONSULTA SQL PARA INVOCAR LOS TIPOS DE USUARIO REGISTRADOS

    // CONSULTA SQL PARA INVOCAR LOS TIPOS DE GENERO
    $select_gender=$connection->prepare("SELECT * FROM gender");
    $select_gender->execute();
    // VARIABLE QUE CONTIENE LA CONSULTA JUNTO CON EL ARRAY ASOCIATIVO QUE CONTIENE LAS FILAS REGISTRADAS
    $gender=$select_gender->fetch(PDO::FETCH_ASSOC);
?>
<?php
    if((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
    {

        // VARIABLES QUE CONTIENE EL NUMERO DE ENCRIPTACIONES DE LAS CONTRASEÑAS
        $pass_encriptaciones=[
            'cost'=> 15
        ];

        // DECLARACION DE LOS VALORES DE LAS VARIABLES DEPENDIENDO DEL TIPO DE CAMPO QUE TENGA EN EL FORMULARIO
        $document_user = $_POST['document'];
        $name_user = $_POST['name'];
        $surname = $_POST['surname'];
        $username = $_POST['username'];
        $user_password= password_hash($_POST['password'], PASSWORD_DEFAULT,$pass_encriptaciones);
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $type_user= $_POST['id_type_user'];
        $id_gender=$_POST['id_gender'];
        $datetime= $_POST['datetime'];
        $id_state=$_POST['id_state'];
        $checkbox= $_POST['terminos'];

        // CONSULTA SQL PARA VERIFICAR SI EL USUARIO YA EXISTE EN LA BASE DE DATOS
        $db_validation=$connection ->prepare("SELECT * FROM user WHERE document='$document_user' OR username='$username'");
        $db_validation -> execute();
        $register_validation=$db_validation->fetchAll();

        // CONDICIONALES DEPENDIENDO EL RESULTADO DE LA CONSULTA
        if ($register_validation){
            // SI SE CUMPLE LA CONSULTA ES PORQUE EL USUARIO YA EXISTE
            echo '<script> alert ("// Estimado Usuario, los datos ingresados ya se encuentran registrados. //");</script>';
            echo '<script> window.location= "crear_cliente.php"</script>';
            
        }
        else if ($document_user=="" || $name_user=="" || $surname==""  || $username=="" || $user_password=="" || $telephone=="" || $email=="" || $type_user=="" || $id_gender=="" || $datetime=="" || $checkbox==""  || $id_state=="" )

        {
            // CONDICIONAL DEPENDIENDO SI EXISTEN ALGUN CAMPO VACIO EN EL FORMULARIO DE LA INTERFAZ
            echo '<script> alert ("Estimado Usuario, Existen Datos Vacios En El Formulario");</script>';
            echo '<script> window.location= "crear_cliente.php"</script>';
        }else
        {
            $register_user=$connection->prepare("INSERT INTO user(document,name,surname,date_user,username,telephone,email,id_type_user,id_gender,password,id_state,confirmacion) VALUES('$document_user','$name_user','$surname','$datetime' ,'$username','$telephone','$email','$type_user','$id_gender','$user_password','$id_state','$checkbox')" );
            $register_user->execute();
                echo '<script>alert ("Registro Exitoso de cliente.");</script>';
                echo '<script>window.location="lista_clientes.php"</script>';
            }
    }
?>
<!-- ESTRUCTURA DEL FORMULARIO DE REGISTRO HTML -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>CREAR CLIENTE || SIFER APP</title>
    <link rel="shortcut icon" href="../../controller/image/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../controller/CSS/style_register.css">

</head>
<body onload="formreg.document.focus()">

    <video autoplay loop muted poster="../../controller/image/poster.png" > <source src="../../controller/image/video_motos.mp4" type="video/mp4"></video>  

    <!-- FORM CONTAINER -->
    <main>
        <div class="container_title">
            <header>CREAR CLIENTE</header>
        </div>
        <form method="POST" name="formreg" action="" autocomplete="off" id="formulario" class="formulario">

            <!-- Container: Document -->
			<div class="formulario__grupo" id="grupo__document">
				<label for="document" class="formulario__label">Numero de documento</label>
				<div class="formulario__grupo-input">
					<input type="number" maxlength="10" oninput="maxlengthNumber(this);" class="formulario__input"  name="document" id="document" required placeholder="Ingrese su numero de documento">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El numero de documento debe ser de 6 a 10 numeros.</p>
			</div>

            <!-- Container: Nombre -->
			<div class="formulario__grupo" id="grupo__name">
				<label for="name" class="formulario__label">Primer Nombre</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" oninput="maxlengthNumber(this);" onkeypress="return(multipletext(event));" maxlength="15" name="name" required id="name" placeholder="Ingrese sus nombres">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Debe ingresar solo letras, y debe indicar su primer nombre</p>
			</div>

            <!-- Container: Apellidos -->

			<div class="formulario__grupo" id="grupo__surname">
				<label for="surname" class="formulario__label">Primer Apellido</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" onkeypress="return(multipletext(event));" pattern="[A-Za-z]+" maxlength="15" name="surname" required id="surname" placeholder="Ingrese sus apellidos">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Debe ingresar solor letras, y debe indicar su primer apellido.</p>
			</div>

            <!-- Container: Username -->
			<div class="formulario__grupo" id="grupo__username">
				<label for="username" class="formulario__label">Nombre de Usuario</label>
				<div class="formulario__grupo-input">
					<input type="text" maxlength="12" oninput="(maxlengthNumber(this))" class="formulario__input" name="username" required id="username" placeholder="Ingrese su nombre de usuario">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El usuario tiene que ser de 10 a 12 dígitos y solo puede contener numeros, letras y guion bajo.</p>
			</div>

        
			<!-- Container: Password -->

			<div class="formulario__grupo" id="grupo__password">
				<label for="password" class="formulario__label">Contraseña de Usuario</label>
				<div class="formulario__grupo-input">
					<input type="password" maxlength="12" class="formulario__input" name="password" oninput="maxlengthNumber(this);" required id="password"placeholder="Ingrese su contraseña">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La contraseña tiene que ser de 10 a 12 dígitos y solo puede contener numeros, letras y guion bajo.</p>
			</div>

            <!-- Group: Password 2 -->

			<div class="formulario__grupo" id="grupo__password2">
				<label for="password2" class="formulario__label">Repetir Contraseña</label>
				<div class="formulario__grupo-input">
					<input type="password" class="formulario__input" maxlength="12" name="password2" oninput=" maxlengthNumber(this);" required id="password2"placeholder="Repita su contraseña">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
			</div>


            <!-- Container: telephone -->

			<div class="formulario__grupo" id="grupo__telephone">
				<label for="telephone" class="formulario__label">Numero de Celular</label>
				<div class="formulario__grupo-input">
					<input type="number" class="formulario__input" maxlength="10" name="telephone" oninput="maxcelNumber(this);" required id="telephone" placeholder="Ingrese su numero de contacto">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Debe ingresar su numero telefonico y solo se permite ingreso de diez datos numericos.</p>
			</div>


            <!-- Container: email -->
			<div class="formulario__grupo" id="grupo__email">
				<label for="email" class="formulario__label">Correo Electronico</label>
				<div class="formulario__grupo-input">
					<input type="email" maxlength="30" oninput="maxlengthNumber(this);" class="formulario__input" name="email" required id="email" placeholder="Ingrese su correo electronico">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Su correo solo puede contener letras, numeros, puntos, guiones y guiones bajos. Obligatoriamente debe tener el signo arroba "@".<p>
			</div>


            <div class="formulario__grupo" id="grupo__datetime">
				<label for="telephone" class="formulario__label">Fecha de nacimiento</label>
				<div class="formulario__grupo-input">
					<input type="date" class="formulario__input" maxlength="10" name="datetime" required id="datetime" placeholder="Ingrese su fecha de nacimiento">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Debe ingresar su fecha de nacimiento</p>
			</div>

            <!-- Container Type User -->

            <div class="state">
                <input class="cajas" type="hidden" value="3" name="id_type_user" placeholder="Ingrese su tipo de usuario">  
            </div>

            <!-- Container Type Gender -->  
            <div class="fomulario__grupo container_gender">
                <label for="" class="formulario__label label"><option value="">Selecccion Tipo de Genero</option></label>
                <div class="formulario__grupo__input formulario__input">
                        <?php
                        do{

                        ?>
                        <input class="gender" name="id_gender" type="radio" value="<?php echo($gender['id_gender'])?>"> <?php echo($gender['gender'])?></input>
                        <?php    

                        }while($gender=$select_gender->fetch(PDO::FETCH_ASSOC));
                        ?>
                </div>
            </div>

            <!-- Container: State_user -->
            <div class="state">
                <input class="cajas" type="hidden" value="2"  name="id_state" placeholder="Ingrese su estado">  
            </div>

            <!-- Container: Terminos y Condiciones -->
			<div class="formulario__grupo formulario__checkbox" id="grupo__terminos">
				<label class="formulario__label">
					<input  type="checkbox" name="terminos" value="1" id="terminos">
					Acepto los Terminos y Condiciones <br> para el uso de mis datos
				</label>    
			</div>

            <div class="formulario__grupo formulario__grupo-btn-enviar">
				<input type="submit" name="validar" value="Crear Cliente" class="formulario__btn"></input>
                <input type="hidden" name="MM_insert" value="formreg">
                <a href="index.php" class="return">Regresar</a>

			</div>
        </form>
    </main>
    
    <!-- FUNCION DE JAVASCRIPT QUE PERMITE INGRESAR SOLO EL NUMERO VALORES REQUERIDOS DE ACUERDO A LA LONGITUD MAXLENGTH DEL CAMPO -->

    <script>
        function maxlengthNumber(obj){

            if(obj.value.length > obj.maxLength){
                obj.value = obj.value.slice(0, obj.maxLength);
                alert("Debe ingresar solo el numeros de digitos requeridos");              
            }
        }
    </script>

    <script>
        function maxcelNumber(obj){

            if(obj.value.length > obj.maxLength){
                obj.value = obj.value.slice(0, obj.maxLength);
                alert("Debe ingresar solo 10 numeros.");              
            }
        }
    </script>
    <!-- FUNCION DE JAVASCRIPT QUE PERMITE INGRESAR SOLO LETRAS -->

    <script>
        function multipletext(e) {
            key=e.keyCode || e.which;

            teclado=String.fromCharCode(key).toLowerCase();

            letras="qwertyuiopasdfghjklñzxcvbnm";

            especiales="8-37-38-46-164-46";

            teclado_especial=false;

            for(var i in especiales){
                if(key==especiales[i]){
                    teclado_especial=true;
                    alert ("Debe ingresar solo letras y espacios en el campo"); 

                    break;
                }
            }

            if(letras.indexOf(teclado)==-1 && !teclado_especial){
                return false;
                alert ("Debe ingresar solo letras y espacios en el campo"); 
            }
        }
    </script>


    <script src="../..//controller/JS/formulario.js"></script>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

</body>
</html>


