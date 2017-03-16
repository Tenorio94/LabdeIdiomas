<?php
//CUALQUIER CAMBIO QUE SE DESEE HACER AQUI VERIFICAR QUE TAMBIEN SE ADAPTO "resultados.php"

//Se definen las preguntas.
$preguntas=array("Casi siempre estudio en un lugar en donde puedo concentrarme.",
"Cuando estoy aprendiendo algo, trato de identificar las partes m&aacutes importantes.",
"Cuando estoy tratando de aprender algo, frecuentemente elaboro un plan de trabajo y me apego a el lo mas posible.",
"Cuando no entiendo algo que estoy tratando de aprender, vuelvo a leerlo y trato de entenderlo.",
"Cuando no entiendo algo, busco asesor&iacutea o le pido a alguien que me aconseje.",
"Cuando estoy tratando de aprender algo, organizo mi horario para dedicar regularmente un tiempo para estudiar <br>o repasar mis notas.",
"Siempre tomo notas o apuntes y luego los reviso.",
"Hago bosquejos, diagramas o tablas para ayudarme a entender lo que quiero aprender.",
"Cuando aprendo algo nuevo, luego trato de relacionarlo con algo que ya conozco.",
"Siempre trato de poner en pr&aacutectica lo que acabo de aprender.",
"Eval&uacuteo mis avances de manera frecuente.",
"Hago listas de lo que considero importante y trato de memorizarlo.",
"Procuro mantenerme al corriente en mis metas de aprendizaje.",
"Trato de identificar los recursos que podr&iacutean serme &uacutetiles en mi aprendizaje.",
"Reconozco f&aacutecilmente las &aacutereas en las que necesito esforzarme m&aacutes.");
?>
<script>
	function cambiar(radio) {
		if(radio.checked) {
			var div=document.getElementById("presentoTOEFL");
			if(radio.value=="Si") {
				div.innerHTML="<p>Puntaje global en TOEFL: <input id='puntajeTOEFL' name='puntajeTOEFL' type='number' class='mandatory'></p>";
				div.innerHTML+="<p>Puntaje en la seccion de 'Listening': <input id='puntajeListening' name='puntajeListening' type='number' class='mandatory'></p>";
				div.innerHTML+="<p>Puntaje en la seccion de 'Structure and Written Expression': <input id='puntajeWritten' name='puntajeWritten' type='number' class='mandatory'></p>";
				div.innerHTML+="<p>Puntaje en la seccion de 'Reading': <input id='puntajeReading' name='puntajeReading' type='number' class='mandatory'></p>";
				cargar();
			}
			else {
				div.innerHTML="<p>Porfavor conteste esta evaluaci&oacuten para determinar su nivel en el idioma ingl&eacutes: <a target='_tab' href='http://www.transparent.com/learn-english-spanish/proficiency-test.html'>click aqu&iacute </a></p>";	
				div.innerHTML+="<p>Introduzca el resultado alcanzado en la prueba (ej. 'Advanced', 'Beginner', etc): <input id='puntajeAlcanzado' name='puntajeAlcanzado' type='textbox' class='mandatory'	 ></p>";
				cargar();
			}
		}
	}
	function empty() {
		if(confirm("Realmente desea vaciar la formula?")) {
			var oblig=document.getElementsByClassName("missing");
			for(var i=oblig.length-1; i>=0; i--) {
				if(oblig[i].type=="radio") {
					oblig[i].parentNode.removeChild(oblig[i].parentNode.children[0]);
				}
				else {
					deleteError(oblig[i].parentNode);
				}
				oblig[i].className="mandatory";
			}
			return true;
		}
		return false;
	}
	function check() {
		var oblig=document.getElementsByClassName("mandatory");
		for(var i=oblig.length-1; i>=0; i--) {
			if(oblig[i].type=="radio") {
				var radio=document.getElementsByName(oblig[i].name);
				var checked=false;
				for(var j=0; j<radio.length; j++) {
					if(radio[j].checked) {
						checked=true;
						break;
					}
				}
				if(!checked) {
					var texto=document.createElement("a");
					texto.appendChild(document.createTextNode("Seleccione uno de los siguientes."));
					texto.className="error";
					oblig[i].parentNode.insertBefore(texto, oblig[i].parentNode.children[0]);
					oblig[i].className="missing";
				}
			}
			else if(oblig[i].tagName=="SELECT"&&oblig[i].selectedIndex==0) {
				addError(oblig[i].parentNode, "Seleccione uno de los siguientes.");
				oblig[i].className="missing";
			}
			else if(oblig[i].value=="") {
				addError(oblig[i].parentNode, "El campo es obligatorio.");
				oblig[i].className="missing";
			}
			else if(oblig[i].type=="email"&&!validCorreo(oblig[i].value)) {
				addError(oblig[i].parentNode, "El correo no es válido.");
				oblig[i].className="missing";
			}
		}
		var mis=document.getElementsByClassName("missing");
		if(mis.length>0) {
			alert("Porfavor llene todos los campos que obligatorios");
			return false;
		}
		return true;
	}
	function cargar() {
		var nums=document.getElementsByTagName("input");
		for(var i=0; i<nums.length; i++) {
			if(nums[i].type=="number") {
				nums[i].onkeyup=numeros;
				nums[i].onchange=numeros;
			}
			else if(nums[i].type=="radio") {
				nums[i].onclick=radio;
			}
			else if(nums[i].type=="email") {
				nums[i].onkeyup=correo;
				nums[i].onchange=correo;
			}
		}
		var obligs=document.getElementsByClassName("mandatory");
		for(var i=0; i<nums.length; i++) {
			if(obligs[i].tagName=="SELECT") {
				obligs[i].onchange=select;
			}
			else if(obligs[i].type!="number"&&obligs[i].type!="email") {
				obligs[i].onkeyup=obligtext;
				obligs[i].onchange=obligtext;
			}
		}
	}
	function select() {
		if(this.selectedIndex!=0&&this.className=="missing") {
			this.className="mandatory";
			deleteError(this.parentNode);
		}
		else if(this.selectedIndex==0&&this.className=="mandatory") {
			addError(this.parentNode, "Seleccione uno de los siguientes.");
			this.className="missing";
		}
	}
	function obligtext() {
		if(this.value==""&&this.className=="mandatory") {
			this.className="missing";
			addError(this.parentNode, "El campo es obligatorio.");
		}
		else if(this.value!=""&&this.className=="missing"){
			this.className="mandatory";
			deleteError(this.parentNode);
		}
	}
	function correo() {
		if(validCorreo(this.value)&&this.className=="missing"){
			this.className="mandatory";
			deleteError(this.parentNode);
		}
	}
	function validCorreo(correo) {
		var cont=0;
		while(cont<correo.length&&correo[cont]!='@') {
			cont++;
		}
		var cont2=cont+1;
		if(cont!=0&&cont<correo.length) cont++;
		else return false;
		while(cont<correo.length&&correo[cont]!='.') {
			cont++;
		}
		if(cont>cont2&&cont<correo.length-1) cont++;
		else return false;
		return true;
	}
	function addError(node, msg) {
			var texto=document.createElement("a");
			texto.appendChild(document.createTextNode(msg));
			texto.className="error";
			node.appendChild(texto);
			node.className="error";
	}
	function deleteError(node) {
		node.className="";
		if(node.lastChild.tagName=="A") {
			node.removeChild(node.lastChild);
		}
	}
	function radio() {
		var nodo=this.parentNode;
		if(nodo.children[0].tagName=="A") {
			nodo.removeChild(nodo.children[0]); 
		}
	}
	function numeros (){
		var str=this.value;
		if(str==""||str<0) {
			if(this.className=="mandatory"||this.className=="numero") {
				this.className="missing";
				addError(this.parentNode, "No es un numero valido.");
			}
		}
		else {
			if(this.className=="missing") {
				this.className="mandatory";
				deleteError(this.parentNode);
			}
		}
	}
