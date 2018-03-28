<?php
  session_start();

  if (isset($_SESSION['username']))
	{
?>
<html>
<head>
<style>
label{display:inline-block;width:100px;margin-bottom:10px;}
</style>
 
 
<title>The Little Book that Could</title>
</head>
<body>
 
<form action="player-search.php" method="post">
    <label>How many players?</label><br/>
    <input type="radio" name="player" value="A" />Single<br />
    <input type="radio" name="player" value="B" />Multiplayer<br />
    <input type="radio" name="player" value="C" />Read-Along Kit<br />
    <input type="submit" name="formSubmit" value="Submit" />
</form>
    
    <br/>
<form action="age-search.php" method="post">    
    <label>How old are the players?</label><br/>
    <input type="radio" name="age" value="A" required/>Under 3<br />
    <input type="radio" name="age" value="B" />3+<br />
    <input type="radio" name="age" value="C" />4+<br />
    <input type="radio" name="age" value="D" />5+<br />
    <input type="radio" name="age" value="E" />6+<br />
    <input type="radio" name="age" value="F" />7+<br />
    <input type="radio" name="age" value="G" />8+<br />
    <input type="radio" name="age" value="H" />10+<br />
    <input type="submit" name="formSubmit" value="Submit" />
</form>

<?php 		
       }
  else echo "Please <a href='../home/index.php'>click here</a> to log in.";
?>
 
 
 
</body>
</html>
