<?php
		$list_id = $_GET['id'];
		echo $list_id;

?>

<h1>Edit list</h1>
<form action = "<?php $_SERVER['PHP_SELF']; ?>" method="post">
	<label>List Name</label><br/>
	<input type = "text" name = "list_name" value="<?php echo $row['list_name']; ?>" /><br/>
	<label>List Body</label><br/>
	<textarea rows="5" cols ="50" name="task_body"><?php echo $row['list_body']; ?></textarea><br/>
	<label>Create Date</label><br/>
	<input type="date" name="create_date" value="<?php echo date($row['create_date']); ?>"/><br/>

	<br/>
	Mark if Completed <input type="checkbox" name="is_complete" value="1">

	<br/>
	<input type="submit" value="Update" name="submit"/>
</form>