<?php 
    include 'connect.php';
    print_r($_POST);
    $uqd = $conn->prepare('UPDATE `selected_product` SET `quantity_select`= :q WHERE selected_id = :sid');
    $uqd->bindParam(':q',$_POST['quantity']);
    $uqd->bindParam(':sid',$_POST['sid']);
    $uqd->execute();
?>