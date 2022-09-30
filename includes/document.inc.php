<?php
    if(!empty($_POST)) {
        $document_name = $_FILES["document"]["name"];
        $document_size = $_FILES["document"]["size"];
        $document_tmp = $_FILES["document"]["tmp_name"];
        $document_err = $_FILES["document"]["error"];

        $document_new_name = "";
        $document_external = pathinfo($document_name, PATHINFO_EXTENSION);
        $document_external_lowercase = strtolower($document_external);
        
        $document_new_name = uniqid("DOCUMENT-", true) . '.' . $document_external_lowercase;
        $document_upload_path = 'public/documents/' . $document_new_name;
        move_uploaded_file($document_tmp, $document_upload_path);

        $_POST["date"] = date("F j, Y h:i:s A");
        $_POST["file"] = $document_new_name;

        array_push($_SESSION["cart"], $_POST);

        header("Location: index.php?page=cart");
    }
?>