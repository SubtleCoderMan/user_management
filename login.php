<?php
//session_start();
//session_unset();
//session_destroy();
session_start();
include 'assets/dbinfo.php';
$query = "SELECT * FROM `users`";
$printed = "";$loginerror="&nbsp;";
$resultObj = $connection->query($query);
if(count($_POST) > 0){
  if($_POST['nickname'] != ""&&$_POST['password'] != ""){
    $sql = "SELECT * FROM users";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        $break=0;
        while($row = mysqli_fetch_assoc($result)) 
        {
            if ($_POST['password']===$row["password"]&&($_POST['nickname']===$row["nickname"]))
            {
                $sql=$query = 'SELECT * FROM `users` WHERE `nickname` LIKE "'.$_POST['nickname'].'"';
                $printed = $connection->query($query);
                $break=1; 
            $result = $connection->query($query);
            while($srow = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            print_r($srow);
            }
            echo  __LINE__.'<br>';$_SESSION['yeet'] = $printed;
            while($brow = mysqli_fetch_array($_SESSION['yeet'], MYSQLI_ASSOC)) {
            print_r($brow);
            $myarray=array_values($brow);
            $array=($brow);
            }
                echo  __LINE__.'<br>';print_r($_SESSION['yeet']);
                echo  __LINE__.'<br>';print_r($myarray);
                echo  __LINE__.'<br>';print_r($myarray[0]);
                echo  __LINE__.'<br>';print_r($array['nickname']);//echo '<br>';
                echo  __LINE__.'<br>';print_r($brow['nickname']);//echo '<br>';
                echo  __LINE__.'<br>';$_SESSION['nickname']=$array['nickname'];//echo '<br>';
                echo  __LINE__.'<br>';print_r($_SESSION['nickname']);
                echo  __LINE__.'<br>';$_SESSION['id']=$array['id'];//echo '<br>';
                echo  __LINE__.'<br>';print_r($_SESSION['id']);
                echo  __LINE__.'<br>';print_r($_SESSION);
                echo  __LINE__.'<br>';//header('Location: user.php');
                header('Location: test.php');
                //var_dump($printed);
                //break;
                exit();
            }
        }
        if ($break===0) 
        {
        $loginerror = "Username or password is incorrect";
        } 
    }
  }else {
    $loginerror = "please fill in both fields";
  }
} else {
    $loginerror = "&nbsp;";
}
?>
<!DOCTYPE html>
<html>
    <head><meta charset="UTF-8">
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Inlog</title>
	<link href="assets/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
		<div id="Header">
			<h2>
				Log in
			</h2>
		</div>        
        <div id="Body">
            <form method="post" action="login.php" >
                <div class="a">
                    <label>Username:</label>
                    <input type="text" name="nickname" />
                </div>
                <div class="a">
                    <label>password:</label>
                    <input type="password" name="password" />
                    <div class="error"><?php echo $loginerror;?></div>
                </div>
                <div class="multiplee">
                    <div class="button" id="button" onclick="window.open( 'create.php','_self'); ">Create new account</div>
                    <input type="submit" name="submit" value="Log in">
                    <div class="hide" id="button">Forgot password</div>
                </div>
            </form>
            <div style="text-align:center;">
                <?php
                    if ($printed != ""){
                        while ($row = $printed->fetch_assoc()) {
                            echo $row['nickname']." is now logged in";
                        }
                    }
                    
                    
                ?>
            </div>
        </div>
    </body>
</html>

<?php

$resultObj->close();
$connection->close();

?>