<?php
    require_once "database.inc.php";

    $db = new Database();

    if(isset($_POST['password'])) {
        $result = $db -> connect(
            "update", 
            "accounts", 
            array(
                "uid" => $_SESSION["uid"],
            ),
            "account"
        );

        $result = $db -> connect(
            "insert", 
            "deleted_account", 
            array(
                "firstname" => $_SESSION["firstname"],
                "lastname" => $_SESSION["lastname"],
                "email" => $_SESSION["email"],
                "reason" => $_POST["reason"],
            ),
        );

        header("Location: index.php?page=myaccount");
    }
?>