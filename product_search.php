<?php include "connect.php" ?>
<?php
$search ="%".$_GET['search']."%";
$query = "SELECT * FROM `product`NATURAL JOIN type_product WHERE `product_name` 
LIKE :key ORDER BY 'product_id' DESC";
$product=$conn->prepare($query);
$product->bindParam(':key',$search);
$product->execute();
$product=($product->fetchall());
?>

