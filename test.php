<html>
<head>
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript" >
</script>
<script type="text/javascript">
var draggable={draggable:true,};
var routedisplay=new google.maps.DirectionsRenderer(draggable);
var directionsService=new google.maps.DirectionsService();

function initialize()
{
var source=new google.maps.LatLng(12.960100,77.533070);
var destination=new google.maps.LatLng(12.961240,	77.530510);
var options={zoom:10,
	     center:source,
	     mapTypeId:google.maps.MapTypeId.ROADMAP,
       	};

var map=new google.maps.Map(document.getElementById('map'),options);

routedisplay.setMap(map);
callroute(source,destination);
}
google.maps.event.addListener(routedisplay,'directions_changed',function(){

distance(routedisplay.directions);
});

function callroute(source,destination)
{

var request={
		origin:source,
		destination:destination,
		travelMode:google.maps.DirectionsTravelMode.DRIVING
            };
directionsService.route(request,function(result,status){
if(status==google.maps.DirectionsStatus.OK)
 {	
        routedisplay.setDirections(result); 
    	distance(result);
}});
}
function distance(result)
 {
	total=0;
        var markers=[];
	var count=0;
	var route=result.routes[0];
        var temp;
	latitude=route.legs[0].start_location.lat();
	longitude=route.legs[0].start_location.lng();
        for(var i=0;i<route.legs.length;i++)
	{
		total+=route.legs[i].distance.value;
		for(var j=0;j<route.legs[i].steps.length;j++)
		{
		/*	if(route.legs[i].steps[j].distance.value>1000)
			{
				temp=route.legs[i].steps[j];
				alert(temp.distance.value);
			}...given up for later implementation	*/
                     
		//	markers[count++]=route.legs[i].steps[j].start_location;
	                markers.push(route.legs[i].steps[j].start_location);
		}
	}
	   markers=JSON.stringify(markers);
	document.getElementById('lat').value=latitude;
	document.getElementById('lng').value=longitude;
	document.getElementById('markers').value=markers;

	total=total/1000;
	document.getElementById('distance').innerHTML=total+"km";
 }

</script>
<title>Confirmation</title>
<link rel="stylesheet" type="text/css" href="signup.css">
</head>
<body onload="initialize();">
<h1>Is this the route you take?<font size='3'>&lt;Note:Drag to change<font size='2'>&lt;Note for a note:It will be easier if you zoom in first&gt;</font>&gt;</font></h1>
<p align="center">Estimated distance from your home to the college :   <span id="distance"> </span></p>
<a href="javascript:location.reload()" style="position:absolute; top:16%;right:10%;">Undo</a>
<div id="map" style="position:fixed; left:5%; height:70%; width:90%">  </div>
<form name="form" method="post" action="route.php">
<input type="hidden" id="markers" name="markers">
<input type="hidden" id="lat" name="lat">
<input type="hidden" id="lng" name="lng">
<input type="submit" style="position:fixed; bottom:3%; left:44%;" name="submit" value="Confirm">
</form>
</body>
</html>		
<?
if(isset($_POST['submit']))
{
	$var1="ROUTELAT";
	$var2="ROUTELNG";
	$markers=json_decode($_POST['markers'],true);
	$latitude=$_POST['lat'];
	$longitude=$_POST['lng'];
	mysql_query("update location set LATITUDE=$latitude where mid='$mid'");
	mysql_query("update location set LONGITUDE=$longitude where mid='$mid'");

	for($i=1;$i<=42;$i++)
	{	
		$name1=$var1.$i;
		$name2=$var2.$i;
		mysql_query("update location set $name1='' where mid='$mid'");
		mysql_query("update location set $name2='' where mid='$mid'");
	}//not required in this page..but required in the update page.
        for($i=1;$i<count($markers);$i++)
	{
		$name1=$var1.$i;
		$name2=$var2.$i;
		$lat=$markers[$i]['wa'];
		$lng=$markers[$i]['ya'];
		settype($lat,double);
		settype($lng,double);
		mysql_query("update location set $name1=$lat where mid='$mid'");
		mysql_query("update location set $name2=$lng where mid='$mid'");
	}	
header("location:home.php");
}
?>
