<?php 
    session_start();
    include 'connect.php';
    print_r($_POST);
    $login = $conn->prepare("SELECT *,COUNT(email) AS status FROM customer WHERE email = :email && password = :pwd Limit 1");
    $login->bindParam(':email',$_POST['email']);
    $login->bindParam(':pwd',$_POST['password']);
    $login->execute();
    $login = $login->fetchall();
    $checkr = $login[0]["status"];
    if($checkr){
        $_SESSION['email'] = $login[0]["email"];
        $_SESSION['fname'] = $login[0]['fname'];
        $_SESSION['lname'] = $login[0]['lname'];
        $_SESSION['tel']   = $login[0]['tel'];
        if($_SESSION['email'] == 'admin@admin.com'){
            header('location:product.php');
        }else{
            header('location:index.php');
        }
        
    }else{
        $_SESSION['Faillogin'] = "email or password incorect.";
        header('location:login.php');
    }
?>