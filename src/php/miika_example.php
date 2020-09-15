$qry2 = "SELECT * FROM pitsa";
$seequl2 = mysqli_fetch_all(mysqli_query($link, $qry2));

<select name="pizza">
<?php foreach ($seequl2 as $pitsa): ?>
<option value="<?php echo $pitsa[0]; ?>">
	<?php echo $pitsa[1]; ?>
</option>
<?php endforeach;?>
</select>