<script src="../recursos/js/jquery-3.1.1.min.js"></script>
<script src="../recursos/js/jquery-ui.js"></script>

<link src="../recursos/css/jquery-ui.structure.css"></link>
<link src="../recursos/css/jquery-ui.theme.css"></link>
<link rel="stylesheet" type="text/css" media="all"
		href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/smoothness/jquery-ui.css"/>
<style>
	table, th, td {
		border: 1px solid black;
	}
</style>

<form name="form3" method="POST" action="index.php?p=semanasBD">
    
  <p align="center" class="titulo">Cambiar Semanas</p>
  	<table border="1" align="center" class="contenido">
    <tr> 
      <td>&nbsp;</td>
      <td class="titulo1" align="center">D&iacute;a</td>
      <td class="titulo1" align="center">Mes</td>
	  <td class="titulo1" align="center">Asueto</td>
    </tr>
    <tr> 
      <td align="right" class="titulo1">Lunes:</td>
      <td align="center"><input type="text" name="lunes" size="2" maxlength="2"></td>
      <td align="center">
			<select name="lunesm">
				<option selected value="---">---- ----</option>
				<option value="enero">Enero</option>
				<option value="febrero">Febrero</option>
				<option value="marzo">Marzo</option>
				<option value="abril">Abril</option>
				<option value="mayo">Mayo</option>
				<option value="junio">Junio</option>
				<option value="julio">Julio</option>
				<option value="agosto">Agosto</option>
				<option value="septiembre">Septiembre</option>
				<option value="octubre">Octubre</option>
				<option value="noviembre">Noviembre</option>
				<option value="diciembre">Diciembre</option>
       		</select>
		</td>
		<td><input type="checkbox" name="lunes_asueto" size="2" maxlength="2" value="1"></td>
    </tr>
    <tr> 
      <td align="right" class="titulo1">Martes:</td>
      <td align="center"><input type="text" name="martes" size="2" maxlength="2"></td>
      <td align="center">			<select name="martesm">
			<option selected value="---">---- ----</option>
			<option value="enero">Enero</option>
			<option value="febrero">Febrero</option>
			<option value="marzo">Marzo</option>
			<option value="abril">Abril</option>
			<option value="mayo">Mayo</option>
			<option value="junio">Junio</option>
			<option value="julio">Julio</option>
			<option value="agosto">Agosto</option>
			<option value="septiembre">Septiembre</option>
			<option value="octubre">Octubre</option>
			<option value="noviembre">Noviembre</option>
			<option value="diciembre">Diciembre</option>
        </select></td>
		<td><input type="checkbox" name="martes_asueto" size="2" maxlength="2" value="1"></td>
    </tr>
    <tr> 
      <td align="right" class="titulo1">Mi&eacute;rcoles:</td>
      <td align="center"><input type="text" name="miercoles" size="2" maxlength="2"></td>
      <td align="center">
						<select name="miercolesm">
			<option selected value="---">---- ----</option>
			<option value="enero">Enero</option>
			<option value="febrero">Febrero</option>
			<option value="marzo">Marzo</option>
			<option value="abril">Abril</option>
			<option value="mayo">Mayo</option>
			<option value="junio">Junio</option>
			<option value="julio">Julio</option>
			<option value="agosto">Agosto</option>
			<option value="septiembre">Septiembre</option>
			<option value="octubre">Octubre</option>
			<option value="noviembre">Noviembre</option>
			<option value="diciembre">Diciembre</option>
        </select>
			</td>
			<td><input type="checkbox" name="miercoles_asueto" size="2" maxlength="2" value="1"></td>
    </tr>
    <tr> 
      <td align="right" class="titulo1">Jueves:</td>
      <td align="center"><input type="text" name="jueves" size="2" maxlength="2"></td>
      <td align="center">
						<select name="juevesm">
			<option selected value="---">---- ----</option>
			<option value="enero">Enero</option>
			<option value="febrero">Febrero</option>
			<option value="marzo">Marzo</option>
			<option value="abril">Abril</option>
			<option value="mayo">Mayo</option>
			<option value="junio">Junio</option>
			<option value="julio">Julio</option>
			<option value="agosto">Agosto</option>
			<option value="septiembre">Septiembre</option>
			<option value="octubre">Octubre</option>
			<option value="noviembre">Noviembre</option>
			<option value="diciembre">Diciembre</option>
        </select>
			</td>
			<td><input type="checkbox" name="jueves_asueto" size="2" maxlength="2" value="1"></td>
    </tr>
    <tr> 
      <td class="titulo1" align="right">Viernes:</td>
      <td align="center"><input type="text" name="viernes" size="2" maxlength="2"></td>
      <td align="center">
						<select name="viernesm">
			<option selected value="---">---- ----</option>
			<option value="enero">Enero</option>
			<option value="febrero">Febrero</option>
			<option value="marzo">Marzo</option>
			<option value="abril">Abril</option>
			<option value="mayo">Mayo</option>
			<option value="junio">Junio</option>
			<option value="julio">Julio</option>
			<option value="agosto">Agosto</option>
			<option value="septiembre">Septiembre</option>
			<option value="octubre">Octubre</option>
			<option value="noviembre">Noviembre</option>
			<option value="diciembre">Diciembre</option>
        </select>
			</td>
			<td><input type="checkbox" name="viernes_asueto" size="2" maxlength="2" value="1"></td>
    </tr>
    <tr> 
      <td class="titulo1">S&aacute;bado:</td>
      <td align="center"><input type="text" name="sabado" size="2" maxlength="2"></td>
      <td align="center">
						<select name="sabadom">
			<option selected value="---">---- ----</option>
			<option value="enero">Enero</option>
			<option value="febrero">Febrero</option>
			<option value="marzo">Marzo</option>
			<option value="abril">Abril</option>
			<option value="mayo">Mayo</option>
			<option value="junio">Junio</option>
			<option value="julio">Julio</option>
			<option value="agosto">Agosto</option>
			<option value="septiembre">Septiembre</option>
			<option value="octubre">Octubre</option>
			<option value="noviembre">Noviembre</option>
			<option value="diciembre">Diciembre</option>
        </select>
			</td>
			<td><input type="checkbox" name="sabado_asueto" size="2" maxlength="2" value="1"></td>
    </tr>
  	<tr> 
    <td colspan="3" align="center">
        <input type="submit" name="Submit" value="Aceptar">
   	</td>
   </tr>
   </table>

</form>

<p>Fecha Asueto: <input type="text" id="datepicker"></p>
<button id="add-date" onclick="addVacation()">Agregar asueto</button>
<table id="vacation-dates">

</table>

<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  });

	function addVacation() {
		if($("#datepicker").val() !== ""){
			var date = $("#datepicker").datepicker("getDate");
			var table = document.getElementById("vacation-dates");
		    var row = table.insertRow(-1);
		    var cell1 = row.insertCell(0);
		    var cell2 = row.insertCell(1);
		    cell1.innerHTML = date;
		    cell2.innerHTML = '<button type="button" onclick="deleteRow(this.parentNode.parentNode)">Delete</button>';
    	$("#datepicker").val("");
		}
	}

	function deleteRow(row) {
		alert(row.rowIndex);
		document.getElementById("vacation-dates").deleteRow(row.rowIndex);

	}
	
</script>



