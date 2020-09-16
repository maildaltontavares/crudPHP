

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<script type="text/javascript">	 

	function fInicia(){
		document.getElementById("btAdd").addEventListener("click",function(){
			
			var uName = document.getElementById('nome').value;
		    window.opener.document.getElementById('username').value = uName ; 
		    window.opener.document.getElementById('col1').innerHTML = uName ; 
		    window.opener.document.getElementById('col2').innerHTML = uName ; 

		    pElem = document.createElement("p");
		    pElem.textContent=uName;
		    pElem.setAttribute("class","teste3");
		    
		    window.opener.document.getElementById('painel').appendChild(pElem);  
		    window.opener.document.getElementById('col3').innerHTML = "Col3";
			window.opener.document.getElementById('col3').setAttribute("class","modelo3"); 

			var lista=document.getElementById("listaElementos");
			var texto=document.getElementById("nome");
			var li=document.createElement("li");
			li.textContent=texto.value;
			lista.appendChild(li);
			texto.value = "";
			texto.focus();

		})

	}

    window.addEventListener("load",fInicia);//fecha a página

</script>
<body>
	Nome Usuario
	<input type="text" name="nome" id="nome"> 
	<button id="btAdd" >EnviaNome</button> 
 

</body>
</html>