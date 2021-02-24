<?php
include "sessioncontrol.php";
include "header.php";
include "body.php";
include "dbconnection.php";

?>

<?php
$titoloricetta = $_POST["titoloricetta"];
$tempocottura = $_POST["tempocottura"];
$modpreparazione = $_POST["modpreparazione"];
$calorie = $_POST["calorie"];
$numporzioni = $_POST["numporzioni"];
$note = $_POST["note"];
$idtipologia = $_POST["selecttipologia"];
$livdifficolta = $_POST["selectdifficolta"];
$datainvio = date('Y-m-d');
$idautore = $_SESSION["id_autore"];
$idmatricolabase = '100';
$_SESSION["titoloricetta"] = $titoloricetta;
$_SESSION["checkingrediente"] = 0;



$query = "INSERT INTO ricette (titolo_ricetta, tempo_cottura, mod_preparazione, 
                                    calorie, num_porzioni, note, id_tipologia, 
                                    liv_difficolta, data_invio, id_autore, matricola ) 
                VALUES (" . "'" . $titoloricetta . "','" . $tempocottura . "','" . $modpreparazione . "','" . $calorie .
    "','" . $numporzioni . "','" . $note . "','" . $idtipologia . "','" . $livdifficolta .
    "','" . $datainvio . "','" . $idautore . "','" . $idmatricolabase . "')";

$risultato = mysqli_query($dbconnection, $query) or die('Errore di connessione. 
                                                            Si prega di effettuare il Log Out e riprovare');

$query = "SELECT id_ricetta, titolo_ricetta
                FROM ricette
                WHERE titolo_ricetta = '$titoloricetta'";

$risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');
$tupla = mysqli_fetch_array($risultato);
$_SESSION["idricetta"] = $tupla["id_ricetta"];

?>

<div id="project-section">
    <div id="subprojecttable">
        <div id="tablefeedback">
            <table>
                <tr>
                    <th colspan="4"> RICETTA: <?php echo $_SESSION["titoloricetta"] ?>
                    </th>
                </tr>
                <tr>
                    <td> Inserire INGREDIENTI e QUANTITA'.
                    </td>
                </tr>
            </table>
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

                                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                                while ($tupla = mysqli_fetch_array($risultato)) {
                                    $idingrediente = $tupla["id_ingrediente"];
                                    $descringrediente = $tupla["descr_ingrediente"];
                                    echo "
                             <option value = '$idingrediente'> $descringrediente </option> \n";
                                }
                                ?> <option value="0"> Ingrediente non presente </option>
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
            </form>
        </div>
        <div id="tableingredienti">
            <table>
                <tr>
                    <th> INGREDIENTE Inserito
                    </th>
                    <th> Quantità
                    </th>
                </tr>
            </table>
        </div>
    </div>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>