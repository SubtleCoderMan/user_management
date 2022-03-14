# user management
##### _(feb-march 2022)_
For this project i wanted to make a user management system as a proof of concept and to test&refine my PHP skills.

### Some things to note
* you require XAMPP or a similar program to run this
* you must set up a database with a table named "users", with the fields "ID" (primary INC), "first_name", "last_name", "nickname", "password" and "email".
* you must set your name password and all in assets/dbinfo.php
* This is not secure at all, passwords are basically stored as plain text.
* Also please note it's just a proof of concept.

# Site navigation
Now i'll briefly explain the pages
## Create a new account
![](https://media.discordapp.net/attachments/892668729241002024/951456454462824518/unknown.png?width=580&height=625)

here you can create a new account; 
* names may contain only letters, spaces and accented letters.
* username may not contain spaces.
* password must be at least 6 characters long,m mst include at least 1 capital letter, must include at least 1 number, must include one special character.
* email must be an email. or look like something@yes.no

### If the account creation was successful it shows up in the DB as such;
![](https://media.discordapp.net/attachments/892668729241002024/951456455133900860/unknown.png)

## Login to existing account
![](https://media.discordapp.net/attachments/892668729241002024/951456454693515284/unknown.png)

here you log into your account; 
* it checks the DB if the filled in name exists
* if the name exists it checks if the password matches
* if both match you get sent to the user homepage, which we will look at next

## User homepage
![](https://media.discordapp.net/attachments/892668729241002024/951456454928388126/unknown.png)

here you can see that the log in worked. it's not much but it'll do
* from the login page the user ID is sent over and here it will retrieve the data associated with the ID.
* it prints; "Good day, [first_name] [last_name]"

# behind the scenes
## DBInfo
Here you fill in the DB name, password, etc. every page runs this

## styles.css
just your basic CSS file, not much going on

That's about it for this webpage, thanks for looking at it.
**-CoderMan**
