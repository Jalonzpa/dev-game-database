# The Care and Keeping of the Developmental Game Database and Web UI
## Database 

### Overview
  The database is the main data storage system.  There are currently two table inside the dev-game database.  Their schema (fancy word for database structure) is:
`dev-main` (used to store all of the information on the developmental game collection):

Column Name | Description
------------ | -------------
id | The id is the *primary key* and is designed to ensure that each item in the database has a unique identifier.  It is an integer value and is auto incrementing.  **The id should never be manually changed.**
color | The color is the category designation.  The options available are included in the web based documentation for the *Add Game* section of the web interface.  If new colors are added the CSS will have to be updated to reflect the changes in the *View Book* section.  See the CSS section for details.
number |The sticker number designating the items place within its category.  
game_name | The title of the game.  Up to now no effort has been made to make this name match the title in the PAC.
description | A brief description of the game.  The storage designated for this column is LONG TEXT.  It can hold *up* to 4G of information.  
age | The age the game is intended for.  In most case it was taken off the box.  The storage designation in TINY TEXT and it can hold up to 255 characters.
player_number | The number of players.  There are 3 options currently.  Single, Multiplayer and Read-Along.  If more options are added the code for the Index creator will have to be updated.  See Index Creator section for my details.

`dev-main` Database quirks:
The only column that can be left blank when entering an item is the numbers column.  If any other column is left blank all of the data entered will be lost.  For example, if a game is entered and the title is omitted it will not be added to the database.

`users` (used to store user information for authentication on password protected sections of the website):

Column Name | Description
------------ | --------------
username | A unique named assigned to a user
password | User selected password which is salted and hashed before being stored.  See setupusers.php for details

The users database is only needed if authentication is desired for entering and editing data.

