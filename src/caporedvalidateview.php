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
        if (isset($_POST["selectredattore"])) {
            echo "
                    <tr>
                        <th> MATRICOLA </th>
                        <th> REDATTORE </th>
                        <th> ID RICETTA </th>
                        <th> TITOLO </th>
                        <th> AUTORE </th>
                        <th> DATA VALIDAZIONE </th>
                    </tr>";

            $ricettevalidate = $_POST["selectredattore"];

            $query = "SELECT r.matricola, rd.cognome_redattore, rd.nome_redattore,
                            r.id_ricetta, r.titolo_ricetta, a.cognome, a.nome,
                            r.data_validazione
                    FROM ricette as r
                    INNER JOIN autori as a
                    ON r.id_autore = a.id_autore
                    INNER JOIN redattori as rd
                    ON r.matricola = rd.matricola
                    WHERE r.ric_validata = '1' AND r.ric_scartata = '0'
                        AND r.matricola = '$ricettevalidate'
                    ORDER BY r.data_validazione";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

            while ($tupla = mysqli_fetch_array($risultato)) {
                echo "
                <tr>
                    <td>$tupla[matricola]</td>
                    <td>$tupla[cognome_redattore] $tupla[nome_redattore]</td>
                    <td>$tupla[id_ricetta]</td>
                    <td>$tupla[titolo_ricetta] </td>
                    <td>$tupla[cognome] $tupla[nome]</td>
                    <td>$tupla[data_validazione]</td>
                </tr>";
            }
            mysqli_free_result($risultato);
        }
        ?>

    </table>
    <div>
        <br /><br />
        <form id="formconferme" name="formconferme" action="caporedcompletaresults.php" method="POST">

            <select required id="selectricettastampa" name="selectricettastampa">
                <option value="" disabled selected> Seleziona Ricetta da Stampare </option>

                <?php
                $query = "SELECT r.id_ricetta, r.data_validazione
                    FROM ricette as r
                    WHERE r.ric_validata = '1' AND r.ric_scartata = '0'
                    AND r.matricola = '$ricettevalidate'";

                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                while ($tupla = mysqli_fetch_array($risultato)) {
                    $idricetta = $tupla["id_ricetta"];
                    $datavalidazione = $tupla["data_validazione"];

                    echo "<option value = '$idricetta'> Ricetta n. $idricetta (validata il 
                                                    $datavalidazione)</option> \n";
                }
                mysqli_free_result($risultato);
                ?>
            </select>
            <br>
            <input type="checkbox" name="attributo1" value="1"> id ricetta
            <input type="checkbox" name="attributo2" value="1"> titolo ricetta
            <input type="checkbox" name="attributo3" value="1"> tempo cottura
            <input type="checkbox" name="attributo4" value="1"> calorie
            <input type="checkbox" name="attributo5" value="1"> numero porzioni
            <input type="checkbox" name="attributo6" value="1"> id tipologia <br />
            <input type="checkbox" name="attributo7" value="1"> id livello difficolta
            <input type="checkbox" name="attributo8" value="1"> ricetta scartata
            <input type="checkbox" name="attributo9" value="1"> ricetta validata
            <input type="checkbox" name="attributo10" value="1"> ricetta approvata
            <input type="checkbox" name="attributo11" value="1"> matricola redattore <br />
            <input type="checkbox" name="attributo12" value="1"> data validazione
            <input type="checkbox" name="attributo13" value="1"> data approvazione
            <input type="checkbox" name="attributo14" value="1"> data invio
            <input type="checkbox" name="attributo15" value="1"> id autore
            <input type="checkbox" name="attributo16" value="1"> modalità preparazione
            <input type="checkbox" name="attributo17" value="1"> note
            <input type='submit' name='stampaselettiva' value='Stampa Selettiva Campi' />
            <input type='submit' name='stampacompleta' value='Stampa Completa Ricetta' />
        </form>
    </div>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>