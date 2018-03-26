<?php
	session_start();
	$id = $_SESSION["id"];
	if (isset($_POST['submit']) && $_POST['submit'] == "OK")
	{
		$title = $_POST['title'];
		$descr = $_POST['description'];
		$img = $_POST['image'];
		$price = $_POST['price'];
		$category = $_POST['category'];
		$link = mysqli_connect("localhost", "root", "renkas", "rush");
		$sql = "UPDATE `products` SET `category`= '$category', `name`= '$title', `description`= '$descr', `price` = '$price', `img`= '$img' WHERE id_product='$id'";
		mysqli_query($link, $sql);
        mysqli_close($link);
        header("Location: index.php?content=adm_prod");
	}
	else
	{
		$link = mysqli_connect("localhost", "root", "renkas", "rush");
		$sql = "SELECT * FROM `products` WHERE id_product='$id'";
		$find = mysqli_query($link, $sql);
		while ($row = mysqli_fetch_array($find))
		{
			$name = $row['name'];
			$cat = $row['category'];
			$des = $row['description'];
			$price = $row['price'];
			$img = $row['img'];
		}
		mysqli_close($link);
	}
?>

<br>
	<form class="create_form" method = "POST" action="">
		<input type="text" name="title" value="<?php echo $name?>" placeholder="name">
		<br>
		<input type="text" name="description" value="<?php echo $des?>" placeholder="description">
		<br>
		<input type="text" name="price" value="<?php echo $price?>" placeholder="price">
		<br>
		<input type="text" name="image" value="<?php echo $img?>" placeholder="img link">
		<br>
		<input type="text" name="category" value="<?php echo $cat?>" placeholder="Category">
		<br>
		<input type = "submit" name="submit" value = "OK"/>
	</form>