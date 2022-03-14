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
## DBInfo.php
Here you fill in the DB name, password, etc. every page runs this

## upload.php
this one does the checking for the account creation page, every regex is hard coded in there.
##### first blocks of code: functions. these are, in order;
* password regex
* string length test
* valid alphabet letters regex
* email test
* no spaces regex
* (debug regex that tests multiple)
* password error function, when the password is incorrect this one will check and then append all issues.
* sanitize string, removes some XSS attack stuff.
##### then we get to the main code
* first it checks if there is any data posted, if not it kicks you back to the login page. (due to the way the login page HTML is coded this would only be possible through a 3rd website in which a malicious 3rd party is trying to inject code.)
* then it checks if all the right fields are set; first name, last name, username, password, email.
* after this it assigns some vars with these 5 fields and checks those further; and the error count is set to 0
* first and last name are tested for length and valid alphabet; the error increments as needed
* nickname is tested for spaces and length
* email is tested for spaces, mail format and length (technically the mail format should be good because the login page HTML, but again this is to prevent malicious script injection)
* password is tested for spaces, and the whole password regex.
##### now we got through that, if the errors are 1 or more it breaks and spits back the errors; if no errors are found it sets verify=1 for later
##### now we get to the existing account check,
* it tries to fetch all users using SQL, sets $a to 0
* if no users exist, just go on; if users do exist check all of them
* if the posted username already exists, spit error and set $a to 1; then break the loop
* if the posted email already exists, spit error and set $a to 1; then break the loop
##### next code only runs if a==0; and verify==1;
* it sanitises the names and email (password would bug out)
* add user to database
* (some remaining debug code that shouldnt pop up unless you remove the next step)
* header = login.php; ; you get sent to the login page

##### if somehow there exists no users, all the way down is the catch for this 
* add user to database
* (some remaining debug code that shouldnt pop up unless you remove the next step)
* header = login.php; ; you get sent to the login page
* note. should sanitize in this block too.

## styles.css
just your basic CSS file, not much going on

That's about it for this webpage, thanks for looking at it.
**-CoderMan**
