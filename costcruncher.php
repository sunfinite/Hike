<?
session_start();
$mid=$_SESSION['mid'];
mysql_connect("localhost","pool","pool") or die(mysql_error());
mysql_select_db("pool") or die(mysql_error());
$getlocation=mysql_query("select * from location where mid='$mid'") or die(mysql_error());
$row=mysql_fetch_array($getlocation);
$distance=$row['DISTANCE'];
?>
<html>
<head>
<script type="text/javascript">
function initialize()
{
var total=<?echo $distance;?>;
alert(total);
document.getElementById('distance').innerHTML=total+"km";
var litre=55;
var twowheelermil=35;
var fourwheelermil=15;
var radius=2;

var twowheeler=(total*litre)/twowheelermil;
var fourwheeler=(total*litre)/fourwheelermil;
document.getElementById('2wheeler').innerHTML="Rs."+twowheeler.toFixed(0);    							                     
document.getElementById('4wheeler').innerHTML="Rs."+fourwheeler.toFixed(0);
var twogiver=(twowheeler/2);
var twotaker=(twowheeler/2)+((1.5*litre)/twowheelermil);
document.getElementById('2giver').innerHTML="Rs."+twogiver.toFixed(0);    							                      
document.getElementById('2taker').innerHTML="Rs."+twotaker.toFixed(0);
var fourgiver1=(fourwheeler*0.5)
var fourgiver2=(fourwheeler*0.67)
var fourgiver3=(fourwheeler*0.75)
var fourtaker1=(fourwheeler*0.5)+((1.5*litre)/fourwheelermil);
var fourtaker2=(fourwheeler*0.33)+((1.5*litre)/fourwheelermil);
var fourtaker3=(fourwheeler*0.25)+((1.5*litre)/fourwheelermil);
document.getElementById('4giver1').innerHTML="Rs."+fourgiver1.toFixed(0); 
document.getElementById('4giver2').innerHTML="Rs."+fourgiver2.toFixed(0);  
document.getElementById('4giver3').innerHTML="Rs."+fourgiver3.toFixed(0); 
document.getElementById('4taker1').innerHTML="Rs."+fourtaker1.toFixed(0);  
document.getElementById('4taker2').innerHTML="Rs."+fourtaker2.toFixed(0);
document.getElementById('4taker3').innerHTML="Rs."+fourtaker3.toFixed(0);                                      
}
</script>
<title>The Cost Cruncher</title>
<link rel="stylesheet" type="text/css" href="signup.css">
</head>
<body onload="initialize();">
<h1>The Estimate<font size="3">  (nothing more than fancy)</font></h1>
<p>Estimated distance from your home to the college:<span id="distance"></span></p>
<p>On a two-wheeler a one-way commute would cost: <span id="2wheeler"> </span><font size="3">(assuming an average mileage of 35kmpl)</font></p>
<br>
<p>On a four-wheeler a one-way commute would cost: <span id="4wheeler"> </span><font size="3">(assuming an average mileage of 15kmpl)</font></p>
<br>
<p>If you give a ride on a two-wheeler you will earn  (without considering the extra distance travelled to</p><p> pick up the ride-taker):<span id="2giver">  </span></p>
<br>
<p>If you take a ride on a two-wheeler you will pay (assuming the ride-giver travels the maximum distance to</p><p> pick you up) : <span id="2taker">   </span></p>
<br>
<table align="center" style="position:relative; bottom:45px; left:140px;">
<tr><p>If you give a ride on a four-wheeler you will earn (approx. min.):</p></tr>
<tr><td ><p id="4giver1"></p> </td> <td><p><font size="3">(1 person)</p></font></td></tr>
<tr><td><p id="4giver2"></p> </td> <td><p><font size="3">(2 persons)</p></font></td></tr>      						       		<tr><td><p id="4giver3"></p> </td> <td><p><font size="3">(3 persons)</p></font></td></tr>
</table>
<table align="center" style="position:relative; bottom:45px; left:140px;">
<tr><p>If you take a ride on a four-wheeler you will pay (approx. max.):</p></tr>
<tr><td ><p id="4taker1"></p> </td> <td><p><font size="3">(1 person)</p></font></td></tr>
<tr><td><p id="4taker2"></p> </td> <td><p><font size="3">(2 persons)</p></font></td></tr>      						       		<tr><td><p id="4taker3"></p> </td> <td><p><font size="3">(3 persons)</p></font></td></tr>
</table>
</body>
</html>		
