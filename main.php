<?
session_start();
$_SESSION['mid']=1;
?>

<html>
<head>
<title>
The Project
</title>
<style type="text/css">
body{
background-image:url('main.jpg');
background-repeat:no-repeat;
background-size:100% 100%;
}
</style>

</head>


<body>
<br>
<br>
<br>
<br>

<font size='4' style='padding-left:5%;'></font>
<div  style="position:absolute; top:30%; right:10%;">
<form id="login" name="login" method="post" action="main.php">
<p><font size="5">Username:</font>&nbsp;&nbsp;<input style="height:30px;" type="text" id="txtUser" name="txtUser" title="The e-mail id you gave while registering."></p>
<p><font size="5">Password: </font>&nbsp;&nbsp;<input style="height:30px;"type="password" id="txtPassword" name="txtPassword"></p>
<input style="position:absolute; left:90px; height:35px; width:50px; font-size:12pt;" type="submit" name="login" value="login">
</form>
<br>
<br>
<br>
<br>
<font size="6" >Haven't pooled yet?</font>
<br>
<form id="register" name="register" method="post" action="signup.php">
<br>
<input style="position:absolute; left:75px; height:35px; width:80px; font-size:12pt;" type="submit" name="login" value="start now">
</form>
</div>
</body>
</html>


<?php
if(isset($_POST['login']))
{
$username=$_POST['txtUser'];
$password=$_POST['txtPassword'];

if($username==admin && $password==admin)
header("Location:mclust.php");
if($username==NULL or $password==NULL)
{
  echo "<font color=#FF0000 size='3' style='position:absolute; bottom:70%; left:70%;'>***Enter username and password***";
}
  else
{
	mysql_connect("localhost","pool","pool") or die(mysql_error());
	mysql_select_db("pool") or die(mysql_error());

    $getmid=mysql_query("Select mid from member where email_id='$username' and password='$password'");
 
	if(mysql_num_rows($getmid)==0)
{
	   echo "<font color=#FF0000 size='3' style='position:absolute; bottom:70%; left:70%;'>***Invalid username or password...please re-enter.***";
}
  else
   {
     $row=mysql_fetch_array($getmid);
   $mid=$row['mid'];
   $_SESSION['mid']=$mid;
     header("Location:home.php");
  }
}

}
?>
<!--To Do:
<br>
multiple dates,gender preferences,time settings,markers on route,static pool(option only if end to end match),<br>will switch,the giver-giver situation,cancel on send.
-->

