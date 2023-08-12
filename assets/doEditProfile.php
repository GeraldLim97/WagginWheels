<?php
include "assets/conn.php";
$alertLevel =$alertLevel??0;
function validatePassword($password){
    $length = strlen($password);
    return (($length > 6 && $length < 12)?(preg_match('/[A-Z]/', $password) && preg_match('/[a-z]/', $password) && preg_match('/\d/', $password)):false);
}
$verify_pass = function($id, $password) use ($conn){
    $stmt = $conn->prepare("SELECT u.password FROM users u WHERE u.id = :id;");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['password']??null;;
    return (password_verify($password, $result) ? $result : false);
};
const PHONEREGEX = "/^([+]([0-9]{2}))? ?[0-9]{4} ?[0-9]{4}/";
if ($_POST['submit']=='Update'){
    $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
    $name = ucwords(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone = $_POST['phone']; //we do validation later
    if (empty($email)){
        $alertMsg = "Email Format incorrect of empty";
        $alertLevel = 2;
    }
    if (!preg_match(PHONEREGEX,$phone) && !empty($phone)) {
        $alertMsg = "Phone Number is not in a valid format";
        $alertLevel = 2;
    }
    if (empty($username) || empty($name)) {
        $alertMsg = "Fields cannot be blank";
        $alertLevel = 2; 
    }
    if (!empty($_FILES['pfp']['tmp_name'])){
        if ($_FILES['pfp']['size'] < 50000){
            $contents = fopen($_FILES['pfp']['tmp_name'], 'rb'); // read binary
            $stmt = $conn->prepare("UPDATE users SET pfp = :pfp WHERE id = :id;");
            $stmt->bindParam(':pfp', $contents, PDO::PARAM_LOB);
            $stmt->bindParam(':id', $_SESSION['id']);
            $stmt->execute();
        } else {
        $alertMsg = 'File too large, must be below 50kb';
        $alertLevel = 2;
        }
    }
    if ($_SESSION['username'] != $username){
        if ($checkUsernameAvailabilty($username)){
            $alertMsg = 'That username is currently in use.';
            $alertLevel = 2;
        }
    }
    if ($alertLevel < 2){
        $stmt = $conn->prepare("UPDATE users SET username = :username,name = :name,email = :email,phone = :phone WHERE id=:id");
        $stmt->bindParam(':id', $_SESSION['id']);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
        $_SESSION = array_replace($_SESSION, array(
            "name" => $name,
            "username" => $username,
            "email" => $email,
            "phone" => $phone,
        ));
        $alertMsg = "Account details updated";
        $alertLevel = 1;
    }
}
if ($_POST['submit']=='Change Password'){
    $password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
    if ($_POST['newPassword']!=$_POST['confirmPassword']){
        $alertMsg = 'Passwords do match.';
        $alertLevel = 2;
    }
    if (!validatePassword($_POST['newPassword'])){
        $alertMsg = "Password does not meet minimum requirement, At least 1, Capital Letter, 1 numerical number, 1 Special Character";
        $alertLevel = 2;
    }
    if ($alertLevel < 2){
        if ($verify_pass($_SESSION['id'],$_POST['password'])) {
            $stmt = $conn->prepare("UPDATE users SET password = :password WHERE id=:id");
            $stmt->bindParam(':id', $_SESSION['id']);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $alertMsg = "Password Changed";
            $alertLevel=1;
        } else {
            $alertMsg = "Password Incorrect";
            $alertLevel=2;
        }
      
    }
}
if ($_POST['submit']=='Im Sure'){ //Deactivate account
    if ($verify_pass($_SESSION['id'],$_POST['password'])) {
        $stmt = $conn->prepare("UPDATE users SET deactivate = 1 WHERE id=:id");
        $stmt->bindParam(':id', $_SESSION['id']);
        $stmt->execute();
        include_once "assets/logout.php";
    } else {
        $alertMsg = "Password incorrect.";
        $alertLevel=2;
    }
}
sqlclose($conn);
?>