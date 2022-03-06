<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'?>
<link rel="stylesheet" href="login.css">
<body>
    <?php include 'navbar.php'?>
    <form class="buyit" action="signin.php" method="post">
        <?php if(isset($_SESSION['Faillogin'])):?>
            <p><?=$_SESSION['Faillogin']?></p>
        <?php endif;?>
        <?php unset($_SESSION['Faillogin'])?>
        <img src="./11 AM/11AM logo.png" width="300px">
        <h2>Login</h2>
        <div class="form_inside">
            <label>Email</label>
            <input id="email" type="email" name="email" onchange="inputEmail()" pattern=".{8,100}" placeholder="Enter Email" required>
        </div>
        <div class="form_inside">
            <label>Password</label>
            <input id="password" type="password" name="password" onchange="inputEmail()" pattern=".{8,100}" placeholder="Enter Password" required>
        </div>
        <button id="submit" name="submit" value="ok" disabled="true">Sign In</button>
    </form>
    <script>
        const inputEmail=()=>{
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            if(email!="" && password!=""){
                document.getElementById('submit').disabled = false;
            }else{
                document.getElementById('submit').disabled = true;
            }
        }
    </script>
</body>
</html>