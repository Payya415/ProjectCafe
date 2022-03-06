<?php 
    print_r($_POST);
    include 'connect.php';
    $save_customer = $conn->prepare("INSERT INTO customer VALUES (:email,:pwd,:fname,:lname,:tel)");
    $save_customer->bindParam(':email',$_POST['email']);
    $save_customer->bindParam(':pwd',$_POST['password1']);
    $save_customer->bindParam(':fname',$_POST['fname']);
    $save_customer->bindParam(':lname',$_POST['lname']);
    $save_customer->bindParam(':tel',$_POST['tel']);
    $save_customer->execute();
    header('location:login.php');
?>
