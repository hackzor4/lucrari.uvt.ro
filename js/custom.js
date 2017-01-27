function show(x){
	var divmail = document.getElementsByClassName('divmail')[0];
	divmail.style.display = "none";
	var divdreamspark = document.getElementsByClassName('divdreamspark')[0];
	divdreamspark.style.display = "none";
	var divanelis = document.getElementsByClassName('divanelis')[0];
	divanelis.style.display = "none";
	var divstudentweb = document.getElementsByClassName('divstudentweb')[0];
	divstudentweb.style.display = "none";
	var divelearning = document.getElementsByClassName('divelearning')[0];
	divelearning.style.display = "none";
	var divph = document.getElementsByClassName('divph')[0];
	divph.style.display = "none";
	//var divsugestii = document.getElementsByClassName('divsugestii')[0];
	//divsugestii.style.display = "none";
	var divDCT = document.getElementsByClassName('divDCT')[0];
	divDCT.style.display = "none";
	var divlists = document.getElementsByClassName('divlists')[0];
	divlists.style.display = "none";
	var y = document.getElementsByClassName(x)[0];
	y.style.display= 'block';

}
function hide(x){
	var y = document.getElementsByClassName(x)[0];
	y.style.display = 'none';
	var z = document.getElementsByClassName('divlists');
	z[0].style.display = 'none';	
}

function select_inregistrare(id){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
	//document.getElementById("tabel").style.display = "none";
	document.getElementById("demo").innerHTML = xhttp.responseText;
	//location.reload();
    }
  };
  xhttp.open("GET", "select.php?q="+id, true);
  xhttp.send();	
	
}
function sterge_inregistrare(id){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
	alert("Lucrarea cu ID-ul: "+id+" a fost stearsa.");
	location.reload();
    }
  };
  xhttp.open("GET", "delete.php?q="+id, true);
  xhttp.send();	
}

function editeaza_inregistrare(id){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
	
    }
  };
  xhttp.open("GET", "update.php?q="+id, true);
  xhttp.send();	
	
}

function aplica_inregistrare(id){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
	location.reload();
    }
  };
  xhttp.open("GET", "aplica_inregistrare.php?q="+id, true);
  xhttp.send();	
	
}

function aproba_inregistrare(id){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
	location.reload();
    }
  };
  xhttp.open("GET", "aproba_inregistrare.php?q="+id, true);
  xhttp.send();	
	
}

function refuza_inregistrare(id){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
	location.reload();
    }
  };
  xhttp.open("GET", "refuza_inregistrare.php?q="+id, true);
  xhttp.send();	
	
}

function genereaza_pdf(id){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
	alert(xhttp.responseText);
	location.reload();
    }
  };
  xhttp.open("GET", "generare_pdf.php?q="+id, true);
  xhttp.send();	
}



