<?php

    require_once "database.inc.php";

    session_start();

    $db = new Database();

    $result = $db -> connect(
        "select",
        "accounts"
    );

    echo json_encode($result);
