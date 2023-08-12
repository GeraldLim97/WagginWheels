<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "assets/redirect.php";
if (isset($_SESSION['id'])) { // if logged in
	redirect();
}
$focus = "home";
if (filter_has_var(INPUT_POST, 'submit')){
	include "assets/doReactivate.php";
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="icon" href="styles/favicon.svg">    
  <link rel="stylesheet" href="styles/profile.css">
  <link rel="stylesheet" href="styles/scrollbar.css">
  <title>Profile</title>
</head>
<body>
<!-- Conscious Decision not to add navbar because of css clash & im lazy -->
<?php include "assets/alertBubble.php";?>
<section class="page body">
	<section>
		<ul class="tabs-controls">
			<li class="tabs-controls__item">
				<a href="" class="tabs-controls__link tabs-controls__link" data-id="301"> <!-- id to match status code; redirect home after anim -->
					Home 
				</a>
			</li>
			<li class="tabs-controls__item">
				<a href="" class="tabs-controls__link tabs-controls__link--active" data-id="1">
					Reactivate Account
				</a>
			</li>
			<li class="tabs-controls__item">
				<a href="" class="tabs-controls__link" data-id="2">
                    Delete Account
			  </a>
			</li>
		</ul>
	</section>
	<section class="cards-container">
		<div class="card card--current" id="1">
		<h1>Reactivate Account:</h1>
			<p>
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="input-container">
                    <label for="uid">Username</label>
                    <input type="text" id="uid" placeholder=" . . . Username" name="username">
                </div>
                <div class="input-container">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder=" . . . Password " name="password">
                </div>
                <div class="input-container">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" placeholder=" . . . Confirm Password" name="confirmPassword">
                </div>
                <div class="submit">
                    <input type="submit" value="Reactivate Account" name="submit" style="background-color:greenyellow;">
                </div>
            </form>
			</p>
		</div>
		<div class="card" id="2">
			<h1>Delete Account:</h1>
			<p>
				Want to <b>Delete</b> your account? This action <b>cannot</b> be reversed.<br>
				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="input-container">
                    <label for="uid">Username</label>
                    <input type="text" id="uid" placeholder=" . . . Username" name="username">
                </div>
                <div class="input-container">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder=" . . . Password " name="password">
                </div>
                <div class="input-container">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" placeholder=" . . . Confirm Password" name="confirmPassword">
                </div>
                Note: You <b>must</b> deactivate your account first.<br>
                <div class="submit">
                    <input type="submit" value="Delete Account" name="submit" style="background-color:red;">
                </div>
                </form>
			</p>
		</div>
	</section>
</section>
<?php include "assets/footer.php";?>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script><script src="styles/profile.js"></script>
</body>
</html>
