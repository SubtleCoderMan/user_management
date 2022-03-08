<?php
include 'assets/dbinfo.php';
include 'upload.php';
$Error="";
?>
<!DOCTYPE html>
<html>
    <head><meta charset="UTF-8">
    <a href="testing.php"></a>
        <title>Inlog</title>
	<link href="assets/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
		<div id="Header">
			<h2>
				Create a new account <?php// echo ("ááéý");?>
			</h2>
		</div>        
        <div id="Body">
            <form method="post" action="create.php" > <!-- zet hier nieuwe file met PHP verificatie -->
                <div class="<?=$Error?>">
                    <label>First name:</label>
                    <input type="text" name="fname" /required><br>
                    <span class="error"><?php echo $nameerror;?></span>
                </div>
                <div class="<?=$Error?>">
                    <label>Last name:</label>
                    <input type="text" name="lname" required/><br>
                    <span class="error"><?php echo $nameerror;?></span>
                </div>
                <div class="<?=$Error?>">
                    <label>Username:</label>
                    <input type="text" name="nname" required/><br>
                    <span class="error"><?php echo $nickerror;?></span>
                </div>
                <div class="<?=$Error?>">
                    <label>password:</label>
                    <input type="text" name="password" required/><br>
                    <span class="error"><?php echo $passerror;?></span>
                </div>
                <div class="<?=$Error?>">
                    <label>E-mail Address:</label>
                    <input type="email" name="email" required/><br>
                    <span class="error"><?php echo $emailerror;?></span>
                </div>
                <div class="multiplee">
                    <input type="submit" name="submit" value="create account">
                    
                    <div class="button" id="button" onclick="window.open( '/newphp/login.php','_self'); ">use existing account</div>
                </div>
            </form>
        </div>
    </body>
</html>

<?php
/*
$resultObj->close();
$connection->close();
*/
?>