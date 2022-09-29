<?php
    require_once "database.inc.php";

    $db = new Database();

    if(isset($_POST['firstname'])) {
        if(!empty($_FILES["picture"]["name"])) {
            $image_name = $_FILES["picture"]["name"];
            $image_size = $_FILES["picture"]["size"];
            $image_tmp = $_FILES["picture"]["tmp_name"];
            $image_err = $_FILES["picture"]["error"];

            $image_new_name = "";
            $image_external = pathinfo($image_name, PATHINFO_EXTENSION);
            $image_external_lowercase = strtolower($image_external);
            
            $image_new_name = uniqid("IMAGE-", true) . '.' . $image_external_lowercase;
            $image_upload_path = 'public/images/profile/' . $image_new_name;
            move_uploaded_file($image_tmp, $image_upload_path);

            $image = $image_new_name;
        }

        $image = empty($image) ? $_SESSION["image"] : $image;
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $contact = $_POST["contact"];
        $gcashName = $_POST["gcashName"];
        $gcashNumber = $_POST["gcashNumber"];

        $result = $db -> connect(
            "update", 
            "accounts", 
            array(
                "uid" => $_SESSION["uid"],
                "image" => $image, 
                "firstname" => $firstname, 
                "lastname" => $lastname, 
                "email" => $email, 
                "address" => $address, 
                "contact" => $contact, 
                "gcashName" => $gcashName, 
                "gcashNumber" => $gcashNumber, 
            ),
            "information"
        );

        $_SESSION["image"] = $image;
        $_SESSION["firstname"] = $firstname;
        $_SESSION["lastname"] = $lastname;
        $_SESSION["email"] = $email;
        $_SESSION["address"] = $address;
        $_SESSION["contact_number"] = $contact;
        $_SESSION["gcash_name"] = $gcashName;
        $_SESSION["gcash_number"] = $gcashNumber;

        header("Location: index.php?page=myaccount");
    }
?>