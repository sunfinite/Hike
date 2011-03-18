<html> 

<head>

<link rel="stylesheet" type="text/css" href="signup.css" />

<title> 

frmSignup_1

</title>

</head> 


<body> 



<?php
$flag=1;

if(isset($_POST["submit1"]))
  {
if($_POST["txtName"]=="" or $_POST["txtMob_no"]=="" or $_POST["txtEmail_id"]=="" or $_POST["txtPassword"]=="" or $_POST["txtConfirmpass"]=="" or (!isset($_POST["radSex"])))
   {  
    echo  "<script type=\"text/javascript\">  alert(\"All fields compulsory\");</script>";  //Empty field validation
    $flag=0;
   }
   
  else
  {
      mysql_connect("localhost","pool","pool") or die(mysql_error()); //establish database connection
	  mysql_select_db("pool") or die(mysql_error());//select pool database
	  
	  $name=$_POST["txtName"];
	  $email=$_POST["txtEmail_id"];
	  $mobile=$_POST["txtMob_no"];
	   $password=$_POST["txtPassword"];
	   $gender=$_POST["radSex"];
      
		$getemail=mysql_query("Select * from member where email_id='$email'");
		
		if(mysql_num_rows($getemail)!=0)
		{
		    echo  "<script type=\"text/javascript\">  alert(\"User with the given email-id already exists\");</script>"; 
		    $flag=0;
		}
		
		If ($_POST["txtPassword"] != $_POST["txtConfirmpass"] and $flag==1) 
		{
			echo  "<script type=\"text/javascript\">  alert(\"Passwords do not match...please reenter\");</script>"; 
		    $flag=0;
	     }
		 
		if($flag==1)
		{
		  mysql_query("insert into member values ('-1','$name','$gender','$email','$mobile','$password')") or die(" Database insert error");
		  
		  $result=mysql_query("select mid from member where name='$name' and mobile_no='$mobile'");
		  $row=mysql_fetch_array($result);
		  $mid=$row['mid'];
		  header("Location:signup2.php?mid=$mid");
		}
		  
		  
			
 }
 }
 
?>



<h1>We want to know you!</h1>

<form method="post" action="signup1.php" > 

<p><label for="name">Name:</label><input title="Name" type="text" maxlength="15" name="txtName"> </p>

<br> 

<p><label for="sex">Sex:</label>Male<input type="radio" name="radSex" value="Male">Female<input type="radio" name="radSex" value="Female"> </p>

<br> 

<p><label for="mobile">Mobile number:</label><input type="text" name="txtMob_no" maxlength="10"> </p>

<br> 

<p><label for="email">Email id:</label><input title="name@example.com" type="text" name="txtEmail_id" maxlength="30"></p> 

<br> 

<p><label for="pass">Password:</label><input type="password" name="txtPassword" maxlength="15"><font size="2">(this will be your username and password when you login)</font> </p>

<br>

<p><label for="confirm pass">Confirm password:</label><input type="password" name="txtConfirmpass" maxlength="15"> </p>

<br>

<p class="submit"><input class="submit" type="submit" name="submit1" value="Next"> </p>

</form>




</body> 

</html> 
