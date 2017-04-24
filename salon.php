<?php
if(($_SESSION['user'] == null && $_SESSION['user'] == '') || !hasChangedPassword()) { ?>
<script>
	location.href = 'index.php?p=uDes';
</script>
<? }
	$dia = $_REQUEST['d'];
	$mes = $_REQUEST["m"];
	$sem = $_REQUEST["s"];

	$idiomas = getConection();

	$salones_query = $idiomas->query("SELECT * FROM tbl_salones;");
?>

<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
	font-size: xx-small;
	font-weight: bold;
}
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #333333;
}
.style14 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: medium; }
.style15 {font-size: small}
.style17 {font-size: small; font-weight: bold; }
.style18 {color: #FFFFFF}
.style19 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: medium; color: #FFFFFF; }
-->
</style>

<table align="center">
	<tr>
		<td class="style2">
			Paso # 2: Selecciona el salón.
		</td>
	</tr>
</table>
<br>
	<table width="300" border="1" align="center" bordercolor="#336699" bgcolor="#FFFFFF">
    	<tr bordercolor="#336699">
		<?php
			while ($row_salonesquery = $salones_query->fetch_assoc()) {
				if ($row_salonesquery["isActive"]) { ?>
					<td align="center">
						<p class="style19"><a href="index.php?p=salon<?php echo $row_salonesquery["idSalon"]?>&d=<?php echo $dia .'&m=' . $mes . '&s=' . $sem;?>"><strong> Sal&oacute;n <?php echo $row_salonesquery["idSalon"]?> </strong></a></p>
						<p class="style19"><br>
							<span class="style17">
							<a href="index.php?p=<?php $row_salonesquery["idSalon"]?>&d=<?php echo $dia .'&m=' . $mes . '&s=' . $sem; ?>">Horario </a><br>
							<a href="index.php?p=<?php $row_salonesquery["idSalon"]?>&d=<?php echo $dia .'&m=' . $mes . '&s=' . $sem;?>">8:00 a 18:00</a></span>
						</p>
					</td>
		<?php 	}
			} ?>
      		
    	</tr>
	</table>





