<?php
	session_start();
	$id = $_SESSION["id"];
	if (isset($_POST['submit']) && $_POST['submit'] == "OK")
	{
		$title = $_POST['id_product'];
		$user = $_POST['id_user'];
		$price = intval($_POST['amount']);
		$total_cost = intval($_POST['price']) * $price;
		$link = mysqli_connect("localhost", "root", "renkas", "rush");
		$sql = "UPDATE `orders` SET `id_product`= '$title', `id_user`= '$user', `amount` = '$price', `total_cost`= '$total_cost' WHERE id_order='$id'";
		mysqli_query($link, $sql);
		mysqli_close($link);
		header("Location: index.php?content=adm_orders");
	}
	else
	{
		$link = mysqli_connect("localhost", "root", "renkas", "rush");
		$sql = "SELECT * FROM `orders` WHERE id_order='$id'";
		$find = mysqli_query($link, $sql);
		while ($row = mysqli_fetch_array($find))
		{
			$name = $row['id_product'];
			$user = $row['id_user'];
			$amount = intval($row['amount']);
			$total_cost = intval($row['total_cost']);
			$one_cost = $total_cost / $amount;
		}
		mysqli_close($link);
	}
?>

<br>
	<form class="create_form" method = "POST" action="">
		<input type="text" name="id_product" value="<?php echo $name?>" placeholder="ID PRODUCT">
		<br>
		<input type="text" name="id_user" value="<?php echo $user?>" placeholder="ID USER">
		<br>
		<input type="text" name="amount" value="<?php echo $amount?>" placeholder="AMOUNT">
		<br>
		<input type="hidden" name="price" value="<?php echo $one_cost?>">
		<input type = "submit" name="submit" value = "OK"/>
	</form>