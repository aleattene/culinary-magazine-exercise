<?php
include "sessioncontrol.php";
include "header.php";
include "body.php";
include "dbconnection.php";
if (!isset($_SESSION['matricola'])) {

    header("Location: logout.php");
}
?>

<div id="project-section">
    <div id=subproject1>
        <?php
        echo "<input type=\"button\" 
            onclick=\"location.href='redvalidazione.php'\" value=\"Valida Ricette\"/>";
        ?>
    </div>

    <div id=subproject2>
        <?php
        echo "<input type=\"button\" 
            onclick=\"location.href='redricettevalidateelenco.php'\" value=\"Ricette Validate\"/>";
        ?>
    </div>

    <div id="subproject3">
        <form id="formvalidazione" name="formvalidazione" action="redvalidazioneview.php" method="POST">

            <select required id="selectricettavalidare" name="selectricettavalidare">
                <option value="" disabled selected> Seleziona RICETTA da VALIDARE </option>

                <?php
                $query = "SELECT id_ricetta, titolo_ricetta, data_invio 
                    FROM ricette
                    WHERE ric_validata = '0' AND ric_scartata = '0'
                    ORDER BY data_invio";

                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                while ($tupla = mysqli_fetch_array($risultato)) {
                    $idricetta = $tupla["id_ricetta"];
                    $titolo = $tupla["titolo_ricetta"];
                    $datainvio = $tupla["data_invio"];
                    echo "<option value = '$idricetta'>Codice: $idricetta / $titolo (del $datainvio)</option> \n";
                }
                mysqli_free_result($risultato);
                ?>
            </select>

            <input type="submit" name="submit" value="Mostra Ricetta" />
        </form>
    </div>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>