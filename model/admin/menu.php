<div id="sidebar">
    <div class="sidebar-header">
        <h3><img src="../../controller/image/favicon.png" class="img-fluid" /><span><?php echo $usua['type_user'] ?> <span><?php echo $usua['name'] ?></span></h3>
        <h3><span></span></h3>
    </div>
    <ul class="list-unstyled component">
        <li class="active">
            <a href="index.php" class="dashboard"><i class="material-icons">dashboard</i>Menu Principal </a>
        </li>
        <li class="dropdown">
            <a href="#homeSubmen15" data-toggle="collapse" class="dropdown-toggle">
                <i class="material-icons">dashboard</i>Actividad Reciente
            </a>
            <ul class="collapse list-unstyled menu" id="homeSubmen15">
                <li><a href="act_trabajador.php">Actividades Trabajadores</a></li>
                <li><a href="act_cliente.php">Actividades Clientes</a></li>

            </ul>
        </li>
        <li class="dropdown">
            <a href="#homeSubmen20" data-toggle="collapse" class="dropdown-toggle">
                <i class="material-icons">dashboard</i>Editar Cuenta
            </a>
            <ul class="collapse list-unstyled menu" id="homeSubmen20">
                <li><a href="./contrasena.php">Cambiar contraseña</a></li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="#homeSubmen11" data-toggle="collapse" class="dropdown-toggle">
                <i class="material-icons">dashboard</i>Crear
            </a>
            <ul class="collapse list-unstyled menu" id="homeSubmen11">
                <li><a href="#" onclick="openFormModal()">Crear Color</a></li>
                <li><a href="#" onclick="openFormModelo()">Crear Modelo</a></li>
                <li><a href="#" onclick="openFormMarca()">Crear Marca</a></li>
                <li><a href="#" onclick="openFormMarcProducto()">Crear Marca Producto</a></li>
                <li><a href="#" onclick="openFormCombustible()">Crear Combustible</a></li>
                <li><a href="#" onclick="openFormCarroceria()">Crear Carroceria</a></li>
                <li><a href="#" onclick="openFormCilindraje()">Crear Cilindraje</a></li>
                <li><a href="#" onclick="openFormServicio()">Crear Serv. Moto</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#homeSubmenu25" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="material-icons">apps</i>Actualizaciones
            </a>
            <ul class="collapse list-unstyled menu" id="homeSubmenu25">
                <li><a href="historial_documentos.php">Historial Soat</a></li>
                <li><a href="historialTecnomecanica.php">Historial Tecnomecanica</a></li>
                <li><a href="historialAceite.php">Historial Cambio de aceite</a></li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="material-icons">apps</i>Usuarios
            </a>
            <ul class="collapse list-unstyled menu" id="homeSubmenu2">
                <li><a href="crear_usu.php">Crear Usuario</a></li>
                <li><a href="lista_usu.php">Lista usuarios</a></li>
                <li><a href="crear_cliente.php">Crear cliente</a></li>
                <li><a href="lista_clientes.php">Lista de Clientes</a></li>
                <li><a href="lista_tipo_usu.php">Lista de tipos de usuarios</a></li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="#homeSubmenu4" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="material-icons">equalizer</i>Motos
            </a>
            <ul class="collapse list-unstyled menu" id="homeSubmenu4">
                <li><a href="list_motos.php">Lista de Motos</a></li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="#homeSubmen17" data-toggle="collapse" class="dropdown-toggle">
                <i class="material-icons">dashboard</i>Inventarios
            </a>
            <ul class="collapse list-unstyled menu" id="homeSubmen17">
                <li><a href="lista_products.php">Lista de Productos</a></li>
                <li><a href="formulario.php">Crear Producto</a></li>
                <li><a href="service.php">Crear Servicio</a></li>
                <li><a href="lista_service.php">Lista de Servicios</a></li>
                <li><a href="documentos.php">Crear Seguro</a></li>
                <li><a href="lista_documento.php">Lista de Seguros</a></li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="#homeSubmenu5" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="material-icons">border_color</i>Generar Ventas
            </a>
            <ul class="collapse list-unstyled menu" id="homeSubmenu5">
                <li><a href="vender.php">Venta de Productos</a></li>
                <li><a href="vender_servicio.php">Venta de Servicios</a></li>
                <li><a href="vender_documento.php">Venta de Seguros</a></li>
                <li><a href="vender_completo.php">Venta completa</a></li>

            </ul>
        </li>

        <li class="dropdown">
            <a href="#homeSubmenu7" data-toggle="collapse" class="dropdown-toggle">
                <i class="material-icons">content_copy</i>Reporte Ventas
            </a>
            <ul class="collapse list-unstyled menu" id="homeSubmenu7">
                <li><a href="listaVentas_completas.php">Lista Venta Completa</a></li>
                <li><a href="ventas.php">Lista Venta Productos</a></li>
                <li><a href="ventas_documento.php">Lista Ventas Seguros</a></li>
                <li><a href="ventas_servicio.php">Lista Venta Servicios</a></li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="#homeSubmenu15" data-toggle="collapse" class="dropdown-toggle">
                <i class="material-icons">content_copy</i>Copia de seguridad
            </a>
            <ul class="collapse list-unstyled menu" id="homeSubmenu15">
                <li><a href="respaldo/respaldo.php">Generar Copia</a></li>
            </ul>
        </li>

    </ul>
