<?php
    require_once "database.inc.php";

    $db = new Database();

    if(isset($_POST['password'])) {
        $result = $db -> connect(
            "update", 
            "accounts", 
            array(
                "uid" => $_SESSION["uid"],
                "password" => $password, 
            ),
            "password"
        );

        $_SESSION["password"] = $password;

        header("Location: index.php?page=myaccount");
    }
?>