<?php
    $current_page = empty($_GET["page"]) ? "" : $_GET["page"];

    switch($current_page) {
        case "home":
            echo '<link rel="stylesheet" href="public/css/index.css">';
            break;
        case "contactus":
            echo '<link rel="stylesheet" href="public/css/contact_us.css">';
            break;
        case "myaccount":
            echo '<link rel="stylesheet" href="public/css/my_account.css">';
            break;
    }
?>