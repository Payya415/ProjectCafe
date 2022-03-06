<?php 
    if(isset($_SESSION['email'])){
        if($_SESSION['email'] != 'admin@admin.com'){
            header("Location: index.php");
        }
    }
    $act = (isset($_GET['act']) ? $_GET['act'] :'');
    if($act =='q'){
        include('product_search.php');
    }else{
        include("connect.php");
        $product = $conn->prepare("SELECT * FROM product NATURAL JOIN type_product LIMIT 0,10");
        $product->execute();
        $product = $product->fetchall();
    }
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="product.css">
<?php include 'head.php'?>

<body>
    <?php include "navbar.php";?>
    <br>
    <center><button class="addproduct" onclick="addproduct()">add product</button></center>
    <center><form class="navbar-from" method="get">
        <div class="from-group">
            <input type="text" class="from-control" placeholder = "Search" name="search" required>
            <button type="submit" name ="act" value="q" class="btn-success">ค้นหา</button>
            <button type="submit" class="sum">สรุปยอดการขาย</button>
    </div> 
    </form></center>
    <center><table >
        <tr>
            <th>รหัสสินค้า</th>
            <th>ชื่อสินค้า</th>
            <th>ประเภท</th>
            <th>ราคา</th>
            <th>จำนวน</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        <?php foreach($product as $row):?>
           
            <tr>
                <td><?=$row['product_id']?></td>
                <td><?=$row['product_name']?></td>
                <td><?=$row['product_type_name']?></td>
                <td><?=number_format($row['price'],2)?></td>
                <td><?=$row['quantity']?></td>
                <td ><a href = 'product_delete.php?pid=<?=$row['product_id']?>'><button  class="delete" >Delete</button></a></td>
                <td><a href = 'product_edit.php?pid=<?=$row['product_id']?>&tid=<?=$row['type_product_id']?>'><button class="editproduct" >Edit</button></a></td>
            </tr>
        
        <?php endforeach;?>
    </table></center> 
    <script>
        const addproduct=()=>{
            window.location.assign('product_add.php');
        }
    </script> 
</body>
</html>