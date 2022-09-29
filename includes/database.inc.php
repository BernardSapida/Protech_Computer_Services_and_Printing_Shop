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
                    case "delete":
                        $this -> deleteData($conn, $tableName, $data);
                        break;
                }
                
                return $result;
                echo "Connected successfully";
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

        function selectData($conn, $tableName, $data, $account) {
            $stmt = $conn->prepare("SELECT * FROM `$tableName` WHERE `$data` = '$account'");
            $stmt -> execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // if(!empty($data) && !empty($account)) {
            //     $stmt = $conn->prepare("SELECT * FROM `$tableName` WHERE `$data` = '$account'");
            //     $stmt -> execute();
            //     $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // } else {
            //     switch($tableName) {
            //         case "supplier_customer":
            //             {
            //                 if(strcmp($data, "order status") == 0) {
            //                     $stmt = $conn->prepare("SELECT * FROM `$tableName` WHERE `order status` = 'completed'");
            //                 } else {
            //                     $stmt = $conn->prepare("SELECT * FROM `$tableName` ORDER BY CASE 
            //                     WHEN `order status` = 'Processing' THEN 1 
            //                     WHEN `order status` = 'To ship' THEN 2 
            //                     WHEN `order status` = 'To receive' THEN 3 
            //                     WHEN `order status` = 'Completed' THEN 4 
            //                     WHEN `order status` = 'Cancelled' THEN 5
            //                     END");
            //                 }
            //             }
            //             break;
            //         case "supplier_product":
            //             $supplierName = $data["supplierName"];
            //             $stmt = $conn->prepare("SELECT * FROM `$tableName` WHERE `supplier name` = '$supplierName' ORDER BY `box quantity` ASC");
            //             break;
            //         case "admin_product":
            //             $stmt = $conn->prepare("SELECT * FROM `$tableName` ORDER BY `quantity` ASC");
            //             break;
            //         case "admin_orders":
            //             if(strcmp($data, "all records") == 0) $stmt = $conn->prepare("SELECT * FROM `$tableName` ORDER BY CASE  WHEN `order status` = 'Processing' THEN 1  WHEN `order status` = 'To ship' THEN 2  WHEN `order status` = 'To receive' THEN 3  WHEN `order status` = 'Completed' THEN 4  WHEN `order status` = 'Cancelled' THEN 5 END");
            //             else $stmt = $conn->prepare("SELECT * FROM `$tableName` WHERE `order status` = 'completed'");
            //             break;
            //         case "accounts":
            //             $stmt = $conn->prepare("SELECT * FROM `$tableName` WHERE `type` = '$data'");
            //             break;
            //         default:
            //             $stmt = $conn->prepare("SELECT * FROM $tableName");
            //             break;
            //     }

            //     $stmt -> execute();
            //     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // }

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

                        $stmt = $conn->prepare("INSERT INTO `$tableName` (`name`, `email`, `address`, `gcash_name`, `gcash_number`, `reference_no`, `order_number`, `transaction_number`, `items`, `total`) VALUES (:name, :email, :address, :gcashName, :gcashNumber, :referenceNo, :orderNumber, :transactionNumber, :items, :total)");
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
                                $storeName = $data['storeName'];
                                $contact = $data['contact no.'];
                                $paymentName = $data['paymentName'];
                                $paymentNumber = $data['paymentNumber'];
                                $type = $data['type'];
                                
                                $stmt = $conn->prepare("UPDATE `$tableName` SET `uid` = '$uid', `image` = '$image', `firstname` = '$firstname', `lastname` = '$lastname', `email` = '$email', `address` = '$address', `store name` = '$storeName', `contact no.` = '$contact', `payment name` = '$paymentName', `payment number` = '$paymentNumber', `type` = '$type' WHERE `uid` = '$uid'");
                                break;
                            case "password":
                                $uid = $data['uid'];
                                $password = $data['password'];

                                $stmt = $conn->prepare("UPDATE `$tableName` SET `password` = '$password' WHERE uid = '$uid'");
                                break;
                            case "notification":
                                $storeName = $data['supplierName'];
                                $result = $this -> selectData($conn, $tableName, "store name", $storeName);
                                $notificationNumber = 0;

                                if($data['notificationNumber'] != 0) {
                                    $notificationNumber = $data['notificationNumber'] + $result['notification number'];
                                }
                                
                                $stmt = $conn->prepare("UPDATE `$tableName` SET `notification number` = '$notificationNumber' WHERE `store name` = '$storeName'");
                        }
                        
                        $stmt->execute();
                        
                        return true;
                    };
                    break;
                case "admin_orders":
                    {
                        $transactionNo = $data['transactionNo'];
                        $orderStatus = $data['orderStatus'];

                        $stmt = $conn->prepare("UPDATE `$tableName` SET `order status` = '$orderStatus' WHERE `transaction no.` = '$transactionNo'");
                        $stmt->execute();
                    };
                    break;
                case "admin_product":
                    {
                        $productCode = $data['productCode'];
                        if(!empty($account)) {
                            $status = $data['status'];

                            $stmt = $conn->prepare("UPDATE `$tableName` SET `status` = '$status' WHERE `product code` = '$productCode'");
                            $stmt->execute();
                        } else {
                            $productName = $data['productName'];
                            $category = $data['category'];
                            $quantity = $data['quantity'];
                            $price = $data['price'];

                            $stmt = $conn->prepare("UPDATE `$tableName` SET `product name` = '$productName', `category` = '$category', `price` = '$price', `quantity` = '$quantity' WHERE `product code` = '$productCode'");
                            $stmt->execute();
                        }
                    };
                    break;
                case "supplier_customer":
                    {
                        $transactionNo = $data['transactionNo'];
                        $orderStatus = $data['orderStatus'];

                        $stmt = $conn->prepare("UPDATE `$tableName` SET `order status` = '$orderStatus' WHERE `transaction no.` = '$transactionNo'");
                        $stmt->execute();
                    };
                    break;
                case "supplier_product":
                    {
                        if(!empty($account)) {
                            $productCode = $data['productCode'];
                            $status = $data['status'];

                            $stmt = $conn->prepare("UPDATE `$tableName` SET `status` = '$status' WHERE `product code` = '$productCode'");
                            $stmt->execute();

                            return "SUCCESS";
                        } else {
                            $productCode = $data['productCode'];
                            $productName = $data['productName'];
                            $category = $data['category'];
                            $boxQuantity = $data['boxQuantity'];
                            $pcsPerBox = $data['pcsPerBox'];
                            $pricePerBox = $data['pricePerBox'];
                            $shippingFee = $data['shippingFee'];
                            $discount = $data['discount'];

                            $stmt = $conn->prepare("UPDATE `$tableName` SET `product code` = '$productCode', `product name` = '$productName', `category` = '$category', `box quantity` = '$boxQuantity', `pcs per box` = '$pcsPerBox', `price per box` = '$pricePerBox', `shipping fee` = '$shippingFee', `discount` = '$discount' WHERE `product code` = '$productCode'");
                            $stmt->execute();
                        }
                    };
                    break;
                }
        }

        function deleteData($conn, $tableName, $data) {
            $id = $data["id"];

            $sql = "DELETE FROM `$tableName` WHERE `id` = $id";
            $conn->exec($sql);
        }
    }
?>