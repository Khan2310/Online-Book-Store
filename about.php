<?php
session_start();
?>

<!DOCTYPE html>
<head>
	<title>Book Shop</title>
	<link href="style/b_style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
</head>
<body>
	<div id="container">
		<div id="menu">
      <ul class="nav">
				<li><a href="home.php" class="current">Home</a></li>
				<li><a href="about.php">About</a></li>
				<li><a href="cart.php">Cart</a></li>
				<li></li>
				<?php
				if(!isset($_SESSION['user'])):
					echo('<li><a href="login.php">Login</a></li>');
				else:
					echo('<li><a href="logout.php">Logout</a></li>');
				endif;
				?>
        <?php
        if(!isset($_SESSION['user'])):
          echo('<li><a href="signup.php">Signup</a></li>');
        endif;
        ?>
      </ul>
		</div>

		<div id="content">
			<div id="content_left">
				<div class="content_left_section">
					<h1>Categories</h1>
					<ul>
						<li><a href="searchresult.php?term=fiction&criteria=CATEGORY">Fiction</a></li>
						<li><a href="searchresult.php?term=drama&criteria=CATEGORY">Drama</a></li>
						<li><a href="searchresult.php?term=romance&criteria=CATEGORY">Roamance</a></li>
						<li><a href="searchresult.php?term=poetry&criteria=CATEGORY">Poetry</a></li>
					</ul>
				</div>
			</div>

			<div id="content_right">
				<h1>About Us</h1>
				<p>Some people like to read on a screen. Other people need the variety and artistry, the sight, smell, and feel of actual books.They love seeing them on their shelves; they love having shelves for them.</p>
				<p>These are the people we're working for.</p>
				<div>&nbsp;</div>
			</div>
		</div>

		<div id="footer">
			<a href="#">Contact Us</a><br />
			<a href="home.php"><strong>Book Shop</strong></a>
		</div>
	</div>
</body>
</html>
