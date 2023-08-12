<?php
include "assets/conn.php";
$alertLevel =$alertLevel??0;
$verify_user = function($username, $password, $status=1) use ($conn){
    try{
        $stmt = $conn->prepare("SELECT u.password FROM users u WHERE u.username = :username AND u.deactivate = :deactivate;"); //if already deactivate
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':deactivate', $status);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['password']??null;
        return (password_verify($password, $result) ? $result : false);
    } catch (PDOException $e) {
        return false;
    }
};
if ($_POST['submit']=='Reactivate Account'){
    $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
    if ($_POST['password']!=$_POST['confirmPassword']){
        $alertMsg = 'Passwords do match.';
        $alertLevel = 2;
    }
    if ($alertLevel<2){
        if ($verify_user($username , $_POST['password'] , 1)) {
            $stmt = $conn->prepare("UPDATE users u SET u.deactivate = 0 WHERE u.username=:username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $alertMsg = 'Account reactivated';
            $alertLevel = 1;
        } else{
            $alertMsg = 'Incorrect Credentials';
            $alertLevel = 2;
        }
    } 
}
if ($_POST['submit']=='Delete Account'){
    $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
    if ($_POST['password']!=$_POST['confirmPassword']){
        $alertMsg = 'Passwords do not match.';
        $alertLevel = 2;
    }
    if ($alertLevel<2){
        if ($verify_user($username,$_POST['password'])) {
            $stmt = $conn->prepare("DELETE FROM users WHERE username = :username;");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $alertMsg = 'Account Deleted.';
            $alertLevel = 1;
        } else{
            $alertMsg = 'Incorrect Credentials';
            $alertLevel = 2;
        }
    } 
}
sqlclose($conn);
?>