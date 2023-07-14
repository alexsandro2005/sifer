<?php

    session_start();
    require_once("../../database/connection.php");
    $db = new Database();

    $connection = $db->conectar();

    $campo = $_POST["codigo"];

    $sql = "SELECT codigo,name_pro FROM productos codigo LIKE ? ORDER BY codigo ASC";

    $autocomplete = $connection ->prepare($sql);
    $autocomplete->execute([$campo . '%']);

    $html= "";

    while($row = $autocomplete->fetch(PDO::FETCH_ASSOC)){
        $html .= "<li>".$row["codigo"]." - ". $row["name_pro"]. "<li>";
    } 


    echo json_encode($html, JSON_UNESCAPED_UNICODE);


?>