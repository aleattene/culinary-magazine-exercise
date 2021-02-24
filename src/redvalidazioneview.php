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
    <table>
        <?php
        if (isset($_POST["selectricettavalidare"])) {
            echo "
                    <tr>
                        <th> TIPOLOGIA </th>
                        <th> TITOLO </th>
                        <th> CALORIE </th>
                        <th> AUTORE </th>
                        <th> DATA INVIO </th>
                    </tr>";

            $ricercaricettavalidare = $_POST["selectricettavalidare"];

            $query = "SELECT r.titolo_ricetta, r.tempo_cottura, r.mod_preparazione, r.calorie,
                            r.num_porzioni, r.note, t.descr_tipologia, d.descrizione, r.data_invio,
                            a.cognome, a.nome
                        FROM ricette as r
                        INNER JOIN tipologie as t
                        ON r.id_tipologia = t.id_tipologia
                        INNER JOIN difficolta as d
                        ON r.liv_difficolta = d.liv_difficolta
                        INNER JOIN autori as a
                        ON r.id_autore = a.id_autore
                        WHERE r.id_ricetta = '$ricercaricettavalidare'";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

            while ($tupla = mysqli_fetch_array($risultato)) {
                echo "
                    <tr>
                        <td>$tupla[descr_tipologia]</td>
                        <td>$tupla[titolo_ricetta] </td>
                        <td>$tupla[calorie] </td>
                        <td>$tupla[cognome] $tupla[nome]</td>
                        <td>$tupla[data_invio]</td>
                    </tr>
                    <tr>
                        <th> PORZIONI </th>
                        <th> TEMPO COTTURA </th>
                        <th> LIVELLO DIFFICOLTA' </th>
                        <th colspan = '2' > NOTE </th>
                    </tr>
                    <tr>
                        <td>$tupla[num_porzioni]</td>
                        <td>$tupla[tempo_cottura] </td>
                        <td>$tupla[descrizione] </td>
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
    <form id="formconferme" name="formconferme" action="redvalidazioneresults.php" method="POST">

        <?php echo "<input type= 'radio' name='validazionericetta' 
            value ='" . $ricercaricettavalidare . "'" . "checked>
            Ricetta numero " . $ricercaricettavalidare . " <br/>
            
            <input type ='submit' name ='ricettavalidata' value ='Valida Ricetta'/>
            
            <input type ='submit' name ='ricettascartata' value='Scarta Ricetta'/>"; ?>
    </form>

</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>