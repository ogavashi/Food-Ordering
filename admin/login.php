<?php include('../config/constants.php')?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login - Dungeon Keeper</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style/admin.css">
    <link rel="icon" href="https://icons.iconarchive.com/icons/3xhumed/mega-games-pack-31/256/Dungeon-Keeper-2-icon.png">
</head>

<body>
    <div class='login'>
        <h1 class='text-center'> Login </h1>
        <br><br>

        <?php 
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        
        ?>
        <br><br>

        <form action='' method="GET" class='text-center'>
            Username: <br>
            <input type='text' name='username' placeholder="Enter Username"> <br><br>
            Password: <br>
            <input type='password' name='password' placeholder="Enter Password"> <br><br>
            <input type="submit" name='submit' value='Login' class='btn-primary'>
            <br><br>
        </form>

        <p class='text-center'>Created By OG</p>
    </div>

    <script src="" async defer></script>
</body>

</html>


<?php 
    if(isset($_GET['submit'])){
        $username = $_GET['username'];
        $password = md5($_GET['password']);

        $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count==1){
            $_SESSION['login'] = "<div class = 'success'> Login Successful</div>";
            $_SESSION['user'] = $username;

            header('location:'.SITEURL.'admin/index.php');
        }
        else{
            $_SESSION['login'] = "<div class = 'login-error text-center'> Incorrect Password Or Username!</div>";
            header('location:'.SITEURL.'admin/login.php');
        }
    }


?>