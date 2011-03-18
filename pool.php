<?
session_start();
error_reporting(~E_NOTICE);
$mid=$_SESSION['mid'];
$pid=$_SESSION['pid'];

mysql_connect("localhost","pool","pool") or die(mysql_error()); 
mysql_select_db("pool") or die(mysql_error());

$getpool=mysql_query("select mid,pool_count from belongs_to where pid='$pid'");
$k=0;
while($row=mysql_fetch_array($getpool))
{
  $pool[$k]['mid']=$row['mid'];
  $tempmid=$row['mid'];
  $pool[$k]['count']=$row['pool_count'];
  $getmember=mysql_query("select * from member m,location l where m.mid='$tempmid' and  m.mid=l.mid") or die(mysql_error());
  $details=mysql_fetch_array($getmember);
  $pool[$k]['name']=$details[1];
  $pool[$k]['sex']=$details[2];
  $pool[$k]['email_id']=$details[3];
  $pool[$k]['mobile_no']=$details[4];
  $pool[$k]['locality']=$details[9];
  $pool[$k]['area']=$details[10];
  $pool[$k]['latitude']=$details[7];
  $pool[$k]['longitude']=$details[8];
  $pool[$k]['cost']=0;
  
  if($pool[$k]['count']==1)
  {
		$getvehicle=mysql_query("select * from vehicle where mid='$tempmid'") or die(mysql_error());
		$details=mysql_fetch_array($getvehicle);
		$pool[$k]['reg_no']=$details[0];
		$pool[$k]['colour']=$details[1];
		$pool[$k]['model']=$details[2];
		$pool[$k]['type']=$details[3];
		$giverlat=$pool[$k]['latitude'];
		$giverlng=$pool[$k]['longitude'];
		$giver=$k;
  }
  $k++;
}
$j=1;
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="signup.css" >
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript" >
</script>
<script type="text/javascript">
function initialize()
{

var center=new google.maps.LatLng(<? echo $giverlat;?>,<?echo $giverlng; ?>);
var options={zoom:10,
	     center:center,
	      mapTypeId:google.maps.MapTypeId.ROADMAP,
		};

var map=new google.maps.Map(document.getElementById('map'),options);
var marker= new google.maps.Marker({
				position:center,
				map:map,
				title:"Your Location"
				}); 
var pesit=new google.maps.LatLng(12.935442,77.534949);
var pesitmarker=new google.maps.LatLng(12.934332,77.534938);
var markerPESIT=new google.maps.Marker({
					position:pesitmarker,
					map:map,	
					title:"PESIT",
					icon:"PESIT.png",
					shadow:"PESIT.png"
					}); 
	var waypts=[];
	<?for($i=0;$i<count($pool);$i++)
	{
       if($pool[$i]['count']!=1)
		{
	?>
		var waypoint=new google.maps.LatLng(<?echo $pool[$i]['latitude']?>,<?echo $pool[$i]['longitude']?>);	
		waypts.push({
						location:waypoint,
						stopover:true
					});
		<?}
		}?>
		
	
var routedisplay=new google.maps.DirectionsRenderer();
var directionsService=new google.maps.DirectionsService();
routedisplay.setMap(map);
var total=0;

var request={
		origin:center,
		destination:pesit,
		waypoints: waypts,
		optimizeWaypoints: true,
		travelMode:google.maps.DirectionsTravelMode.DRIVING
            };
directionsService.route(request,function(result,status){
if(status==google.maps.DirectionsStatus.OK)
{   
var route=result.routes[0];
   for(var i=0;i<route.legs.length;i++)
		total+=route.legs[i].distance.value;
  	
    routedisplay.setDirections(result);
	total=total/1000;
    routedisplay.setDirections(result);
	document.getElementById('dist').innerHTML=total+"km";
	var litre=55;
	var twowheelermil=35;
	var fourwheelermil=15;
	var radius=2;

	var twowheeler=(total*litre)/twowheelermil;
	var fourwheeler=(total*litre)/fourwheelermil;
	var twogiver=(twowheeler*0.5);
	var fourtaker1=(fourwheeler*0.5);
	var fourtaker2=(fourwheeler*0.33);
	var fourtaker3=(fourwheeler*0.25);
    <?if($pool[$giver]['type']==2)
		{
		?>
			document.getElementById('cost1').innerHTML="Rs."+twogiver.toFixed(0);
	<?}
	else if(count($pool)==2 && $pool[$giver]['type']==4)
	{
	?>
	   document.getElementById('cost1').innerHTML="Rs."+fourtaker1.toFixed(0);
	   <?
	   }
	   else if(count($pool)==3)
	   {?>
		
	      document.getElementById('cost1').innerHTML="Rs."+fourtaker2.toFixed(0);
	      document.getElementById('cost2').innerHTML="Rs."+fourtaker2.toFixed(0);
		  <?}
		  else
		  {?>
		   document.getElementById('cost1').innerHTML="Rs."+fourtaker3.toFixed(0);
	      document.getElementById('cost2').innerHTML="Rs."+fourtaker3.toFixed(0);
		document.getElementById('cost3').innerHTML="Rs."+fourtaker3.toFixed(0);
	      <?}?>
	
}
}
);
}
</script>
</head>
<body onload="initialize()">
<h1>The Pool</h1>
<p>Total distance covered by the ride-giver:<span id="dist"></span><p>
<div name="map" id="map" align="right" style="position:absolute; left:5%; height:400px; width:90%"> &nbsp;&nbsp;  </div>
<br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>


