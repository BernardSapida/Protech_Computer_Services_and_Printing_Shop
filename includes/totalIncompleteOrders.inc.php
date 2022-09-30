<?php
    require_once "database.inc.php";

    session_start();

    $db = new Database();

    $result = $db -> connect(
        "select", 
        "client_carts",
        "item_status",
        "Incomplete"
    );

    echo json_encode($result);
?>