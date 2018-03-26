<?PHP
	include("install.php");
	$content = 'products.php';
	if (isset($_GET["content"]))
	{
		if ($_GET["content"] == "create")
			$content = "create.php";
		else if ($_GET["content"] == "userout")
			$content = "userout.php";
		else if ($_GET["content"] == "login")
			$content = "sign_in.php";
		else if ($_GET["content"] == "addprod")
			$content = "addprod.php";
		else if ($_GET["content"] == "adm_prod")
			$content = "adm_prod.php";
		else if ($_GET["content"] == "edit_prod")
		{	
			$content = "edit_prod.php";
			$_SESSION['id'] =  $_GET['id'];
		}
		else if ($_GET["content"] == "adm_users")
			$content = "adm_users.php";
		else if ($_GET["content"] == "cart")
			$content = "cart.php";
		else if ($_GET["content"] == "submit_order")
			$content = "submit_order.php";
		else if ($_GET["content"] == "adm_orders")
			$content = "adm_orders.php";
		else if ($_GET["content"] == "edit_order")
			{	
				$content = "edit_order.php";
				$_SESSION['id'] =  $_GET['id'];
			}
		else if ($_GET["content"] == "userdelete")
		{
			$link = mysqli_connect("localhost", "root", "renkas", "rush");
			$name = $_SESSION['loggued_on_user'];
			$sql = "DELETE FROM `users` WHERE `login` = '$name'";
			mysqli_query($link, $sql);
			mysqli_close($link);
			$content = "userout.php";
		}
		
	}
?>

<?PHP include("header.php"); ?>

	<?php include($content); ?>
</body>
</html>