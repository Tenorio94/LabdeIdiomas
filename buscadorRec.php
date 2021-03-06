<?php ?>
<!DOCTYPE html>
<html>
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  </head>
  <body>
    <p class="multilingual">selecciona_recursos</p>

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
        <button class="multilingual" onclick="submitForm()">seleccionar</button>
    <?php

    // Create connection
    $idiomas = getConection();

    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    if(isset($_POST['temas'])) {
      $tema = $_POST['temas'];

    ?>

    <h1 class="multilingual">recursos_para</h1> 
    <h1><?=ucfirst($tema);?></h1>



    <?php

      	$result = $idiomas->query("SELECT * FROM resource WHERE Tags LIKE '%".$tema ."%'");
        $resultado = array();
          // Nmero de renglones del resultado de la consulta
          
        // Realiza el fetch al arreglo, con el modo asociativo y de ndice
        while($resource = $result->fetch_assoc()) {

          if ($resource['year'] == "") {
            $resource['year'] = "<i class='multilingual'>no_info</i>";
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
      <u class="multilingual">fecha_publ</u> <?=$resource['year']?>
      <form class="" target="_blank" action="indice.php?id=<?=$resource['id']?>" method="post">
        <input target="_blank" type="submit" name="submitId" value="Ver contenido">
        <button class="multilingual" onclick="submitForm()">ver_contenido</button>
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
    <script>
      function submitForm() {
        document.getElementById('forma-recursos').submit();
      }
    </script>
  </body>
</html>
