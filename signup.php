<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3c.org/TR/xhtml 1/DTD/xhtml 1-transitional.dtd">
<?
session_start();
$_SESSION['mid']=1;
?>

<html><!--issues:The vehicle registration details have not been fully specified and implemented...later update:kinda solved with the fill one,fill all message.-->

<head>

<link rel="stylesheet" type="text/css" href="signup.css" >

<title>

The Sign Up

</title>

<style type="text/css">
.radio1{
position:relative;
left:130px;
}

</style>

</head>



<h1>We want to know you!</h1>

<form id="form" name="frmInput" method="post" onsubmit="return validation();"   action="signup.php" > 

<p ><font id="error" face="arial" size="3" color="red" style="position:relative; left:200px;"> </font></p>

<p><label for="name">*Name:</label><input  title="Name" type="text"  name="txtName"> </p>



<br> 

<p><label for="sex">*Sex:</label>Male<input type="radio" name="radSex" value="M"><span class="radio">Female</span><input class="radio" type="radio" name="radSex" value="F"> </p>

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


<h1>Your wheels?</h1><a href="#Location"><font style="position:relative; ">Do not have one?</a>

<p><font size="2">Fill one,you fill all.</font></p>
<p><label for="regn no">Registration number:</label><input title="registration number" type="text"  name="txtRegno"></p>

<br>

<p><label for="veh type">Vehicle type:</label>2-wheeler<input type="radio" name="radVehicle" value="2"><span class="radio">4-wheeler</span><input class="radio" type="radio" name="radVehicle" value="4"></p>

 <br>
<p><label for="seats">Pool capacity:</label>1<input type="radio" name="radSeat" value="1"> <span class="radio">2</span><input class="radio" type="radio"  name="radSeat" value="2"><span class="radio1">3</span><input class="radio1" type="radio"  name="radSeat" value="3"><font size="2" style="position:relative; left:180px;">(only for 4-wheelers)</font></p>

<br>

<p><label for="model">Model:</label><input title="model" type="text" name="txtModel"></p>

<br>

<p><label for="colour">Colour:</label><input title="colour" type"text" name="txtColour"></p>

<br>

<h1><a name="Location">Where are you?</h1>

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
<div  id="map" style="position:relative; bottom:55px; height:400px; width:1100px;" ><br/></td></div>
</tr>
</table>
<input class="submit" style="position:relative; left:44%;" type="submit"  name="submit"  value="Submit" > 

<br>

</form>

