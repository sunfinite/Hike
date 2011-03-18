<html><!--issues:associative arrays did not work,the solution to the vehicle update problem has not been implemented fully...kinda solved by the fill one,fill all message.-->
<?
session_start();
$mid=$_SESSION['mid'];
$check=$_SESSION['check'];
?>
<head>

<link rel="stylesheet" type="text/css" href="signup.css" >

<title>

The Update

</title>

<style type="text/css">
.radio1{
position:relative;
left:130px;
}

</style>


</head>

<?php

  mysql_connect('localhost','pool','pool') or die(mysql_error());
  mysql_select_db('pool') or die(mysql_error());
   error_reporting(~E_NOTICE);
 $getperson=mysql_query("select * from member where mid='$mid'") or die(mysql_error());
 $personrow=mysql_fetch_array($getperson);

 $getvehicle=mysql_query("select * from vehicle where mid='$mid'") or die(mysql_error());
 $vehiclerow=mysql_fetch_array($getvehicle);

?>





<form id="form" name="frmInput" method="post" onsubmit="return validation();"   action="update.php" > 

<h1>The same set of wheels?</h1><p><font size="3" style="position:relative; left:70px; colour:red;">&lt;Compulsory if you are giving a ride and have not specified the details before&gt;</font></p>

<p ><font id="error" face="arial" size="3" color="red" style="position:relative; left:200px;">  </font></p>
<p><font size="2">Fill one,you fill all.</font></p>

<p><label for="regn no">Registration number:</label><input title="registration number" type="text" id="regno" name="txtRegno" value="<?echo $vehiclerow[0];?>"></p>

<br>

<p><label for="veh type">Vehicle type:</label>2-wheeler<input type="radio" id="radVehicle" name="radVehicle" value="2" <? if ($vehiclerow[3]==2) { ?> checked="yes" <?}?>><span class="radio">4-wheeler</span><input class="radio" id="radVehicle" type="radio" name="radVehicle" value="4" <? if ($vehiclerow[3]==4) { ?> checked="yes" <?}?>></p>

 <br>

<p><label for="seats">Pool capacity:</label>1<input type="radio" name="radSeat" value="1" <? if ($vehiclerow[5]==1) { ?> checked="yes" <?}?>> <span class="radio">2</span><input class="radio" type="radio"  name="radSeat" value="2" <? if ($vehiclerow[5]==2) { ?> checked="yes" <?}?>><span class="radio1">3</span><input class="radio1" type="radio"  name="radSeat" value="3" <? if ($vehiclerow[5]==3) { ?> checked="yes" <?}?>><font size="2" style="position:relative; left:200px;">(only for 4-wheelers)</font></p>

<br>

<p><label for="model">Model:</label><input title="model" type="text" name="txtModel" value="<?echo $vehiclerow[1];?>"></p>

<br>

<p><label for="colour">Colour:</label><input title="colour" type"text" name="txtColour" value="<?echo $vehiclerow[2];?>"></p>

<br>

<h1>Any other changes?</h1>

<p><label for="name">*Name:</label><input  title="Name" type="text" id="name"  name="txtName" value="<?echo $personrow[1];?>"> </p>



<br> 

<p><label for="sex">*Sex:</label>Male<input type="radio" name="radSex" value="M" <? if ($personrow[2]=='M') { ?> checked="yes" <?}?>><span class="radio">Female</span><input class="radio" type="radio" name="radSex" value="F" <? if ($personrow[2]=='F') { ?> checked="yes" <?}?>> </p>

<br> 

<p><label for="mobile">*Mobile number:</label><input type="text" name="txtMob_no" id="txtMob_no" maxlength="10" value="<?echo $personrow[4];?>"> </p>

<br>
 
<p ><font id="numerror" face="arial" size="2" color="red" style="position:relative; left:220px;">  </font></p>

<p><label for="email">*Email id:</label><input  type="text" name="txtEmail_id" maxlength="30" value="<?echo $personrow[3];?>"></p> 

<br> 

<p><label for="pass">New Password:</label><input type="password" name="txtPassword" maxlength="15" value="<?echo '';?>"></p>

<br>

<p ><font id="passerror" face="arial" size="2" color="red" style="position:relative; left:200px;">  </font></p>

<p><label for="confirm pass">Confirm password:</label><input type="password" name="txtConfirmpass" maxlength="15"> </p>

<br>



<p style="postion:relative; padding-left:300px;  bottom:500px;" class="submit"><input class="submit" type="submit"  name="submit"  value="Submit" > </p>


</form>



