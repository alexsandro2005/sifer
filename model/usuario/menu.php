<div id="sidebar">
    <div class="sidebar-header">
        <h3><img src="../../controller/image/favicon.png" class="img-fluid" /><span><?php echo $usua['type_user'] ?> <span><?php echo $usua['name'] ?></span></h3>
        <h3><span></span></h3>
    </div>
    <ul class="list-unstyled component">
        <li class="active">
            <a href="index.php" class="dashboard"><i class="material-icons">dashboard</i>Mis Motos </a>
        </li>
        <li class="dropdown">
            <a href="#homeSubmen20" data-toggle="collapse" class="dropdown-toggle">
                <i class="material-icons">dashboard</i>Editar Cuenta
            </a>
            <ul class="collapse list-unstyled menu" id="homeSubmen20">
                <li><a href="./contrasena.php">Cambiar contraseña</a></li>
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

                                    $services = $connection->prepare("SELECT * FROM trigger_service INNER JOIN motorcycles INNER JOIN user ON trigger_service.placa = motorcycles.placa AND motorcycles.document = user.document WHERE user.document = '" . $_SESSION['id_user'] . "'  LIMIT 5");
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

                                                echo '<li>' . '<a>' . 'Su moto con la placa' . ' ' . $ventServicio['placa'] . ' ' . 'Tiene' . ' ' . $diasRestantes . ' dias Restantes para realizar cambio de aceite' . ' </a>' . '</li>';
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

                                    $documents = $connection->prepare("SELECT ventas.total, ventas.fecha, ventas.id, ventas.fecha_fin, user.name, motorcycles.placa,documentos.nombre, GROUP_CONCAT(documentos.codigo, '..', documentos.nombre, '..', documentos.nombre SEPARATOR '__') AS documentos FROM ventas INNER JOIN documentos_vendidos ON documentos_vendidos.id_venta = ventas.id INNER JOIN documentos ON documentos.id_documento = documentos_vendidos.id_documento INNER JOIN user ON user.document = ventas.document INNER JOIN motorcycles ON motorcycles.placa = ventas.placa WHERE user.document = :user_document GROUP BY ventas.id ORDER BY ventas.id LIMIT 5");

                                    $user_document = $_SESSION['id_user'];
                                    $documents->bindParam(':user_document', $user_document);
                                    $documents->execute();

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


                                                echo '<li>' . '<a>' . 'la moto con la placa' . ' ' . $ventaDocumento->placa . ' ' . 'Tiene' . ' ' . $diasRestantes . ' dias Restantes para actualizar sus seguros' . ' </a>' . '</li>';
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