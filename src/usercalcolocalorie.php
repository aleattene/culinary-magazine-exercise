<?php
include "sessioncontrol.php";
include "header.php";
include "body.php";
include "dbconnection.php";

?>

<div id="project-section">
    <table>
        <?php
        $calorie = 0;

        if (empty($_SESSION["ricetta"])) {
            echo "  <tr>
                        <th> Risultato Interrogazione Variabile di Sessione </th>
                    </tr>
                    <tr>
                        <td> Nessuna ricetta memorizzata durante le precedenti ricerche. 
                            Si consiglia di effettuare nuove ricerche e riprovare. 
                        </td>
                    </tr> ";
        } else {
            $idricettasessione = $_SESSION["ricetta"][0];
            echo "
                    <tr>
                        <th> RICETTA </th>
                        <th> TITOLO </th>
                        <th> AUTORE </th>
                        <th> CALORIE </th>
                        <th> DATA APPROVAZIONE </th>
                    </tr>";

            $query = "SELECT r.id_ricetta, r.titolo_ricetta, r.calorie, a.cognome, a.nome, 
                            r.data_approvazione  
                    FROM ricette as r
                    INNER JOIN autori as a
                    ON r.id_autore = a.id_autore
                    WHERE r.id_ricetta = '$idricettasessione'";

            $ricettememorizzate = count($_SESSION["ricetta"]);

            for ($i = 1; $i < $ricettememorizzate; $i = $i + 1) {
                $idricettasessione = $_SESSION["ricetta"][$i];
                $query .= " OR r.id_ricetta = '$idricettasessione' ";
            }

            $query .= "ORDER BY r.data_approvazione ";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

            $calorie = 0;

            while ($tupla = mysqli_fetch_array($risultato)) {
                $calorie = $calorie + $tupla["calorie"];

                echo "
                <tr>
                <td>$tupla[id_ricetta]</td>
                <td>$tupla[titolo_ricetta]</td>
                <td>$tupla[cognome] $tupla[nome]</td>
                <td>$tupla[calorie]</td>
                <td>$tupla[data_approvazione]</td>
                </tr>";
            }
            mysqli_free_result($risultato);
        }

        ?>
        <tr>
            <th colspan="5"> Totale CALORIE : <?php echo $calorie ?>
            </th>
        </tr>
    </table>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>