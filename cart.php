<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="cart.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <?php include 'navbar.php'?>
    <?php 
        $cart = $conn->prepare("SELECT * FROM `selected_product`,product 
        WHERE selected_product.email = :email
        AND selected_product.bill_id IS NULL
        AND product.product_id = selected_product.product_id");
        $cart->bindParam(':email',$_SESSION['email']);
        $cart->execute();
        $cart = $cart->fetchall();
    ?>
    
    <table align='center'>
        <tr>
            <th>Product</th>
            <th>Price/Unit</th>
            <th>Quantity</th>
            <th>Sum in select</th>
            <th>Option</th>
        </tr>
        <?php foreach($cart as $rows):?>
            <tr>
            <!-- <?=$rows['product_name']?> -->
                <td> <img class='img' src="product_image/<?=$rows['product_id']?>.jpg"> </td>
                <td><input type="text" id ="price-<?=$rows['selected_id']?>" value="<?=number_format($rows['price'],2)?>" readonly></td>
                <td><input type="number" id="quantity-<?=$rows['selected_id']?>" onchange="change('<?=$rows['selected_id']?>')" name="item" value='<?=$rows['quantity_select']?>'></td>
                <td><p id="sum-<?=$rows['selected_id']?>"><?=number_format($rows['quantity_select']*$rows['price'],2)?></p></td>
                <td><button class='cancel' onclick="delitem('<?=$rows['selected_id']?>')">Cancel</button></td>
                
            </tr>
        <?php endforeach;?>
        <?php 
            $sum = $conn->prepare("SELECT SUM(selected_product.quantity_select * product.price) AS sumall FROM `selected_product`,product WHERE selected_product.email = :email AND selected_product.bill_id IS NULL AND product.product_id = selected_product.product_id");
            $sum->bindParam(':email',$_SESSION['email']);
            $sum->execute();
            $sum = $sum->fetchall()[0]['sumall'];
        ?>
        <tr>
            <td>Sum All</td>
            <td></td>
            <td></td>
            <td><p id="sumall"><?=number_format($sum,2)?></p></td>
            <td><button class='comfirm' onclick = 'Next()'>confirm</button></td>
        </tr>
    </table>
    
    
    
    <script>
        const Next=()=>{
            window.location = 'confirmAddress.php';
        }
        async function updown(sid,quantity){
            await $.ajax({
                type: "POST",
                url:'update_quntity_selection.php',
                cache: false,
                data: `sid=${sid}&quantity=${quantity}`,
            })
            return await $.ajax({
                url : 'cart_sum_price.php',
                type : 'POST',
            });
        }
        const change=(sid)=>{
            const quantity = document.getElementById(`quantity-${sid}`).value;
            const price = document.getElementById(`price-${sid}`).value;
            const sum = document.getElementById(`sum-${sid}`);
            const sumall = document.getElementById('sumall');
            updown(sid,quantity).then(sum=>(sumall.innerHTML = (parseFloat(sum).toFixed(2)).toLocaleString("en-US").replace(/\B(?=(\d{3})+(?!\d))/g, ",")));
            sum.innerHTML = ((quantity*price).toFixed(2)).toLocaleString("en-US").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        const delitem=(sid)=>{
            $.ajax({
                type: "POST",
                url:'cart_item_delete.php',
                cache: false,
                data: `sid=${sid}`,
                success: function(data){
                    alert('delete item success');
                    window.location.reload();
                }
            })

        }
    </script>
</body>
</html>