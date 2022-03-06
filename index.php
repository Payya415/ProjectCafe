<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin:0;
            padding:0;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<link rel="stylesheet" href="index.css">
<body>
    <?php include "navbar.php"?>
    <div class="main-cafe">
        <?php if(isset($_GET['type'])):?>
            <?php $cake = $conn->prepare("SELECT * FROM product NATURAL JOIN type_product  WHERE product.type_product_id = :id LIMIT 0,6");?>
            <div class="item_show">
                <?php if($_GET['type'] == 1):?>
                    <?php 
                        $iidd = "0000000001";
                        $cake->bindParam(':id',$iidd);
                        $cake->execute();
                        $cake = $cake->fetchall();
                    ?>
                    <!-- <h1 class="header">Product</h1> -->
                    <div class="drink">
                        <?php foreach($cake as $rows):?>
                            <div class="item-shoping" >
                                <img src="./product_image/<?=$rows['product_id']?>.jpg" width='300'>
                                <p><?=$rows['product_name']?></p>
                                <p><?=number_format(floatval($rows['price']),2)?> Bath</p>
                                <input id="<?=$rows['product_id']?>" type="number" id="item-<?=$rows['product_id']?>" pattern='[\d]' min='1' max='<?=$row['quantity']?>' value=1>
                                <button onclick="add('<?=$rows['product_id']?>')">Add Cart</button>
                            </div>
                        <?php endforeach;?>
                    </div>
                    
                <?php endif;?>
                <?php if($_GET['type'] == 2):?>
                    <?php 
                        $iidd = "0000000002";
                        $cake->bindParam(':id',$iidd);
                        $cake->execute();
                        $cake = $cake->fetchall();
        
                    ?>
                    <!-- <h1 class="header">DRINK</h1> -->
                    <div class="drink">
                        <?php foreach($cake as $rows):?>
                            <div class="item-shoping">
                                <img src="./product_image/<?=$rows['product_id']?>.jpg" width='300'>
                                <p><?=$rows['product_name']?></p>
                                <p><?=number_format(floatval($rows['price']),2)?> Bath</p>
                                <input id="<?=$rows['product_id']?>" type="number" name="quantity" pattern='[\d]' min='1' max='<?=$row['quantity']?>' value=1>
                                <button onclick="add('<?=$rows['product_id']?>')">Add Cart</button>
                            </div>
                        <?php endforeach;?>
                    </div>
                <?php endif;?>
            </div>
        <?php else:?>
            <h1>Welcome Customer</h1>
            
        <?php endif;?>
    </div>
    <script>
        const add=(product_id)=>{
            const quntity = document.getElementById(product_id).value;
            const bodyContent = $.ajax({
                type: "POST",
                url:'addtocart.php',
                cache:false,
                data: `pid=${product_id}&quantity=${quntity}`,
                success: function(msg){
                    alert(msg);
                }
            }).responseText;
        }
    </script>
</body>
</html>