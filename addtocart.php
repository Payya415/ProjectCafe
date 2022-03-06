<?php
    include 'connect.php';
    session_start();
    if(isset($_SESSION['email'])){
        $data = $conn->prepare('SELECT * FROM product WHERE product_id = :pid');
        $data->bindParam(':pid',$_POST['pid']);
        $data->execute();
        $data = ($data->fetchall()[0]);
        $price_sum = $data['price']*$_POST['quantity'];
        $email = $_SESSION['email'];
        function lastID($conn){
            $lastID = $conn->prepare('SELECT  selected_id FROM selected_product ORDER BY selected_id DESC LIMIT 1');
            $lastID->execute();
            $lastID = $lastID->fetch();
            if(empty($lastID)){
                $lastID = "0";
            }else if($lastID == 'fff'){
                $_SESSION["error"] = "ERROR";
                header( "location: province.php" );
            }else{
                $lastID = $lastID[0];
            }
            $lastID = hexdec($lastID);
            $lastID = dechex((int)( $lastID + 1));
            $lastID = sprintf('%010s',$lastID);
            return $lastID;
        }
        $id = lastID($conn);
        $saveSelect = $conn->prepare('INSERT INTO selected_product(selected_id, product_id, email, quantity_select) VALUES (:selectid,:pid,:email,:qant)');
        $saveSelect->bindParam(':selectid',$id);
        $saveSelect->bindParam(':pid',$data['product_id']);
        $saveSelect->bindParam(':email',$_SESSION['email']);
        $saveSelect->bindParam(':qant',$_POST['quantity']);
        $saveSelect->execute();
        // echo 'Add Success';
        echo $id;
    }else{
        echo 'You must login';
    }
?>