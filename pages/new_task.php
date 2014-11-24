<?php
	if($_POST['task_submit']){
		$task_name =$_POST['task_name'];
		$task_body = $_POST['task_body'];
		$due_date  =$_POST['due_date'];
		$list_id = $_POST['list_id'];

		$database = new Database();

		$database->query('INSERT INTO tasks (task_name, task_body, due_date,list_id) VALUES (:task_name,:task_body,:due_date,:list_id)');
		$database->bind(':task_body',$task_body);
		$database->bind(':task_name',$task_name);
		$database->bind(':due_date',$due_date);
		$database->bind(':list_id',$list_id);
		$database->execute();

		if($database->lastInsertId()){
			echo '<p>Your task has been created</p>';
		}
	}
?>