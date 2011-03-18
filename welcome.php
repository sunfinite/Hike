<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="signup.css">
</head>
<?php

   $mid=$_GET['mid'];
  
    mysql_connect("localhost","pool","pool") or die(mysql_error());
    mysql_select_db("pool") or die(mysql_error());

    $getname=mysql_query("Select name from member where mid='$mid'");
    $row=mysql_fetch_array($getname);
    $name=$row['name'];
   $charm=0;
?>
<body>
<br>
<br>
<font size="6" face="times new roman">Hi,there!<? echo $name; ?> </font>
<form style="position:relative; left:250px; bottom:30px;"name="logout" method="post" action="main.php">
<input type="submit" value="logout">
</form>
<hr style="position:relative; bottom:40px;"> 
<font style="position:relative; bottom:50px; left:50px;">You have <?echo $charm?> charms.</font>
</body>
</html>
