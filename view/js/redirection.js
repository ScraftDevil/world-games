var segundos = 3;
	function tiempo(){  
		var t = setTimeout("tiempo()",1000);
		if (segundos > 0) {
		document.getElementById('contenedor').innerHTML = segundos;
	}
		segundos--;
		
		if (segundos==-1){
			window.location.href='../';
			clearTimeout(t);
		}
	}  
tiempo();