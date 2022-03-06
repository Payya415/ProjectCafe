<?php 
    include 'connect.php';
    if(isset($_POST['email'])){
        $check = $conn->prepare("SELECT COUNT(email) AS de FROM customer WHERE email = :email LIMIT 1");
        $check->bindParam(':email' ,$_POST['email']);
        $check->execute();
        echo json_encode($check->fetchall());
    }
    if(isset($_POST['pdname'])){
        $check = $conn->prepare("SELECT COUNT(product_id) AS num FROM product WHERE product_name = :name LIMIT 1");
        $check->bindParam(':name',$_POST['pdname']);
        $check->execute();
        echo json_encode($check->fetchall());
    }
?>