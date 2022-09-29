<?php
    require_once "database.inc.php";

    session_start();

    error_reporting(E_ERROR | E_PARSE);

    $db = new Database();
    $data = json_decode(file_get_contents("php://input"), true);

    if(!empty($data)) {
        $firstname = $data["firstname"];
        $lastname = $data["lastname"];
        $email = $data["email"];
        $address = $data["address"];
        $gcashName = $data["gcashName"];
        $gcashNumber = $data["gcashNumber"];
        $referenceNo = $data["referenceNo"];
        $orderNumber = uniqid(rand(0,999));
        $transactionNumber = uniqid(rand(0,999));
        $items = json_encode($data["items"]);
        $total = $data["total"];

        $result = $db -> connect(
            "insert", 
            "client_carts", 
            array(
                "name" => $firstname . " " . $lastname, 
                "email" => $email, 
                "address" => $address, 
                "gcashName" => $gcashName, 
                "gcashNumber" => $gcashNumber, 
                "referenceNo" => $referenceNo, 
                "orderNumber" => $orderNumber, 
                "transactionNumber" => $transactionNumber, 
                "items" => $items,
                "total" => $total,
            )
        );

        $_SESSION["cart"] = array();
    }
?>