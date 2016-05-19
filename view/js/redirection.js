var segundos = 3;
	function tiempo(){  
		var t = setTimeout("tiempo()",1000);
		document.getElementById('contenedor').innerHTML = segundos--;
		
		if (segundos==0){
			window.location.href='../';
			clearTimeout(t);
		}
	}  
tiempo()