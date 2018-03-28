<!-This code is only used once to set up logins if authentication is desired.  To use simply change user names and passwords (and really you should change the salts), save in your webroot, then point a browser to it's location.  All of the action will take place invisibly.  This will only work once.  After that the it will fail with an error because the table already exists.  To start over drop the "users" table.-->
<?php 
	include 'login.php'; 
	$connect=mysqli_connect($hn,$un,$pw,$db);
 
if(mysqli_connect_errno($connect))
{
		echo 'Failed to connect';
}
 
?>
<?php
    $query = "CREATE TABLE users (
    username VARCHAR(32) NOT NULL UNIQUE,
    password VARCHAR(32) NOT NULL
   )";
   $results = $connect->query($query);
   if (!$results) die($connect->error);
   
   $salt1  ="CHANGE THIS";
   $salt2  ="CHANGE THIS ALSO";
   
   $username = 'username';
   $password = 'password';
   $token    = hash('ripemd128', "$salt1$password$salt2");
   
   add_user($connect, $username, $token);
    
   function add_user($connect, $un, $pw)
      {
      $query = "INSERT INTO users VALUES('$un', '$pw')";
      $result = $connect->query($query);
      if (!$result) die($connect->error);
      }
?>
   
   
