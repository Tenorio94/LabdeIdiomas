<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Buscar Recursos</title>
    </head>

    <body>

      <p>Selecciona el tema para desplegar sus recursos disponibles:</p>

      <form action="index.php?p=buscadorRec" method="post">

        <select id="temas" name="temas">
          <option value="grammar">Grammar</option>
          <option value="business">Business Purposes</option>
          <option value="dictionary">Dictionary</option>
          <option value="teaching">Teaching</option>
          <option value="listenning">Listening</option>
          <option value="reading">Reading</option>
          <option value="writting">Writing</option>
          <option value="speaking">Speaking</option>
        </select>
        <input type="submit" value="Seleccionar">


      </form>
    </body>
</html>