</script>
<style>
p,h3, legend {text-align:left; position:relative}
input.mandatory {}
input.missing {border: 3px ridge #FF6060;}
a.error {color: #FF6060;}
p.error {color: #FF6060; font-weight: bold;}
</style>
<body onload='cargar()'>
</body>
<h3>&nbsp&nbspBienvenido al sistema de auto diagn&oacutestico </h3>
<p>&nbsp&nbsp&nbspPor favor llena <b>todos</b> los campos</p>
<form action='index.php?p=resultados' onsubmit="return check()" method="post">
<fieldset>
<legend>Datos personales</legend>
<p>Nombre completo: <input id="nombre" name="nombre" type="textbox" class='mandatory'></p> 
<p>Matr&iacutecula o n&oacutemina: <input id="matricula" name="matricula" type="textbox" class='mandatory'></p> 
<p>Correo electr&oacutenico: <input id="correo" name="correo" type="email" class='mandatory'></p> 
</fieldset>
<br>
<fieldset>
<legend>TOEFL</legend>
<p>&iquestHa presentado el TOEFL? <br>
<input type="radio" name="TOEFL" value="Si" Checked onchange="cambiar(this)"> S&iacute <br>
<input type="radio" name="TOEFL" value="No" onchange="cambiar(this)"> No <br></p>
<div id="presentoTOEFL">
	<p>Puntaje global en TOEFL: <input id="puntajeTOEFL" name="puntajeTOEFL" type="number" class='mandatory'></p> 
	<p>Puntaje en la secci&oacuten de 'Listening': <input id="puntajeListening" name="puntajeListening" type="number" class='mandatory'></p> 
	<p>Puntaje en la secci&oacuten de 'Structure and Written Expression': <input id="puntajeWritten" name="puntajeWritten" type="number" class='mandatory'></p> 
	<p>Puntaje en la secci&oacuten de 'Reading': <input id="puntajeReading" name="puntajeReading" type="number" class='mandatory'></p> 
</div>
</fieldset>

<br>

<fieldset>
<legend>Habilidades</legend>
<p>Seleccione 3 opciones de habilidades que usted desea dominar.</p>
<p>
<select id="opcion1" name="opcion1">
	<option value="A">A</option>
	<option value="B">B</option>
	<option value="C">C</option>
	<option value="D">D</option>
	<option value="E">E</option>
	<option value="F">F</option>
	<option value="G">G</option>
	<option value="H">H</option>
	<option value="I">I</option>
</select>
<select id="opcion2" name="opcion2">
	<option value="A">A</option>
	<option value="B">B</option>
	<option value="C">C</option>
	<option value="D">D</option>
	<option value="E">E</option>
	<option value="F">F</option>
	<option value="G">G</option>
	<option value="H">H</option>
	<option value="I">I</option>
</select>
<select id="opcion3" name="opcion3">
	<option value="A">A</option>
	<option value="B">B</option>
	<option value="C">C</option>
	<option value="D">D</option>
	<option value="E">E</option>
	<option value="F">F</option>
	<option value="G">G</option>
	<option value="H">H</option>
	<option value="I">I</option>
</select>
</p>
<p>A  Leer textos ac&aacutedemicos eficientemente</p>
<p>B  Comprender conferencias</p>
<p>C  Comunicarse oralmente</p>
<p>D  Redactar reportes de investigaci&oacuten</p>
<p>E  Redactar documentos personales</p>
<p>F  Comunicarse a trav&eacutes del correo electr&oacutenico, participar en foros de discusi&oacuten y blogs.</p>
<p>G  Realizar estudios profesionales y/o de postgrado en el extranjero.</p>
<p>H  Presentar ponencias en el extranjero</p>
<p>I  Acreditar su nivel de dominio del idioma a trav&eacutes de una prueba estandarizada (TOEFL, IELTS, DELF, etc.)</p>
</fieldset>

<br>
<fieldset>
<legend>Preguntas</legend>
<p>Asigna un valor en una escala del 1 al 5 (1=completamente en desacuerdo, 5=completamente de acuerdo)</p>
<?php 
$opciones="<option value='1'>1</option>
	<option value='2'>2</option>
	<option value='3'>3</option>
	<option value='4'>4</option>
	<option value='5'>5</option>
	";
for($i=0; $i<count($preguntas); $i++) {
	echo "<p><select id='respuesta".($i+1)."' name='respuesta".($i+1)."'>".$opciones."</select>&nbsp".$preguntas[$i]."</p>";
}
?>
</fieldset>
<input type="submit" value="Enviar">
</form>