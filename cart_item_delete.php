<?php
    include 'connect.php';
    session_start();
    $del = $conn->prepare("DELETE FROM `selected_product` WHERE selected_id = :id");
    $del->bindParam(':id',$_POST['sid']);
    $del->execute();
    echo true;
?>