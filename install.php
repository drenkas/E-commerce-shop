<?PHP
	$server = "localhost";
	$user = "root";
	$pass = "renkas";
	$db = "rush";

	session_start();
	$link = mysqli_connect($server, $user, $pass) or die("Can't connect to the mysql");
	
	$sql = "CREATE DATABASE IF NOT EXISTS ".$db;
	
	mysqli_query($link,$sql);
	$link = mysqli_connect($server, $user, $pass, $db);
	//add users table
	$sql = "SELECT * FROM users";
	$result = mysqli_query($link,$sql);
	if (!$result)
	{
		$sql = "CREATE TABLE IF NOT EXISTS `users`(
		`id_user` INT(255) NOT NULL AUTO_INCREMENT,
		`login` VARCHAR(200) NOT NULL,
		`passwd` VARCHAR(500) NOT NULL,
		PRIMARY KEY(`id_user`)
		)";
		mysqli_query($link, $sql);

		$adminpass = hash("whirlpool", 'admin');
		mysqli_query($link, "INSERT INTO `users` (login, passwd) VALUES ('admin', '$adminpass')");
	}
	$sql = "SELECT * FROM products";
	$result = mysqli_query($link, $sql);
	if (!$result)
	{
		$sql = "CREATE TABLE IF NOT EXISTS products (
		  id_product INT(255) NOT NULL AUTO_INCREMENT,
		  name VARCHAR(100) NOT NULL,
		  category VARCHAR(100),
		  description VARCHAR(500) NOT NULL,
		  price INT(6) NOT NULL,
		  img VARCHAR (1000) NOT NULL,
		  PRIMARY KEY(`id_product`)
		)";
		mysqli_query($link, $sql);

		$sql = "INSERT INTO products (name, category, description, price, img)
				VALUES ('iPhone 6', 'Old', 'Old but stil good', '500.00', 'img/iphone6.jpg'),
				('iPhone 6s', 'Old', 'Best of the best', '600.00', 'img/iphone6s.jpg'),
				('iPhone 7', 'Old', 'I dont use it but recomend', '700.00', 'img/iphone7.jpg'),
				('iPhone 7s', 'Old', 'Very powerfull for this price', '800.00', 'img/iphone7.jpg'),
				('iPhone 8', 'New', 'If you dont buy this', '900.00', 'img/iphone8.jpg'),
				('iphone X', 'New', 'Top phone in the world', '1200.00', 'img/iphone_x.jpg')
				";
		mysqli_query($link, $sql);
	}
	$sql = "SELECT * FROM cart";
	$result = mysqli_query($link, $sql);
	if (!$result)
	{
		$sql = "CREATE TABLE IF NOT EXISTS cart (
		  id_cart INT(255) NOT NULL AUTO_INCREMENT,
		  id_product VARCHAR(500) NOT NULL,
		  id_user VARCHAR(500),
		  amount VARCHAR(500) NOT NULL,
		  total_cost INT(255) NOT NULL,
		  PRIMARY KEY(`id_cart`)
		)";
		mysqli_query($link, $sql);
	}
	$sql = "SELECT * FROM orders";
	$result = mysqli_query($link, $sql);
	if (!$result)
	{
		$sql = "CREATE TABLE IF NOT EXISTS orders (
		  id_order INT(255) NOT NULL AUTO_INCREMENT,
		  id_product VARCHAR(500) NOT NULL,
		  id_user VARCHAR(500),
		  amount VARCHAR(500) NOT NULL,
		  total_cost INT(255) NOT NULL,
		  PRIMARY KEY(`id_order`)
		)";
		mysqli_query($link, $sql);
	}
	if (!$_SESSION)
	{
		$i = -1;
		$_SESSION['id_guest'] = $i;
		$sql = "SELECT * FROM cart";
		$query = mysqli_query($link, $sql);
		while ($row = mysqli_fetch_array($query)) {
			if ($row['id_user'] == $_SESSION['id_guest'])
				$i--;
		}
		$_SESSION['id_guest'] = $i;
	}
	mysqli_close($link);
?>