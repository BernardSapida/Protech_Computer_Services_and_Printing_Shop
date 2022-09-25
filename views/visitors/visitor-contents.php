<?php
    $current_page = empty($_GET["page"]) ? "" : $_GET["page"];

    switch($current_page) {
        case "admin-dashboard":
            require_once "admin/admin-dashboard.php";
            break;
        default:
            require_once "views/home.php";
    }
?>