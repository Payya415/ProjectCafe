<?php 
    include 'connect.php';
    session_start();
    $sum = $conn->prepare("SELECT SUM(selected_product.quantity_select * product.price) AS sumall FROM `selected_product`,product WHERE selected_product.email = :email AND selected_product.bill_id IS NULL AND product.product_id = selected_product.product_id");
    $sum->bindParam(':email',$_SESSION['email']);
    $sum->execute();
    $sum = $sum->fetchall()[0]['sumall'];
    echo ($sum)
?>