<!-Authentication code-->
<?php
  session_start();

  if (isset($_SESSION['username']))
	{
?>
<!-html form that lets user pick an already existing record to edit.-->
<html>
<head>
<style>
label{display:inline-block;width:100px;margin-bottom:10px;}
</style>
 
 
<title>Record Editor</title>
</head>
<body>
 
<form method="post" action="edit.php">
<label>Color</label>
<input type="text" name="color" />
<label>Number</label>
<input type="text" name="number" />


<input type="submit" value="Find Game">
</form>
<h1> 
<a href="../home/home.php">Go Home</a>
</h1> 
 
 
</body>
</html>

<?php

}
  else echo "Please <a href='../home/index.php'>click here</a> to log in.";
?>
