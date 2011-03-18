<?php
$flag=1;
           echo "hello";
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
		}

                $regno=$_POST["txtRegno"];
	        $type=$_POST["radVehicle"];
	        $model=$_POST["txtModel"];
	  	$colour=$_POST["txtColour"];
	  
	  
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

		if($flag==1)
		{		
		  mysql_query("insert into vehicle values ('$regno','$model','$colour','$type','$mid')") or die("Database insertion error"); 		  
		}

          $location=$_POST["txtLocn"];
	  $area=$_POST["txtArea"];
	  $lat=$_POST["txtLat"];
	  $lng=$_POST["txtLng"];
	  
		
		
				
	  mysql_query("insert into location values ('$mid','$lat','$lng','$location','$area')") or die("Database insertion error"); 
   
 ?>
