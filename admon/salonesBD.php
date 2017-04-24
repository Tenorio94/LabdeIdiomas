<?php

//Abriendo conexion con la base de datos
$idiomas = getConection();

//Obteniendo los datos de la forma
$salon = $_POST["salon"];
$accion = $_POST["action"];

$success = 0;

function deactivateSalon($salon, $idiomas) {
    //Guardando la informacion en la base de datos
    if($idiomas->query("UPDATE tbl_salones set isActive = 0 WHERE idSalon = '$salon'"))
        $success = 1;

    //Cerrando la conexion con la base de datos
    closeConection($idiomas);
    ?>
    <table>
    <?
    if(!$success) {		
    ?>
        <tr>
            <td><p><strong><font color="#333333" face="Verdana, Arial, Helvetica, sans-serif">
                    Lo sentimos, no fue posible guardar la información en nuestra base de datos.<br>
                    Intenta más tarde.</font></strong></p>
                <p>&nbsp;</p>
            </td>
        </tr>
    <? } else { ?>
        <tr>
            <td><p><strong><font color="#333333" face="Verdana, Arial, Helvetica, sans-serif">
                    El salón fue desactivado exitosamente.
                <p>&nbsp;</p>
            </td>
        </tr>
    <? } ?>

    </table>
<?php
}
?>

<?php
function activateSalon($salon, $idiomas) {
    //Guardando la informacion en la base de datos
    if($idiomas->query("UPDATE tbl_salones set isActive = 1 WHERE idSalon = '$salon'"))
        $success = 1;

    //Cerrando la conexion con la base de datos
    closeConection($idiomas);
    ?>
    <table>
    <?
    if(!$success) {		
    ?>
        <tr>
            <td><p><strong><font color="#333333" face="Verdana, Arial, Helvetica, sans-serif">
                    Lo sentimos, no fue posible guardar la información en nuestra base de datos.<br>
                    Intenta más tarde.</font></strong></p>
                <p>&nbsp;</p>
            </td>
        </tr>
    <? } else { ?>
        <tr>
            <td><p><strong><font color="#333333" face="Verdana, Arial, Helvetica, sans-serif">
                    El salón fue activado exitosamente.
                <p>&nbsp;</p>
            </td>
        </tr>
    <? } ?>

    </table>
<?php
}

function altaSalon($salon, $idiomas) { ?>
    <table>
    <?php 
    $salonExiste = $idiomas->query("SELECT idSalon FROM tbl_salones WHERE idSalon = '$salon';");
    if ($salonExiste->num_rows > 0) { ?>
        <tr>
            <td><p><strong><font color="#333333" face="Verdana, Arial, Helvetica, sans-serif">
                    Lo sentimos, el salón seleccionado ya existe en la base de datos</font></strong></p>
                <p>&nbsp;</p>
            </td>
        </tr>
    <?php }
    else {
        if (isset($_POST["active"])){
            if($idiomas->query("INSERT INTO tbl_salones (idSalon, isActive) VALUES ('$salon', 1);")) { ?>
                <tr>
                    <td><p><strong><font color="#333333" face="Verdana, Arial, Helvetica, sans-serif">
                            El salón fue dado de alta y activado exitosamente.
                        <p>&nbsp;</p>
                    </td>
                </tr>
            <?php }
            else { ?>
                <tr>
                    <td><p><strong><font color="#333333" face="Verdana, Arial, Helvetica, sans-serif">
                    Lo sentimos, no fue posible guardar la información en nuestra base de datos.<br>
                    Intenta más tarde.</font></strong></p>
                        <p>&nbsp;</p>
                    </td>
                </tr>
           <?php }
        }
        else {
            if($idiomas->query("INSERT INTO tbl_salones (idSalon, isActive) VALUES ('$salon', 0);")) { ?>
                <tr>
                    <td><p><strong><font color="#333333" face="Verdana, Arial, Helvetica, sans-serif">
                            El salón fue dado de alta y desactivado exitosamente.
                        <p>&nbsp;</p>
                    </td>
                </tr>
            <?php }
            else { ?>
                <tr>
                    <td><p><strong><font color="#333333" face="Verdana, Arial, Helvetica, sans-serif">
                    Lo sentimos, no fue posible guardar la información en nuestra base de datos.<br>
                    Intenta más tarde.</font></strong></p>
                        <p>&nbsp;</p>
                    </td>
                </tr>
           <?php }
        }
    } ?>
    </table>
<?php } ?>

<?php
switch ($accion) {
    case 'desactiva' :
        deactivateSalon($salon, $idiomas);
        break;
    case 'activa' :
        activateSalon($salon, $idiomas);
        break;
    case 'alta' :
        altaSalon($salon, $idiomas);
        break;
}
?>