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

		<div id="login-container">

			<center>
				<table border="0" cellspacing="0" cellpadding="5">
					<tr>
						<td>
							<fieldset>
								<legend><b>SIGN UP</b></legend>
								<table>
									<tr>
										<td>
											<font size="2" color="green">Email</font><br />
											<input id="email" type="text" />
										</td>
									</tr>
									<tr>
										<td>
											<font size="2">Name</font><br />
											<input id="name" type="text" />
										</td>
									</tr>
									<tr>
										<td>
											<font size="2">Password</font><br />
											<input id="password" type="password" />
										</td>
									</tr>
									<tr>
										<td>
											<font size="2">Confirm Password</font><br />
											<input id="confirmation" type="password" />
										</td>
									</tr>
								</table>
								<hr />
								<button id="signupButton" type="button">Signup</button>
							</fieldset>
						</td>
					</tr>
				</table>
			</center>

			<div>&nbsp;</div>

			<div>&nbsp;</div>
		</div>

		<div id="footer">
			<a href="#">Contact Us</a><br />
			<a href="index.php"><strong>Book Shop</strong></a>
		</div>
	</div>

	<script type="text/javascript" src="js/signup.js"></script>
</body>
</html>
