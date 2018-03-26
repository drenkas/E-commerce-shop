<?php

if (isset($_GET['podelat1']) && $_GET['podelat1'] == "delete" && $_GET['content'] == "cart")
{
	$link = mysqli_connect("localhost", "root", "renkas", "rush");
	$id = $_GET['id'];
	$sql = "DELETE FROM `cart` WHERE `id_product` = '$id'";
	mysqli_query($link, $sql);
	mysqli_close($link);
}

if (isset($_POST['submit_order'])) {
	if ($_SESSION['loggued_on_user'])
	{
		$link = mysqli_connect("localhost", "root", "renkas", "rush") or die("Can't connect to the mysql.");
		$sql = "SELECT * FROM orders";
		$query = mysqli_query($link, $sql);
		while ($row = mysqli_fetch_array($query)) {
			$id_order = $row['id_order'];
		}
		if (!$id_order)
			$id_order = 0;
		else
			$id_order++;
		$sql = "INSERT INTO `orders` SELECT * FROM `cart`";
		$sql1 = "SELECT * FROM orders";
		$sql1 = "DELETE FROM `cart`";
		mysqli_query($link, $sql);
		mysqli_query($link, $sql1);
		echo "<div class=\"create_text\">You order is confirm</div>";
	}
	else
		echo "<div class=\"create_text\">Please login or register</div>";
}
?>

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
<?php 
	$link = mysqli_connect("localhost", "root", "renkas", "rush");
	$sql = "SELECT * FROM cart ORDER BY id_cart";
	$query = mysqli_query($link, $sql);
	$row = mysqli_fetch_array($query);
	if ($row['id_user'])
	{ ?>
	<div class="create_text">Goods in the cart</div>
	<table class="prod_table">
	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Amount</th>
		<th>Total cost</th>
		<th>Ля шо бы поделат</th>
	</tr>

	<?php
		$i = 0;
		$summa = 0;
		$link = mysqli_connect("localhost", "root", "renkas", "rush");
		$sql = "SELECT * FROM cart ORDER BY id_cart";
		$query = mysqli_query($link, $sql);
		$sql2 = "SELECT * FROM users";
		$query2 = mysqli_query($link, $sql2);
		$id_guest = $_SESSION['id_guest'];
		if ($_SESSION['loggued_on_user']) {
				while ($row2 = mysqli_fetch_array($query2)) {
						if ($row2['login'] == $_SESSION['loggued_on_user'])
							break ;
				}
				$id_user1 = $row2['id_user'];
			}
		while ($row = mysqli_fetch_array($query)) {
			?>
		<tr>
			<?php

			if ($row['id_user'] == $_SESSION['id_guest'] && $_SESSION['loggued_on_user'])
				{
					$sql3 = "UPDATE `cart` SET `id_user`= '$id_user1' WHERE id_user='$id_guest'";
					mysqli_query($link, $sql3);
				}
			if ($row['id_user'] != $_SESSION['id_guest'] && $row['id_user'] != $id_user1)
				continue ;
				$sql1 = "SELECT * FROM products";
				$query1 = mysqli_query($link, $sql1);
				while ($row1 = mysqli_fetch_array($query1)) {
					 if ($row1['id_product'] == $row['id_product'])
						 break ;
					 }?>
					 <?php
						$summa = $summa + $row['total_cost'];
					 ?>
			<td><?php echo ++$i?></td>
			<td><?php echo $row1['name']?></td>
			<td><?php echo $row['amount']?></td>
			<td><?php echo $row['total_cost']?></td>
			<td>
				<a href="index.php?content=cart&podelat1=delete&id=<?php echo $row1['id_product']?>">Delete</a>
			</td>
		</tr>
		<?php
		}
		mysqli_close($link);
	?>
	</table>
<div class="create_text">
	
	Total price:
	<?php echo $summa?>
	<form action="" method="post">
		<input type="hidden" name="price" value="<?php echo $summa?>">
		<button type="submit" name="submit_order" value="">Confirm order</button>
	</form>
	</div><?php }
	else{ ?>
		<div class="create_text">Your basket is totally empty!</div>
		<div class="create_text">Buy already something!</div>
	<?php }; ?>
</body>
</html>
