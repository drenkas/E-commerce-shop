<?php
	function check($login, $passwd)
	{
		$mysql = mysqli_connect("localhost", "root", "renkas", "rush");
		$pass = hash("whirlpool", $passwd);
		$sql = "SELECT * FROM `users` WHERE `login`='$login' AND  `passwd`='$pass'";
		$query = mysqli_query($mysql, $sql);
		while ($row = mysqli_fetch_array($query)) {
			if ($row['login'] == $login && $row['passwd'] == $pass) {
				return (true);
			}
		}
		return (false);
	}
	session_start();
	if ($_POST["login"] && $_POST["passwd"]) {
		if (check($_POST["login"], $_POST["passwd"])) {
			$_SESSION['loggued_on_user'] = $_POST["login"];
			$_SESSION['login'] = $_POST["login"];
			$_SESSION['passwd'] = $_POST["passwd"];
			header("Location: index.php");
		}
		else {
			$_SESSION['loggued_on_user'] = "";
			header("Location: index.php?content=login&page=error");
		}
	}
?>


<div class="create_text">Log in, iBro<br>We all love apples!</div>
<form class="create_form" action="<?php $_PHP_SELF ?>" method="post" class="form">
	<input type="text" name="login" value="<?php if (isset($_SESSION["login"])) {echo $_SESSION["login"];}?>" placeholder="Enter your login">
	<br>
	<input type="password" name="passwd" value="<?php if (isset($_SESSION["passwd"])) {echo $_SESSION["passwd"];}?>" placeholder="Enter your password">
	<br>
	<?php
	if ($_GET['page'] == "error"){
		echo "<div style=\"
		color:  red;
		font-size: 20px;
		margin: 0 auto;
		width: 300px;
		text-align: center;
	\">Wrond login or/and password </div>";
	};
	?>
	<input type="submit" name="submit" value="OK">
</form>
<div class="create_text">If you like apples, but not yet registered on our site<br>then 
<a href="index.php?content=create">do it, iBro</a>!<br>PS: We dont know why there are some phones here, not apples :3</div>
