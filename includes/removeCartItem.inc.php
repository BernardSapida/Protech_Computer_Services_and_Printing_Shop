<?php
    session_start();

    $data = json_decode(file_get_contents("php://input"), true);

    unset($_SESSION["cart"][$data["index"]]);
    echo json_encode($_SESSION["cart"]);
?>