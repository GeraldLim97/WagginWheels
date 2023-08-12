<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "assets/redirect.php"; 
include "assets/conn.php"; 
if (isset($_SESSION['role'])) {
    redirect();
}
$focus = "Login";
if (filter_has_var(INPUT_POST, 'submit')){
    include_once "assets/doLogin.php";
    include_once "assets/doRegister.php";
}
sqlclose($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="styles/favicon.svg">    
    <link rel="stylesheet" href="styles/login.css">
    <link rel="stylesheet" href="styles/font.css">
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/scrollbar.css">
    <title>Login</title>
</head>
<body>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <div class="image-login" style="min-height: 650px;">
    <div class="body">
        <?php include "assets/navbar.php" ?>
        <?php include "assets/alertBubble.php" ?>
        <div class="form-d">
        <div class="form-darius">
            <div class="login-btn splits">
                <p>Already an user?</p>
                <button class="active">Login</button>
            </div>
            <div class="rgstr-btn splits">
                <p>Don't have an account?</p>
                <button>Register</button>
            </div>
            <div class="wrapper">
                <form id="login" tabindex="500" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <h3>Login</h3>
                    <div class="uid">
                        <input type="text" name="username" value="<?php echo ($_POST['username']??"")?>">
                        <label>Username</label>
                    </div>
                    <div class="passwd">
                        <input type="password" name="password">
                        <label>Password</label>
                    </div>
                    <div class="submit">
                        <input type="submit" value="Login" class="dark" name="submit">
                        <!-- <button class="dark">Login</button> -->
                    </div>
                </form>
                <form id="register" tabindex="502" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <h3>Register</h3>
                    <div class="uid">
                        <input type="text" name="username" value="<?php echo ($_POST['username']??"")?>">
                        <label>User Name</label>
                    </div>
                    <div class="passwd">
                        <input type="password" name="password"> <!-- dont autofill password again -->
                        <label>Password</label>
                    </div>
                    <div class="name">
                        <input type="text" name="name" value="<?php echo ($_POST['name']??"")?>">
                        <label>Full Name</label>
                    </div>
                    <div class="mail">
                        <input type="mail" name="email" value="<?php echo ($_POST['email']??"")?>">
                        <label>Email</label>
                    </div>
                    <div class="number">
                        <input type="phone" name="phone" value="<?php echo ($_POST['phone']??"")?>">
                        <label>phone</label>
                    </div>
                    <div class="submit">
                        <input type="submit" value="Register" class="dark" name="submit">
                        <!-- <button class="dark">Register</button> -->
                    </div>
                </form>
            </div>
        </div>
        </div>
        <?php include "assets/footer.php" ?>
    </div>
    </div>

    <style type="text/css">
        .site-link {
            padding: 5px 15px;
            position: fixed;
            z-index: 99999;
            background: #fff;
            box-shadow: 0 0 4px rgba(0, 0, 0, .14), 0 4px 8px rgba(0, 0, 0, .28);
            right: 30px;
            bottom: 30px;
            border-radius: 10px;
        }

        .site-link img {
            width: 30px;
            height: 30px;
        }
    </style>
    <!-- partial -->
    <script src="styles/login.js"></script>
</body>

</html>