<table>
<tr><h1>The Giver</h1></tr>
<tr><td><p>Name :</p></td><td><?echo "<p>".$pool[$giver]['name']."</p>";?></td></tr>
<tr><td><p>Sex :</p></td><td><?echo "<p>".$pool[$giver]['sex']."</p>";?></td></tr>
<tr><td><p>Email-id :</p></td><td><?echo "<p>".$pool[$giver]['email_id']."</p>";?></td></tr>
<tr><td><p>Mobile Number :</p></td><td><?echo "<p>".$pool[$giver]['mobile_no']."</p>";?></td></tr>
<tr><td><p>Locality :</p></td><td><?echo "<p>".$pool[$giver]['locality']."</p>";?></td></tr>
<tr><td><p>Area :</p></td><td><?echo "<p>".$pool[$giver]['area']."</p>";?></td></tr>
<br>
<br>
<tr><td><font size='5'  color=#008533><u>Vehicle Details:</u></font></td></tr>
<br>
<tr><td><p>Registration Number :</p></td><td><?echo "<p>".$pool[$giver]['reg_no']."</p>";?></td></tr>
<tr><td><p>Model :</p></td><td><?echo "<p>".$pool[$giver]['model']."</p>";?></td></tr>
<tr><td><p>Colour :</p></td><td><?echo "<p>".$pool[$giver]['colour']."</p>";?></td></tr>
</table>
<h1>The Takers</h1>
<?for($i=0;$i<count($pool);$i++)
{
	if($i!=$giver)
	{
		$cost="cost";	
		$temp=$cost.$j;
		$j++;
?>
		  
<table>
<tr><td><p>Name :</p></td><td><?echo "<p>".$pool[$i]['name']."</p>";?></td></tr>
<tr><td><p>Sex :</p></td><td><?echo "<p>".$pool[$i]['sex']."</p>";?></td></tr>
<tr><td><p>Email-id :</p></td><td><?echo "<p>".$pool[$i]['email_id']."</p>";?></td></tr>
<tr><td><p>Mobile Number :</p></td><td><?echo "<p>".$pool[$i]['mobile_no']."</p>";?></td></tr>
<tr><td><p>Locality :</p></td><td><?echo "<p>".$pool[$i]['locality']."</p>";?></td></tr>
<tr><td><p>Area :</p></td><td><?echo "<p>".$pool[$i]['area']."</p>";?></td></tr>
<tr><td><p>You Pay:</p></td><td><p id=<?echo $temp;?>></p></td></tr>
</table>
<br><hr><br>
<?
}
}
?>
</body>
</html>

