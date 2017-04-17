<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Buscar Recursos</title>
    </head>

    <body>

      <p class="multilingual">selecciona_recursos</p>

      <form action="index.php?p=buscadorRec" method="post" id="forma-recursos">

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
        <button class="multilingual" onclick="submitForm()">seleccionar</button>
      </form>
      <script>
        function submitForm() {
          document.getElementById('forma-recursos').submit();
        }
      </script>
    </body>
</html>
