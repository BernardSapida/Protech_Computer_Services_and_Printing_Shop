<?php
    require_once "database.inc.php";

    $db = new Database();

    if(isset($_POST['newPassword'])) {
        $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
        $result = $db -> connect(
            "update", 
            "accounts", 
            array(
                "uid" => $_SESSION["uid"],
                "password" => $newPassword, 
            ),
            "password"
        );

        $_SESSION["password"] = $newPassword;
        header("Location: index.php?page=myaccount");
    }
?>