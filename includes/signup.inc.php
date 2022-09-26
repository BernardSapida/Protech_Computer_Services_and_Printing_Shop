<?php
    require_once "database.inc.php";

    error_reporting(E_ERROR | E_PARSE);

    $db = new Database();

    if(count($_POST) > 0) {
        $uid = uniqid(rand(0,999));
        $image = "default.jpg";
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $contact_number = $_POST["contact"];
        $gcashName = $_POST["gcashName"];
        $gcashNumber = $_POST["gcashNumber"];
        $password = $_POST["password"];
        $encryptPassword = password_hash($password, PASSWORD_DEFAULT);

        $db -> connect(
            "insert", 
            "accounts", 
            array(
                "uid" => $uid, 
                "image" => $image, 
                "firstname" => $firstname,
                "lastname" => $lastname,
                "email" => $email,
                "address" => $address,
                "contact_number" => $contact_number,
                "gcashName" => $gcashName,
                "gcashNumber" => $gcashNumber,
                "password" => $encryptPassword,
                "type" => "client",
            )
        );

        header("Location: index.php?page=signin");
    }
?>