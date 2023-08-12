<?php 
date_default_timezone_set('Asia/Singapore');
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
include "assets/redirect.php";
$focus="dashboard";
if (!isset($_SESSION) || $_SESSION['role']!=2){ //only admin can see this page
    redirect();
}
include "assets/conn.php";
$results = $dashboardItems();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="styles/favicon.svg">
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/scrollbar.css">
    <link rel="stylesheet" href="styles/dashboard.css">
    <title>Dashboard</title>
</head>
<body>
<?php include "assets/navbar.php";?>
<div class="body image-main"  style="min-height: 1000px;">
<main>
    <article article class="larg">
    <?php if ($results) { foreach ($results as $row) {?>
    <div>
      <h3><?php echo sprintf("%-10s|%s %s",$row['username'], $row['time'], $row['date'])?><span class="entypo-down-open"></span></h3>
      <p>
        Dog Information: <br>
        Name: <?php echo $row['pet_name']?><br>
        Dog breed: <?php echo $row['breed']?><br>
        Weight: <?php echo $row['weight']?>kg<br>
        Size: <?php echo $row['size']?><br>
        Neutered?: <span style="color: green;"><?php echo !$row['neutered']?"Yes":"No"?></span><br>
      </p>
      <p>
        User Information: <br>
        User's Name: <?php echo $row['user_name']?><br>
       <a href="mailto:<?php echo $row['email']?>">Email: <?php echo $row['email']?></a>
        Phone: <?php echo $row['phone']?><br>
      </p>
    </div>
    <?php }} ?>
  </article>
  <div class="Spacer"><br><br><br><br><br><br><br><br><br><br></div><!-- im lazy -->
</main>
</div>
<?php include_once "assets/footer.php"; ?>
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="styles/dashboard.js"></script>
</body>
</html>