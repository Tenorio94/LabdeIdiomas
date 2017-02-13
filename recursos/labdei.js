
	
function verificaMat()
{
  strMat = document.form3.mat.value;

   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;
	 
		 for (i = 0; i < strMat.length && IsNumber == true; i++) 
      { 
      Char = strMat.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         	IsNumber = false;
  			alert("Sólo se aceptan números en la matrícula (Sin espacios)");
  			document.form3.mat.focus();
  			return false;
         }
      }
	  if(strMat < 100000)
	  {
	  		alert("La matrícula no es valida");
			document.form3.mat.focus();
	  }
	 
}

function valida()
{
	verificaMat();
	if(document.form3.mat.value == "")
		{
			alert("Favor de escribir su matrícula");
			document.form3.mat.focus();
		}
		else										
		{
			if(document.form3.hora.value == "0")
			{
				alert("Favor de seleccionar la hora para su reservación.");
				document.form3.hora.focus();
			}
		}
}



//AJAX functionality for includes.
function ajaxIncludeFunction(fileToInclude)
{
	var xmlHttp;
	try
  	{
  		// Firefox, Opera 8.0+, Safari
  		xmlHttp=new XMLHttpRequest();
  	}
	catch (e)
  	{
  		// Internet Explorer
  		try
   		{
    		xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    	}
  		catch (e)
    	{
    		try
      		{
      			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      		}
    		catch (e)
      		{
      			alert("Your browser does not support AJAX!");
      			return false;
      		}
    	}
  }
  
  xmlHttp.onreadystatechange=function()
  {
    if(xmlHttp.readyState==4)
      {
    	document.getElementById("contenidoPrincipal").innerHTML = xmlHttp.responseText;
      }
    }
  	xmlHttp.open("GET",fileToInclude,true);
  	xmlHttp.send(null);
  }
