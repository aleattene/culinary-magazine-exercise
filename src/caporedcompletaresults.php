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
        if (isset($_POST["stampacompleta"])) {
            echo "
                    <tr>
                        <th> ID RICETTA </th>
                        <th> TITOLO RICETTA </th>
                        <th> TEMPO COTTURA </th>
                        <th> CALORIE </th>
                        <th> NUM.PORZIONI </th>
                    </tr>";

            $ricettastampacompleta = $_POST["selectricettastampa"];

            $query = "SELECT *
                    FROM ricette 
                    WHERE id_ricetta = '$ricettastampacompleta'";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

            while ($tupla = mysqli_fetch_array($risultato)) {
                echo "
                <tr>
                    <td> $tupla[id_ricetta]</td>
                    <td> $tupla[titolo_ricetta] </td>
                    <td> $tupla[tempo_cottura] </td>
                    <td> $tupla[calorie] </td>
                    <td> $tupla[num_porzioni]</td>
                </tr>
                <tr>
                    <th> ID TIPOLOGIA </th>
                    <th> ID LIV.DIFFICOLTA' </th>
                    <th> RIC.SCARTATA </th>
                    <th> RIC.VALIDATA </th>
                    <th> RIC.APPROVATA </th>
                </tr>
                <tr>
                    <td> $tupla[id_tipologia]</td>
                    <td> $tupla[liv_difficolta] </td>
                    <td> $tupla[ric_scartata] </td>
                    <td> $tupla[ric_validata]</td>
                    <td> $tupla[ric_approvata]</td>
                </tr>
                <tr>
                    <th> MATR.REDATTORE </th>
                    <th> DATA VALIDAZIONE </th>
                    <th> DATA APPROVAZIONE </th>
                    <th> DATA INVIO </th>
                    <th> ID AUTORE </th>
                </tr>
                    <td> $tupla[matricola]</td>
                    <td> $tupla[data_validazione] </td>
                    <td> $tupla[data_approvazione] </td>
                    <td> $tupla[data_invio]</td>
                    <td> $tupla[id_autore]</td>
                <tr>
                <th colspan = '3'> MODALITA' di PREPARAZIONE </th>
                <th colspan = '2'> NOTE </th>
                </tr>
                <tr>
                <td colspan = '3'> $tupla[mod_preparazione]</td>
                <td colspan = '2'> $tupla[note]</td>
                </tr>";
            }

            mysqli_free_result($risultato);
        }


        // INIZIO SEZIONE STAMPA SELETTIVA ATTRIBUTI 

        if (isset($_POST["stampaselettiva"])) {


            if (!isset($_POST["attributo1"])) {
                $_POST["attributo1"] = 0;
            }
            if (!isset($_POST["attributo2"])) {
                $_POST["attributo2"] = 0;
            }
            if (!isset($_POST["attributo3"])) {
                $_POST["attributo3"] = 0;
            }
            if (!isset($_POST["attributo4"])) {
                $_POST["attributo4"] = 0;
            }
            if (!isset($_POST["attributo5"])) {
                $_POST["attributo5"] = 0;
            }
            if (!isset($_POST["attributo6"])) {
                $_POST["attributo6"] = 0;
            }
            if (!isset($_POST["attributo7"])) {
                $_POST["attributo7"] = 0;
            }
            if (!isset($_POST["attributo8"])) {
                $_POST["attributo8"] = 0;
            }
            if (!isset($_POST["attributo9"])) {
                $_POST["attributo9"] = 0;
            }
            if (!isset($_POST["attributo10"])) {
                $_POST["attributo10"] = 0;
            }
            if (!isset($_POST["attributo11"])) {
                $_POST["attributo11"] = 0;
            }
            if (!isset($_POST["attributo12"])) {
                $_POST["attributo12"] = 0;
            }
            if (!isset($_POST["attributo13"])) {
                $_POST["attributo13"] = 0;
            }
            if (!isset($_POST["attributo14"])) {
                $_POST["attributo14"] = 0;
            }
            if (!isset($_POST["attributo15"])) {
                $_POST["attributo15"] = 0;
            }
            if (!isset($_POST["attributo16"])) {
                $_POST["attributo16"] = 0;
            }
            if (!isset($_POST["attributo17"])) {
                $_POST["attributo17"] = 0;
            }

            echo "<tr>";

            if ($_POST["attributo1"] == 1) {
                echo " <th> ID RICETTA </th> ";
            }

            if ($_POST["attributo2"] == 1) {
                echo " <th> TITOLO RICETTA </th> ";
            }

            if ($_POST["attributo3"] == 1) {
                echo " <th> TEMPO COTTURA </th> ";
            }

            if ($_POST["attributo4"] == 1) {
                echo " <th> CALORIE </th> ";
            }

            if ($_POST["attributo5"] == 1) {
                echo " <th> NUM.PORZIONI </th>";
            }
            echo "</tr>";


            $ricettastampaselettiva = $_POST["selectricettastampa"];

            $query = "SELECT *
                    FROM ricette 
                    WHERE id_ricetta = '$ricettastampaselettiva'";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

            while ($tupla = mysqli_fetch_array($risultato)) {

                echo "<tr>";
                if ($_POST["attributo1"] == 1) {
                    echo " <td> $tupla[id_ricetta]</td> ";
                }

                if ($_POST["attributo2"] == 1) {
                    echo " <td> $tupla[titolo_ricetta] </td> ";
                }

                if ($_POST["attributo3"] == 1) {
                    echo " <td> $tupla[tempo_cottura] </td>";
                }

                if ($_POST["attributo4"] == 1) {
                    echo " <td> $tupla[calorie] </td>";
                }

                if ($_POST["attributo5"] == 1) {
                    echo " <td> $tupla[num_porzioni]</td>";
                }
                echo "</tr>";

                echo "<tr>";
                if ($_POST["attributo6"] == 1) {
                    echo " <th> ID TIPOLOGIA </th> ";
                }

                if ($_POST["attributo7"] == 1) {
                    echo " <th> ID LIV.DIFFICOLTA' </th> ";
                }

                if ($_POST["attributo8"] == 1) {
                    echo "  <th> RIC.SCARTATA </th> ";
                }

                if ($_POST["attributo9"] == 1) {
                    echo "<th> RIC.VALIDATA </th>";
                }

                if ($_POST["attributo10"] == 1) {
                    echo "  <th> RIC.APPROVATA </th>";
                }
                echo "</tr>";

                echo "<tr>";
                if ($_POST["attributo6"] == 1) {
                    echo " <td> $tupla[id_tipologia]</td> ";
                }

                if ($_POST["attributo7"] == 1) {
                    echo "<td> $tupla[liv_difficolta] </td> ";
                }

                if ($_POST["attributo8"] == 1) {
                    echo " <td> $tupla[ric_scartata] </td> ";
                }

                if ($_POST["attributo9"] == 1) {
                    echo "  <td> $tupla[ric_validata]</td> ";
                }

                if ($_POST["attributo10"] == 1) {
                    echo " <td> $tupla[ric_approvata]</td>";
                }
                echo "</tr>";

                echo "<tr>";
                if ($_POST["attributo11"] == 1) {
                    echo " <th> MATR.REDATTORE </th> ";
                }

                if ($_POST["attributo12"] == 1) {
                    echo "<th> DATA VALIDAZIONE </th";
                }

                if ($_POST["attributo13"] == 1) {
                    echo " <th> DATA APPROVAZIONE </th>";
                }

                if ($_POST["attributo14"] == 1) {
                    echo "   <th> DATA INVIO </th>";
                }

                if ($_POST["attributo15"] == 1) {
                    echo " <th> ID AUTORE </th>";
                }
                echo "</tr>";

                echo "<tr>";
                if ($_POST["attributo11"] == 1) {
                    echo " <td> $tupla[matricola]</td> ";
                }

                if ($_POST["attributo12"] == 1) {
                    echo "<td> $tupla[data_validazione] </td> ";
                }

                if ($_POST["attributo13"] == 1) {
                    echo " <td> $tupla[data_approvazione] </td> ";
                }

                if ($_POST["attributo14"] == 1) {
                    echo " <td> $tupla[data_invio]</td> ";
                }

                if ($_POST["attributo15"] == 1) {
                    echo "  <td> $tupla[id_autore]</td> ";
                }
                echo "</tr>";

                echo "<tr>";
                if ($_POST["attributo16"] == 1) {
                    echo " <th colspan = '3'> MODALITA' di PREPARAZIONE </th>";
                }

                if ($_POST["attributo17"] == 1) {
                    echo "<th colspan = '2'> NOTE </th>";
                }
                echo "</tr>";

                echo "<tr>";
                if ($_POST["attributo16"] == 1) {
                    echo " <td colspan = '3'> $tupla[mod_preparazione]</td>";
                }

                if ($_POST["attributo17"] == 1) {
                    echo "<td colspan = '2'> $tupla[note]</td>";
                }
                echo "</tr>";
            }

            mysqli_free_result($risultato);
        }
        ?>
    </table>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>