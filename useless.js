

function showbox()
{
	var query=document.getElementById('query').value;
	var ajaxRequest;
try{
	ajaxRequest=new XMLHttpRequest();

}

catch(e)
{
	try{
		ajaxRequest=new ActiveXObject("Msxml2.XMLHTTP");
	}

	catch(e)
	{
		try{
			ajaxRequest=new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(e)
		{
		}
	}
}
ajaxRequest.onreadystatechange=function()
{
		if(ajaxRequest.readyState==4)
			document.getElementById("selectbox").innerHTML=ajaxRequest.responseText;

}
var querystr="?query="+query;
ajaxRequest.open("GET","useless.php"+querystr,true);
ajaxRequest.send(null);
}
function display(str)
{
		var temp=document.getElementsByClassName('list');
		for(i=0;i<temp.length;i++)
			temp[i].style.visibility='hidden';	
		if(str=='general')
		{				
			document.getElementById('general').style.visibility='visible';
			
		}

}
function redirect(str)
{
	


	var query=document.getElementById('query').value;


	if(str=='google')
		{
		window.location='http://www.google.com/search?hl=en&q='+query;
}	
}
