<?php 
    $item = empty($_GET["item"]) ? "" : $_GET["item"];

    switch($item) {
        case "document":
            include_once "document.php";
            break;
        case "id":
            include_once "id.php";
            break;
        case "tarpaulin":
            include_once "tarpaulin.php";
            break;
    }
?>