<h1> Welcome to my Task</h1>

<?php 

	if($_SESSION['logged_in']){
		//Instantiate Databse object

		$database = new Database();

	// Get logged in user
		$list_user = $_SESSION['username'];

		//Query
		$database->query('SELECT * FROM list WHERE list_user = :list_user');
		$database->bind(':list_user',$list_user);
		$rows = $database->resultset();

		echo '<h4>Here are the current lists</h4>';

		if($rows){
			echo '<ul class ="items">';
		foreach($rows as $list){
			echo '<li><a href = "?page=list&id='.$list['id'].'">'.$list['list_name'].'</a></li>';
		}
		 	echo '</ul>';
		 } else{
			echo 'There are no list available -<a href="index.php?page=new_list">Create New';
		}
		}else{
			echo '<p>Register and login to access</p>';
		}
		

?>