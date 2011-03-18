<!DOCTYPE html> <!--Time features,Selecting multiple dates,Gender preferences-->
<?
session_start();
$mid=$_SESSION['mid'];
?>

<html>

<head>

<title>

The Home

</title>

<link rel="stylesheet" type="text/css" href="signup.css">

<style type="text/css">
body{
background-image:url('homeedit.jpg');
background-repeat:no-repeat;
background-size:35%;
background-position:100% 0%;
}
</style>

<script type="text/javascript" src="calendarDateInput.js">

/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
* Script featured on and available at http://www.dynamicdrive.com
***********************************************/
 
</script>

</head>



<?php

  
    mysql_connect("localhost","pool","pool") or die(mysql_error());
    mysql_select_db("pool") or die(mysql_error());
	error_reporting(~E_NOTICE);

    $getname=mysql_query("Select name from member where mid='$mid'");
    $row=mysql_fetch_array($getname);
    $name=$row['name'];
    $charm=0;
	$getpid=mysql_query("select pid from belongs_to where mid='$mid' and pid in (select pid from belongs_to where pool_count>1)") or die(mysql_error());
	if(mysql_num_rows($getpid)!=0)
	{
		while($row=mysql_fetch_array($getpid))
			$pid=$row['pid'];
		
		$_SESSION['pid']=$pid;
		$getdate=mysql_query("select date from pool where pid='$pid'");
		$row=mysql_fetch_array($getdate);
		$date=date('d F Y(D)',strtotime($row['date']));
                
        echo "<a href='pool.php' style='position:absolute; top:55%; left:6%;'><font size='4'>Details of your pool on ".$date."</font></a>";
    	}
        else
		echo "<font style='position:absolute; top:55%; left:14%;'>None</font>";	

	
	$todaydate=date("Y-m-d");
	$getpid=mysql_query("select p.pid,p.date,p.capacity from pool p,belongs_to b where p.date>'$todaydate' and p.pid=b.pid and b.mid='$mid' and 	b.pid in (select b.pid from belongs_to where b.pool_count=1)") or die(mysql_error());       
	if(mysql_num_rows($getpid))
	{

		echo "<form name='fpools' method='post' action='home.php'>";
		echo "<font color='#008533' size='3' style='position:absolute; top:67%; left:5%;'>";
		$limit=0;
		while($row=mysql_fetch_array($getpid))
			{
				if($limit<9)
				{
				$limit++;
				$fdate=$row['date'];
				$delarray[$fdate]=$row['pid'];
				if($row['capacity']>0)
					  $temp="giving";
				else
					  $temp="taking";
		                echo "->You are ".$temp." a ride on ".date('d F',strtotime($fdate))." &nbsp;&nbsp;<input type='checkbox' name='fpools[]' value=".$fdate."><br>";
   }
		        }
		echo "<br><input type='submit' style='position:absolute; left:25%;' name='undo' value='Undo Selected'>";
	        echo "</font></form>";
	}
	
	else
	{
		echo "<font style='position:absolute; top:66%; left:14%;'>None</font>";
}
if(isset($_POST['undo']))
{
	$fpools=$_POST['fpools'];
	if(empty($fpools))
		echo "<font color='#FF0000' size='3' style='position:absolute; top:60%; left:7%;'>***You did not select anything???***</font>";
         else
	{
		$count=count($fpools);
		for($i=0;$i<$count;$i++)
		{
		  $pid=$delarray[$fpools[$i]];
		  mysql_query("delete from pool where pid='$pid'");
		}
 	  header("location:home.php");

	}
} 	
 ?>
<body>
<br>
<br>
<font size="6" face="times new roman" color=#AF00FF>Hi there!<? echo $name; ?> </font>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="costcruncher.php">The Cost Cruncher</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="history.php">Pool History</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="routeupdate.php">Change Route</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="update.php">Update</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="main.php">Logout</a>
<hr style="position:relative; bottom:10px;"></p> 
<p><font style="position:relative; bottom:30px; left:50px;">You have <?echo $charm?> charms.</font></p>
<br>
<br>


