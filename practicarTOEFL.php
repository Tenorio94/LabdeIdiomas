<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Untitled Document</title>

        <link rel="stylesheet" type="text/css" href="styleLista.css">

        <script type="text/javascript" src="CollapsibleLists.js"></script>
        <script>
        window.onload = function() {
          CollapsibleLists.apply();
        };

        function mandar(){
          var nombre = document.forms["formaEnviar"]["nombre"].value;
          var matricula = document.forms["formaEnviar"]["matricula"].value;
          var puntaje = document.forms["formaEnviar"]["puntaje"].value;
          var correo = document.forms["formaEnviar"]["correo"].value;
          var e = document.getElementById("niveles");
          var nivel = e.options[e.selectedIndex].value;
          var lblError;
          var error = false;
          
          if (nombre == null || nombre == "") {
              lblError =document.getElementById('msjErrorNombre');
              lblError.style.display = "";
              error = true;
          }
          else {
            lblError =document.getElementById('msjErrorNombre');
            lblError.style.display = "none";
          }

          if (matricula == null || matricula == "") {
              lblError =document.getElementById('msjErrorMatricula');
              lblError.style.display = "";
              error = true;
          }
          else {
            lblError =document.getElementById('msjErrorMatricula');
            lblError.style.display = "none";
          }

          if ((puntaje == null || puntaje == "") && (nivel == null || nivel == "")) {
                lblError =document.getElementById('msjErrorPuntaje');
                lblError.style.display = "";
                error = true;
          }
          else {
            if(puntaje == null || puntaje == ""){
              puntaje=nivel;
            }
            lblError =document.getElementById('msjErrorPuntaje');
            lblError.style.display = "none";
          }

          if (correo == null || correo == "") {
              lblError =document.getElementById('msjErrorCorreo');
              lblError.style.display = "";
              error = true;
          }
          else {
            lblError =document.getElementById('msjErrorCorreo');
            lblError.style.display = "none";
          }

          if (error){
            return false
          } else{
            mandado();
            return true;
          }

          console.log(puntaje);

        }


        function mandado(){
        	var lbExito = document.getElementById('lblExito');
			     lbExito.style.display = "";
        }

        function activarTOEFL(radio){
          var elemento;
          if(radio.checked) {
            if(radio.value=="Si") {
              elemento= document.getElementsByClassName("siToefl");
              elemento[0].style.display = "block";
              elemento[1].style.display = "block";
              elemento= document.getElementsByClassName("noToefl");
              elemento[0].style.display = "none";
              elemento[1].style.display = "none";
            }
            else {
              elemento= document.getElementsByClassName("noToefl");
              elemento[0].style.display = "block";
              elemento[1].style.display = "block";
              elemento= document.getElementsByClassName("siToefl");
              elemento[0].style.display = "none";
              elemento[1].style.display = "none";
            }
          }
        }

        </script>

    </head>

    <body>

      <form action="enviar.php" method="post" name="formaEnviar" onSubmit="return mandar()" target="_blank">

        <table align="left">
        <tr><td style="text-align:left;">Nombre: </td>
        					<td style="text-align:left;"><input type="text" name="nombre"></input><span id="msjErrorNombre" style="display:none" >*Por favor ingresa tu nombre.</span></td></tr>
        <tr><td style="text-align:left;">Matricula: </td>
                  <td style="text-align:left;"><input type="text" name="matricula"></input><span id="msjErrorMatricula" style="display:none" >*Por favor ingresa tu matricula.</span></td></tr>

        <tr><td style="text-align:left;">&iquestHas presentado el TOEFL? <br>
          <input type="radio" name="TOEFL" value="Si" onchange="activarTOEFL(this)"> S&iacute <br>
          <input type="radio" name="TOEFL" value="No" onchange="activarTOEFL(this)"> No <br></td></tr>

        <tr class="siToefl" style="display:none;"><td style="text-align:left;">Puntaje TOEFL: </td></tr>
        <tr class="siToefl" style="display:none;"><td style="text-align:left;"><input type="text" name="puntaje"></input><span id="msjErrorPuntaje" style="display:none" >*Por favor ingresa tu puntaje.</span></td></tr>

        <tr class="noToefl" style="display:none;"><td style="text-align:left;">Nivel: </td>
          <tr class="noToefl" style="display:none;"><td style="text-align:left;">
            <select id="niveles" name="niveles">
              <option value="0">Nivel A1</option>
              <option value="443">Nivel A2</option>
              <option value="473">Nivel B1</option>
              <option value="540">Nivel B2/C1</option>
            </select></td></tr>

        <tr><td style="text-align:left;">Correo: </td>
        						<td style="text-align:left;"><input type="text" name="correo"></input><span id="msjErrorCorreo" style="display:none" >*Por favor ingresa tu correo.</span></td></tr>
        </table>

        <br><br><br><br><br><br>

        <div style="clear: left; text-align:left;">
        <ul class="collapsibleList">
          <li>
            <span style= "color: #0B0080; text-decoration: underline;"> Morphology </span>
            <ul>
              <li>
                <span><input type="checkbox" name="temas[]" value="Nouns"> Nouns</span>
                <ul>
                  <li>Singular and Plural Nouns</li>
                  <li>Irregular Nouns</li>
                  <li>Quantifiers for Countable and Non-Countable Nouns</li>
                  <li>Noun Person, Noun Thing</li>
                  <li>Direct and Indirect Objects</li>
                  <li>Gerunds</li>
                  <li>Infinitives</li>
                </ul>
              </li>

               <li>
                <span><input type="checkbox" name="temas[]" value="Pronouns"> Pronouns</span>
                <ul>
                  <li>Subject and Object Pronouns</li>
                  <li>Possessive Pronouns</li>
                  <li>Reflexive Pronouns</li>
                  <li>Pronoun Reference</li>
                </ul>
              </li>
              
              <li>
                <span><input type="checkbox" name="temas[]" value="Adjectives"> Adjectives </span>
                <ul>
                  <li>Present Participles</li>
                  <li>Past Particples</li>
                  <li>Adjectives Ending in -ly</li>
                  <li>Predicate Adjectives</li>
                  <li>Position of Adjectives</li>
                </ul>
              </li>

              <li><input type="checkbox" name="temas[]" value="ComparativesSuperlatives"> Comparatives and Superlatives</li>

              <li>
                <span><input type="checkbox" name="temas[]" value="Verbs"> Verbs</span>
                <ul>
                  <li>Verb Forms</li>
                  <li>Verb Tenses</li>
                  <li>Verb Tenses and Sequence of Tenses</li>
                  <li>Active and Passive Voice</li>
                  <li>Causative Verbs: Have, Get, Make, Let</li>
                </ul>
              </li>

              <li>
                <span><input type="checkbox" name="temas[]" value="Adverbs"> Adverbs </span>
                <ul>
                  <li>Position of Adjectives</li>
                  <li>Adverbs of Frequency</li>
                </ul>
              </li>

              <li><input type="checkbox" name="temas[]" value="Prepositions"> Prepositions</li>

              <li><input type="checkbox" name="temas[]" value="Articles"> Articles</li>

              <li>
                <span> <input type="checkbox" name="temas[]" value="WordChoice"> Word Choice</span>
                <ul>
                  <li>Make and Do</li>
                  <li>Like, Unlike, and Alike</li>
                  <li>Other, Another, The Other</li>
                  <li>So and Such</li>
                  <li>Too and Enough</li>
                </ul>
              </li>

            </ul>
          </li>
          <li>
            <span style= "color: #0B0080; text-decoration: underline;">Syntax</span>
            <ul>

              <li>
                <span><input type="checkbox" name="temas[]" value="Phrases"> Phrases </span>
                <ul>
                  <li>Prepositional Phrases</li>
                  <li>Appositives</li>
                  <li>Modifying Phrases</li>
                </ul>
              </li>

              <li><input type="checkbox" name="temas[]" value="SVAgreement"> Subject-Verb Agreement</li>

              <li>
                <span><input type="checkbox" name="temas[]" value="InvertedSentences"> Inverted Sentences </span>
                <ul>
                  <li>with Question Words</li>
                  <li>with Negative Expressions</li>
                  <li>with Expressions of Place</li>
                  <li>with Comparisons</li>
                  <li>with Conditionals</li>
                </ul>
              </li>

              <li>
                <span><input type="checkbox" name="temas[]" value="Parallelism"> Parallelism in Phrases and Clauses </span>
                <ul>
                  <li>Parts of Speech</li>
                  <li>Paired Conjunctions</li>
                  <li>Comparatives</li>
                </ul>
              </li>

                  <li><span><input type="checkbox" name="temas[]" value="SimpleSentences"> Simple Sentences </span></li>

                  <li><span><input type="checkbox" name="temas[]" value="CompoundSentences"> Compound Sentences </span></li>

                  <li>
                    <span><input type="checkbox" name="temas[]" value="ComplexSentences"> Complex Sentences </span>
                    <ul>
                      
                      <li>Principal/Main Clauses</li>

                      <li>
                        Subourdinate/Dependent Clauses
                        <ul>
                          <li>Adjective Subourdinate Clauses</li>
                          <li>Adverb Subourdinate Clauses</li>
                          <li>Noun Subourdinate Clauses</li>
                          <li>Reduced Adjective Clauses</li>
                          <li>Reduced Adverb Clauses</li>
                        </ul>
                      </li>
                </ul>
                </li>
        </ul>

        <br><br><input type="submit" value="Submit">
        <div id="lblExito" style="display:none">Tu mensaje ha sido enviado!</div>
            </div>
	
      </form>
    </body>
</html>