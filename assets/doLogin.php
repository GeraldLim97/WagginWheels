<?php 
include_once "assets/redirect.php";
include_once "assets/auth.php";
if ($_POST['submit']=='Login'){
    $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST['password']; //we dont fear xss attack as value is never reflected nor stored
    $id = $login($username, $password);
    if ($id){
        $_SESSION = array_merge($_SESSION, $getUser((string)$id));
        csrf_token(null); //inplace, will return false but we dont care
        if ($_SESSION['role']==2){
            redirect('dashboard.php'); //automatically redirect admins to admin page
        }
        redirect();
    } else {
        $alertLevel = 2;
        $alertMsg = 'Username or Password is incorrect';
    }
}
?>