<div style="width:600px; text-align:left ">
	<p><a href="index.php?p=bregistros"  onClick="return confirmarBajaRegistros();"><img src="../imagenes/delete.jpg" /> Borrar todos los registros (alumnos, reservaciones) de la base de datos.</a></p>
	<p><a href="index.php?p=bcomentarios" onClick="return confirmarBajaComentarios();"><img src="../imagenes/delete.jpg" /> Borrar comentarios de la base de datos.</a></p>
</div>

<script>
	function confirmarBajaRegistros() {
		var ok = confirm("¿Deseas eliminar todos los registros de la base de datos? Recuerda que una vez borrados no podrán ser recuperados.");
		if(ok) {
			return true;
		}
		return false;
	}
	
	function confirmarBajaComentarios() {
		var ok = confirm("¿Deseas eliminar todos los comentarios de la base de datos? Recuerda que una vez borrados no podrán ser recuperados.");
		if(ok) {
			return true;
		}
		return false;
	}
</script>