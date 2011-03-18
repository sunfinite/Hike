<html>
	<head>
		<script type="text/javascript">
		var click=0;
				function check()
				{
				if(click==0)
				{
		   			document.getElementById('check').innerHTML='Click';
					click=1;
				}
				else if(click==1)
				{
					click=0;
				}
				}

			function click()
			{
				alert("here");
				if(click==0)
				{
					if(check==1)
						document.getElementById('check').innerHTML='Ha';
					else if(check==2)
						document.getElementById('check').innerHTML='Hello';
				}
			}

			</script>
</head>

<body>
<p id="check" name="check" onclick="check();" onmouseover="if(click==0)this.innerHTML='Ha'" onmouseout="if(click==0)this.innerHTML='Hello'"> Hello</p>
</body>
</html>
