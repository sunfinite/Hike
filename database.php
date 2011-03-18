<?
mysql_connect("localhost","pool","pool");
mysql_select_db("pool");
$var1="ROUTELAT";
$var2="ROUTELNG";
for($i=121;$i<=200;$i++)
{
	$name1=$var1.$i;
	$name2=$var2.$i;
	mysql_query("alter table location add $name1 double(9,6)");
	mysql_query("alter table location add $name2 double(9,6)");
}
?>
