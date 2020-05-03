<?php 
include('conn.php');
session_start();


if(isset($_POST['username']) && ($_POST['password'])){
    $uname = $_POST['username'];
    $pass = $_POST['password'];
    
    $sql = "select * from admin where username='".$uname."' AND password='".$pass."'";
    
    $result=mysqli_query($conn,$sql);
    $num= mysqli_num_rows($result);
            
            if($num==1){
                header('location:admin/home.php');
            }else{
                header('location:admin-signinform.php');
            }
        
        }
        
?>
<!DOCTYPE>
<html>
    <head>
        <title>Admin sign in form</title>
        <link rel="stylesheet" href="css/stiliadm.css">
        <script src="https://kit.fontawesome.com/2c8cdf3872.js" crossorigin="anonymous"></script>
    </head>
    <body>
        
         <div class="loginbox">
            <form class="" method="post">
                <h1>Login</h1>
                    <div class="textbox">
                         <i class="fas fa-user-tie"></i>
                         <input type="text" name="username" placeholder="Username" value="">
                    </div>

                    <div class="textbox">
          
                        <i class="fas fa-lock"></i>
                    
                        <input type="password" name="password" placeholder="Password" value="">

                    </div>

                <input class="btn" type="submit" name="submit" value="Sign in">
        </div>
    </body>

</html>