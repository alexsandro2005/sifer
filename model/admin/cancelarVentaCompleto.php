<?php

session_start();


// ELIMININAMOS LOS PRODUCTOS QUE ESTEN AGREGADOS

unset($_SESSION["productCart"]);
$_SESSION["productCart"] = [];

// ELIMINAMOS LOS DOCUMENTOS QUE ESTEN AGGREGADOS

unset($_SESSION["documentCart"]);
$_SESSION["documentCart"] = [];


// ELIMINAMOS LOS SERVICIOS QUE ESTEN AGREGADOS

unset($_SESSION["serviceCart"]);
$_SESSION["serviceCart"] = [];

header("Location: ./vender_completo.php?status=2");
?>