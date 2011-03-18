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
			$pcount++;
			$temp1=-$pcount;
			mysql_query("delete from pool where pid='$tpid'") or die(mysql_error());
			mysql_query("insert into belongs_to values ('$tmid','$gpid','$temp1')") or die(mysql_error());
		
		}
		$temp=$pool[$i]['capacity'];
			        mysql_query("update pool set capacity=$temp where pid=$gpid"); 
	}
}


