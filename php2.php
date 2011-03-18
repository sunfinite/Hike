<html>
<body>
 <?php
$a[0]=1;
$a[1]=10.897;
$marks["maths"]=90;
$marks["science"]=90;
$marks["social"]=80;
$marks["sanskrit"]=80;
$sum=0;
foreach($marks as $subject => $submark)
 $sum=$sum+$submark;

if(get_magic_quotes_gpc())
echo "Magic quotes are enabled";
else
echo "Magic quotes are disabled";

echo "<br>";

$text=$_POST['text'];
$script="This is the input<br>
      <script type='text/javascript' >
   alert(\"In me script\")
</script>";
echo $text;
echo $script;
echo htmlentities($script);


//	echo "The total is ".$sum;
?>


<form method="post">
Text:<input type="text" name='text'>

        
<input type="submit" name="submit">
</form>
</body>
</html>
