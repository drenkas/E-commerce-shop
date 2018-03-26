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
	<div class="nav">
		<a href="index.php">Home</a>
		<div class="dropdown">
			<button class="dropbtn">
				Categories
				<i class="fa fa-power-off"></i>
			</button>
			<div class="content">
				<a href="#">Categoria 1</a>
				<a href="#">Categoria 2</a>
				<a href="#">Categoria 3</a>
			</div>
		</div>
		<a href="addprod.php">Products</a>
		<a href="adm_user.php">Users</a>
		<a href="adm_orders.php">Orders</a>
		<a href="create.php">Sign up</a>
		<a href="sign_in.php">Sign in</a>
		<a href="cart.php">Cart</a>
	</div>
