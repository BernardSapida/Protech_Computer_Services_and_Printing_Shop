<?php
    if(isset($_SESSION["type"])) {
        if(strcmp($_SESSION["type"], "admin") == 0) header("Location: index.php?page=adminorders");
    } else {
        header("Location: index.php?page=home");
    }
?>