</div>


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
                            </div>
                        </form>
                    </div>
                </div>


                <div class="col-10 col-md-6 col-lg-8 order-1 order-md-3">
                    <div class="xp-profilebar text-right">
                        <nav class="navbar p-0">
                            <ul class="nav navbar-nav flex-row ml-auto">


                                <!-- NOTIFICACIONES AL USUARIO SOBRE LA ACTUALIZACION DE DOCUMENTOS -->
                                <li class="dropdown nav-item active">
                                    <a class="nav-link" href="#" data-toggle="dropdown">
                                        <span class="material-icons">
                                            <span class="material-symbols-sharp">
                                                two_wheeler
                                            </span>
                                        </span>
                                        </span> <span class="notification">4</span>
                                    </a>
                                    <?php

                                    $services = $connection->prepare("SELECT * FROM trigger_service LIMIT 5");
                                    $services->execute();
                                    $ventasServicio = $services->fetchAll(PDO::FETCH_ASSOC);

                                    date_default_timezone_set('America/Bogota');
                                    echo '<ul class="dropdown-menu">';

                                    try {
                                        $fecha_actual = new DateTime();


                                        if (!empty($ventasServicio)) {
                                            foreach ($ventasServicio as $ventServicio) {
                                                $fechaVenta = new DateTime($ventServicio['fecha']);
                                                $fechaVencimiento = new DateTime($ventServicio['fecha_fin']);
                                                $diasRestantes = $fecha_actual->diff($fechaVencimiento)->days;

                                                echo '<li>' . '<a>' . 'la moto con la placa' . ' ' . $ventServicio['placa'] . ' ' . 'Tiene' . ' ' . $diasRestantes . ' dias Restantes para realizar cambio de aceite' . ' </a>' . '</li>';
                                            }
                                            echo '<li><a class="btn btn-info" href="historial_cambio_aceite.php">Ver mas -></a></li>';
                                        } else {
                                            echo '<li>' . '<a>' . 'No hay cambio de aceites disponibles' .  '</a>' . '</li>';
                                        }
                                    } catch (PDOException $e) {
                                        echo 'Error' . $e->getMessage();
                                    }

                                    echo  '</ul>';
                                    ?>
                                </li>


                                <li class="dropdown nav-item active">
                                    <a class="nav-link" href="#" data-toggle="dropdown">
                                        <span class="material-icons">
                                            <span class="material-symbols-sharp">
                                                receipt_long
                                            </span>
                                        </span>
                                        </span> <span class="notification">4</span>
                                    </a>
                                    <?php

                                    $documents = $connection->query("SELECT ventas.total,ventas.fecha, ventas.id,ventas.fecha_fin,user.name,motorcycles.placa,documentos.nombre,GROUP_CONCAT(documentos.codigo, '..',documentos.nombre, '..', documentos.nombre SEPARATOR '__') AS documentos FROM ventas INNER JOIN documentos_vendidos ON documentos_vendidos.id_venta = ventas.id INNER JOIN documentos ON documentos.id_documento = documentos_vendidos.id_documento INNER JOIN user ON user.document=ventas.document INNER JOIN motorcycles ON  motorcycles.placa=ventas.placa GROUP BY ventas.id ORDER BY ventas.id LIMIT 5;");
                                    $ventasDocumentos = $documents->fetchAll(PDO::FETCH_OBJ);

                                    date_default_timezone_set('America/Bogota');

                                    try {
                                        $fecha_actual = new DateTime();

                                        echo '<ul class="dropdown-menu">';

                                        if (!empty($ventasDocumentos)) {
                                            foreach ($ventasDocumentos as $ventaDocumento) {
                                                $fechaVenta = new DateTime($ventaDocumento->fecha);
                                                $fechaVencimiento = new DateTime($ventaDocumento->fecha_fin);
                                                $diasRestantes = $fecha_actual->diff($fechaVencimiento)->days;


                                                echo '<li>' . '<a>' . 'la moto con la placa' . ' ' . $ventaDocumento->placa . ' ' . 'Tiene' . ' ' . $diasRestantes . ' dias Restantes para actualizar sus documentos' . ' </a>' . '</li>';
                                            }

                                            echo '<li><a class="btn btn-info" href="historial_documentos.php">Ver mas -></a></li>';
                                            
                                        } else {
                                            echo '<li>' . '<a>' . 'No hay documentos por actualizar' .  '</a>' . '</li>';
                                        }

                                        echo  '</ul>';
                                    } catch (PDOException $e) {
                                        echo 'Error' . $e->getMessage();
                                    }
                                    ?>
                                </li>

                                <li class="dropdown nav-item active">
                                    <a class="nav-link" href="#" data-toggle="dropdown">
                                        <span class="material-icons">add_business</span>

                                        <?php
                                        $consulta = "SELECT COUNT(*) AS conteo FROM productos WHERE cantidad <= 5";

                                        try {
                                            $resultado = $connection->query($consulta);
                                            $conteo = $resultado->fetch(PDO::FETCH_ASSOC)['conteo'];
                                            if ($conteo) {
                                                echo '<span class="notification vencido">' . $conteo . '</span>';
                                            } else {
                                                echo '<span class="notification-green">' . $conteo . '</span>';
                                            }
                                        } catch (PDOException $e) {
                                            echo "Error en la consulta: " . $e->getMessage();
                                        }
                                        ?>

                                    </a>
                                    <?php

                                    try {
                                        $productos = $connection->prepare("SELECT * FROM productos INNER JOIN marca ON productos.id_marca = marca.id_marca AND productos.id_marca=marca.id_marca WHERE productos.cantidad <= 5 LIMIT 4");
                                        $productos->execute();
                                        $comprar_productos = $productos->fetchAll(PDO::FETCH_ASSOC);
                                        echo  '<ul class="dropdown-menu">';
                                        if (!empty($comprar_productos)) {
                                            
                                            foreach ($comprar_productos as $desgastados) {
                                                echo '<li>' . '<a>' . 'El producto' . ' ' . $desgastados['name_pro'] . ' ' . 'Esta agotado, tiene una cantidad de' . ' ' .  $desgastados['cantidad'] . ' ' . 'unidades' . '</a>' . '</li>';
                                            }

                                            echo '<li><a class="btn btn-info" href="lista_products.php">Ver mas</a></li>';

                                            
                                        } else {


                                            echo '<li>' . '<a>' . 'No hay productos agotados' .  '</a>' . '</li>';


                                        }
                                    } catch (PDOException $e) {
                                        echo 'Error: ' . $e->getMessage();
                                    }

                                    echo '</ul>';

                                    ?>
                                </li>

                                <li class="dropdown nav-item">
                                    <a class="nav-link" href="#" data-toggle="dropdown">
                                        <img src="../../controller/image/favicon.png" style="width:40px; border-radius:50%;" />
                                        <span class="xp-user-live"></span>
                                    </a>
                                    <ul class="dropdown-menu small-menu">
                                        <li>
                                            <form method="POST" action="">
                                                <tr><br>
                                                    <td colspan="2" align="center">
                                                        <input type="submit" value="Cerrar sesion" id="btn_quote" name="btncerrar" class="btn__out" />
                                                    </td>
                                                </tr>
                                            </form>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <script>
                function openFormModal() {
                    var modal = document.getElementById("formularioModal");
                    modal.style.display = "block";
                }

                function closeFormModal() {
                    var modal = document.getElementById("formularioModal");
                    modal.style.display = "none";
                }
            </script>

            <script>
                function openFormModelo() {
                    var modal = document.getElementById("formularioModelo");
                    modal.style.display = "block";
                }

                function closeFormModelo() {
                    var modal = document.getElementById("formularioModelo");
                    modal.style.display = "none";
                }
            </script>


            <script>
                function openFormMarca() {
                    var modal = document.getElementById("formularioMarca");
                    modal.style.display = "block";
                }

                function closeFormMarca() {
                    var modal = document.getElementById("formularioMarca");
                    modal.style.display = "none";
                }
            </script>

            <script>
                function openFormCombustible() {
                    var modal = document.getElementById("formularioCombustible");
                    modal.style.display = "block";
                }

                function closeFormCombustible() {
                    var modal = document.getElementById("formularioCombustible");
                    modal.style.display = "none";
                }
            </script>


            <script>
                function openFormCarroceria() {
                    var modal = document.getElementById("formularioCarroceria");
                    modal.style.display = "block";
                }

                function closeFormCarroceria() {
                    var modal = document.getElementById("formularioCarroceria");
                    modal.style.display = "none";
                }
            </script>

            <script>
                function openFormCilindraje() {
                    var modal = document.getElementById("formularioCilindraje");
                    modal.style.display = "block";
                }

                function closeFormCilindraje() {
                    var modal = document.getElementById("formularioCilindraje");
                    modal.style.display = "none";
                }
            </script>

            <script>
                function openFormServicio() {
                    var modal = document.getElementById("formularioServicio");
                    modal.style.display = "block";
                }

                function closeFormServicio() {
                    var modal = document.getElementById("formularioServicio");
                    modal.style.display = "none";
                }
            </script>

            <script>
                function openFormMarcProducto() {
                    var modal = document.getElementById("formularioMarcaProducto");
                    modal.style.display = "block";
                }

                function closeFormMarcProducto() {
                    var modal = document.getElementById("formularioMarcaProducto");
                    modal.style.display = "none";
                }
            </script>