
<?php
// Start Session   --> it shoud be at first for session running
  session_start();
// Config file
 include 'config.php'; 
//Database class
 require 'classes/database.php'; 

$database = new Database();

//Set Timeout
date_default_timezone_set('America/New_York');
?>



<?php
// LOG IN
    if($_POST['login_submit']){
      $username = $_POST['username'];
      $password = $_POST['password'];
      $enc_password = md5($password);

  //Query
      $database->query("SELECT * FROM users WHERE username = :username AND password =:password");
      $database->bind(':username',$username);
      $database->bind(':password',$enc_password);
      $rows = $database->resultset();
      $count = count($rows);
      if($count>0){
        session_start();

      //Assign session variable
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['logged_in'] = 1;

      }else{
        $login_msg[] = 'Sorry. Login does not work';
      }
    }
    
    //Log out
    if($_POST['logout_submit']){
      if(isset($_SESSION['username']))
          unset($_SESSION['username']);
      if(isset($_SESSION['password']))
        unset($_SESSION['password']);

      if(isset($_SESSION['logged_in']))
          unset($_SESSION['logged_in']);
      session_destroy();
    }
    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Task App</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <style>
  .container h1{
    margin-top: 100px;
  }
  </style>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">TASK APP</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class = "active"><a href="http://localhost/taskapp">Home</a></li>
            <?php 
              if(!$_SESSION['logged_in']):?>
                  <li><a href="index.php?page=register">Register</a></li>
            <?php else: ?>
            <li><a href  = "index.php?page=new_list">Add List</a></li>
             <li><a href="index.php?page=new_task">Add Task</a></li>
           
            <?php endif; ?>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

    <h1>Hello World</h1>

    <?php
      if($_GET['page'] == 'welcome' || $_GET['page']==""){
        include 'pages/welcome.php';
      }elseif($_GET['page']=='list'){
        include 'pages/list.php';
      }elseif($_GET['page']=='task'){
        include 'pages/task.php';
      }elseif($_GET['page']=='new_task'){
        include 'pages/new_task.php';
      }elseif($_GET['page']=='new_list'){
        include 'pages/new_list.php';
      }elseif($_GET['page']=='edit_task'){
        include 'pages/edit_task.php';
      }elseif($_GET['page']=='edit_list'){
        include 'pages/edit_list.php';
      }elseif($_GET['page']=='register'){
        include 'pages/register.php';
      }elseif($_GET['page']=='delete_list'){
        include 'pages/delete_list.php';
      }
     
      ?>

    </div><!-- /.container -->

    <h3>Login Form</h3>
      <form action = "<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <?php if(!$_SESSION['logged_in']): ?>
          <?php foreach($login_msg as $msg):?>
            <?php echo $msg.'<br/>'; ?>
          <? endforeach; ?>
      <label>Username: </label></br>
      <input type="text" name = "username" /><br/>
      <label>Password: </label></br/>
      <input type = "password" name= "password" /><br/>
      <input type = "submit" value ="Login" name ="login_submit" />
    <?php else: ?>
      <input type ="submit" value = "Logout" name = "logout_submit" />
    <?php endif; ?>

      </form>


  </body>
</html>
