<?php
$verify=0;
//header('Content-type: text/html; utf8');
//echo "ýýýéýnooý";
// echo  __LINE__." ";
include 'assets/dbinfo.php';
$nameerror ="";$nickerror ="";$emailerror ="";$passerror ="";
function passtest ($text) {
    $regex='/(?=.*[A-Z])(?=.*[a-z])(?=.*[1-9])(?=.*[!@#$%&*()\'"`~_\-+=;:])[^\s]{6,24}/';
    if (preg_match($regex,$text)){
        return 1;
    } else {
        return 0;
    }
}
function lentest ($text) {
    $regex='/[^\s]{6,50}/';
    if (preg_match($regex,$text)){
        return 1;
    } else {
        return 0;
    }
}
function texttest ($text) {
    $regex="/^([a-zA-ZÀ-ÿ ]){1,25}$/";
    if (preg_match($regex,$text)){
        return 1;
    } else {
        return 0;
    }
}
function mailtest ($text) {
    if (filter_var($text, FILTER_VALIDATE_EMAIL)){
        return 1;
    } else {
        return 0;
    }
}
function spacetest ($text) {
    $regex='/(?=.*['." ".'])/';
    if (preg_match($regex,$text)){
        return 0;
    } else {
        return 1;
    }
}
function regdump($text) {
    $array = ['a-z','A-Z','1-9','!@#$%&*()\'"`~_\-+=;:','À-ÿ'];
    foreach($array as $count => $test) {
        $regex='/(?=.*['.$test.'])/';
        echo $count='';
        if (preg_match($regex,$text)){
            echo "-contains ".$test;
        } else {
            echo "-doesn't contain " .$test;
        }
        echo "<br>";
    }
    $regex='/^(\xC0-\xFF ]){1,25}$/';
    if (preg_match($regex,$text)){
        echo "-contains a special char";
    } else {
        echo "-doesn't contain a special char";
    }
    echo "<br>";
}
function passerror ($text) {
    $temp='Password does not meet the requirements,<ul>';
    if (strlen($text)<6){
        $temp=$temp.'<li>Must be at least 6 characters long</li>';
    }
    if (strlen($text)>24){
        $temp.='<li>Must be at most 25 characters long</li>';
    }
    if (!preg_match("/(?=.*[a-z])/",$text)){
        $temp.='<li>Must include at least 1 lowercase letter</li>';
    }
    if (!preg_match("/(?=.*[A-Z])/",$text)){
        $temp.='<li>Must include at least 1 capital letter</li>';
    }
    if (!preg_match("/(?=.*[1-9])/",$text)){
        $temp.='<li>Must include at least 1 number</li>';
    }
    if (!preg_match('/(?=.*[!@#$%&*(\)\'"`~_\-+=;:])/',$text)) {
        $temp.='<li>Must include one special character</li>';
    }
    $regex='/(?=.*['." ".'])/';
    if (preg_match($regex,$text)) {
        $temp.='<li>May not have any spaces</li>';
    }
    $temp.='</ul>';
    return $temp;
}
function sanitize ($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if($_SERVER['REQUEST_METHOD']=='POST') {
    if (
        isset($_POST['fname'])
        &&isset($_POST['lname'])
        &&isset($_POST['nname'])
        &&isset($_POST['password'])
        &&isset($_POST['email'])
        )
    {
        $errorcount = 0;
        $fname=($_POST['fname']);
        $lname=($_POST['lname']);
        $nname=($_POST['nname']);
        $pass=($_POST['password']);
        $email=($_POST['email']);
        //regdump($fname);
        if (texttest($fname)*texttest($lname)){
            $errorcount = $errorcount;
        } else {
            $nameerror = "Names may only contain letters and spaces, and at most be 25 letters long.";
            $errorcount++;
        }
        if (spacetest($nname)*lentest($nname)){
            $errorcount = $errorcount;
        } else if (lentest($nname)){
            $nickerror = "Usernames cannot contain spaces.";
            $errorcount++;
        } else {
            $nickerror = "Usernames cannot be less than 6 characters, or more than 50 characters.";
            $errorcount++;
        }
        if (spacetest($email)*mailtest($email)*lentest($email)){
            $errorcount = $errorcount;
        } else if (lentest($email)) {
            $emailerror = "Invalid E-mail.";
            $errorcount++;
        } else {
            $emailerror = "E-mail may not be longer than 50 characters.";
            $errorcount++;
        }
        if (spacetest($pass)*passtest($pass)){
            $errorcount = $errorcount;
        } else {
            $passerror = passerror($pass);
            $errorcount++;
        }
        
        if ($errorcount<1){
            $verify=1;
        } /*else {
            $Error="";
            $dump="";
            if (strlen($nameerror)>0){$dump.=($nameerror."<br>");}
            if (strlen($nickerror)>0){$dump.=($nickerror."<br>");}
            if (strlen($emailerror)>0){$dump.=($emailerror."<br>");}
            if (strlen($passerror)>0){$dump.=($passerror."<br>");}
            echo $dump;
            echo '<br><br>';
            echo 'the password "'.$pass.'"<br>';
            regdump($pass);
        }*/
    } else {
        $Error="validation";
        echo 'error';
    }
/* } if (1){ */
$sql = "SELECT `first_name`,`last_name`,`nickname`,`email` FROM users";
$result = mysqli_query($connection, $sql);
  if (mysqli_num_rows($result) > 0) {
    $a=0;
    $count=0;
    $testemail = $row["email"];
    while($row = mysqli_fetch_assoc($result)) {   
        if ($_POST['nname']===$row["nickname"])
        {
            $nickerror = "That username already exists."; //existing nickname
            $a=1;
            break;
        }
        if ($_POST['email']===$row["email"])
        {
            $emailerror = "That e-mail is already in use."; //existing email
            $a=1;
            break;
        }
    }
    
    //echo "[ ".$a." ".$verify."] ";
    
    if ($a===0&&$verify){ 
        $fname=sanitize($fname);
        $lname=sanitize($lname);
        $nname=sanitize($nname);
        //$pass=sanitize($password);
        $email=sanitize($email);
        //echo "{  ".$fname."', '".$lname."', '".$nname."', '".$pass."', '".$_POST['email']."  }";
     //INSERT INTO `users` (`id`, `first_name`, `last_name`, `nickname`, `password`, `email`) VALUES (NULL, 'Charles', 'Dickens', 'CDdestroyer', '123456', '123@ab.cd');
        $query1 = "INSERT INTO `users` (`id`, `first_name`, `last_name`, `nickname`, `password`, `email`) VALUES (NULL, '".$fname."', '".$lname."', '".$nname."', '".$pass."', '".$email."')";
        //echo  __LINE__." "."<br>"."<br>"."<br>";
        print_r($connection);
        //echo  __LINE__." "."<br>"."<br>"."<br>";
        print_r($query1);
      //  echo  __LINE__." "."<br>"."<br>"."<br>";
        $resultObj = $connection->query($query1);
        
       header('Location: login.php'); 
    }else {
        
    }
  }else {
    $query1 = "INSERT INTO `users` (`id`, `first_name`, `last_name`, `nickname`, `password`, `email`) VALUES (NULL, '".$fname."', '".$lname."', '".$nname."', '".$pass."', '".$_POST['email']."')";
    $resultObj = $connection->query($query1);
        print_r($connection);
        //echo  __LINE__." "."<br>"."<br>"."<br>";
        print_r($query1);
    header('Location: login.php'); 
  }   
}
?>