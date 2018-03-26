
<?php
	$link = mysqli_connect("localhost", "root", "renkas", "rush");
	$sql = "SELECT * FROM products ORDER BY category";
	$query = mysqli_query($link, $sql);
	$check = array();
	while ($row = mysqli_fetch_array($query)) {
		if (in_array($row['category'], $check))
			continue ;
		else
		{
			array_push($check, $row['category']);
			?><a href="index.php?cat=<?php echo $row['category']?>"><?php echo $row['category']?></a><?php
		}
?><?php
	}
	mysqli_close($link);
?>