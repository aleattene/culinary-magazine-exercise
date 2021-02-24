<?php
include "sessioncontrol.php";
include "header.php";
include "body.php";
include "dbconnection.php";

if (!isset($_SESSION['caporedattore'])) {

    header("Location: logout.php");
}
?>

<div id="project-section">
    <div id=subproject1>
        <?php
        echo "<input type=\"button\" 
        onclick=\"location.href='caporedricetteapprovateelenco.php'\" value=\"Ricette Approvate\"/>";
        ?>
        <?php
        echo "<input type=\"button\" 
        onclick=\"location.href='caporedapprovazione.php'\" value=\"Approva Ricette\"/>";
        ?>
    </div>

    <div id=subproject2>
        <?php
        echo "<input type=\"button\" 
        onclick=\"location.href='caporedvalidazioniredattore.php'\" value=\"Validazioni Redattore\"/>";
        ?>
        <?php
        echo "<input type=\"button\" 
        onclick=\"location.href='caporedgestioneredattori.php'\" value=\"Gestione Redattori\"/>";
        ?>
    </div>

    <div id="subproject3"> <br /><br />
        <form id="formapprovazione" name="formapprovazione" action="caporedapprovazioneview.php" method="POST">

            <select required id="selectricettaapprovare" name="selectricettaapprovare">
                <option value="" disabled selected> Seleziona RICETTA da APPROVARE </option>

                <?php
                $query = "SELECT id_ricetta, titolo_ricetta, data_validazione 
                    FROM ricette
                    WHERE ric_validata = '1' AND ric_scartata = '0' AND ric_approvata = '0'
                    ORDER BY data_approvazione";

                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                while ($tupla = mysqli_fetch_array($risultato)) {
                    $idricetta = $tupla["id_ricetta"];
                    $titolo = $tupla["titolo_ricetta"];
                    $datavalidazione = $tupla["data_validazione"];
                    echo "<option value = '$idricetta'>Codice: $idricetta / $titolo 
                (approvata $datavalidazione)</option> \n";
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