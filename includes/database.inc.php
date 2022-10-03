<?php
    class Database {
        function connect($operation, $tableName, $data = null, $account = null) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $result = false;

            try {
                $conn = new PDO("mysql:host=$servername; dbname=pcsps", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                switch($operation) {
                    case "select":
                        $result = $this -> selectData($conn, $tableName, $data, $account);
                        break;
                    case "insert":
                        $result = $this -> insertData($conn, $tableName, $data);
                        break;
                    case "update":
                        $result = $this -> updateData($conn, $tableName, $data, $account);
                        break;
                }
                
                return $result;
                echo "Connected successfully";
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

        function selectData($conn, $tableName, $data, $account) {
            if(strcmp($data, "email") == 0) {
                $stmt = $conn->prepare("SELECT * FROM `$tableName` WHERE `$data` = '$account'");
                $stmt -> execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else if(strcmp($data, "uid") == 0) {
                $stmt = $conn->prepare("SELECT * FROM `$tableName` WHERE `$data` = '$account'");
                $stmt -> execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else if(strcmp($account, "Completed") == 0) {
                $stmt = $conn->prepare("SELECT * FROM `$tableName` WHERE `$data` = '$account'");
                $stmt -> execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else if(strcmp($account, "Incomplete") == 0) {
                $stmt = $conn->prepare("SELECT * FROM `$tableName` WHERE NOT `$data` = 'Completed'");
                $stmt -> execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $stmt = $conn->prepare("SELECT * FROM `$tableName`");
                $stmt -> execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            return $result;
        }

        function insertData($conn, $tableName, $data) {
            switch($tableName) {
                case "accounts":
                    {
                        $uid = $data['uid'];
                        $image = $data['image'];
                        $firstname = $data['firstname'];
                        $lastname = $data['lastname'];
                        $email = $data['email'];
                        $address = $data['address'];
                        $contact = $data['contact_number'];
                        $gcashName = $data['gcashName'];
                        $gcashNumber = $data['gcashNumber'];
                        $password = $data['password'];
                        $type = $data['type'];

                        $stmt = $conn->prepare("INSERT INTO `$tableName` (`uid`, `image`, `firstname`, `lastname`, `email`, `address`, `contact_number`, `gcash_name`, `gcash_number`, `password`, `type`) VALUES (:uid, :image, :firstname, :lastname, :email, :address, :contact, :gcashName, :gcashNumber, :password, :type)");
                        $stmt -> bindParam(':uid', $uid);
                        $stmt -> bindParam(':image', $image);
                        $stmt -> bindParam(':firstname', $firstname);
                        $stmt -> bindParam(':lastname', $lastname);
                        $stmt -> bindParam(':email', $email);
                        $stmt -> bindParam(':address', $address);
                        $stmt -> bindParam(':contact', $contact);
                        $stmt -> bindParam(':gcashName', $gcashName);
                        $stmt -> bindParam(':gcashNumber', $gcashNumber);
                        $stmt -> bindParam(':password', $password);
                        $stmt -> bindParam(':type', $type);
                        $stmt->execute();
                    };
                    break;
                case "client_carts":
                    {
                        $uid = $data['uid'];
                        $name = $data["name"];
                        $email = $data["email"];
                        $address = $data["address"];
                        $gcashName = $data["gcashName"];
                        $gcashNumber = $data["gcashNumber"];
                        $referenceNo = $data["referenceNo"];
                        $orderNumber = uniqid(rand(0,999));
                        $transactionNumber = uniqid(rand(0,999));
                        $items = $data["items"];
                        $total = $data["total"];

                        $stmt = $conn->prepare("INSERT INTO `$tableName` (`uid`, `name`, `email`, `address`, `gcash_name`, `gcash_number`, `reference_no`, `order_number`, `transaction_number`, `items`, `total`) VALUES (:uid, :name, :email, :address, :gcashName, :gcashNumber, :referenceNo, :orderNumber, :transactionNumber, :items, :total)");
                        $stmt -> bindParam(':uid', $uid);
                        $stmt -> bindParam(':name', $name);
                        $stmt -> bindParam(':email', $email);
                        $stmt -> bindParam(':address', $address);
                        $stmt -> bindParam(':gcashName', $gcashName);
                        $stmt -> bindParam(':gcashNumber', $gcashNumber);
                        $stmt -> bindParam(':referenceNo', $referenceNo);
                        $stmt -> bindParam(':orderNumber', $orderNumber);
                        $stmt -> bindParam(':transactionNumber', $transactionNumber);
                        $stmt -> bindParam(':items', $items);
                        $stmt -> bindParam(':total', $total);
                        $stmt->execute();
                    }
                    break;
                case "client_concerns":
                    {
                        $firstname = $data['firstname'];
                        $lastname = $data['lastname'];
                        $email = $data['email'];
                        $message = $data['message'];

                        $stmt = $conn->prepare("INSERT INTO `$tableName` (`firstname`, `lastname`, `email`, `message`) VALUES (:firstname, :lastname, :email, :message)");
                        $stmt -> bindParam(':firstname', $firstname);
                        $stmt -> bindParam(':lastname', $lastname);
                        $stmt -> bindParam(':email', $email);
                        $stmt -> bindParam(':message', $message);
                        $stmt->execute();
                    }
                    break;
                case "deleted_account":
                    {
                        $firstname = $data['firstname'];
                        $lastname = $data['lastname'];
                        $email = $data['email'];
                        $reason = $data['reason'];

                        $stmt = $conn->prepare("INSERT INTO `$tableName` (`firstname`, `lastname`, `email`, `reason`) VALUES (:firstname, :lastname, :email, :reason)");
                        $stmt -> bindParam(':firstname', $firstname);
                        $stmt -> bindParam(':lastname', $lastname);
                        $stmt -> bindParam(':email', $email);
                        $stmt -> bindParam(':reason', $reason);
                        $stmt->execute();
                    }
                    break;
            }
                
        }

        function updateData($conn, $tableName, $data, $account) {
            switch($tableName) {
                case "accounts":
                    {
                        $stmt = "";

                        switch($account) {
                            case "information":
                                $uid = $data['uid'];
                                $image = $data['image'];
                                $firstname = $data['firstname'];
                                $lastname = $data['lastname'];
                                $email = $data['email'];
                                $address = $data['address'];
                                $contact = $data['contact'];
                                $gcashName = $data['gcashName'];
                                $gcashNumber = $data['gcashNumber'];
                                
                                $stmt = $conn->prepare("UPDATE `$tableName` SET `uid` = '$uid', `image` = '$image', `firstname` = '$firstname', `lastname` = '$lastname', `email` = '$email', `address` = '$address', `contact_number` = '$contact', `gcash_name` = '$gcashName', `gcash_number` = '$gcashNumber' WHERE `uid` = '$uid'");
                                break;
                            case "password":
                                $uid = $data['uid'];
                                $password = $data['password'];

                                $stmt = $conn->prepare("UPDATE `$tableName` SET `password` = '$password' WHERE uid = '$uid'");
                                break;
                            case "account":
                                $uid = $data['uid'];

                                $stmt = $conn->prepare("UPDATE `$tableName` SET `status` = 'deactivated' WHERE uid = '$uid'");
                                break;
                        }
                        
                        $stmt->execute();
                        
                        return "Success";
                    };
                    break;
                case "client_carts":
                    {
                        if(strcmp($account, "item_status") == 0) {
                            $transactioNumber = $data['transactioNumber'];
                            $itemStatus = $data['status'];

                            $stmt = $conn->prepare("UPDATE `$tableName` SET `item_status` = '$itemStatus' WHERE `transaction_number` = '$transactioNumber'");
                            $stmt->execute();
                        } else if (strcmp($account, "transaction_status") == 0) {
                            $transactioNumber = $data['transactioNumber'];
                            $transactionStatus = $data['status'];

                            $stmt = $conn->prepare("UPDATE `$tableName` SET `transaction_status` = '$transactionStatus' WHERE `transaction_number` = '$transactioNumber'");
                            $stmt->execute();
                        }
                    };
                    break;
                }
        }
    }
?>