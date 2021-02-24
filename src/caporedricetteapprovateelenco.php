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
        echo "
                    <tr>
                        <th> RICETTA </th>
                        <th> TITOLO </th>
                        <th> AUTORE </th>
                        <th> MATRICOLA REDATTORE </th>
                        <th> DATA APPROVAZIONE</th>
                    </tr>";

        $query = "SELECT r.id_ricetta, r.titolo_ricetta, r.matricola, r.data_approvazione,
                            a.cognome, a.nome
                    FROM ricette as r
                    INNER JOIN autori as a
                    ON r.id_autore = a.id_autore
                    WHERE r.ric_approvata = '1' AND r.ric_validata = '1' AND r.ric_scartata = '0'
                    ORDER BY r.data_approvazione";

        $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

        while ($tupla = mysqli_fetch_array($risultato)) {
            echo "
                <tr>
                    <td>$tupla[id_ricetta]</td>
                    <td>$tupla[titolo_ricetta] </td>
                    <td>$tupla[cognome] $tupla[nome]</td>
                    <td>$tupla[matricola]</td>
                    <td>$tupla[data_approvazione]</td>
                </tr>";
        }
        mysqli_free_result($risultato);
        ?>
    </table>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>