<h2 style="position:absolute; right:77%;  top:20%;"><font color="#008533"><u>Wanna dive in?</u></font></h2>
<form id="ride" name="ride" method="post" action="home.php">
<font size="4">
<input type="hidden" name="mid" value="<?echo $mid?>">
<p style="position:absolute; left:-4%; top:25%;">
I want to give
<input type="radio" name="radRide" value="1">or take<input type="radio" name="radRide" value="0"> a ride on </font> </div>
<br>
<script type="text/javascript">DateInput('txtDate', true, 'YYYY-MM-DD')</script>
<span name="will" >
<font size="4" color="green" style="position:absolute; left:12%; top:35%">"The dude abides"</font>
<input type="checkbox" style="position:absolute; top:35%; left:10%; " name="switch" id="switch">
<font size="3" color="green" style="position:absolute; left:15%; top:38%;">&lt;switch options IF a pool of your choice is not formed&gt;</font>
</span>
<input type="submit" style="position:absolute; top:43%; left:14%;" name="submit" value="Go">
</p>
</form>
<br>
<br>
<h2 style='position:absolute; top:47%; left:13%;'><font color='#008533'><u>Feelers</u></font></h2>
<br>
<br>

<h2 style="position:absolute; right:80%;  top:57%;"><font color="#008533"><u>Reminders</u></font></h2>
<br>
<br>

<br>
 

</body>

</html>

<?php

if(isset($_POST['submit']))
{
	$ride=$_POST['radRide'];
	$_SESSION['check']=$ride;
	$date=$_POST['txtDate'];
	$mid=$_POST['mid'];
	$flag=1;
	$switch=$_POST['switch'];

	if($ride=="")
	{
 		echo "<p><font style='position:absolute; top:20%%; left:-1%;' size='3' color=#FF0000 face='arial'>***Make a choice between giving and taking***</font></p>";
	$flag=0;
	}	
else
  	{  
        	             
                   $getpid=mysql_query("select pid from belongs_to where mid='$mid'");
                   for($i=0;$i<mysql_num_rows($getpid);$i++)
		   {
		      $row=mysql_fetch_array($getpid);
		      $pid=$row['pid'];
		      $getmid=mysql_query("select * from pool where pid='$pid' and date='$date'");
		      $num=mysql_num_rows($getmid);               
	              if($num)
		   	{
		     		echo "<p><font style='position:absolute; top:20%; left:-1%;' size='3' color=#FF0000 face='arial'>***You have already 					chosen something for this day***</font><p>";
				$flag=0;
			}
		 }
	}
	
	 if($flag==1)
	 {
		$getcapacity=mysql_query("select * from vehicle where mid=$mid");
		$row=mysql_fetch_array($getcapacity);
		if(!mysql_num_rows($getcapacity) && $switch)
		{
			echo "<p><font style='position:absolute; top:20%; left:-1%;' size='2' color=#FF00000 face='arial'>***You have turned the 'will switch' on....please specify vehicle details or turn it off.***</font></p>";
			$flag=0;
		}
	        else if(!mysql_num_rows($getcapacity) && $ride)
		{
				echo "<p><font style='position:absolute; top:20%; left:-1%;' size='3' color=#FF0000 face='arial'>***You are giving a ride ...please specify vehicle details.***</font></p>";
				$flag=0;
		}
		else if($ride)		
			$capacity=$row['CAPACITY'];
		else
			$capacity=-1;
				
	}	

	if($flag==1)
        {

             mysql_query("insert into pool(date,capacity) values ('$date',$capacity)") or die(mysql_error());  
             $pid=mysql_insert_id();
	     if($switch)
		mysql_query("update pool set switch=1 where pid=$pid");
	     mysql_query("insert into belongs_to values ('$mid','$pid',1)") or die(mysql_error()); 
	     header("Location:home.php");
	 }
    
}
?>





  






