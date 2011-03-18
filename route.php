<?
session_start();
$mid=$_SESSION['mid'];
mysql_connect("localhost","pool","pool") or die(mysql_error());
mysql_select_db("pool") or die(mysql_error());
$getlocation=mysql_query("select * from location where mid='$mid'") or die(mysql_error());
$row=mysql_fetch_array($getlocation);
$lat=$row['LATITUDE'];
$lon=$row['LONGITUDE'];
?>
<html>
<head>
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript" >
</script>
<script type="text/javascript">
var draggable={draggable:true,};
var routedisplay=new google.maps.DirectionsRenderer(draggable);
var directionsService=new google.maps.DirectionsService();
var latitude=<?echo $lat;?>;
var longitude=<?echo $lon;?>;

function initialize()
{
var center=new google.maps.LatLng(latitude,longitude);
var options={zoom:10,
	     center:center,
	     mapTypeId:google.maps.MapTypeId.ROADMAP,
       	};

var map=new google.maps.Map(document.getElementById('map'),options);
var pesit=new google.maps.LatLng(12.934332,77.534938);
var markerPESIT=new google.maps.Marker({
					position:pesit,
					map:map,	
					title:"PESIT",
					icon:"PESIT.png",
					shadow:"PESIT.png"

                                     });
routedisplay.setMap(map);
callroute(center,pesit);
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
			if(route.legs[i].steps[j].distance.value>=300)
			{
				var pi=Math.PI;
				var temp=route.legs[i].steps[j];
				var dist=temp.distance.value;
				var lat1=temp.start_location.lat();				
				var lng1=temp.start_location.lng();
				var lat2=temp.end_location.lat();
				var lng2=temp.end_location.lng();
				split(lat1,lng1,lat2,lng2,dist)

				function split(lat1,lng1,lat2,lng2,dist)
				{
					
					if(dist>=200)
					{
					dist=dist/2;
					var dlng=(lng2-lng1)*pi/180;
					var rlat1=lat1*pi/180;
					var rlat2=lat2*pi/180;
					var rlng1=lng1*pi/180;;
					var rlng2=lng2*pi/180;
					var x = Math.cos(rlat2)*Math.cos(dlng);
					var y = Math.cos(rlat2)*Math.sin(dlng);
			        	var rlat3 = Math.atan2(Math.sin(rlat1)+Math.sin(rlat2),
                      			Math.sqrt((Math.cos(rlat1)+x)*(Math.cos(rlat1)+x)+y*y)); 
					var rlng3 = rlng1 + Math.atan2(y, Math.cos(rlat1)+x);
					lat3=(rlat3*180/pi).toFixed(6);
					lng3=(rlng3*180/pi).toFixed(6);
					var mid={lat:lat3,
						 lng:lng3
						};
					markers.push(mid);									
					split(lat1,lng1,lat3,lng3,dist);
					split(lat3,lng3,lat2,lng2,dist);
					}					
				}

			}                     
			else
	                markers.push(route.legs[i].steps[j].start_location);
		}
	}
	   markers=JSON.stringify(markers);
	document.getElementById('lat').value=latitude;
	document.getElementById('lng').value=longitude;
	document.getElementById('markers').value=markers;
	total=total/1000;
	document.getElementById('total').value=total;
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
<input type="hidden" id="total" name="total">
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
	$total=$_POST['total'];
	mysql_query("update location set LATITUDE=$latitude where mid='$mid'");
	mysql_query("update location set LONGITUDE=$longitude where mid='$mid'");
	mysql_query("update location set DISTANCE=$total where mid='$mid'");
	for($i=1;$i<=42;$i++)
	{	
		$name1=$var1.$i;
		$name2=$var2.$i;
		mysql_query("update location set $name1='' where mid='$mid'");
		mysql_query("update location set $name2='' where mid='$mid'");
	}//not required in this page..but required in the update page.
		$j=1;
        for($i=1;$i<count($markers);$i++)
	{
		$name1=$var1.$i;
		$name2=$var2.$i;
		foreach($markers[$i] as $key=>$value)
		{
		   if($j==1)
		   {
			$lat=$value;
			$j++;
	           }	
		 else if($j==2)
		   {
			$lng=$value;
			$j=1;
		   }
                }
		settype($lat,double);
		settype($lng,double);
		mysql_query("update location set $name1=$lat where mid='$mid'");
		mysql_query("update location set $name2=$lng where mid='$mid'");
	}
?>	
<script>
window.location="home.php";
</script>
<?
}
?>
