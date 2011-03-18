<?php

session_start();
if(!isset($_SESSION['mid']))
{
$_SESSION['mid']=$_GET['mid'];
echo $_SESSION['mid'];
}

if(isset($_GET["butNext"]))
  {  
    if($_GET["txtLocn"]=="" or  $_GET["txtArea"]=="" or $_GET["txtColour"]=="" or $_GET["lat"]=="" or $_GET["lng"]=="")
     {  
    echo  "<script type=\"text/javascript\">  alert(\"All fields compulsory\");</script>";  //Empty field validation
    $flag=0;
     }
   
    else
     {
      mysql_connect("localhost","pool","pool") or die(mysql_error()); //establish database connection
	  mysql_select_db("pool") or die(mysql_error());//select pool database
	  
	  $regno=$_GET["txtLocn"];
	  $type=$_GET["txtArea"];
	  $model=$_GET["lat"];
	  $colour=$_GET["lng"];
	  
		$mid1=$_SESSION['mid'];
		echo $mid1;
		
				
	  mysql_query("insert into location values ('$mid1','$lat','$lng','$txtLocn','$txtArea')") or die("Database insertion error"); 
	  session_destroy();
	  //header("Location:home.php?mid=$mid1");		  
		
}
}		

?>




<html>
<head>
<link rel="stylesheet" type="text/css" href="signup.css" />
<title>
frmSignup3
</title>
</head>
<body>
<h1>Co-ordinates</h1>
<form method="get" action="signup3.php">
<p><label for="locn">Location:</label><input type="text" maxlength="25" name="txtLocn"></p>
<br>
<p><label for="area">Area:</label><input type="text" maxlength="25" name="txtArea"></p>
<br>


<!--Longitude:<input type="number" size="15" name="txtLong">
<br>
Latitude:<input type="number" size="15" name="textLat">
<br>-->
<p class="submit"><input type="submit" value="Next" name="butNext"></p>
</form>

</body>
</html>

