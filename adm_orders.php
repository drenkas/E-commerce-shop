<?php
	if (isset($_GET['podelat']) && $_GET['podelat'] == "delete" && $_GET['content'] == "adm_orders")
	{
		$link = mysqli_connect("localhost", "root", "renkas", "rush");
		$id = $_GET['id'];
		$sql = "DELETE FROM `orders` WHERE `id_order` = '$id'";
		mysqli_query($link, $sql);
		mysqli_close($link);
	}
	if (isset($_GET['podelat']) && $_GET['podelat'] == "edit" && $_GET['content'] == "adm_orders")
	{
		header("Location: index.php?content=edit_order&id={$_GET['id']}");
	}
?>

<div class="create_text">ADMIN PAGE: orders</div>
<table class="prod_table">
	<tr>
		<th>ID Order</th>
		<th>ID Product</th>
		<th>ID User</th>
		<th>Amount</th>
		<th>Total cost</th>
		<th>Ля шобы поделать</th>
	</tr>

	<?php
		$link = mysqli_connect("localhost", "root", "renkas", "rush");
		$sql = "SELECT * FROM orders ORDER BY id_order";
		$query = mysqli_query($link, $sql);
		while ($row = mysqli_fetch_array($query)) {
			?>
		<tr>
			<td><?php echo $row['id_order']?></td>
			<td><?php echo $row['id_product']?></td>
			<td><?php echo $row['id_user']?></td>
			<td><?php echo $row['amount']?></td>
			<td><?php echo $row['total_cost']?></td>
			<td>
				<a href="index.php?content=adm_orders&podelat=delete&id=<?php echo $row['id_order']?>">Delete</a>
				<a href="index.php?content=edit_order&podelat=edit&id=<?php echo $row['id_order']?>">Edit</a>
			</td>
		</tr>
		<?php
		}
		mysqli_close($link);
	?>
</table>

</form>