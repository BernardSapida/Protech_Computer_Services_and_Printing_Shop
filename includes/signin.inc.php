<?php
    require_once "database.inc.php";
 
    error_reporting(E_ERROR | E_PARSE);

    session_start();

    $db = new Database();

    $data = json_decode(file_get_contents("php://input"), true);

    if(!empty($data)) {
        $email = $data["email"];
        $password = $data["password"];
        $result = $db -> connect("select", "accounts", 'email', $email);

        if(!empty($result)) {
            if(strcmp($result["status"], "activated") == 0) {
                if(password_verify($password, $result["password"]) == 1) {
                    $_SESSION["uid"] = $result["uid"];
                    $_SESSION["image"] = $result["image"];
                    $_SESSION["firstname"] = $result["firstname"];
                    $_SESSION["lastname"] = $result["lastname"];
                    $_SESSION["email"] = $result["email"];
                    $_SESSION["address"] = $result["address"];
                    $_SESSION["contact_number"] = $result["contact_number"];
                    $_SESSION["gcash_name"] = $result["gcash_name"];
                    $_SESSION["gcash_number"] = $result["gcash_number"];
                    $_SESSION["password"] = $result["password"];
                    $_SESSION["type"] = $result["type"];
                    $_SESSION["cart"] = array();
                    echo json_encode(["Authorized", $_SESSION["type"]]);
                } else echo "Incorrect password";
            } else {
                echo "Deleted account";
            }
        } else echo "Not found";
    }
?>