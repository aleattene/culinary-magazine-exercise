<?php
include "sessioncontrol.php";
include "header.php";
include "body.php";
include "dbconnection.php";

?>

<?php
if (isset($_POST["continuainserimento"])) {

  $idricetta = $_SESSION["idricetta"];
  $quantita = $_POST["qta"];

  // CONTROLLO SELECT VUOTA e INSERT VUOTA 

  if (($_POST["selectingrediente"] == 0) && ($_POST["insertingrediente"] == "")) {  ?>

    <div id="project-section">
      <div id="subprojecttable">
        <div id="tablefeedback">
          <table>
            <tr>
              <th> RICETTA: <?php echo $_SESSION["titoloricetta"] ?>
              </th>
            </tr>
            <tr>
              <td> Attenzione: inserire almeno un ingrediente.
              </td>
            </tr>
          </table>
        <?php }

      // CONTROLLO SELECT COMPILATA e INSERT COMPILATA

      else if (($_POST["selectingrediente"] != 0) && ($_POST["insertingrediente"] != "")) { ?>

          <div id="project-section">
            <div id="subprojecttable">
              <div id="tablefeedback">
                <table>
                  <tr>
                    <th> RICETTA: <?php echo $_SESSION["titoloricetta"] ?>
                    </th>
                  </tr>
                  <tr>
                    <td> Attenzione: inserire un solo ingrediente
                    </td>
                  </tr>
                </table>
                <?php }

              // CONTROLLO SELECT VUOTA e INSERT CORRETTA

              else if (($_POST["selectingrediente"] == 0) && ($_POST["insertingrediente"] != "")) {

                $ingrediente = $_POST["insertingrediente"];  // ingrediente inserito manualmente
                $query = "SELECT descr_ingrediente
                    FROM ingredienti
                    WHERE descr_ingrediente = '$ingrediente'";  // controllo presenza

                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                $tupletrovate = mysqli_num_rows($risultato);   // numero tuple trovate

                if ($tupletrovate == 0) {   // ingrediente non presente
                  $query = "INSERT INTO ingredienti (descr_ingrediente)
                          VALUES ('$ingrediente')";
                  $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                  $_SESSION["checkingrediente"] = 1;

                  $query = "SELECT id_ingrediente       
                        FROM ingredienti
                        WHERE descr_ingrediente = '$ingrediente'";  // estrapolo id del nuovo ingrediente
                  $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');
                  $tupla = mysqli_fetch_array($risultato);
                  $idingrediente = $tupla["id_ingrediente"];

                  // collego l'ingrediente n-esimo alla ricetta
                  $query = "INSERT INTO composizioni (id_ricetta, id_ingrediente, qta_ingrediente) 
            VALUES ('" . $idricetta . "','" . $idingrediente . "','" . $quantita . "')";
                  $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                ?>
                  <div id="project-section">
                    <div id="subprojecttable">
                      <div id="tablefeedback">
                        <table>
                          <tr>
                            <th> RICETTA: <?php echo $_SESSION["titoloricetta"] ?>
                            </th>
                          </tr>
                          <tr>
                            <td> Ingrediente inserito con Successo.
                            </td>
                          </tr>
                        </table>
                      <?php } else { // ingrediente presente 
                      ?>
                        <div id="project-section">
                          <div id="subprojecttable">
                            <div id="tablefeedback">
                              <table>
                                <tr>
                                  <th> RICETTA: <?php echo $_SESSION["titoloricetta"] ?>
                                  </th>
                                </tr>
                                <tr>
                                  <td> Attenzione: ingrediente presente nel Menu a Tendina.
                                  </td>
                                </tr>
                              </table>
                            <?php }
                        }

                        // CONTROLLO SELECT CORRETTA e INSERT VUOTA
                        else if (($_POST["selectingrediente"] != 0) && ($_POST["insertingrediente"] == "")) {

                          $idingrediente = $_POST["selectingrediente"]; // ingrediente della Select

                          $query = "SELECT id_ingrediente, id_ricetta
                FROM composizioni
                WHERE id_ingrediente = '$idingrediente' AND id_ricetta = '$idricetta'";

                          $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                          $tupletrovate = mysqli_num_rows($risultato);   // numero tuple trovate

                          if ($tupletrovate == 0) {   // ingrediente non presente

                            // collego l'ingrediente n-esimo alla ricetta
                            $query = "INSERT INTO composizioni (id_ricetta, id_ingrediente, qta_ingrediente) 
        VALUES ('" . $idricetta . "','" . $idingrediente . "','" . $quantita . "')";
                            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');
                            $_SESSION["checkingrediente"] = 1;
                            ?>
                              <div id="project-section">
                                <div id="subprojecttable">
                                  <div id="tablefeedback">
                                    <table>
                                      <tr>
                                        <th> RICETTA: <?php echo $_SESSION["titoloricetta"] ?>
                                        </th>
                                      </tr>
                                      <tr>
                                        <td> Ingrediente inserito con Successo.
                                        </td>
                                      </tr>
                                    </table>
                                  <?php } else { // ingrediente presente 
                                  ?>
                                    <div id="project-section">
                                      <div id="subprojecttable">
                                        <div id="tablefeedback">
                                          <table>
                                            <tr>
                                              <th> RICETTA: <?php echo $_SESSION["titoloricetta"] ?>
                                              </th>
                                            </tr>
                                            <tr>
                                              <td> Ingrediente già inserito.
                                              </td>
                                            </tr>
                                          </table>
                                      <?php }
                                  }

                                      ?>
                                      <br />
                                      <form id="formricette" name="formicette" action="usercaricoricetteresults.php" method="POST">
                                        <table>
                                          <tr>
                                            <td class="ingredienti">
                                              <select required id="selectingrediente" name="selectingrediente">

                                                <option value="" disabled selected> Seleziona Ingrediente o Ingrediente non Presente </option>
                                                <?php
                                                $query = "SELECT id_ingrediente, descr_ingrediente
                          FROM ingredienti
                          ORDER BY descr_ingrediente";

                                                $risultato = mysqli_query($dbconnection, $query) or die('Query non  e seguibile');

                                                while ($tupla = mysqli_fetch_array($risultato)) {
                                                  $idingrediente = $tupla["id_ingrediente"];
                                                  $descringrediente = $tupla["descr_ingrediente"];
                                                  echo "
              <option value = '$idingrediente'> $descringrediente </option> \n";
                                                } ?>
                                                <option value="0"> Ingrediente non presente </option>
                                              </select>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td class="ingredienti">
                                              <input class="ingredientefree" type="text" id="insertingrediente" name="insertingrediente" placeholder="Inserire ingrediente se non presente nella Lista" maxlength="25" />
                                            </td>
                                          </tr>
                                          <tr>
                                            <td class="ingredienti">
                                              <input class="qta" required type="text" id="qta" name="qta" placeholder="Q.tà (grammi)" maxlength="5" />
                                            </td>
                                          </tr>
                                        </table>

                                        <input type="submit" name="continuainserimento" value="Continua Inserimento" />
                                        <?php
                                        if ($_SESSION["checkingrediente"] == 1) {
                                          echo "<input type=\"button\" 
            onclick=\"location.href='usercaricoricetteresults.php'\" value=\"Termina Inserimento\"/>";
                                        } ?>
                                      </form>
                                        </div>

                                        <div id="tableingredienti">
                                          <table>
                                            <?php
                                            $idricetta = $_SESSION["idricetta"];
                                            echo "<tr>
                    <th> INGREDIENTE Inserito</th>
                    <th> Quantità  </th>
                  </tr>";

                                            $query = "SELECT i.descr_ingrediente, c.qta_ingrediente
                            FROM ingredienti as i
                            INNER JOIN composizioni as c
                            ON c.id_ingrediente = i.id_ingrediente
                            WHERE c.id_ricetta = '$idricetta' 
                            AND c.id_ingrediente = i.id_ingrediente";

                                            $risultato = mysqli_query($dbconnection, $query) or
                                              die('Query non eseguibile');

                                            while ($tupla = mysqli_fetch_array($risultato)) {
                                              echo "
                      <tr>
                        <td> $tupla[descr_ingrediente] </td>
                        <td> $tupla[qta_ingrediente]  </td>
                      </tr>";
                                            }
                                            mysqli_free_result($risultato);  ?>

                                          </table>
                                        </div>
                                      </div>
                                    </div>

                                  <?php } else {  ?>
                                    <div id="project-section">
                                      <table>
                                        <tr>
                                          <th> RIEPILOGO INSERIMENTO
                                          </th>
                                        </tr>
                                      </table>
                                      <br />
                                      <table>
                                        <?php
                                        $idricetta = $_SESSION["idricetta"];
                                        echo "
                  <tr>
                    <th> TIPOLOGIA </th>
                    <th colspan = '2'> TITOLO  </th>
                    <th> AUTORE  </th>
                    <th> DATA INVIO </th>
                    <th>  </th>
                  </tr>";

                                        $query = "SELECT r.titolo_ricetta, r.mod_preparazione, r.calorie,
                            r.num_porzioni, r.note, t.descr_tipologia, r.data_invio, 
                            d.descrizione, a.cognome, a.nome
                    FROM ricette as r
                    INNER JOIN tipologie as t
                    ON r.id_tipologia = t.id_tipologia
                    INNER JOIN difficolta as d
                    ON r.liv_difficolta = d.liv_difficolta
                    INNER JOIN autori as a
                    ON r.id_autore = a.id_autore
                    WHERE r.id_ricetta = '$idricetta'";

                                        $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                                        while ($tupla = mysqli_fetch_array($risultato)) {
                                          echo "
                <tr>
                    <td>$tupla[descr_tipologia]</td>
                    <td colspan = '2'> $tupla[titolo_ricetta] </td>
                    <td>$tupla[cognome] $tupla[nome]</td>
                    <td>$tupla[data_invio]</td>
                </tr>
                <tr>
                    <th> CALORIE </th>
                    <th> LIVELLO DIFFICOLTA' </th>
                    <th> NUM.PORZIONI 
                    <th colspan = '2' > NOTE </th>
                </tr>
                <tr>
                    <td>$tupla[calorie] </td>
                    <td>$tupla[descrizione] </td>
                    <td>$tupla[num_porzioni]</td>
                    <td colspan = '2'> $tupla[note]</td>
                </tr>
                <tr>
                    <th colspan = '5'> MODALITA' di PREPARAZIONE </th>
                </tr>
                <tr>
                <td colspan = '5'>$tupla[mod_preparazione]</td>
                </tr>
                <tr>
                <th colspan = '5'> INGREDIENTI </th>
                </tr>
                <tr>
                <td colspan = '5'>";
                                          $queryin = "SELECT i.descr_ingrediente, c.qta_ingrediente
                                      FROM ingredienti as i
                                      INNER JOIN composizioni as c
                                      ON c.id_ingrediente = i.id_ingrediente
                                      WHERE c.id_ricetta = '$idricetta' 
                                      AND c.id_ingrediente = i.id_ingrediente";

                                          $risultatoin = mysqli_query($dbconnection, $queryin) or
                                            die('Query non eseguibile');

                                          while ($tuplain = mysqli_fetch_array($risultatoin)) {
                                            echo $tuplain["descr_ingrediente"] . " ";
                                            echo "(" . $tuplain["qta_ingrediente"] . " gr) ";
                                          }
                                        }
                                        mysqli_free_result($risultato);  ?>

                                      </table>
                                    </div>
                                  <?php } ?>

                                  </div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

                                  <?php include "footer.php"; ?>