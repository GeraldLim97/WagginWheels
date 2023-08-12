<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "assets/redirect.php";
include "assets/auth.php";
if (!isset($_SESSION['id'])) { // if not logged in
	redirect();
}
$focus = "profile";
if (filter_has_var(INPUT_POST, 'submit')){
	if (isset($_SESSION['csrf_token']) && csrf_token($_SESSION['csrf_token'])){
		include "assets/doEditProfile.php";
	} else {
		$alertMsg = '<b>Your account is likely to be compromised, please contact a admin now</b>.';
		$alertLevel = 2;
	}
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
				<a href="#" class="tabs-controls__link tabs-controls__link--active" data-id="1">
					Profile
				</a>
			</li>
			<li class="tabs-controls__item">
				<a href="#" class="tabs-controls__link" data-id="2">
                    Password
			  </a>
			</li>
			<li class="tabs-controls__item">
				<a href="#" class="tabs-controls__link" data-id="3">
					History
				</a>
			</li>
			<li class="tabs-controls__item">
				<a href="#" class="tabs-controls__link" data-id="4">
					More
				</a>
			</li>
		</ul>
	</section>
	<section class="cards-container">
		<div class="card card--current" id="1">
			<h1>Profile:</h1>
			<p>
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
					<div class="input-container">
						<label for="username">username</label>
						<input type="text" id="username" placeholder="Update your Username" name="username" value="<?php echo $_SESSION['username'];?>">
					</div>
					<div class="input-container">
						<label for="name">Name</label>
						<input type="text" id="name" placeholder="Update your Name" name="name" value="<?php echo $_SESSION['name'];?>">
					</div>
					<div class="input-container">
						<label for="email">Email</label>
						<input type="text" id="email" placeholder="Update your Email" name="email" value="<?php echo $_SESSION['email'];?>">
					</div>
					<div class="input-container">
						<label for="phone">Phone</label>
						<input type="text" id="phone" placeholder="Update your Phone No" name="phone" value="<?php echo $_SESSION['phone'];?>">
					</div>
					Profile Picture: <input type="file" id="pfp" name="pfp" accept="image/png, image/jpeg" style="margin-bottom: 15px;">
                    <div class="submit">
						<input type="submit" value="Update" name="submit">
                    </div>
					<input type="hidden" id="CSRF" name="CSRF" value="<?php echo $_SESSION["csrf_token"];?>"/>
                </form>
			</p>
		</div>
		<div class="card" id="2">
		<h1>Password:</h1>
			<p>
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
				<div class="input-container">
					<label for="password">Current Password</label>
					<input type="password" id="password" placeholder=" . . . Password" name="password">
				</div>
				<div class="input-container">
					<label for="newPassword">New Password</label>
					<input type="password" id="newPassword" placeholder=" . . . New Password " name="newPassword">
				</div>
				<div class="input-container">
					<label for="confirmPassword">Confirm Password</label>
					<input type="password" id="confirmPassword" placeholder=" . . . Confirm Password" name="confirmPassword">
				</div>
				<div class="submit">
					<input type="submit" value="Change Password" name="submit">
				</div>
				<input type="hidden" id="CSRF" name="CSRF" value="<?php echo $_SESSION["csrf_token"];?>"/>
			</form>
			</p>
		</div>
		<div class="card" id="3">
			<h1>History</h1>
			<p style="overflow: hidden;">
				Havent done this part either, will work on it later.
			</p>
		</div>
		<div class="card" id="4">
			<h1>More</h1>
			<p>
				Want to <b>deactivate</b> your account? You can reactivate it anytime later.<br>
				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
				<div class="input-container">
					<label for="password">Password</label>
					<input type="password" id="password" placeholder=" . . . Password" name="password">
				</div>
				<div class="submit">
					<input type="submit" value="Im Sure" name="submit" style="background-color:red;">
				</div>
				<input type="hidden" id="CSRF" name="CSRF" value="<?php echo $_SESSION["csrf_token"];?>"/>
                </form>
			</p>
		</div>
	</section>
</section>
<?php include "assets/footer.php";?>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script><script src="styles/profile.js"></script>
</body>
</html>
