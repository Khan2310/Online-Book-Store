<!DOCTYPE html>
<head>
	<title>Book Shop</title>
	<link href="../style/b_style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery-3.1.1.js"></script>
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

		        <center>
						<table border="0" cellspacing="0" cellpadding="5">
							<tr>
								<td>
									<fieldset>
										<legend><b>BOOK UPLOAD</b></legend>
										<table>
											<tr>
												<td>
													<font size="2" color="green">BOOK NAME</font><br />
													<input id="bookname" type="text" />
												</td>
											</tr>
											<tr>
												<td>
													<font size="2">AUTHOR</font><br />
													<input id="bookauthor" type="text" />
												</td>
											</tr>
											<tr>
												<td>
													<font size="2">PUBLISHER</font><br />
													<input id="bookpublisher" type="text" />
												</td>
											</tr>
											<tr>
			                                    <td>
			                                        <font size="2" >CETEGORY TYPE</font><br />
			                                        <select name="dropdown">
														<option id="cetegoryselect" selected>SELECT</option>
														<option id="cetegorytypefiction" value="fiction">Fiction</option>
														<option id="cetegorytypedrama" value="drama">Drama</option>
														<option id="cetegorytyperoamance" value="roamance">Roamance</option>
														<option id="cetegorytypepoetry" value="poetry">Poetry</option>
													</select>
			                                    </td>
			                                </tr>
											<tr>
												<td>
													<font size="2">DESCRIPTION</font><br />
													<input id="description" type="text" />
												</td>
											</tr>
											<tr>
												<td>
													<font size="2">QUANTITY</font><br />
													<input id="quantity" type="text" />
												</td>
											</tr>
											<tr>
												<td>
													<font size="2">BOOK PRICE</font><br />
													<input id="bookprice" type="text" />
												</td>
											</tr>
											<tr>
												<td>
													<font size="2">BOOK COVER</font><br />
													<input id="bookcoverimage" type="file" name="pic" accept="image/*">
												</td>
											</tr>
										</table>
										<hr />
										<button id="bookupload" type="button">UPLOAD</button>
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

	<script type="text/javascript" src="../js/signup.js"></script>
</body>
</html>
