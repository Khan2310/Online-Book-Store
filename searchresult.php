<?php
session_start();
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
    <div id="searchbox-container">
      <?php
        if(isset($_GET['term'])):
          echo('<input type="text" id="searchbox-small" value="'. $_GET['term']. '" placeholder="Search books..">');
        else:
          echo('<input type="text" id="searchbox-small" placeholder="Search books..">');
        endif;
      ?>
        <select id="categorySelect">
            <option value="BOOKNAME" selected>Name</option>
            <option value="AUTHOR">Author</option>
            <option value="PUBLISHER">Publisher</option>
            <option value="CATEGORY" <?php if(isset($_GET['criteria']) && $_GET['criteria'] === 'CATEGORY') echo "selected"?>>Category</option>
        </select>

        <button id="searchButton" type="button">Search</button>
    </div>


    <div id="searchContent">

    </div>

    <div id="footer">
        <a href="#">Contact Us</a><br />
        <a href="index.html"><strong>Book Shop</strong></a>
    </div>
</div>
<script src="js/common.js" type="text/javascript"></script>
<script src="js/searchresult.js" type="text/javascript"></script>
<?php if(isset($_GET['term'])): ?>
  <script type="text/javascript">onClickSearch();</script>
<?php endif; ?>
</body>
</html>
