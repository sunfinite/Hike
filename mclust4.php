<?
mysql_connect("localhost","pool","pool");
mysql_select_db("pool");
$pool=json_decode($_POST['json'],true);
for($i=0;$i<count($pool);$i++)
{
     
	if($pool[$i]['takers']!=NULL)
	{
		$gmid=$pool[$i]['mid'];
		$gpid=$pool[$i]['pid'];
		$getcount=mysql_query("select count(pid) as count from belongs_to where pid=$gpid group by pid");
		$count=mysql_fetch_array($getcount);
		$pcount=$count['count'];		
		for($j=0;$j<count($pool[$i]['takers']);$j++)
		{		
			$tpid=$pool[$i]['takers'][$j]['pid'];
			$tmid=$pool[$i]['takers'][$j]['mid'];
			mysql_query("delete from pool where pid='$tpid'") or die(mysql_error());
			$pcount++;			
			mysql_query("insert into belongs_to values ('$tmid','$gpid','$pcount')") or die(mysql_error());
						
		}
		$temp=$pool[$i]['capacity'];
			        mysql_query("update pool set capacity=$temp where pid=$gpid"); 
	}
}

$date=date("Y-m-d",strtotime('tomorrow'));
//$date=date("Y-m-d");
$g_count=0;
$t_count=0;
$getmid=mysql_query("Select b.mid,b.pid,l.longitude,l.latitude,p.capacity from belongs_to b,pool p,location l where l.mid=b.mid and b.pool_count=1 and b.pid=p.pid and p.date='$date'");
while($row=mysql_fetch_array($getmid))
{
	
  if($row['capacity']>0)
  {
	
     $giver[$g_count]['mid']=$row['mid'];
     $mid=$row['mid'];
     $giver[$g_count]['pid']=$row['pid'];
     $giver[$g_count]['capacity']=$row['capacity'];
     $getroute=mysql_query("select * from location where mid=$mid");
     $row1=mysql_fetch_array($getroute);
     $i=1;
     $lat="ROUTELAT";
     $lng="ROUTELNG";
     do{
	     $temp=$lat.$i;
	     $temp1=$lng.$i;
	     if($row1[$temp]!=0.0)
               {
		       $giver[$g_count]['route'][$i-1]['lat']=$row1[$temp];
		       $giver[$g_count]['route'][$i-1]['lng']=$row1[$temp1];
	       }
	      $i++;
     }while($row1[$temp]!=0.0);
     $giver[$g_count++]['takers']=Array();
	
  } 
  
  else if($row['capacity']==-1)
  {
     $taker[$t_count]['mid']=$row['mid'];
     $taker[$t_count]['pid']=$row['pid'];
     $taker[$t_count]['latitude']=$row['latitude'];
     $taker[$t_count]['longitude']=$row['longitude'];
     $taker[$t_count++]['pooled']=0;
  }
}
$getswitchers=mysql_query("Select b.mid,b.pid,l.longitude,l.latitude,p.capacity from belongs_to b,pool p,location l where l.mid=b.mid and b.pool_count=1 and b.pid=p.pid and p.date='$date' and p.switch=1");
while($row=mysql_fetch_array($getmid))
{
	
  if($row['capacity']==-1)
  {
	
     $giver[$g_count]['mid']=$row['mid'];
     $mid=$row['mid'];
     $giver[$g_count]['pid']=$row['pid'];
     $giver[$g_count]['capacity']=$row['capacity'];
     $getroute=mysql_query("select * from location where mid=$mid");
     $row1=mysql_fetch_array($getroute);
     $i=1;
     $lat="ROUTELAT";
     $lng="ROUTELNG";
     do{
	     $temp=$lat.$i;
	     $temp1=$lng.$i;
	     if($row1[$temp]!=0.0)
               {
		       $giver[$g_count]['route'][$i-1]['lat']=$row1[$temp];
		       $giver[$g_count]['route'][$i-1]['lng']=$row1[$temp1];
	       }
	      $i++;
     }while($row1[$temp]!=0.0);
     $giver[$g_count++]['takers']=Array();
	
  } 
  
  else if($row['capacity']>0)
  {
	$pid=$row['pid'];
	$getcount=mysql_query("select count(pid) as count from belongs_to where pid=$pid group by pid");
	$count=mysql_fetch_array($getcount);
	if($count['count']==1)
	{
       	
	     $taker[$t_count]['mid']=$row['mid'];
	     $mid=$row['mid'];

	     $taker[$t_count]['pid']=$row['pid'];
	     $taker[$t_count]['latitude']=$row['latitude'];
	     $taker[$t_count]['longitude']=$row['longitude'];
	     $taker[$t_count++]['pooled']=0;
	}
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
var flag=1;
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
routedisplay.setMap(map);
var giverloc;
var takerloc;
for(i=0;i<jgiver.length;i++)
{
	for(j=0;j<jtaker.length;j++)
	{	
			if(jgiver[i].mid!=jtaker[j].mid)
			{
				for(k=0;k<jgiver[i].route.length;k++)
				{
					 giverloc=new google.maps.LatLng(jgiver[i].route[k].lat,jgiver[i].route[k].lng);
					 takerloc=new google.maps.LatLng(jtaker[j].latitude,jtaker[j].longitude);
					 calculate(giverloc,takerloc,i,j,k);
				}
			}
	}
		
}
	
}
function calculate(giverloc,takerloc,i,j,k)
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
				
				for(var l=0;l<route.legs.length;l++)
					total+=route.legs[l].distance.value;
					
				routedisplay.setDirections(result);
				total=(total/1000);
if(total<0.5)	
{
	alert(jgiver[i].mid);
	alert(jtaker[j].mid);
	alert(giverloc);
	alert(takerloc);
	alert(total);
}
				if(flag)
				{
					flag=0;
					distances[count]={
											givermid:jgiver[i].mid,
											takermid:jtaker[j].mid,
											distance:total.toFixed(6),
											done:0
				    			 }
				}

				if(total<distances[count].distance)				
					distances[count].distance=total.toFixed(6);
				
				if(k==jgiver[i].route.length-1)
				{
					count++;
					flag=1;
				}
				if(i==jgiver.length-1 && j==jtaker.length-1 && k==jgiver[i].route.length-1)
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
		 if(mindist.distance>0.5)
		    continue;
		 
		 
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
	var string=JSON.stringify(jgiver);
	alert(string);
	document.getElementById('json').value=string;
	document.pool.submit();
	
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
	<body onload="initialize()">
	<form id="pool" name="pool" method="post"  action="mclust3.php">
     <input type="hidden" name="json" id="json" value="">
	<input type="submit" name="mclust" value="Run mclust" style="height:5%; width:10%;">
	  </form>
	<div name="map" id="map" align="right" style=" position:absolute; left:0px; height:1000px; width:1000px"> &nbsp;&nbsp;  </div>	
	</body>
	</html>
	
	
	
	

