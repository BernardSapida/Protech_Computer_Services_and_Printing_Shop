<?php

    require_once "database.inc.php";

    error_reporting(E_ERROR | E_PARSE);

    $db = new Database();

    if (!empty($_POST)) {
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $subject = $_POST["subject"];
        $message = $_POST["message"];

        $db -> connect(
            "insert",
            "client_concerns",
            array(
                "firstname" => $firstname,
                "lastname" => $lastname,
                "email" => $email,
                "subject" => $subject,
                "message" => $message,
            )
        );
    }
