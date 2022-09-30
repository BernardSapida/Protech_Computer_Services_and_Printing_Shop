<?php
    if(!empty($_POST)) {
        $image_name = $_FILES["picture"]["name"];
        $image_size = $_FILES["picture"]["size"];
        $image_tmp = $_FILES["picture"]["tmp_name"];
        $image_err = $_FILES["picture"]["error"];

        $image_new_name = "";
        $image_external = pathinfo($image_name, PATHINFO_EXTENSION);
        $image_external_lowercase = strtolower($image_external);
        
        $image_new_name = uniqid("IMAGE-", true) . '.' . $image_external_lowercase;
        $image_upload_path = 'public/documents/' . $image_new_name;
        move_uploaded_file($image_tmp, $image_upload_path);

        $image = $image_new_name;

        $_POST["date"] = date("F j, Y h:i:s A");
        $_POST["file"] = $image_new_name;

        array_push($_SESSION["cart"], $_POST);

        header("Location: index.php?page=cart");
    }
?>