<? 
mysql_connect("localhost","pool","pool") or die(mysql_error());
mysql_select_db("pool") or die(mysql_error());
$date=date("Y-m-d",strtotime('tomorrow'));

$g_count=0;
$t_count=0;
$getmid=mysql_query("Select b.mid,b.pid,v.capacity,l.longitude,l.latitude,p.giver_or_taker from belongs_to b,pool p,vehicle v,location l where l.mid=b.mid and v.mid=b.mid and b.pid=p.pid and p.date='$date'");
while($row=mysql_fetch_array($getmid))
{
  if($row['giver_or_taker']==1)//pooling on capacity first...write special case for capacity 1 later.
  {
     $giver[$g_count]['mid']=$row['mid'];
	 $giver[$g_count]['pid']=$row['pid'];
     $giver[$g_count]['capacity']=$row['capacity'];//subscript for mid and associative arrays for the others.
	 $giver[$g_count]['latitude']=$row['latitude'];//if associative is used for mid's assigning to js variables becomes a pain.
	 $giver[$g_count]['longitude']=$row['longitude'];    
	 $giver[$g_count++]['takers']=Array();
  }
  
  
  else
  {
     $taker[$t_count]['mid']=$row['mid'];
	 $taker[$t_count]['pid']=$row['pid'];
     $taker[$t_count]['latitude']=$row['latitude'];
	 $taker[$t_count]['longitude']=$row['longitude'];
	 $taker[$t_count++]['pooled']=0;
     
	 
  }

  }


 
?>
<html>
<head>
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript" >
</script>

<script type="text/javascript">
var jgiver= <? echo json_encode($giver);?>;
var jtaker=<? echo json_encode($taker);?>;
var map;
var routedisplay=new google.maps.DirectionsRenderer();
var directionsService=new google.maps.DirectionsService();
var total;
var distances=[];
var count=0;

 function initialize()
{
var i=0;
var j=0;

var center=new google.maps.LatLng(12.935442,77.534949);
var options={zoom:10,
	         center:center,
	          mapTypeId:google.maps.MapTypeId.ROADMAP,
		    };

var map=new google.maps.Map(document.getElementById('map'),options);

var pesit=new google.maps.LatLng(12.935442,77.534949);
var pesitmarker=new google.maps.LatLng(12.934332,77.534938);
var markerPESIT=new google.maps.Marker({
					position:pesitmarker,
					map:map,	
					title:"PESIT",
					icon:"PESIT.png",
					shadow:"PESIT.png"
					}); 
					
routedisplay.setMap(map);


var giverloc;
var takerloc;
for(i=0;i<jgiver.length;i++)
{
	for(j=0;j<jtaker.length;j++)
		{
			 giverloc=new google.maps.LatLng(jgiver[i].latitude,jgiver[i].longitude);
			takerloc=new google.maps.LatLng(jtaker[j].latitude,jtaker[j].longitude);
			calculate(giverloc,takerloc,i,j);
		}
}
		
}
function calculate(giverloc,takerloc,i,j)
{
  		 total=0;
		 var request={
		                origin:giverloc,
						destination:takerloc,
						travelMode:google.maps.DirectionsTravelMode.DRIVING
					};
			
				
		directionsService.route(request,function(result,status)
		{				
			if(status==google.maps.DirectionsStatus.OK)
			{	 
				var route=result.routes[0];
				
				for(var k=0;k<route.legs.length;k++)
					total+=route.legs[k].distance.value;
					
				routedisplay.setDirections(result);
				total=(total/1000);
				
				distances[count++]={
											givermid:jgiver[i].mid,
											takermid:jtaker[j].mid,
											distance:total.toFixed(6),
											done:0
								   }
if(i==jgiver.length-1 && j==jtaker.length-1)
{
    
	mclust(distances);
}		
		}						
		}
		);
}

function mclust(distances)
{
     var i;
	 var j=0;
	 var k=0;
	 var object={};
	 
    var mindist;	
	for(i=0;i<distances.length;i++)
	{
	     
	     mindist=findmin(distances);
		 if(mindist.distance>2)
		    continue;
		 
		 alert(mindist.distance);
		  j=0;
		   while(jgiver[j].mid!=mindist.givermid)
		    j++;
			if(jgiver[j].capacity==0)
			   continue;
			else
              {
				k=0;
				while(jtaker[k].mid!=mindist.takermid)
				  k++;
				  if(jtaker[k].pooled==1)
				    continue;
				  else
                   {
                        jgiver[j].capacity-=1;
                        jtaker[k].pooled=1;
						object={
									mid:jtaker[k].mid,
									pid:jtaker[k].pid,//no need to search for pid again when meddling with the database.
									distance:mindist.distance//choosing speed over redundancy.
								}
						jgiver[j].takers.push(object);
					}	
				}
			
    }
}
function findmin(distances)
{

   var i;
   var j;
  var min=999;
  var mindist;
  for(i=0;i<distances.length;i++)
  {
		if(distances[i].distance<min && distances[i].done==0)
		{		   
		   min=distances[i].distance;
		   j=i;
		}
  }
  distances[j].done=1;
  mindist=distances[j];

  return mindist;
  }
	
	
		</script>
		</head>
	<body>
	<form id="pool" name="pool" method="post" onsubmit="return initialize();" action="mclust.php">
	  <input type="submit" name="mclust" value="Run mclust"
	<div name="map" id="map" align="right" style=" position:absolute; left:35px; height:0px; width:0px"> &nbsp;&nbsp;  </div>	
	</body>
	</html>
	
	<?
	
	