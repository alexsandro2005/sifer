<?php

session_start();
require_once("../../database/connection.php");
$db = new Database();
$connection = $db->conectar();


$productos = $connection->prepare("SELECT * FROM `products` WHERE id_state=1");
$productos->execute();
$num_rows = $productos->rowCount();

$resultado = $num_rows;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../controller/css/estilos.tienda.css">

</head>

<body>
    <div class="center mt-5">
        <div class="card pt-3">
            <p>Carrito de compra</p>

            <?php
            foreach ($productos as $rows) { ?>


                <div class="container-card">
                    <div class="container__trust container__card_primary">
                        <div class="text__trust text__card-primary">
                            <p>TIENDA DE COMPRA DE PRODUCTOS</p>
                            <h1>Resultado (<?php echo $num_rows ?>)</h1>
                        </div>
                        <form id="formulario" name="formulario" method="post" action="cart.php">
                            <div class="blog-post">
                                <a class="category" href="">
                                </a>
                            </div>


                            <div class="trust card__primary">

                                <div class="container__trust container__box-cardPrimary">
                                    <div class="card__trust box__card-primary">
                                        <img src="../../controller/image/anchor.png" alt="">


                                        <div class="tabla_content">
                                            <input name="id" type="hidden" value="<?php echo $rows["id_product"] ?>">
                                            <input name="precio" type="hidden" value="<?php echo $rows["name_product"] ?>">
                                            <input name="cantidad" type="hidden" value="<?php echo $rows["precio"] ?>">
                                            <input name="cant" type="hidden" value="1">
                                        </div>




                                    </div>

                                </div>
                            </div>
                    </div>
                    </form>

                <?php } ?>
                </div>
        </div>

    </div>
    </div>
</body>

</html>