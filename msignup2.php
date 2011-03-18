
<?php

if(isset($_GET["butNext"]))
{
  
if($_GET["txtRegno"]=="" or (!isset($_GET["radVehicle"])) or $_GET["txtModel"]=="" or $_GET["txtColour"]=="" )
   {  
    echo  "<script type=\"text/javascript\">  alert(\"All fields compulsory\");</script>";  //Empty field validation
    $flag=0;
   }
   
  else
  {
      mysql_connect("localhost","pool","pool") or die(mysql_error()); //establish database connection
	  mysql_select_db("pool") or die(mysql_error());//select pool database
	  
	  $regno=$_GET["txtRegno"];
	  $type=$_GET["radVehicle"];
	  $model=$_GET["txtModel"];
	  $colour=$_GET["txtColour"];
	  
	  
	  if($type=="two")
	    $type=2;
		else
		$type=4;
	  
	  $getregno=mysql_query("Select * from vehicle where reg_no='$regno'");
		
		if(mysql_num_rows($getregno)!=0)
		{
		    echo  "<script type=\"text/javascript\">  alert(\"User with the given vehicle registration number already exists\");</script>"; 
		    $flag=0;
		}
		
		$mid1=$_SESSION['mid'];
		//echo "This is the troubling thing".$mid1.$_SESSION['mid'];
		
		if($flag==1)
		{		
		  mysql_query("insert into vehicle values ('$regno','$model','$colour','$type','$mid1')") or die("Database insertion error"); 
		  session_destroy();
		  header("Location:signup3.php?mid=$mid1");		  
		}
}
}		

?>


<html> 
<head> 
<link rel="stylesheet" type="text/css" href="signup.css" />
<title> 
frmSignup_2
</title> 
</head> 
<body> 

<h1>Your wheels?</h1>
<form method="get" action="signup2.php">
<p><label for="regn no">Registration number:</label><input title="registration number" type="text" maxlength="10" name="txtRegno"></p>
<br>
<p><label for="veh type">Vehicle type:</label>2-wheeler<input type="radio" name="radVehicle" value="two">4-wheeler<input type="radio" name="radVehicle" value="four"></p>
 <br>
<p><label for="model">Model:</label><input title="model" type="text" name="txtModel"></p>
<br>
<p><label for="colour">Colour:</label><input title="colour" type"text" name="txtColour"></p>
<br>
<p class="submit"><input type="submit" value="Next" name="butNext"></p>
</form>

</body>
</html>
