<?php
    require_once "database.inc.php";

    session_start();

    $data = json_decode(file_get_contents("php://input"), true);

    $db = new Database();

    $result = $db -> connect(
        "update", 
        "client_carts",
        array(
            "transactioNumber" => $data['transactioNumber'],
            "status" => $data['itemStatus'],
        ),
        "item_status"
    );

    echo json_encode($result);
?>