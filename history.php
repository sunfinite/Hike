<html>
<head>
<link rel="stylesheet" type="text/css" href="signup.css">
</head>
<font size='6' color="#6B8E23">The History</font>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="home.php">Back</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="costcruncher.php">The Cost Cruncher</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<a href="main.php">Logout</a>
<hr>
<p>&lt;Click to view&gt;</p>

<?php
session_start();
$mid=$_SESSION['mid'];

 mysql_connect("localhost","pool","pool") or die(mysql_error());
    mysql_select_db("pool") or die(mysql_error());
	error_reporting(~E_NOTICE);
  

 $getpid=mysql_query("select pid,pool_count from belongs_to where mid='$mid' and pid in (select pid from belongs_to where pool_count>1)") or die(mysql_error());
	if(mysql_num_rows($getpid)!=0)
	{
		while($row=mysql_fetch_array($getpid))
		{
                  $pid=$row['pid'];
		  $getdate=mysql_query("select date from pool where pid='$pid'");
		  $row=mysql_fetch_array($getdate);
		  $date=$row['date'];
                  $array[$date]=$pid;//create associative array on date to store the pid of the pool the mid was in on that day...otherwise the same query will have to be written again...which is better?
		  $date=date('d F Y',strtotime($date));
		  echo "<a href='#' onclick='check(this)'>".$date."</a><br><br>";
               }
         }
 
?>

<form name="form" id="form" method="post" action="history.php">
<input type="hidden" id="temp" name="temp" value="">
</form>

<script type="text/javascript">
function check(element)
{
    //var date=element.innerHTML.split("on ");
    document.getElementById('temp').value=element.innerHTML;
    alert(document.getElementById('temp').value);
    document.form.submit();
}
</script>

<?php
if($_POST['temp']!="")
{
   $date=$_POST['temp'];
   $date=date("Y-m-d",strtotime($date));
   $_SESSION['pid']=$array[$date];
    header("location:pool.php");
}
?>


