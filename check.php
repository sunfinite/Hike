<?
mysql_connect("localhost","pool","pool") or die(mysql_error());
mysql_select_db("pool") or die(mysql_error());

$var="ROUTELAT2";
echo "check";
$result=1;
$i=2;
while($result==1)
{
	$var="ROUTELONG".$i;
	$result=mysql_query("alter table location drop column $var");
	echo $var;
 	$i+=1;
}
echo $result;
?>