<script type="text/javascript">
function validation()
{

var form=document.getElementById("form");

 document.getElementById('error').innerHTML="";
 document.getElementById('passerror').innerHTML="";
document.getElementById('numerror').innerHTML="";


for(var i=0;i<form.length;i++)
{
	if(((form.elements[i]!=form.txtRegno && form.elements[i]!=form.txtModel && form.elements[i]!=form.txtColour && form.elements[i]!=form.radVehicle  && form.elements[i] != form.radSeat && form.elements[i]!=form.txtPassword && form.elements[i]!=form.txtConfirmpass) && form.elements[i].value=="" )|| (form.radSex[0].checked==false &&  form.radSex[1].checked==false))
     {
      document.getElementById('error').innerHTML="***Fields marked * are compulsory ***";
	form.elements[i].focus();  
      return false;
    }
}
if(document.frmInput.txtPassword.value!=document.frmInput.txtConfirmpass.value)
{
    document.getElementById('passerror').innerHTML="***Passwords do not match..please re-enter***";
    form.txtPassword.focus();
    return false;
}



var num=/\D/;//Invalid even if a single non-digit occurs.
var check=1;

if(document.getElementById("txtMob_no").value.match(num))
{
check=0;
}


if(document.frmInput.txtMob_no.value.length == 10 && check)
{
return true;
}
else
{
 
  document.getElementById('numerror').innerHTML="***Invalid mobile number..please re-enter***";
   form.txtMob_no.focus();
  return false;
}

}
</script>


  
  
 


<?php
$flag=1;


if(isset($_POST["submit"]))
  {
        
          mysql_connect("localhost","pool","pool") or die(mysql_error()); 
	  mysql_select_db("pool") or die(mysql_error());	  
	        $name=$_POST["txtName"];
	        $email_id=$_POST["txtEmail_id"];
	  	$mobile_no=$_POST["txtMob_no"];
	  	$password=$_POST["txtPassword"];
	  	$gender=$_POST["radSex"];
                 
                         
			$getemail=mysql_query("Select * from member where email_id='$email_id' and mid<>'$mid'") or die(mysql_error());
		
		if(mysql_num_rows($getemail)!=0)
		{
                          
                    
		    echo  "<p style='position:relative; bottom:330px; left:200px;'><font face='arial' size='2' color='red'>***User with the given 					email-id already exists***</font></p>"; 
		    $flag=0;
		
		}
			 
		if($flag==1)
		{
                      

		  mysql_query("update member set name='$name',email_id='$email_id',mobile_no='$mobile_no',sex='$gender' where mid='$mid'") or die(mysql_error());
                  if($password!="")
                   mysql_query("update member set password='$password' where mid='$mid'") or die(mysql_error());

		}
	

                $reg_no=$_POST["txtRegno"];
	        $type=$_POST["radVehicle"];
	        $model=$_POST["txtModel"];
	  	$colour=$_POST["txtColour"];
		$capacity=$_POST["radSeat"];
                     
			 
                    
           if($check==1 && $reg_no=="" && $type=="" && $model=="" && $colour=="" && $capacity=="")
		      {
			    echo "<font style='position:absolute; top:10%; left:10%;' color=#FF0000>***You are giving a ride...please specify vehicle details***</font>";    
                $flag=0;
			  }  
					
                     
	        
	        else   if($reg_no!="" && $type!="" && $model!="" && $colour!="" && $capacity!="")
		    {
                                
		     if($type==2)
		       $capacity=1;
                  $getmid=mysql_query("Select * from vehicle where mid='$mid'") or die(mysql_error());
                  if(mysql_num_rows($getmid)==0)
                    {
			 			

	  	$getregno=mysql_query("Select * from vehicle where reg_no='$reg_no'");
		
		if(mysql_num_rows($getregno)!=0)
		{
		    echo  "<p style='position:relative; bottom:330px; left:190px;'><font face='arial' size='2' color='red'>***User with the given vehicle registration number already exists***</p>"; 
		    $flag=0;
		}

		if($flag==1)
		{		
		  mysql_query("insert into vehicle values ('$reg_no','$model','$colour','$type','$mid','$capacity')") or die(""); 		  
		}
                  }
		else
		{
		 $getregno=mysql_query("Select * from vehicle where reg_no='$reg_no' and mid<>'$mid'") or die(mysql_error());
		
		if(mysql_num_rows($getregno)!=0)
		{
		    echo  "<p style='position:relative; bottom:130px; left:190px;'><font face='arial' size='2' color='red'>***User with the given vehicle 					registration number already exists***</p>"; 
		    $flag=0;
		}

		if($flag==1)
		{		
		  mysql_query("update vehicle set reg_no='$reg_no',vehicle_type='$type',model='$model',colour='$colour',capacity='$capacity' where mid='$mid'") or die(mysql_error()); 		  
		}
		}
}
  if($flag==1)
  {  
?>
<script type="text/javascript">
      window.location="home.php";
</script>
<?
}
}
       ?>
           
		

 
</html>