### PHPmyAdmin
([General PHPmyAdmin help can be found on their website](https://docs.phpmyadmin.net/en/latest/index.html))

Important things to know:
1.	Any deletion action is permanent. Deleting a record, dropping a table, emptying a table.  All of it is final.  There is no undo button in SQL.  Make sure you feel good with your decision before you click that delete button.  There is no web interface option for deleting of any kind. This an intentional part of the design.  The only way to delete is from the PHPmyAdmin interface.
2.	Backups are pretty easy to restore from (this is directly related to point one).  Saving a backup occasionally can drastically reduce the risk of accidentally dropping the entire table and losing all the info. Exports are available in an overwhelming number of formats.  For ease of restoring, SQL is best.  For creating human readable data CSV is probably best.  Importing SQL data will recreate the table exactly as it was keeping column formats in place and keeping the id’s consistent.


## PHP Code

### Things to Know about PHP

1.	Variables begin with a $ and their type is not declared.
1.	. is shorthand for concatenate (combine the parts on either side of it).
1.	This cannot be overstated.  There is no undo in SQL.  All actions are final.  Some are more final than others.  Edits can be re-edited, but a dropped table is gone forever.
1.	Comments are bits of code that are ignored by the computer when the code is ran. PHP Comments come in 3 different flavors:
    1. Anything being read as html has to use html comments <!- Comments are in here ->
    1. Single line PHP comments look like this:  //this is a comment they can begin anywhere in a line and go until the end of the line.
    1. Multi-line PHP comments look like this `/*this comment can be really long and say a lot of stuff and sometimes that is necessary to convey all the information that is happening in some complex lines of PHP*/`

### Overview

The PHP code for the website is broken up into 4 main components:
1.	Database code (store passwords/usernames out of sight and create new users)
2.	Entry (create a new record)
3.	Edit (change an existing record)
4.	Book (view the records)

All code is heavily commented. Below you will find a brief description of what each part does and what other parts it interacts with.  Troubleshooting and bug squashing will be aided by having a general understanding of how each piece fits together.  

As a general rule any form that appears in PHP/HTML works in two parts.  There is the form html (often contained inside a .php file) that tells the web browser what to display and the PHP that processes the input received from the form.  The processing part usually happens invisibly and often so quickly that the user had no idea anything even happened.

Each section of the website will have an error log.  This is where any PHP errors will be shown.  Most PHP errors will be from the processing part of the PHP (or will be related to bad variables being passed over from the form part).

### Database Code

There are two files that make up the database code.  They are never directly interacted with by the end user and their only purpose is for logging in. 

#### Login.php
The only thing in this file is the host name ($hn), database name ($db), user name ($un) and password ($pw) for the database.  The purpose of keeping it in a separate file is to keep it from being seen by people on the outside.  It is needed at the beginning of every PHP file that interacts with the database (inserting, selecting, reading, updating, etc… ), but parts of those files can end up being readable by people who shouldn’t have access to that sensitive information.  By offloading them into another file that is included with the main file an added level of security is put into place.  Once again, that security might be less necessary with the files sitting safely on the LAN, but they are remnants from its time spent on a perilous journey through cyberspace.

#### Setupusers.php
This is a quick script for creating a database of users that you can access the Entry and Edit functionality of the database.  This script uses a hash and salts to store the password in non-plain text on the database.  If you wish to use authentication this file needs to be updated, stored in the web root and accessed from a web browser to create and populated the user table that is used for login purposes.  Changing the salts (which SHOULD be done) requires the ~/home/index.php file to be updated.  The salts need to match in order for authentication to work.
  
### Entry
The entry section of the website consists of two files.  Index.php, process.php.  Index creates the form, process puts the information from the form into the database and lets the user know what the id (the mysterious number generated by the database every time a new record is added, also known as the auto-incrementing primary key) of the game that was just added so that the user can add a picture for the record (see ~/book/query.php for more details).  

#### Index.php
This file creates a form for adding games into the database.  The `<label>` is the display name for the boxes on the webpage.  `<input type>` determines what size and kind of box is displayed. `<name>` is the name of the variable handed over to process.php.  It is important that there are no errors in this field.  This is one of the places that will need to be edited should another column be added to the database. 

#### Process.php
This file contains the code that opens a connection to the database and inserts the values received from the form into it.  After it has done that it opens a static web page that displays the id that was just assigned to the last record and explains the steps needed to add a picture for that record.  Pictures are now labeled with the id for the record (on a previous iteration they were named by color and number, but both fields are subject to change which requires renaming every picture file and id’s are forever).	

### Edit 
The edit section of the website is 3 files.  Index.php, edit.php and process.php.  Index is a simple form that lets the use pick what game they want to edit.  Edit is a form that is filled in with the existing data for the record.  It is the easiest way to for an end user to find out what some of the hidden tags in the database contain (these tags as of right now are id, ages, and number of players).  The hidden tags are used to populate the book index.  Changes made here permanently change the record.  Process simply updates the database with the changes made in the edit form.  All code in Edit works similarly to the code in Entry and any differences are mentioned in the comments directly in the files.

### Book 
The book is not behind any authentication because there is no option for editing the database in anyway.  The book has 2 publically viewable parts: query.php and book-index.php.  Query displays every item in the database using a while statement to iterate through a basic html template.  Any changes made to the database should be immediately viewable in the query view (this is the fastest way to test if changes were made correctly).  Book-index is a way to sort the games by ages or players (mutually exclusive, you can only search by one or the other, this is something that could probably be ironed out in future updates, but wasn’t necessary for the purpose of the page currently and wasn’t functioning as expected).  The submit buttons are each connected to a different backend file and pull a different set of data.  The backend for book-index consists of age-search.php and player-search.php.  These files use a switch case to determine which data to display and, similarly to the query.php page, show it as a website through iterating over data and an html layout. 

### CSS
The book is a webpage.  It is styled using CSS.  Many changes can be applied across the board using minimal changes in the CSS code.  Font changes and color changes are the most likely.  The “number stickers” are buttons and changing the color of them is as easy as updating the button tag in the CSS.  If new colors are added new tags will have to be created to change the color. CSS is case sensitive.  If it was to use some info from the database it is important that case is consistent.  (The images were originally pulled using a combination of color and number.  Any game that was entered with a capitalized color name wouldn’t have a picture.  Now that they are pulled using the id this isn’t an issues, but it the sort of issues to be on the lookout for.)  For the colors I used the W3Schools color picker.  





