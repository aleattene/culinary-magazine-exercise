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
    <?php
    $ricettaapprovare = $_POST["approvazionericetta"];

    if (isset($_POST["ricettaapprovata"])) {
        $oggi = date('Y-m-d');
        $query = "UPDATE ricette 
                    SET ric_scartata = '0', ric_approvata = '1', data_approvazione = '$oggi'
                    WHERE id_ricetta = '$ricettaapprovare'";

        $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

        echo "
            <table> 
                <tr>
                    <th> Conferma Operazione </th>
                </tr>
                <tr>
                    <td> Ricetta n. " . $ricettaapprovare . " - Approvazione alla Pubblicazione avvenuta con Successo </td>
                </tr>
            </table>";
    }

    if (isset($_POST["ricettascartata"])) {

        $query = "UPDATE ricette 
                    SET ric_scartata = '1' , ric_approvata = '0'
                    WHERE id_ricetta = '$ricettaapprovare'";

        $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

        echo "
            <table> 
                <tr>
                    <th> Conferma Operazione </th>
                </tr>
                <tr>
                    <td> Ricetta n. " . $ricettaapprovare . " - Scartata con Successo </td>
                </tr>
            </table>";
    }
    ?>

</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>