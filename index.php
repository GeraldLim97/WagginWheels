<?php 
if (session_status() === PHP_SESSION_NONE) { //if session doesnt exist 
    session_start();
}?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="styles/favicon.svg">
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/font.css">
    <link rel="stylesheet" href="styles/scrollbar.css">
    <title>Home</title>
    
</head>

<body>
<div w3-include-html="assets/loading.html"></div>
<?php include "assets/navbar.php" ?>
<main id="contents">
    <div class="image-main" style="min-height: 1000px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-8">
                    <h2>Waggin' Wheels</h2>
                    <p>Hello, I'm Farrah Wainwright, the founder of Waggin' Wheels. Our goal is to provide affordable and reliable pet transport services in Singapore. We understand that pets are family, and we're here to make their transportation safe and convenient.</p>
                    <p>With years of experience in event planning and management, I've channeled my expertise into creating Waggin' Wheels. Our focus is on delivering exceptional service and ensuring a stress-free experience for both you and your pets.</p>
                    <p>At Waggin' Wheels, we believe that pet transportation should be affordable without compromising on quality and care. Whether you need to take your furry friends to the vet, move to a new home, or travel with them on a vacation, we're here to assist you.</p>
                    <p>Our dedicated team of professionals is passionate about animals and committed to providing the best possible service. We work closely with trusted transportation services and accommodations to ensure your pets receive the highest standard of care during their journey.</p>
                </div><!--/.col-xs-12 -->
            </div><!--/.row -->
        </div><!--/.container -->
    </div>
</main>
<?php include "assets/footer.php" ?>

</body>

</html>