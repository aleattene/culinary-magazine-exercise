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
    <table>
        <?php
        if (isset($_POST["selectricettaapprovare"])) {
            echo "
                    <tr>
                        <th> TIPOLOGIA </th>
                        <th> TITOLO </th>
                        <th> AUTORE </th>
                        <th> DATA VALIDAZIONE </th>
                        <th> MATRICOLA REDATTORE </th>
                    </tr>";

            $selectricettaapprovare = $_POST["selectricettaapprovare"];

            $query = "SELECT r.titolo_ricetta, r.mod_preparazione, r.calorie,
                            r.num_porzioni, r.note, t.descr_tipologia, r.data_validazione, 
                            r.matricola, d.descrizione, a.cognome, a.nome
                    FROM ricette as r
                    INNER JOIN tipologie as t
                    ON r.id_tipologia = t.id_tipologia
                    INNER JOIN difficolta as d
                    ON r.liv_difficolta = d.liv_difficolta
                    INNER JOIN autori as a
                    ON r.id_autore = a.id_autore
                    WHERE r.id_ricetta = '$selectricettaapprovare'";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

            while ($tupla = mysqli_fetch_array($risultato)) {
                echo "
                <tr>
                    <td>$tupla[descr_tipologia]</td>
                    <td>$tupla[titolo_ricetta] </td>
                    <td>$tupla[cognome] $tupla[nome]</td>
                    <td>$tupla[data_validazione]</td>
                    <td>$tupla[matricola]</td>
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
                </tr>";
            }
            mysqli_free_result($risultato);
        }
        ?>
    </table>
    <form id="formconferme" name="formconferme" action="caporedapprovazioneresults.php" method="POST">

        <?php
        echo " <input type= 'radio' name='approvazionericetta' 
            value ='" . $selectricettaapprovare . "'" . "checked>
            Ricetta numero " . $selectricettaapprovare . " <br/>

            <input type ='submit' name ='ricettaapprovata' value ='Approva Ricetta'/>

            <input type ='submit' name ='ricettascartata' value='Scarta Ricetta'/>";
        ?>

    </form>

</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>