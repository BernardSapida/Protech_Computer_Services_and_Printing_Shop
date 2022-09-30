<?php
    if(isset($_SESSION["type"])) {
        if(strcmp($_SESSION["type"], "client") == 0) header("Location: index.php?page=home");
    } else {
        header("Location: index.php?page=home");
    }
?>