<?php 
$alertLevel=$alertLevel??1;
if ($_POST['submit']=='Book Now!'){
    include "assets/conn.php";
    if (isset($_SESSION["id"])){ //Must be logged in (we can change later)
        $userid = $_SESSION["id"];
        $breed = filter_var($_POST['breed'], FILTER_SANITIZE_SPECIAL_CHARS);
        $weight = filter_var($_POST['weight'], FILTER_SANITIZE_SPECIAL_CHARS);
        $date = preg_replace("([^0-9-])", "", $_POST['date']);
        $time = preg_replace("([^0-9: ])", "", $_POST['time']);
        $name = ucwords(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
        $size = filter_var($_POST['size'], FILTER_SANITIZE_SPECIAL_CHARS);
        $neutered = filter_var($_POST['status'], FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($breed) || empty($name) || empty($date) || empty($time) || empty($weight)){
            $alertLevel = 2;
            $alertMsg = 'Fields cannot be empty';
        }
        if ($alertLevel<2){
            if ($booking($breed, $weight, $date, $time, $name, $size,($neutered=="neutered")?1:0, $userid)){
                $alertLevel = 1;
                $alertMsg = 'Successfully booked';
            } else {
                $alertLevel = 2;
                $alertMsg = 'There is a error right now, please try again later';
            }
        }
    } else {
        $alertLevel = 2;
        $alertMsg = 'You must be logged in to book';
    }
    sqlclose($conn);
}
?>