<?php 
include('../conn.php');

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if(isset($_SESSION['_admin_username'])) {
    //If already logged in
    header('location:index.php');
    exit();
}

if(isset($_POST['username']) && ($_POST['password'])){
    //If gets username and password from form below
    $uname = $_POST['username'];
    $pass = $_POST['password'];
    
    //Will add encryption later
    //Password from POST will be encrypted and checked if matches the password in database for username
    $sql = "SELECT * FROM admin WHERE username='".$uname."' AND password='".$pass."'";
    
    $result=mysqli_query($conn,$sql);
    $num= mysqli_num_rows($result);
            
    if($num==1){
        $_SESSION['_admin_username'] = $uname;
        header('location:index.php');
        exit();
    } else {
        header('location:login.php');
        exit();
    }  
} 
?>
<!DOCTYPE>
<html>
    <head>
        <title>Admin Login</title>
        <link rel="stylesheet" href="../css/style.css">
        <script src="https://kit.fontawesome.com/2c8cdf3872.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="loginbox">
            <form class="" method="post">
                <h1>Admin Login</h1>
                    <div class="textbox">
                         <i class="fas fa-user-tie"></i>
                         <input type="text" name="username" placeholder="Username" value="">
                    </div>
                    <div class="textbox">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" value="">
                    </div>
                <input class="btn" type="submit" name="submit" value="Sign In">
            </form>
        </div>
    </body>
</html>