<?php
    session_start();
    print_r($_POST);
    include 'connect.php';
    function lastID($conn){
        $lastID = $conn->prepare('SELECT  product_id FROM product ORDER BY product_id DESC LIMIT 1');
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
    $name = $id;
    echo($id);
    if(isset($_FILES['fileToUpload'])){
        echo 'lotus';
        $img_file = $_FILES["fileToUpload"]["name"];
        $type = $_FILES["fileToUpload"]["type"];
        $size = $_FILES["fileToUpload"]["size"];
        $temp = $_FILES["fileToUpload"]["tmp_name"];
        $lname = explode('.',$img_file)[1];
        $path = "./product_image/". $name.'.'.$lname;
        echo $path.'<br>';
        echo $type;
        if(empty($img_file)){
            $errorMsg = "Please Select Image";
        }else if($type == "image/jpg" || $type == "image/jpeg"){
            // || $type == "image/jpeg" || $type == "image/png" || $type == "image/gif"
            if(!file_exists($path)){
                if( $size < 50000000){
                    move_uploaded_file($temp, $path);
                    if(isset($_POST['submit'])){
                        $add = $conn->prepare("INSERT INTO product VALUES (:id,:pname,:price,:quantity,:type)");
                        $add->bindParam(':id',$id);
                        $add->bindParam(':pname',$_POST['product_name']);
                        $add->bindParam(':price',$_POST['price']);
                        $add->bindParam(':quantity',$_POST['quantity']);
                        $add->bindParam(':type',$_POST['type']);
                        $add->execute();
                        $_SESSION["status"] = "Adding sucsess";
                        header('location:product_add.php');
                    }
                }else{
                    $errorMsg = "Sorry, your file is too large.";
                }
            }else{
                $errorMsg = "Sorry, file already exists.";
            }
        }else{
            $errorMsg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
        echo $errorMsg;
    }
?>