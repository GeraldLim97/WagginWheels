<?php 
include_once "assets/redirect.php";
$alertLevel = $alertLevel??0;
const PHONEREGEX = "/^([+]([0-9]{2}))? ?[0-9]{4} ?[0-9]{4}/";
function validatePassword($password){
    $length = strlen($password);
    return (($length > 6 && $length < 12)?(preg_match('/[A-Z]/', $password) && preg_match('/[a-z]/', $password) && preg_match('/\d/', $password)):false);
}
if ($_POST['submit']=='Register'){
    $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $name = ucwords(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone = $_POST['phone']; //we do checking later
    if (!validatePassword($_POST['password'])){ //the order matters
        $alertMsg = "Password does not meet minimum requirement, At least 1, Capital Letter, 1 numerical number, 1 Special Character";
        $alertLevel = 2;
    }
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
    if (!$checkUsernameAvailabilty($username)){
        if ($alertLevel < 2){
            $register($username, $password, $name, $email, $phone);
            $alertMsg = "Account Created";
            $alertLevel = 1;
        }
    } else {
        $alertLevel = 2;
        $alertMsg = "Username has already been taken!";
    }
}
?>