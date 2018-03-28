<!- Sessions are used for authentication. If a user hasn't logged in during this session it will kick them back to the login page
The header php code can be removed if authentication is no longer needed (ie. if this is only accessed in-house) -->
<?php
  session_start();
  
/*this opens an if statement that asks for some html to happen if user authetication is complete.
<?php begins the php code and ?> ends it or puts it on hold.  In this case it is putting it on hold.
If the specific condition has been met the it moves on and compeletes the html part of the drawing the website.*/
  
  if (isset($_SESSION['username']))
  {
?>
<!-html written inside php is treated exactly like html written in a regular html file->

<html>
<head>
<style>
label{display:inline-block;width:100px;margin-bottom:10px;}
</style>
 
 
<title>Dev Game Data Entry Form... of Doom</title>
</head>
<body>
 <h1>To input a game please use the below form</h1>
 <p>The steps below need to be followed exactly :-)</p>
  <ul>
  <li><b>Game Color:</b><i> Enter the color:</i> 
 	<ul>
  	<li>Colors you can use are:</li>
  		<ul>
  		<li>blue</li>
  		<li>orange</li>
  		<li>pink</li>
  		<li>purple</li>
  		<li>red</li>
  		<li>yellow</li>
  		<li>use "unknown" if the game has not been sorted yet</li>
  		</ul>
  	<li>all letters are <b>lowercase</b></li>	
	</ul> 
  </li>
  <li><b>Game Number:</b><i> This is the card number</i></li>
  <li><b>Name:</b><i> Title is copied off the top of the card</i></li>
  <li><b>Description:</b><i> Description is copied from the text box on the card</i></li>
  <li><b>Age: </b><i> The age will be something like 3+.  It is only indicating the lowest age that the game is designed for.  If there is no age it can be left blank.</i></li>
  <li><b>Number of Players: </b><i>There are three options for number of players:</i> Single, Multiplayer and Read-Along</li> 

</ul> 

<!-php forms have two parts: the part that displays something and the part that does something.  The doing part to use is indicated in the "action" field of the form tag.  Slight aside: if session authetication WASN'T being used on this page, this could be a regular html page and the form would work the same.  html and php are designed to work together.->

<form method="post" action="process.php">
<label>Game Color</label>
<input type="text" name="game_color" />
<br>
<label>Number</label>
<input type="text" name="game_num"  />
<br>
<label>Name</label>
<input type="text" name="game_name"  />
<br>
<label>Description</label>
<textarea rows="4" cols="50" name="description" > </textarea>
<br>
<label>Age</label>
<input type="text" name="game_age"  />
<br>
<label>Number of Players</label>
<input type="text" name="game_play_num"  />
<br>
<input type="submit" value="Add Game">
</form>
<h1> 
<a href="../home/home.php">Go Home</a>
</h1> 
</body>
</html>

<!-This is the final part of the if statement started at the beginning of the document it sends the user to the login page if they aren't already logged in ->   
<?php 		
       }
  else echo "Please <a href='../home/index.php'>click here</a> to log in.";
?>
