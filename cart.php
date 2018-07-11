<?php
require 'common.php';
session_start();
$user = getCurrentUser();
if($user) {
	echo "cdcddf";
	$conn = connectToDatabase();
	$userid = $user['USERID'];
	$query = oci_parse($conn ,'SELECT * FROM cart WHERE USERID = :userid AND IS_ACTIVE = 1');
	oci_bind_by_name($query, ':userid', $userid);
	$cart = executeAndFetch($query);
	$cartBooks = [];
	foreach ($cart as $key => $cartBook) {
		$bid = $cartBook['BOOKID'];
		$q = oci_parse($conn, 'SELECT * FROM books WHERE bookid = :bookid');
		oci_bind_by_name($q, ':bookid', $bid);
		$cartBooks[] = executeAndFetch($q);
	}
}

?>

<!DOCTYPE html>
<head>
	<title>Book Shop</title>
	<link href="style/b_style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="style/test.css">
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
</head>
<body>
	<script>
    const cart = <?php global $cartBooks; echo json_encode($cartBooks, JSON_HEX_TAG); ?>; //Don't forget the extra semicolon!
	</script>

	<div id="container">
		<div id="menu">
			<ul class="nav">
				<li><a href="home.php" class="current">Home</a></li>
				<li><a href="about.php">About</a></li>
				<li><a href="cart.php">Cart</a></li>
				<li></li>
				<?php if(!isset($_SESSION['user'])):
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
<div><a href="confirm.php"><button>Confirm cart</button></a></div>
				<div class="content-right-container">
					<div id="content_right"></div>
				</div>

			</div>

			<div id="footer"> <a href="#">Contact Us</a><br />
				<a href="index.html"><strong>Book Shop</strong></a>
			</div>
		</div>
		<script src="js/cart.js" type="text/javascript"></script>
	</body>
	</html>
