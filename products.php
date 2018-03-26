<?php

session_start();
	$user = $_SESSION['loggued_on_user'];
		$server = "localhost";
		$user = "root";
		$pass = "renkas";
		$db = "rush";
		$link = mysqli_connect($server, $user, $pass, $db) or die("Can't connect to the mysql.");
		if (isset($_POST['amount']) && $_POST['amount'] > 0 && isset($_POST['submit_buy'])) {

			$amount = intval($_POST['amount']);
			$id = $_POST['submit_buy'];
			$id_product = $_POST['id_product'];
			$sql = "SELECT * FROM users";
			$query = mysqli_query($link, $sql);
			if ($_SESSION['loggued_on_user']) {
				while ($row = mysqli_fetch_array($query)) {
					 echo $row['login'];
						if ($row['login'] == $_SESSION['loggued_on_user'])
							break ;
				}
				$id_user = $row['id_user'];
			}
			else
				$id_user = $_SESSION['id_guest'];
			$login = $_SESSION['loggued_on_user'];
			$price = intval($_POST['price']);
			$total = $amount * $price;
			$sql = "INSERT INTO `cart` (id_product, id_user, amount, total_cost) VALUES ('$id_product', '$id_user', '$amount', '$total')";
			mysqli_query($link, $sql);
		}
?>
<?php
	$server = "localhost";
	$user = "root";
	$pass = "renkas";
	$db = "rush";
	$link = mysqli_connect($server, $user, $pass, $db) or die("Can't connect to the mysql.");
	$sql = "SELECT * FROM products";
	if (isset($_GET['cat']))
	{
		$categ = $_GET['cat'];
		$sql = "SELECT * FROM products WHERE category='$categ' ORDER BY name";
	}
	$result = mysqli_query($link, $sql);
	if ($result->num_rows > 0) {
	?>
	<div class="products"> <?php
	while($row = $result->fetch_assoc()) {
	 ?>
	 <div class="product">
	 <div class="prod_img"><img src="<?php echo $row['img'] ?>" alt=""></div>
		 <div class="prod_name"><?php echo $row["name"]?></div>
		 <div class="prod_des"><?php echo $row["description"]?></div>
		 <div class="prod_price"><?php echo $row["price"]?>$</div>
		 <form class="cart_form" action="" method="post">
			 <input type="number"  name="amount" value="0">
			 <input type="hidden"  name="id_product" value="<?php echo $row['id_product']?>">
			 <input type="hidden" name="price" value="<?php echo $row["price"]?>">
			 <button type="submit" name="submit_buy" class="buy_btn" value="<?php echo $row["name"]?>">Buy</button>
		 </form>
	 </div>
	<?php
	}?>
	</div><?php
	}
	mysqli_close($link);
?>