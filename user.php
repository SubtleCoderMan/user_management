<?php
session_start();
//header('Content-type: text/html; utf8');
include 'assets/dbinfo.php';
//print_r($_SESSION);

//print_r($_SESSION['id']);
if(isset($_SESSION['id'])){
    $posted = $_SESSION['id'];
    $query = "SELECT * FROM `users`  WHERE `id` LIKE '".$_SESSION["id"]."'";
    //echo $query;
    $array=$connection->query($query);
    $row=$array->fetch_assoc();
    //print_r($row);
    
} else {
    echo "no";
}
?>
<!DOCTYPE html>
<html>
    <head><meta charset="UTF-8">
        <title>homepage</title>
	<link href="assets/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="Header">
            <h2>
                Successfully logged in!
            </h2>
        </div>        
        <div id="Body">
            <div class="user">Good day, <?php 
                //var_dump($posted);
                //print_r($row);
                echo $row['first_name']." ".$row['last_name'];
                //var_dump($resobj);
                /*if($resobj->num_rows > 0)
                {
                while($query_row = $resobj->fetch_assoc()) 
                    {
                    $array = array_values($query_row);
                    for($i=0;$i<count($array);$i++){
                        if ($i+1<count($array)){print $array[$i]." ";}
                        else {print $array[$i];}
                        }
                    print "</br>";
                    }
                }*/
                ?>
            </div>
        </div>
	</body>
</html>