<?php
    include 'connect.php'; 
    session_start();
    $pid=$_GET['pid'];
    echo $pid;
    $del = $conn->prepare("DELETE FROM `product` WHERE product_id = '$pid'");
    $del->execute();
    $data = $_GET['pid'];
    $path = "product_image/".$data.".jpg";
    unlink($path);
    header('location:product.php');
?>
