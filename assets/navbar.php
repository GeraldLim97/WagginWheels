<?php
$focus = $focus??"Home";
$username = $_SESSION['username']??"Guest";

$role = $_SESSION['role']??0;
?>
<script>
    function confirmLogout() {
        if (window.confirm("Are you sure you want to Logout?")) {window.location.href = "assets/logout.php"; 
    }}
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.css'>
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/font.css">
 <!-- partial:index.partial.html -->
    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="small-logo-container">
                    <a class="small-logo" href="index.php">Waggin' Wheels</a>
                </div>
            </div>
            <div class="navbar-collapse collapse">

                <ul class="nav navbar-nav navbar-right">
                    <li class="<?php echo ($focus=='Home')?"active":"none"?>"><a href="index.php">Home</a></li>
                    <?php if ($role!=0){  ?>
                        <li><button class="logout" onclick="confirmLogout()">Log Out</button></li>
                        <li class="<?php echo ($focus=='profile')?"active":"none"?>"><a href="profile.php">Profile</a></li>
                    <?php } else { ?>
                        <li class="<?php echo ($focus=='Login')?"active":"none"?>"><a href="login.php">Log In</a></li>
                    <?php } ?>
                    <?php if ($role==2){  ?>
                    <li class="<?php echo ($focus=='dashboard')?"active":"none"?>"><a href="dashboard.php">Dashboard</a></li>
                    <?php } else { ?>
                            <li class="<?php echo ($focus=='booking')?"active":"none"?>"><a href="booking.php">Booking</a></li>
                    <?php } ?>
                    <li class="<?php echo ($focus=='reviews')?"active":"none"?>"><a href="reviews.php">Reviews</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>

    <div class="container-fluid big-logo-row">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 big-logo-container">
                    <h1 class="big-logo">Waggin' Wheels</h1>
                </div><!--/.col-xs-12 -->
            </div><!--/.row -->
        </div><!--/.container -->
    </div><!--/.container-fluid -->
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js'></script>
    <script src="styles/navbar.js"></script>