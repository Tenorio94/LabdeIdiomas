<?php
    //Abrir conexion con la base de datos
	$idiomas = getConection();

    $salonesInactivos = $idiomas->query("SELECT idSalon FROM tbl_salones WHERE isActive = 0;");
    $salonesActivos = $idiomas->query("SELECT idSalon from tbl_salones WHERE isActive = 1");
?>

<?php if ($salonesInactivos->num_rows > 0) { ?>
    <form name="activarSalon" method="POST" action="index.php?p=salonesBD">
        <h2> Activación de salones </h2>
        <input type="hidden" name="action" value="activa"/>
        <span>Salón: </span>
        <select name="salon">
            <?php while($salon = $salonesInactivos->fetch_assoc()) { ?>
                <option><?php echo $salon["idSalon"] ?></option>
            <?php } ?>
        </select>
        <input class="salonesSubmit" type="submit" name="activar" value="Activar">
    </form>
<?php } ?>

<?php if ($salonesActivos->num_rows > 0) { ?>
    <form name="desActivarSalon" method="POST" action="index.php?p=salonesBD">
        <h2> Desactivación de salones </h2>
        <input type="hidden" name="action" value="desactiva"/>
        <span>Salón: </span>
        <select name="salon">
            <?php while($salon = $salonesActivos->fetch_assoc()) { ?>
                <option><?php echo $salon["idSalon"] ?></option>
            <?php } ?>
        </select>
        <input class="salonesSubmit" type="submit" name="desactivar" value="Desactivar">
    </form>
<?php } ?>

    <form name="altaSalon" method="POST" action="index.php?p=salonesBD">
        <h2> Alta de salones </h2>
        <input type="hidden" name="action" value="alta"/>
        <p><label>Salón: <input type="text" name="salon" maxlength="3" size="3"></label>
            <input class="salonesSubmit" type="submit" name="desactivar" value="Alta">
        </p>
        <p><label>¿Activo? <input type="checkbox" name="active" /></label></p>
    </form>