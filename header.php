<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Menu</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="index.css">
	<link rel="stylesheet" href="form.css">
</head>
<body>
	<div class="nav" >
		<a href="index.php">Home</a>
		<div class="dropdown">
			<button class="dropbtn">
				Categories
				<i class="fa fa-filter"></i>
			</button>
			<div class="content">
				<?php include("dropdown.php"); ?>
			</div>
		</div>
		<?php if ($_SESSION['loggued_on_user'] && $_SESSION['loggued_on_user'] != 'admin') {
				echo "
				<div class=\"dropdown\">
				<button class=\"dropbtn\">
				{$_SESSION['loggued_on_user']}
					<i class=\"fa fa-user-o\"></i>
				</button>
				<div class=\"content\">
					<a href=\"index.php?content=userdelete\">Delete account</a>
				</div>
			</div>";
				echo "<a href=\"userout.php\">Log out</a>";
				echo "<a href=\"index.php?content=cart\">Cart</a>";
			}
			elseif ($_SESSION['loggued_on_user'] == 'admin'){
				echo "<a href=\"index.php?content=addprod\">Add Product</a>";
				echo "<a href=\"index.php?content=adm_prod\">Products</a>";
				echo "<a href=\"index.php?content=adm_users\">Users</a>";
				echo "<a href=\"index.php?content=adm_orders\">Orders</a>";
				echo "<a href=\"index.php?content=addprod\">Admin</a>";
				echo "<a href=\"index.php?content=userout\">Log out</a>";
			}
			else
			{
				echo "<a href=\"index.php?content=create\">Sign up</a>";
				echo "<a href=\"index.php?content=login\">Log in</a>";
				echo "<a href=\"index.php?content=cart\">Cart</a>";
			}
		?>
	</div>