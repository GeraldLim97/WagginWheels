<?php
date_default_timezone_set('Asia/Singapore');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$focus = "booking";
if (filter_has_var(INPUT_POST, 'submit')){
    include_once "assets/doBooking.php";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="styles/favicon.svg">
    <link rel="stylesheet" href="styles/scrollbar.css">
    <link rel="stylesheet" href="styles/booking.css">
    <link rel="stylesheet" href="styles/home.css">
    <title>Booking</title>
</head>

<body>
    <div class="image-main" style="min-height: 650px;">
        <?php include "assets/navbar.php" ?>
        <?php include "assets/alertBubble.php" ?>
        <div class="booking">
            <form action="<?php echo $_SERVER["SCRIPT_NAME"] ?>" method="post" class="form">
                <h1>Booking</h1>
                <input type="text" name="name" placeholder="Dog Name" class="animalName" value="<?php echo ($_POST['name']??"")?>">
                <input type="number" name="weight" min="1" max="100" placeholder="Weight in KG"  value="<?php echo ($_POST['weight']??"")?>">
                <input type="date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>" name="date" value="<?php echo ($_POST['date']??"")?>">
                <input type="time" step="60" min="09:00" max="18:00" name="time" value="<?php echo ($_POST['time']??"")?>"><br>
                <input type="text" name="pickup" id="pickup" placeholder="Pick Up Point" value="<?php echo ($_POST['pickup']??"")?>"><br>
                <input type="text" name="dropoff" id="dropoff" placeholder="Drop Off Point" value="<?php echo ($_POST['dropoff']??"")?>"><br>
                <section class="plan cf">
                    <!-- <h4>Size of dog:</h4> -->
                    <input type="radio" name="size" id="small" value="small"><label class="four col" for="small">Small</label>
                    <input type="radio" name="size" id="medium" value="medium" checked><label class="four col" for="medium">Medium</label>
                    <input type="radio" name="size" id="large" value="large"><label class="four col" for="large">Large</label>
                </section>
                <input type="text" name="breed" id="breed" placeholder="Dog Breed" value="<?php echo ($_POST['breed']??"")?>">
                <section class="plan cf">
                    <!-- <h4>Size of dog:</h4> -->
                    <input type="radio" name="status" id="neutered" value="neutered"><label class="four col" for="neutered">Neutered</label>
                    <input type="radio" name="status" id="notNeutered" value="notNeutered" checked><label class="four col" for="notNeutered">Not Neutered</label>
                </section>
                <input type="submit" value="Book Now!" name="submit">
            </form>
        </div>
        <iframe src="http://127.0.0.1/wagginwheels/assets/reviewEmbed.php" frameborder="0"  allowtransparency="true" style="width: 100%;min-height:300px;"></iframe><!-- not clean at all, i dont care. -->
        <div class="Spacer"><br><br><br><br><br><br><br><br><br><br></div><!-- im lazy -->
        <?php include "assets/footer.php" ?>
    </div>
</body>

</html>