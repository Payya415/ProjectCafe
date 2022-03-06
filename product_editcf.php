<?php include "connect.php" ?>
<?php
print_r ($_POST);
    //UPDATE `product` SET `product_id`='[value-1]',`product_name`='[value-2]',`price`='[value-3]',`quantity`='[value-4]',`type_product_id`='[value-5]' WHERE 1
    // $stmt = $conn->prepare("UPDATE product SET product_id =?,product_name =?,price =?,quantity=?,type_product_id =? WHERE pid = ?");
    $stmt = $conn->prepare("UPDATE product SET product_name= ?,price=?,quantity=?,type_product_id= ? WHERE product_id =? ");
    $stmt->bindParam(5,$_POST["ID"]);
    $stmt->bindParam(1,$_POST["product_name"]); 
    $stmt->bindParam(2,$_POST["price"]); 
    $stmt->bindParam(3,$_POST["quantity"]); 
    $stmt->bindParam(4,$_POST["type"]);
    // $stmt->bindValue('password', $password, PDO::PARAM_STR); 
    $stmt->execute();
    header("location: product.php");

    if(isset($_FILES['fileToUpload'])){
        $errorMsg ='';  
        $img_file = $_FILES["fileToUpload"]["name"];
        $type = $_FILES["fileToUpload"]["type"];
        $size = $_FILES["fileToUpload"]["size"];
        $temp = $_FILES["fileToUpload"]["tmp_name"];
        $lname = explode('.',$img_file)[1];
        $path = "./product_image/". $_POST["ID"].'.'.$lname;
        echo $path.'<br>';
        echo $type;
        if(empty($img_file)){
            $errorMsg = "Please Select Image";
        }else if($type == "image/jpg" || $type == "image/jpeg"){
            // || $type == "image/jpeg" || $type == "image/png" || $type == "image/gif"
            
                if( $size < 50000000){
                    move_uploaded_file($temp, $path);
                    
                }else{
                    $errorMsg = "Sorry, your file is too large.";
                }
        }else{
            $errorMsg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
        echo $errorMsg;
    }
  
      
?>