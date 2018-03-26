<?php
	if (isset($_GET['podelat']) && $_GET['podelat'] == "delete" && $_GET['content'] == "adm_prod")
	{
		$link = mysqli_connect("localhost", "root", "renkas", "rush");
		$id = $_GET['id'];
		$sql = "DELETE FROM `products` WHERE `id_product` = '$id'";
		mysqli_query($link, $sql);
		mysqli_close($link);
	}
	if (isset($_GET['podelat']) && $_GET['podelat'] == "edit" && $_GET['content'] == "adm_prod")
	{
		header("Location: index.php?content=edit_prod&id={$_GET['id']}");
	}
?>

<div class="create_text">ADMIN PAGE: products</div>
<table class="prod_table">
	<tr>
		<th>Name</th>
		<th>Description</th>
		<th>Category</th>
		<th>Price</th>
		<th>Ля шобы поделать</th>
	</tr>

	<?php
		$link = mysqli_connect("localhost", "root", "renkas", "rush");
		$sql = "SELECT * FROM products ORDER BY category";
		$query = mysqli_query($link, $sql);
		while ($row = mysqli_fetch_array($query)) {
			?>
		<tr>
			<td><?php echo $row['name']?></td>
			<td><?php echo $row['description']?></td>
			<td><?php echo $row['category']?></td>
			<td><?php echo $row['price']?></td>
			<td>
				<a href="index.php?content=adm_prod&podelat=delete&id=<?php echo $row['id_product']?>">Delete</a>
				<a href="index.php?content=edit_prod&podelat=edit&id=<?php echo $row['id_product']?>">Edit</a>
			</td>
		</tr>
		<?php
		}
		mysqli_close($link);
	?>
</table>

</form>