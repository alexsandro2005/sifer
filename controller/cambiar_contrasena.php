<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VALIDACION USUARIO || SIFER-APP</title>
    <link rel="stylesheet" href="../controller/CSS/login_style.css">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="shortcut icon" href="../controller/image/favicon.png" type="image/x-icon">
</head>

<body>


    <video autoplay loop muted poster="../controller/image/motos_img.png">
        <source src="../controller/image/video_motos.mp4">
    </video>

    <div class="container_all">
        <div class="ctn-form">
            <header>
                <img src="../controller/image/favicon.png" alt="" class="logo">
                <h1 class="title"> <span>VALIDACION EXISTENCIA DE USUARIO</span></h1>
            </header>

            <form action="../controller/recuperar_contrasena.php" method="POST" autocomplete="off" id="formulario" class="formulario" autocomplete="off">

                <!-- Group: Document -->
                <div class="formulario__grupo" id="grupo__document">
                    <label for="document" class="formulario__label">Numero de documento</label>
                    <div class="formulario__grupo-input">
                        <input type="number" autofocus onkeypress="" maxlength="10" oninput="maxlengthNumber(this);" class="formulario__input" name="document" id="document" required placeholder="Ingrese su numero de documento">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El numero de documento debe ser de 6 a 10 numeros.</p>
                </div>
                <!-- Group: Username -->

                <div class="formulario__grupo" id="grupo__username">
                    <label for="username" class="formulario__label">Nombre de Usuario</label>
                    <div class="formulario__grupo-input">
                        <input type="text" onkeypress="return(multipletext(event));" maxlength="12" oninput="maxlengthNumber(this);" class="formulario__input" name="username" required id="username" placeholder="Ingrese su nombre de usuario">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">El usuario tiene que ser de 10 a 12 dígitos y solo puede contener numeros, letras y guion bajo.</p>
                </div>

                <input type="submit" class="submit"  name="inicio" value="Validar"> 

            </form>
            <span class="text-footer"><a href="../index.php">Regresar a Pagina Principal</a></span>
            <span class="text-footer">¿Aun no se encuentra registrado?<a href="../register_usu.php"> Registrarme</a></span>


        </div>
        <div class="ctn-text">
            <div class="capa"></div>
            <h1 class="title-description">Validacion de <span class="multiple-text"></span><span class="usuario"></h1>
            <p class="textdescription">Lo que más quieres en el mundo tiene nombre, placa y cilindraje, son parte de nuestro día a día, ningún cuidado es suficiente para demostrarle cuánto las amamos, por eso somos tu mejor eleccion.</p>
        </div>
    </div>

    <!-- FUNCION QUE PERMITE INGRESAR SOLO EL NUMERO REQUERIDOS DE VALORES DE ACUERDO AL VALOR DEL MAXLENGTH DEL INPUT -->

    <script>
        function maxlengthNumber(obj) {
            if (obj.value.length > obj.maxLength) {
                obj.value = obj.value.slice(0, obj.maxLength);
                alert("Debe ingresar solo numeros en el campo y debe ser en un rango de 6 a 10 numeros.");
            }
        }
    </script>

    <!-- FUNCION QUE PERMITE INGRESAR SOLO LETRAS EN CADA UNO DE LOS CAMPOS EL CUAL SE INVOCO LA FUNCION EN EL ONKEYPRESS -->
    <script>
        function multipletext(e) {
            key = e.keyCode || e.which;

            teclado = String.fromCharCode(key).toLowerCase();

            letras = "qwertyuiopasdfghjklñzxcvbnm1234567890";

            especiales = "8-37-38-46-164-46";

            teclado_especial = false;

            for (var i in especiales) {
                if (key == especiales[i]) {
                    teclado_especial = true;
                    break;
                }
            }

            if (letras.indexOf(teclado) == -1 && !teclado_especial) {
                return false;
                alert("Debe ingresar solo numeros en el campo y debe ser en un rango de 6 a 10 numeros.");
            }
        }
    </script>

    <!-- TYPED JS -->
    <script src="https://unpkg.com/typed.js@2.0.132/dist/typed.umd.js"></script>
    <script src="../controller/JS/main.js"></script>

    <!-- VALIDACION DE FORMULARIO -->
    <script src="../controller/JS//formulario.js"></script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</body>

</html>

