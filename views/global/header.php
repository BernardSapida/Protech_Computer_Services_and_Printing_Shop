<?php
    $current_page = empty($_GET["page"]) ? "" : $_GET["page"];

    switch($current_page) {
        case "home":
            echo '<link rel="stylesheet" href="public/css/index.css">';
            echo '<title>PSCPS | Home</title>';
            break;
        case "services":
            echo '<title>PSCPS | Services</title>';
            break;
        case "cart":
            echo '<title>PSCPS | Cart</title>';
            break;
        case "status":
            echo '<title>PSCPS | Order Status</title>';
            break;
        case "addtocart":
            echo '<title>PSCPS | Add to cart</title>';
            break;
        case "contactus":
            echo '<link rel="stylesheet" href="public/css/contact_us.css">';
            echo '<title>PSCPS | Contact Us</title>';
            break;
        case "myaccount":
            echo '<link rel="stylesheet" href="public/css/my_account.css">';
            echo '<title>PSCPS | My Account</title>';
            break;
        case "clientorders":
            echo '<title>PSCPS | Client Orders</title>';
            break;
        case "clientaccounts":
            echo '<title>PSCPS | Client Accounts</title>';
            break;
        case "clientmessages":
            echo '<title>PSCPS | Client Messages</title>';
            break;
        case "signup":
            echo '<title>PSCPS | Signup</title>';
            break;
        case "signin":
            echo '<title>PSCPS | Signin</title>';
            break;
        default:
            echo '<link rel="stylesheet" href="public/css/index.css">';
            echo '<title>PSCPS | Home</title>';
            break;
    }
?>