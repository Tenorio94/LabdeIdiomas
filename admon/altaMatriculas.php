<p class="title" align="center">Alta de matrículas</p>
<table width="100%">
	<tbody>
		<tr>
			<!-- Alta de matriculas en grupo -->
			<td align="center" width="50%">
				<p class="title" align="center">En grupo</p>
				<form name="form" method="post" action="index.php?p=pamatriculasgpo" enctype="multipart/form-data">
					<table align="center">
						<tr>
							<td align="center">
								<input type="file" name="alumnos">
							</td>
						</tr>
						<tr>
							<td align="center">
								<input type="submit" name="Submit" value="Submit">
							</td>
						</tr>
					</table>
				</form>
			</td>
			<!-- Alta de matriculas individuales -->
			<td align="center" width="50%">
				<p class="title" align="center">Individuales</p>
				<form name="form" method="post" action="index.php?p=pamatriculasind">
					<table align="center" class="contenido">
						<tr>
							<td class="titulo1" align="right">Matrícula</td>
							<td><input type="text" name="matricula" size="10"></td>
						</tr>
						<tr>
							<td class="titulo1" align="right">Cantidad</td>
							<td><input type="text" name="cantidad" size="2" value="1"></td>
						</tr>
						<tr>
							<td colspan="2" align="center"><br><input type="submit" name="Submit" value="Aceptar"></td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
	</tbody>
</table>
<br><br><br>
