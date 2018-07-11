<?php
session_start();
require 'common.php';
?>

<!DOCTYPE html>
<head>
	<title>Book Shop</title>
	<link href="style/b_style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="style/test.css">
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
				<div class="content-right-container">
      <?php
      $conn = connectToDatabase();

      //$query = oci_parse($conn, 'UPDATE books SET quantity_remaining=50 WHERE bookid IN( SELECT bookid FROM cart WHERE userid=:userid)');
      $query = oci_parse($conn ,'SELECT * FROM cart WHERE USERID = :userid AND IS_ACTIVE = 1');
      oci_bind_by_name($query, ':userid', $_SESSION['user']['USERID']);
      $cart = executeAndFetch($query);
      foreach ($cart as $key => $cartBook) {
        $bid = $cartBook['BOOKID'];
        $query = oci_parse($conn, 'UPDATE books SET quantity_remaining = quantity_remaining-1 WHERE bookid = :bookid');
        oci_bind_by_name($query, ':bookid', $bid);
        oci_execute($query);
        $query = oci_parse($conn, 'UPDATE cart SET is_active = 0 WHERE userid = :userid');
        oci_bind_by_name($query, ':userid', $_SESSION['user']['USERID']);
        oci_execute($query);


      }
      echo "Confirmed successfully!";



       ?>
			</div>

			<div id="footer">
				<a href="#">Contact Us</a><br />
				<a href="index.html"><strong>Book Shop</strong></a>
			</div>
		</div>
		<script src="js/common.js" type="text/javascript"></script>
		<script src="js/home.js" type="text/javascript"></script>
	</body>
	</html>
