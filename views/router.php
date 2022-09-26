<?php 
    $current_page = empty($_GET["page"]) ? "" : $_GET["page"];
    $visitor = empty($_SESSION["type"]) ? "" : $_SESSION["type"];

    switch($current_page) {
        case "home":
            include_once "global/home.php";
            break;
        case "services":
            {   
                if(strcmp($visitor, "client") == 0) include_once "clients/services.php";
                else include_once "global/services.php";
            }
            break;
        case "addtocart":
            include_once "clients/addtocart.php";
            break;
        case "cart":
            include_once "clients/cart.php";
            break;
        case "status":
            include_once "clients/order_status.php";
            break;
        case "contactus":
            include_once "global/contact_us.php";
            break;
        case "myaccount":
            include_once "clients/my_account.php";
            break;
        case "adminorders":
            include_once "admin/client_orders.php";
            break;
        case "adminaccounts":
            include_once "admin/client_accounts.php";
            break;
        case "adminmessages":
            include_once "admin/client_messages.php";
            break;
        case "signin":
            include_once "visitors/signin.php";
            break;
        case "signup":
            include_once "visitors/signup.php";
            break;
        case "signout":
            include_once "global/signout.php";
            break;
        default:
            include_once "global/home.php";
            break;
    }
?>
