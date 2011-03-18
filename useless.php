<?
$query=$_GET['query'];
?>

<html>
<head>
<style type="text/css">
#box
{
	position:relative;
	width:600px;
	height:250px;
	cursor:default;
	opacity:0.75;
}

.list
{
	position:absolute;
	width:450px;
	height:200px;
	right:0;
	top:0;
	border:1px solid #000000;
	background-color:#808080;
	overflow:auto;
	visibility:visible;
	
}

#maincolumn
{
	position:absolute;
	width:150px;
	height:200px;
	left:0;
	top:0;
	border:1px solid #000000;
	background-color:#808080;
	overflow:auto;
}

#initial
{
	text-align:center;
	visibility:visible;
}
#general
{
	visibility:hidden;
}

.listtd
{
	width:85px;
	height:35px;
}
.maintd
{
	width:150px;
}
.move
{
	position:absolute;
	left:20px;
	top:8px;
}
	
table
{
	border-collapse:collapse;
}

font 
{ 
	color:white;
	font-size:20;
}
</style>
<script type="text/javascript" src="useless.js">
	
	</script>
</head>

	<body>
	<div id="box">
        <div id="maincolumn">	
	<table>
	<tr>
	<td class="maintd" onclick="display('general');" onmouseover="this.style.background='#C0C0C0'" onmouseout="this.style.background='#808080'"><font>General</font></td>
	
	</tr>

        	<tr>
      <td class="maintd" onclick="alert('clicked computational');" onmouseover="this.style.background='#C0C0C0'" onmouseout="this.style.background='#808080'"><font>Computational<font></td>
	</tr>
	<tr>
      <td class="maintd" onclick="alert('clicked open source');" onmouseover="this.style.background='#C0C0C0'" onmouseout="this.style.background='#808080'"><font>Open Source<font></td>
	</tr>

	<tr>
      <td class="maintd" onclick="alert('clicked topical');" onmouseover="this.style.background='#C0C0C0'" onmouseout="this.style.background='#808080'"><font>Topical</font></td>
	</tr>
	<tr>
      <td class="maintd" onclick="alert('clicked realtime');" onmouseover="this.style.background='#C0C0C0'" onmouseout="this.style.background='#808080'"><font>Realtime</font></td>
	</tr>
	<tr>
      <td class="maintd" onclick="alert('clicked directories');" onmouseover="this.style.background='#C0C0C0'" onmouseout="this.style.background='#808080'"><font>Directories</font></td>
	</tr>
	<tr>
      <td class="maintd" onclick="alert('clicked meta');" onmouseover="this.style.background='#C0C0C0'" onmouseout="this.style.background='#808080'"><font>Meta</font></td>
	</tr>
	 <td class="maintd" onclick="alert('clicked Source Code');" onmouseover="this.style.background='#C0C0C0'" onmouseout="this.style.background='#808080'"><font>Source Code</font></td>
	</tr>
	<td class="maintd" onclick="alert('clicked Blog');" onmouseover="this.style.background='#C0C0C0'" onmouseout="this.style.background='#808080'"><font>Blog</font></td>
	</tr>


	</table>
	</div>		
		<div id="initial" class="list">
		<font> Select a category.</font>
		</div>
	
		<div id="general" class="list">
		<div class="move">
		<table>
		<tr>
		<td class="listtd" onmouseover="{document.getElementById('google').style.color='#C0C0C0'; document.getElementById('google').style.fontSize=23;}" onmouseout="{document.getElementById('google').style.color='white';document.getElementById('google').style.fontSize=20;}" onclick="redirect('google')"><font id='google'>Google</font></td>

		<td class="listtd" onmouseover="{document.getElementById('altavista').style.color='#C0C0C0'; document.getElementById('altavista').style.fontSize=23;}" onmouseout="{document.getElementById('altavista').style.color='white';document.getElementById('altavista').style.fontSize=20;}" onclick="alert('clicked altavista')"><font id='altavista'>Altavista</font></td>		
</tr>



	<tr>
		<td class="listtd" onmouseover="{document.getElementById('yahoo').style.color='#C0C0C0'; document.getElementById('yahoo').style.fontSize=23;}" onmouseout="{document.getElementById('yahoo').style.color='white';document.getElementById('yahoo').style.fontSize=20;}" onclick="alert('clicked yahoo')"><font id='yahoo'>Yahoo!</font></td>
		<td class="listtd "onmouseover="{document.getElementById('Kosmix').style.color='#C0C0C0'; document.getElementById('Kosmix').style.fontSize=23;}" onmouseout="{document.getElementById('Kosmix').style.color='white';document.getElementById('Kosmix').style.fontSize=20;}" onclick="alert('clicked Kosmix')"><font id='Kosmix'>Kosmix</font></td>
	
	</tr>
	<tr>
		<td class="listtd "onmouseover="{document.getElementById('bing').style.color='#C0C0C0'; document.getElementById('bing').style.fontSize=23;}" onmouseout="{document.getElementById('bing').style.color='white';document.getElementById('bing').style.fontSize=20;}" onclick="alert('clicked bing')"><font id='bing'>Bing</font></td>
	<td class="listtd "onmouseover="{document.getElementById('Blekko').style.color='#C0C0C0'; document.getElementById('Blekko').style.fontSize=23;}" onmouseout="{document.getElementById('Blekko').style.color='white';document.getElementById('Blekko').style.fontSize=20;}" onclick="alert('clicked Blekko')"><font id='Blekko'>Blekko</font></td>
	
	</tr>
	<td class="listtd "onmouseover="{document.getElementById('aol').style.color='#C0C0C0'; document.getElementById('aol').style.fontSize=23;}" onmouseout="{document.getElementById('aol').style.color='white';document.getElementById('aol').style.fontSize=20;}" onclick="alert('clicked aol')"><font id='aol'>AOL</font></td>
		
	<td class="listtd "onmouseover="{document.getElementById('Yedol').style.color='#C0C0C0'; document.getElementById('Yedol').style.fontSize=23;}" onmouseout="{document.getElementById('Yedol').style.color='white';document.getElementById('Yedol').style.fontSize=20;}" onclick="alert('clicked Yedol')"><font id='Yedol'>Yedol</font></td>
	
</tr>
	
      	</table>
	</div>
	</div>
	</div>
	
</body>
</html>
