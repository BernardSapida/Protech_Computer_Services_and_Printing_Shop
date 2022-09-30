<?php
    session_start();

    $data = json_decode(file_get_contents("php://input"), true);

    if(!empty($data)) {
        if(password_verify($data["password"], $_SESSION["password"]) == 1) {
            echo "password matched";
            return;
        }
        echo "password didn't matched";
    }
?>