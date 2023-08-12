<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once "assets/conn.php";
include 'assets/rating.php';
$filter = $_GET['filter']??5;
$results = $reviews($filter);
$focus = "reviews";
$role = $_SESSION['role']??0;
if (filter_has_var(INPUT_POST, 'submit')){
    include_once "assets/doReview.php";
}
sqlclose($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reviews</title>
    <link rel="icon" href="styles/favicon.svg">
    <link rel="stylesheet" href="styles/scrollbar.css">
    <script src="https://unpkg.com/scrollreveal@4.0.0-beta.6"></script>
    <link rel="stylesheet" href="styles/reviews.css">
    <link rel="stylesheet" href="styles/home.css">
</head>

<body>
    <?php include_once "assets/navbar.php"; ?>
    <?php include "assets/alertBubble.php" ?>
    <main id="contents">
    <div class="body image-darkened">
        <div class="wrapper">
        <h1 class="title">Reviews:</h1>
            <!-- <h3 class="subtitle">
            Have child elements animate after parent has revealed itself.</h3> -->
        <div class="card-container">
            <div class="card">  
            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
            <div class="card-box">
                <textarea name="testimonial" id="testimony" required placeholder="Write a Review!"><?php echo ($_POST['testimonial']??"")?></textarea>
                <div class="card-content">
                <h4 class="card-title"><input type="submit" name="submit" value="Submit Review!" <?php if ($role==2){ ?>disabled<?php }?>></h4>
                <h6 class="rating-container">
                    <div class="rating">
                        <?php for ($star=5; $star > 0; $star--) { ?>
                        <input type="radio" id="star<?php echo $star?>" name="rating" value="<?php echo $star?>"
                            <?php echo (($_POST['rating'] ?? 3) == $star) ? "checked" : ""; ?> />
                        <label class="star" for="star<?php echo $star?>" title="rating" aria-hidden="true"></label>
                        <?php } ?>
                    </div><br>
                </h6>
                <h6 class="card-title">
                <?php switch ($role) {
                    case 1: ?>
                        Give us a review!
                    <?php break;
                    case 2: ?>
                        You cannot write a review as a admin.
                    <?php break;
                    default: ?>
                        Give a review as a guest!
                    <?php  break;
                }?>
                </h6>
                </div>
            </div>
            </form>
            </div>
            <!--   END card   -->
            <div class="card">  
            <div class="card-box">
                <div class="card-image"></div>
                <div class="card-content">
                <h4 class="card-title">Filter by Star:</h4>
                <h5 id="filter">
                    <?php for ($i = 1; $i < 6; $i++) {?>
                        <a href="<?php echo $_SERVER["PHP_SELF"] . "?filter=$i"; ?>" class="<?php echo ($filter >= $i) ? "checked" : "blank"; ?>">★</a>
                    <?php }?>
                </h5>
                <p class="card-title">Click on a star to filter</p>
                </div>
            </div>
            </div>
            <!--   END card   -->
            <?php if ($results) { foreach ($results as $row) { ?>
                <div class="card">
                    <div class="card-box">
                        <div class="card-image">
                            <?php if (!empty($row['pfp'])) {
                                echo '<img class="pfp" src="data:image/png;base64,' . base64_encode($row['pfp']) . '"/>';
                            } else { ?>
                                <img class="pfp" src="images/default.jpg" alt="No profile Picture" class="center"><?php } ?>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title"><?php echo $row['username']  ?></h4>
                            <h5><?php echo rating($row['rating']); ?></h5>
                            <p class="card-text"><?php echo $row['testimony'] ?></p>
                        </div>
                    </div>
                </div>
                <!--   END card   -->
                <?php }
            } else { ?>
                No reviews yet. Be the first to write one.
            <?php } ?>

            </div>
            <div class="Spacer"><br><br><br><br><br><br><br><br><br><br></div>

        </div>
    </div>
    </main>

    <!-- partial -->
    <?php include_once "assets/footer.php"; ?>
    <script src='https://unpkg.com/scrollreveal@4.0.0-beta.6'></script>
    <script src="styles/reviews.js"></script>

</body>

</html>