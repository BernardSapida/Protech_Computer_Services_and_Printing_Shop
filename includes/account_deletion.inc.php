<?php
    require_once "database.inc.php";

    $db = new Database();

    session_start();

    $data = json_decode(file_get_contents("php://input"), true);

    if(isset($data['password'])) {
        $result1 = $db -> connect(
            "update", 
            "accounts", 
            array(
                "uid" => $_SESSION["uid"],
            ),
            "account"
        );

        $result2 = $db -> connect(
            "insert", 
            "deleted_account", 
            array(
                "firstname" => $_SESSION["firstname"],
                "lastname" => $_SESSION["lastname"],
                "email" => $_SESSION["email"],
                "reason" => $data["reason"],
            ),
        );
    }
?>