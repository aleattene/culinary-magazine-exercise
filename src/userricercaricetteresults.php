<?php
include "sessioncontrol.php";
include "header.php";
include "body.php";
include "dbconnection.php";

?>

<div id="project-section">
    <table>
        <?php
        if (isset($_POST["selectcalorie"])) {
            echo "
                    <tr>
                        <th> RICETTA N. </th>
                        <th> TITOLO </th>
                        <th> AUTORE </th>
                        <th> CALORIE </th>
                        <th> DATA APPROVAZIONE </th>
                    </tr>";

            $ricercacalorie = $_POST["selectcalorie"];

            $query = "SELECT r.id_ricetta, r.titolo_ricetta, r.calorie, 
                            a.cognome, a.nome, r.data_approvazione  
                    FROM ricette as r
                    INNER JOIN autori as a
                    ON r.id_autore = a.id_autore
                    WHERE r.calorie = '$ricercacalorie' AND r.ric_approvata = 1
                    ORDER BY r.data_approvazione ";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

            $index = 0;

            if (!empty($_SESSION["ricetta"])) {

                $index = count($_SESSION["ricetta"]);
            }

            while ($tupla = mysqli_fetch_array($risultato)) {
                echo "<tr>
                    <td>$tupla[id_ricetta]</td>
                    <td>$tupla[titolo_ricetta]</td>
                    <td>$tupla[cognome] $tupla[nome]</td>
                    <td>$tupla[calorie]</td>
                    <td>$tupla[data_approvazione]</td>
                </tr>";
                $_SESSION["ricetta"][$index] = $tupla["id_ricetta"];
                $index = $index + 1;
            }
            mysqli_free_result($risultato);
        }
        ?>
    </table>
    <br><br><br>
    <?php
    echo "
            <table> 
                <tr>
                    <th> Conferma Operazione </th>
                </tr>
                <tr>
                    <td> Memorizzazione \"Ricette Cercate\" avvenuta con Successo (per eventuale successivo \"Calcolo Calorie\")</td>
                </tr>
            </table>";
    ?>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>