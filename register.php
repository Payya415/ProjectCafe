<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'?>
<link rel="stylesheet" href="register.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
    
</style>
<body>
    <?php include 'navbar.php'?>
    <form class="buyit" action="registeration.php" method="post">
        <div class="ccccc">
            <img src="./11 AM/11AM logo.png" width="300px">
            <p class="register">Register</p>
            <div class="from_inside">
                <p>Email</p>
                <input id="email" type="email" name="email" onchange="changing()" pattern=".{10,300}" placeholder="Enter email" required>
                <p class="dangerus" id="emailalert"></p>
            </div>
            <div class="from_inside">
                <p>Password</p>
                <input id="password1" type="password" name="password1" onchange="changing()" pattern=".{3,100}" placeholder="Enter password" required>
                <p class="dangerus" id="pass1alert"></p>
            </div>
            <div class="from_inside">
                <p>Confirm Password</p>
                <input id="password2" type="password" name="password2" onchange="changing()" pattern=".{8,100}" placeholder="Enter confirm password"  required>
                <p class="dangerus" id="pass2alert"></p>
            </div>
            <div class="from_inside">
                <p>Firstname</p>
                <input id="fname" type="fname" name="fname" onchange="changing()" pattern="[a-zA-Zก-๏]{1,50}" placeholder="Enter firstname"  required>
            </div>
            <div class="from_inside">
                <p>Lastname</p>
                <input id="lname" type="lname" name="lname" onchange="changing()" pattern="[a-zA-Zก-๏].{1,50}" placeholder="Enter lastname"  required>
            </div>
            <div class="from_inside">
                <p>Telephone number</p>
                <input id="tel" type="tel" name="tel" onchange="changing()" pattern="[0-9]{10}" placeholder="Enter tel"  required>
            </div>
            <div class="from_button">
                <button id="submit" name="submit" value="ok" disabled="true">Sign In</button>
            </div>
        </div>
    </form>
    <script>
        let email = "";
        let password1 = "";
        let password2 = "";
        let emailcheck = false;
        function changing(){
            const email1 = document.getElementById('email').value;
            if(email1 !== email){
                document.getElementById('emailalert').innerHTML = ""
                $.post("duplicatecheck.php",
                    {
                        email: email1
                    },
                    (data,status)=>{
                        const cc = JSON.parse(data)[0]['de']
                        console.log(cc)
                            if(cc != 0){
                                document.getElementById('emailalert').innerHTML = "Your email has already exist."
                                emailcheck = false;
                            }else{
                                document.getElementById('emailalert').innerHTML = ""
                                emailcheck = true && email!="";
                            }
                        }
                    );
                
                email = email1;
            }
            
            password1 = document.getElementById('password1').value;
            const lpass1 = password1.length >= 8;
            if(!lpass1 && password1 != ""){
                document.getElementById('pass1alert').innerHTML = "Password must have 8 charecter"
            }else{
                document.getElementById('pass1alert').innerHTML = ""
            }

            password2 = document.getElementById('password2').value;
            const p1p2 = password1 != password2;
            if(p1p2 && password2 != ""){
                document.getElementById('pass2alert').innerHTML = "Your comfirm password incorect" ;
            }else{
                document.getElementById('pass2alert').innerHTML = ""; 
            }
            const fname = document.getElementById('fname').value;
            const lname = document.getElementById('lname').value;
            const tel = document.getElementById('tel').value;

            if(emailcheck && lpass1 && !p1p2 && fname != "" && lname != "" && tel != ""){
                document.getElementById('submit').disabled = false;
            }else{
                document.getElementById('submit').disabled = true;
            }
        }
    </script>
</body>
</html>