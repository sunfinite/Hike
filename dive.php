<!DOCTYPE html>

<html>

<head>

<link rel="stylesheet" type="text/css" href="signup.css">

<script type="text/javascript" src="calendarDateInput.js">

/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
* Script featured on and available at http://www.dynamicdrive.com
***********************************************/
 
</script>

</head>


<body>
<h1>
Wanna dive in?
</h1>
<form id="ride" name="ride" method="post" action="home.php">
<font size="4">
<input type="hidden" name="mid" value="<?echo $mid?>">
<p>
I want to give
<input type="radio" name="radRide" value="1">or take<input type="radio" name="radRide" value="0"> a ride on: </font> </div>
<script type="text/javascript">DateInput('txtDate', true, 'YYYY-MM-DD')</script>
<input type="submit" style="position:relative; bottom:20px; left:180px;" name="submit" value="Go">
</p>
</form>

</body>

</html>

<?php

if(isset($_POST['submit']))
{
	$ride=$_POST['radRide'];
	$date=$_POST['txtDate'];
	$mid=$_POST['mid'];
	if($ride=="")
 		echo "<font style='position:relative; bottom:75px;' size='2' face='arial'>Make a choice between giving and taking</font>";
	else
  	{  
   
	    $getmid=mysql_query("select * from pool where mid='$mid' and date='$date'");
	    if(mysql_num_rows($getmid)!=0)
		echo "<font style='position:relative; bottom:75px;' size='2' face='arial'>You have already chosen something for this day</font>";
		else
	       {
		    mysql_query("insert into pool(date,giver_or_taker) values ('$date','$ride')") or die(mysql_error());  
		    $getpid=mysql_query("select pid from pool where date='$date' and giver_or_taker='$ride'") or die(mysql_error());
	       	    for($i=0;$i<mysql_num_rows($getpid);$i++)     
		   	$row=mysql_fetch_array($getpid);
	     	    $pid=$row['pid'];      
		    mysql_query("insert into belongs_to values ('$mid','$pid',0)") or die(mysql_error()); 
	     	    header("Location:update.php?mid=$mid");
		}
	 }
}
?>
