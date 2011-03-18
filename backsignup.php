<html>

<head>

<link rel="stylesheet" type="text/css" href="signup.css" >

<title>

The Sign Up

</title>

</head>



<h1>We want to know you!</h1>

<form id="form" name="frmInput" method="post"  action="backsignup.php" > 

<p ><font id="error" face="arial" size="3" color="red" style="position:relative; left:200px;">  </font></p>

<p><label for="name">*Name:</label><input  title="Name" type="text"  name="txtName"> </p>



<br> 

<p><label for="sex">*Sex:</label>Male<input type="radio" name="radSex" value="Male"><span class="radio">Female</span><input class="radio" type="radio" name="radSex" value="Female"> </p>

<br> 

<p><label for="mobile">*Mobile number:</label><input type="text" name="txtMob_no" id="txtMob_no" maxlength="10"> </p>

<br>
 
<p ><font id="numerror" face="arial" size="2" color="red" style="position:relative; left:220px;">  </font></p>

<p><label for="email">*Email id:</label><input  type="text" name="txtEmail_id" maxlength="30"></p> 

<br> 

<p><label for="pass">*Password:</label><input type="password" name="txtPassword" maxlength="15"><font size="2">(this will be your username and password when you login)</font> </p>

<br>

<p ><font id="passerror" face="arial" size="2" color="red" style="position:relative; left:200px;">  </font></p>

<p><label for="confirm pass">*Confirm password:</label><input type="password" name="txtConfirmpass" maxlength="15"> </p>

<br>


<h1>Your wheels?</h1>


<p><label for="regn no">Registration number:</label><input title="registration number" type="text"  name="txtRegno"></p>

<br>

<p><label for="veh type">Vehicle type:</label>2-wheeler<input type="radio" name="radVehicle" value="two"><span class="radio">4-wheeler</span><input class="radio" type="radio" name="radVehicle" value="four"></p>

 <br>

<p><label for="model">Model:</label><input title="model" type="text" name="txtModel"></p>

<br>

<p><label for="colour">Colour:</label><input title="colour" type"text" name="txtColour"></p>

<br>

<h1>Where are you?</h1>

<p><label for="locn">*Locality:</label><input type="text" maxlength="25" name="txtLocn"><font size="2">(Eg:PESIT)</font></p>

<br>

<p><label for="area">*Area:</label><input type="text" maxlength="25" name="txtArea"><font size="2">(Eg:Banashankari)</font></p>

<br>

<p  style="position:relative;left:270px;"><font size="2">*&lt;Mark your location on the map&gt;</font></p>
<p><input type="hidden" name="txtLat" id="lat" value=""></p>

<br>

<p><input type="hidden" name="txtLng" id="lng" value=""></p>

<table style="padding-left:50px;">
<tr><td>
<div  id="map" style="position:relative;bottom:52px; left:20px;width: 900px; height: 400px;"><br/></td></div>
</tr>
</table>
<p style="postion:relative; padding-left:300px;  bottom:500px;" class="submit"><input class="submit" type="submit"  name="submit"  value="Submit" > </p>

<br>

</form>



<?php
$flag=1;
if(isset($_POST['submit']))
{
 
 ?>
    <script type="text/javascript">
	window.location="main.php?mid=<? echo $flag ?>";
	</script>
  <?
 }
  ?>



 
</html>

