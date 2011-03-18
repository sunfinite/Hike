<html>
<div style="border:1px solid black;">
	<p>I have to be in the college at</p> 
<input type="radio" name="uptime" value="1" checked="yes"/>normal start time(8:15) or
<input type="radio" name="uptime" value="2"/>no later than 
<select name="uphour" >
<?php
 for($i=1;$i<=12;$i++)
	{
		if($i==8)	
		{	
?>
	<option selected="yes"><?printf("%02d",$i)?></option>
<?
	}
	  else
	{
?>
	<option> <?printf("%02d",$i)?></option>
<?}}?>
</select>
:
<select name="upminute">
<?php
		  for($i=0;$i<=55;$i+=5)
		  {
			  if($i==30)
			  {
?>
	<option selected="yes"><?printf("%02d",$i)?></option>
<?
			  }
			  else
			  {
?>
	<option> <?printf("%02d",$i)?></option>
<?}}?>
</select>
<p>I will be leaving the college at</p>

<input type="radio" name="downtime" value="1" checked="yes">normal end time(3:30) or 
<input type="radio" name="downtime" value=2"> I will not leave before 
<select name="downhour1" >
<?php
 for($i=1;$i<=12;$i++)
	{
		if($i==4)	
		{	
?>
	<option selected="yes"><?printf("%02d",$i)?></option>
<?
	}
	  else
	{
?>
	<option> <?printf("%02d",$i)?></option>
<?}}?>
</select>
:
<select name="downminute1">
<?php
		  for($i=0;$i<=55;$i+=5)
		  {
			  if($i==0)
			  {
?>
	<option selected="yes"><?printf("%02d",$i)?></option>
<?
			  }
			  else
			  {
?>
	<option> <?printf("%02d",$i)?></option>
<?}}?>
</select>
and I will not stay after 
<select name="downhour2" >
<?php
 for($i=1;$i<=12;$i++)
	{
		if($i==6)	
		{	
?>
	<option selected="yes"><?printf("%02d",$i)?></option>
<?
	}
	  else
	{
?>
	<option> <?printf("%02d",$i)?></option>
<?}}?>
</select>
:
<select name="downminute2">
<?php
		  for($i=0;$i<=55;$i+=5)
		  {
			  if($i==0)
			  {
?>
	<option selected="yes"><?printf("%02d",$i)?></option>
<?
			  }
			  else
			  {
?>
	<option> <?printf("%02d",$i);?></option>
<?}}?>
</select>
</div>
</html>  
