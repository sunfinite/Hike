<html>
<body>

<?php

mysql_connect("localhost","root","root");
mysql_select_db("pool");




$getemail=mysql_query("Select * from member where email_id='sunil3590@gmail.com';");

if(mysql_num_rows($getemail)==0)
echo "I am here";
 
 else
 {
		$row=mysql_fetch_array($getemail) or die(mysql_error());
		
		
		}
?>
		
</body>
</html>