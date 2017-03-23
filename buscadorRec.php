<?php ?>
<!DOCTYPE html>
<html>
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  </head>
  <body>
    <p>Selecciona el tema para desplegar sus recursos disponibles:</p>

      <form action="index.php?p=buscadorRec" method="post">

        <select id="temas" name="temas">
          <option value="grammar">Grammar</option>
          <option value="business">Business and Specific Purposes</option>
          <option value="dictionary">Dictionary</option>
          <option value="teaching">Teaching</option>
          <option value="listenning">Listening</option>
          <option value="reading">Reading</option>
          <option value="writting">Writing</option>
          <option value="speaking">Speaking</option>
        </select>
        <input type="submit" value="Seleccionar">
    <?php

    // Create connection
    $con=mysqli_connect("localhost","wlmuser1","landpeac","wlmreservacion");

    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    if(isset($_POST['temas'])) {
      $tema = $_POST['temas'];

    ?>

      <?php if($tema=="listenning"){ ?>
      <h1>Recursos para Listening</h1>

      <?php }else if($tema=="writting"){ ?>
      <h1>Recursos para Writing</h1>

      <?php }else if($tema=="business"){ ?>
      <h1>Recursos para Business and Specific Purposes</h1>

      <?php }else{ ?>
      <br>
      <h1>Recursos para <?=ucfirst($tema);?></h1>
      <hr>
      <?php } ?>



    <?php

      	$result = mysqli_query($con,"SELECT * FROM resource WHERE Tags LIKE '%".$tema ."%'");
        $resultado = array();
          // Nmero de renglones del resultado de la consulta
          
        // Realiza el fetch al arreglo, con el modo asociativo y de ndice
        for ($i = 0; $i < $result->num_rows; $i++)
          $resultado[$i] = mysqli_fetch_array($result, MYSQL_BOTH);

        while($resource = mysqli_fetch_array($result)) {

          if ($resource['year'] == "") {
            $resource['year'] = "<i>No hay informaci&oacute;n</i>";
          } else {
            $resource['year'] = date("Y",strtotime($resource['year']));
          }

          if ($resource['image_url'] == ""){
            $resource['image_url'] = "../imagenes/no_cover.jpg";
          }

          switch($resource['type']){
            case '0' : $resource_type = "Otro";
              break;
            case '1' : $resource_type = "Libro";
              break;
            case '2' : $resource_type = "DVD";
              break;
            case '3' : $resource_type = "CD";
              break;
            case '4' : $resource_type = "Libro y CD";
              break;
            case '6' : $resource_type = "Access Key";
              break;
          }
    ?>

 <img src="<?=$resource['image_url']?>"/>
  <p>
      <strong><?=$resource['name']?></strong> (<?=$resource_type?>)<br/>
      <i><?=$resource['author']?></i><br/>
      ISBN: <?=$resource['ISBN']?><br/>
      Fecha de Publicaci&oacute;n: <?=$resource['year']?>
      <form class="" target="_blank" action="indice.php?id=<?=$resource['id']?>" method="post">
        <input target="_blank" type="submit" name="submitId" value="Ver contenido">
      </form>
  </p>
    <p style="text-align:justify;">
      <?=$resource['description']?>
    </p>
    <div class="clear"></div>
        <hr>

    <?php
    }
    }
    ?>
  </body>
</html>
