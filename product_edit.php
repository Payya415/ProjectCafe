<?php include "connect.php" ?>
<?php 
    if(isset($_SESSION['email'])){
        if($_SESSION['email'] != 'admin@admin.com'){
            header("Location: product.php");
        }
    }
    $pid=$_GET['pid'];
    
    $stmt = $conn->prepare("SELECT*FROM product WHERE product_id = ?");
    $stmt->bindParam(1,$_GET["pid"]);
    $stmt->execute();
    $row = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'?>
<link rel="stylesheet" href="product_edit.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<body class=body >
    <?php include 'navbar.php'?>
    <center><form class="soid" action="product_editcf.php" method="post" enctype="multipart/form-data">
        <?php if(isset($_SESSION['status'])):?>
            <p><?=$_SESSION['status']?></p>
        <?php endif;?>
        <?php unset($_SESSION['status'])?>
        <br>
        <h2>แก้ไขสินค้า</h2>
        <div class="form_inside">
            <label>ชื่อสินค้า</label>
            <input id="product_name" type="text" name="product_name" value=<?=$row["product_name"]?> onchange="change()" placeholder="ชื่อสินค้า" required>
            <p id="al"></p>
        </div>
        <div class="form_inside">
            <label>ราคา</label>
            <input id="price" type="number" step="0.01" name="price" value=<?=$row["price"]?> onchange="change()" min='0.00' max='2000.00' placeholder="ราคา" required>
        </div>
        <input type ="hidden" name ="ID" value="<?=$row['product_id']?>">
        <div class="form_inside">
            <label>จำนวน</label>
            <input id="quntity" type="number" name="quantity" value=<?=$row["quantity"]?> onchange="change()" min='1' max='100' placeholder="จำนวน" required>
        </div>
        <div class="form_inside">
            <label>ชนิดสินค้า</label>
            <?php 
                $tid = $_GET['tid'];
                if($tid=="0000000002"){
                    $type = $conn->prepare("SELECT * FROM type_product ORDER BY $tid ASC ");
                }else{
                    $type = $conn->prepare("SELECT * FROM type_product ORDER BY $tid DESC ");
                }
                $type->execute();
                $type = $type->fetchall();
            ?>
            <select name="type" id="type" onchange="change()" required>
                <?php foreach($type as $row):?>
                    <option id="<?=$row['type_product_id']?>" value="<?=$row['type_product_id']?>" selected><?=$row['product_type_name']?></option>
                <?php endforeach;?>    
            </select>
        </div>
        <div class="form_inside">
            <label>Upload Image</label>
            <input class="form-control" type="file" name="fileToUpload" id="fileToUpload" required>
        </div>
        
        <button id="submit" name="submit" value="1" disabled="true">Edit Now</button>
    </form></center>
    <script>
        const name = document.getElementById('product_name');
        const price = document.getElementById('price');
        const quntity = document.getElementById('quntity');
        const type = document.getElementById('type')

        const change=()=>{
            $.post('duplicatecheck.php',{pdname:name.value},(data,status)=>{
                const value = JSON.parse(data);
                const product_name = value[0]['num'] == '0' && name.value != "";
                const priced = price.value != "";
                const quntityd = quntity.value != "";
                const typed = type.value != "";
                if(product_name && priced && quntityd && typed){
                    document.getElementById('submit').disabled = false;
                }else{
                    if(value[0]['num'] != '0'){
                        document.getElementById('al').innerHTML = "Product name has already exist."
                    }else{
                        document.getElementById('al').innerHTML = "";
                    }
                    document.getElementById('submit').disabled = true;
                }
            })
        }
    </script>
</body>
</html>