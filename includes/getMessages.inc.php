<?php
    require_once "database.inc.php";

    session_start();

    $db = new Database();

    $result = $db -> connect(
        "select", 
        "client_concerns"
    );

    echo json_encode($result);
?>