<script type="text/javascript">
function validation()
{
var form=document.getElementById("form");
 document.getElementById('error').value="";
 document.getElementById('passerror').value="";
document.getElementById('numerror').value="";

for(var i=0;i<form.length;i++)
{
	if(((form.elements[i]!=form.txtRegno && form.elements[i]!=form.txtModel && form.elements[i]!=form.txtColour && form.elements[i]!=form.radVehicle && form.elements[i] != form.radSeat) && form.elements[i].value=="")|| (form.radSex[0].checked==false &&  form.radSex[1].checked==false))
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



    <form name="test" action="#" onsubmit="showAddress(this.address.value); return false">
 <div align="right" style="position:relative; right:45px;  bottom:520px;">           
  <input type="text"  size="20" name="address" value="pesit" />    
 <input type="submit"  value="Search" /></td>
    </div> 
    </form>
	


	
 <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAgrj58PbXr2YriiRDqbnL1RRdqDCIfn-akWLPXbZqJg-hQ6eHehSRJ1rozvQIj0_jjwfMfzxMVY23oQ"
      type="text/javascript"></script>
    <script type="text/javascript">

 function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.addControl(new GSmallMapControl());
        map.addControl(new GMapTypeControl());
        var center = new GLatLng(12.935440,77.535020);
        map.setCenter(center, 15);
        geocoder = new GClientGeocoder();
        var marker = new GMarker(center, {draggable: true});  
        map.addOverlay(marker);
        document.getElementById("lat").value = center.lat().toFixed(6);

        document.getElementById("lng").value = center.lng().toFixed(6);

	  GEvent.addListener(marker, "dragend", function() {
       var point = marker.getPoint();
	      map.panTo(point);
       document.getElementById("lat").value = point.lat().toFixed(6);

       document.getElementById("lng").value = point.lng().toFixed(6);

        });


	 GEvent.addListener(map, "moveend", function() {
		  map.clearOverlays();
    var center = map.getCenter();
		  var marker = new GMarker(center, {draggable: true});
		  map.addOverlay(marker);
		  document.getElementById("lat").value = center.lat().toFixed(6);
	   document.getElementById("lng").value = center.lng().toFixed(6);


	 GEvent.addListener(marker, "dragend", function() {
      var point =marker.getPoint();
	     map.panTo(point);
      document.getElementById("lat").value = point.lat().toFixed(6);
	     document.getElementById("lng").value = point.lng().toFixed(6);

        });
 
        });

      }
    }

	   function showAddress(address) {
            address+=",bangalore";
	   var map = new GMap2(document.getElementById("map"));
       map.addControl(new GSmallMapControl());
       map.addControl(new GMapTypeControl());
       if (geocoder) {
        geocoder.getLatLng(
          address,
          function(point) {
            if (!point) {
              alert(address + " not found");
            } else {
		  document.getElementById("lat").value = point.lat().toFixed(6);
	   document.getElementById("lng").value = point.lng().toFixed(6);
		 map.clearOverlays()
			map.setCenter(point, 15);
   var marker = new GMarker(point, {draggable: true});  
		 map.addOverlay(marker);

		GEvent.addListener(marker, "dragend", function() {
      var pt = marker.getPoint();
	     map.panTo(pt);
      document.getElementById("lat").value = pt.lat().toFixed(6);
	     document.getElementById("lng").value = pt.lng().toFixed(6);
        });


	 GEvent.addListener(map, "moveend", function() {
		  map.clearOverlays();
    var center = map.getCenter();
		  var marker = new GMarker(center, {draggable: true});
		  map.addOverlay(marker);
		  document.getElementById("lat").value = center.lat().toFixed(6);
	   document.getElementById("lng").value = center.lng().toFixed(6);

	 GEvent.addListener(marker, "dragend", function() {
     var pt = marker.getPoint();
	    map.panTo(pt);
    document.getElementById("lat").value = pt.lat().toFixed(6);
	   document.getElementById("lng").value = pt.lng().toFixed(6);
        });
 
        });

            }
          }
        );
      }
    }
    </script>
  
<body onload="load()" onunload="GUnload()" >
 
</body>


<?php
$flag=1;
error_reporting(~E_NOTICE);
if(isset($_POST["submit"]))
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
		    echo  "<p style='position:relative; bottom:1590px; left:200px;'><font face='arial' size='2' color='red'>***User with the given 					email-id already exists***</font></p>"; 
		    $flag=0;
		}
			 
		if($flag==1)
		{
		  mysql_query("insert into member values ('-1','$name','$gender','$email','$mobile','$password')") or die("");
		  
		  $result=mysql_query("select mid from member where name='$name' and mobile_no='$mobile'");
		  $row=mysql_fetch_array($result);
		  $mid=$row['mid'];
		}
	

                $regno=$_POST["txtRegno"];
	        $type=$_POST["radVehicle"];
	        $model=$_POST["txtModel"];
	  	$colour=$_POST["txtColour"];
                $capacity=$_POST["radSeat"];
	        
	          if($regno!="" && $type !="" && $model !="" && $colour!="" && $capacity!="")
		{
		 			  
		if($type==2)
		   $capacity=1;

	  	$getregno=mysql_query("Select * from vehicle where reg_no='$regno'");
		
		if(mysql_num_rows($getregno)!=0)
		{
		    echo  "<p style='position:relative; bottom:1230px; left:190px;'><font face='arial' size='2' color='red'>***User with the given vehicle 					registration number already exists***</p>"; 
		    $flag=0;
		}

		if($flag==1)
		{		
		  mysql_query("insert into vehicle values ('$regno','$model','$colour','$type','$mid','$capacity')") or die(""); 		  
		}
		}

          	$locality=$_POST["txtLocn"];
	  	$area=$_POST["txtArea"];
	  	$lat=$_POST["txtLat"];
	  	$lng=$_POST["txtLng"];
	        mysql_query("insert into location(MID,LATITUDE,LONGITUDE,LOCALITY,AREA) values ('$mid','$lat','$lng','$locality','$area')") or die("");
                $_SESSION['mid']=$mid;
           ?>
           <script type="text/javascript">
		window.location="route.php";
	</script>
  <?
 }
  ?>
		

 
</html>

