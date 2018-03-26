<?php

$server = "localhost";
	$user = "root";
	$pass = "renkas";
	$db = "rush";

	$link = mysqli_connect($server, $user, $pass, $db);

if (isset($_POST['submit'])) {
    if ($_POST["submit"] == "OK") {
        $name = $_POST["title"] ;
        $cat = $_POST["category"];
        $description = $_POST["description"];
        $img = $_POST["image"];
        $price = $_POST["price"];
        $mysql =  mysqli_connect("localhost", "root", "renkas", "rush"); /*PASSWORD*/
        $sql = "INSERT INTO `products` 
                (`id_product`,
                `name`,  
                `category`, 
                `description`, 
                `price`, 
                `img`) 
                VALUES (NULL, '$name', '$cat', '$description ', '$price', '$img')";
        mysqli_query($link, $sql);
        mysqli_close($link);
    }
}

?>
	<br>
	<form class="create_form" method = "POST" action="">
		<input type="text" name="title" value="" placeholder="name">
		<br>
		<input type="text" name="description" value="" placeholder="description">
		<br>
		<input type="text" name="price" value="" placeholder="price">
		<br>
		<input type="text" name="image" value="" placeholder="img link">
		<br>
		<input type="text" name="category" value="" placeholder="Category">
		<br>
		<input type = "submit" name="submit" value = "OK"/>
	</form>
