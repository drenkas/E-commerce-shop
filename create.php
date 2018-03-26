<?php
	if (isset($_POST['submit'])) {
		if ($_POST["submit"] == "OK") {
			if ($_POST["login"] && $_POST["passwd"]) {
				$link = mysqli_connect("localhost", "root", "renkas", "rush");
				$login = $_POST["login"];
				$pass = hash("whirlpool", $_POST["passwd"]);
				$sql = "SELECT * FROM `users` WHERE `login`='$login'";
				$query = mysqli_query($link, $sql);
				$sign = 1;
				while ($row = mysqli_fetch_array($query)) {
					if ($row['login'] == $login) {
						$sign = 0;
						header("Location: index.php?content=create&page=error");;
						break ;
					}
				}
				if ($sign === 1) {
					$sql = "INSERT INTO `users` (`login`, `passwd`) VALUES ('$login', '$pass')";
					mysqli_query($link, $sql);
					$_SESSION['loggued_on_user'] = $_POST["login"];
					echo "{$_SESSION['loggued_on_user']}";
					header("Location: index.php");
				}
				mysqli_close($link);
			}
		} else
			echo "ERROR0\n";
	}
?>

<div class="create_text">Create new account</div>
<form class="create_form" method = "POST" action="">
	<input type = "text" name = "login"  value="" placeholder="Enter your login"/>
	<br />
	<input type = "password" name = "passwd" value=""  placeholder="Enter your password"/>
	<br />
	<?php
	if ($_GET['page'] == "error"){
		echo "<div style=\"
		color:  red;
		font-size: 20px;
		margin: 0 auto;
		width: 300px;
		text-align: center;
	\">User with such name already exists</div>";
	};
	?>
	<input type = "submit" name="submit" value = "OK"/>
</form>

