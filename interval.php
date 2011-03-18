<html>
	<head>
		<style>
		#generallist
		{
			background-color:black;
			border:1px solid black;
			width:400px;
			height:150px;
            cursor:default;
			opacity:0.6;
			  }
			font
			{
				color:white;
				font-size:20;
			}
			
		</style>
				</head>
	<body>
	
	<div id="generallist">
	<table>
	<tr>
		<td onmouseover="{document.getElementById('google').style.color='#C0C0C0'; document.getElementById('google').style.fontSize=23;}" onmouseout="{document.getElementById('google').style.color='white';document.getElementById('google').style.fontSize=20;}" onclick="alert('clicked google')"><font id='google'>Google</font></td>
<td onmouseover="{document.getElementById('altavista').style.color='#C0C0C0'; document.getElementById('altavista').style.fontSize=23;}" onmouseout="{document.getElementById('altavista').style.color='white';document.getElementById('altavista').style.fontSize=20;}" onclick="alert('clicked altavista')"><font id='altavista'>Altavista</font></td>		
	</tr>
	<tr>
		<td onmouseover="{document.getElementById('yahoo').style.color='#C0C0C0'; document.getElementById('yahoo').style.fontSize=23;}" onmouseout="{document.getElementById('yahoo').style.color='white';document.getElementById('yahoo').style.fontSize=20;}" onclick="alert('clicked yahoo')"><font id='yahoo'>Yahoo!</font></td>
	</tr>
	<tr>
		<td onmouseover="{document.getElementById('bing').style.color='#C0C0C0'; document.getElementById('bing').style.fontSize=23;}" onmouseout="{document.getElementById('bing').style.color='white';document.getElementById('bing').style.fontSize=20;}" onclick="alert('clicked bing')"><font id='bing'>Bing</font></td>
	</tr>

	</table>
	</div>
	</body>
	</html>
	
		