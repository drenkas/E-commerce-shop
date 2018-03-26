<?php
	if (isset($_GET['podelat']) && $_GET['podelat'] == "delete" && $_GET['content'] == "adm_users")
	{
		$link = mysqli_connect("localhost", "root", "renkas", "rush");
		$id = $_GET['id'];
		$sql = "DELETE FROM `users` WHERE `id_user` = '$id'";
		mysqli_query($link, $sql);
		mysqli_close($link);
	}
?>

<div class="create_text">ADMIN PAGE: users</div>
<table class="prod_table">
	<tr>
		<th>Name</th>
		<th>Ля шобы поделать</th>
	</tr>

	<?php
		$link = mysqli_connect("localhost", "root", "renkas", "rush");
		$sql = "SELECT * FROM users ORDER BY login";
		$query = mysqli_query($link, $sql);
		while ($row = mysqli_fetch_array($query)) {
			?>
		<tr>
			<td><?php echo $row['login']?></td>
			<td>
				<a href="index.php?content=adm_users&podelat=delete&id=<?php echo $row['id_user']?>">Delete</a>
			</td>
		</tr>
		<?php
		}
		mysqli_close($link);
	?>
</table>

</form>