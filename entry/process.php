<!-This header is different from the header in the form file.  This is the code the opens a connection to the database.  It "includes" the login.php file which allows the log in to take place and has code to display an error message should the connection not succeed-->
<?php 
	include '../login.php'; 
	$connect=mysqli_connect($hn,$un,$pw,$db);
 
if(mysqli_connect_errno($connect))
{
		echo 'Failed to connect';
}
 
?>
 
<?php 
/*These variables are assigned from the entry web form.  $_POST['name_of_field_on_html_form']  If you add a new column that you want added from the web form then you will need to declare the new variable here*/
$game_color=$_POST['game_color'];
$game_num=$_POST['game_num'];
$game_name=$_POST['game_name'];
$description=$_POST['description'];
$age=$_POST['game_age'];
$player_number=$_POST['game_play_num'];

/*This is the SQL query.  It is telling the database what information to put into the row.  If new columns are added they need to be added here as well.  When naming the columns please note that when setting the fields in PHP the column names are between backticks ` (on the key with the ~) and not quotation makres.  HOWEVER the values are between quotation marks.  The syntax for SQL insert statements is INSERT INTO table_name (column1, column2, column3, ...) VALUES (value1, value2, value3, ...);*/

$mysqli_query="INSERT INTO `dev-main` (`id`, `color`, `number`, `game_name`, `description`, `age`, `player_number`) VALUES (NULL, '$game_color', '$game_num', '$game_name', '$description', '$age', '$player_number')";

/*This bit of code recalls the auto-assigned id for the last record and displays it for the user.  A future iteration may have included an ftp setup to "upload" the 
the image to the web, but for now the user is prompted to save the image file as a .png with the name being the id of the game.  This is used directly to display images both in the book and in the index.  !!NEEDS TO BE UPDATED TO INCLUDE ACTUAL LOCATION OF THE IMAGE DIRECTORY!! */

if ($connect->query($mysqli_query) === TRUE) {
    $last_id = $connect->insert_id;
    echo "You've added a game. Last inserted ID is: <b><h3>" . $last_id . "</b></h3><br>";
    echo "<h1>Please name the pictures associated with this record<i> ".$last_id.".png</i> and save it to PLACE TO BE DETERMINED</h1><br>";
    echo "<h2><a href='index.php'>When that is complete click here to add another game</h2></a>";
} else {
    echo "Error: " . $mysqli_query . "<br>" . $connect->error;
}    
?>
