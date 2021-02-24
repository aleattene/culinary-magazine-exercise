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
    <?php
    $ricettavalidare = $_POST["validazionericetta"];

    if (isset($_POST["ricettavalidata"])) {
        $oggi = date('Y-m-d');
        $query = "UPDATE ricette 
                        SET ric_scartata = '0' , ric_validata = '1', data_validazione = '$oggi',
                        matricola = '101'
                        WHERE id_ricetta = '$ricettavalidare'";

        $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

        echo "
                <table> 
                    <tr>
                        <th> Conferma Operazione </th>
                    </tr>
                    <tr>
                        <td> Ricetta n. " . $ricettavalidare . " - Validazione avvenuta con Successo </td>
                    </tr>
                    <tr>
                        <td> Ricetta n. " . $ricettavalidare . " - Inoltro al Caporedattore avvenuto con Successo </td>
                    </tr>
                </table>";
    }

    if (isset($_POST["ricettascartata"])) {

        $query = "UPDATE ricette 
                        SET ric_scartata = '1' , ric_validata = '0'
                        WHERE id_ricetta = '$ricettavalidare'";

        $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

        echo "
                <table> 
                    <tr>
                        <th> Conferma Operazione </th>
                    </tr>
                    <tr>
                        <td> Ricetta n. " . $ricettavalidare . " - Scartata con Successo </td>
                    </tr>
                </table>";
    }
    ?>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>