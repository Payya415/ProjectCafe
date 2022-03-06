<?php
    session_start();
    include 'connect.php';
?> 
<link rel="stylesheet" href="navbar.css">
<script src="https://kit.fontawesome.com/f5910a4aaa.js" crossorigin="anonymous"></script>
<div class="header-cafe">
<a href="index.php?type=0"><img src="./11 AM/11AM logo1.png" width="420px"></a>
</div>
<ul class="cafe-navbar">
  <li class="cafe-item menu-cafe"><a  href="index.php?type=0">HOME</a></li>
  <li class="cafe-item menu-cafe"><a  href="index.php?type=1">CAKE</a></li>
  <li class="cafe-item menu-cafe"><a  href="index.php?type=2">DRINK</a></li>
    <?php if(isset($_SESSION['email'])):?>
        <?php if($_SESSION['email'] == 'admin@admin.com'):?>
          <li class="cafe-item" style="float:right"><a href="logout.php">Logout</a></li>
          <li class="cafe-item" style="float:right"><a href="#"><?=$_SESSION['email']?></a></li>
          <li class="cafe-item" style="float:right"><a href="product.php">Manage</a></li>
        <?php else:?>
          <li class="cafe-item" style="float:right"><a href="logout.php">Logout</a></li>
          <li class="cafe-item" style="float:right"><a href="#"><?=$_SESSION['email']?></a></li>
          <li class="cafe-item" style="float:right"><a href="cart.php"><i class="fas fa-cart-plus"></i> Cart</a></li>
        <?php endif;?>
    <?php else:?>
        <li class="cafe-item" style="float:right"><a href="login.php">Login</a></li>
        <li class="cafe-item" style="float:right"><a href="register.php">Register</a></li>
    <?php endif;?>
</ul>

