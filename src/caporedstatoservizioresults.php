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
        if (isset($_POST["selectstatoredattore"])) {
            $matricola = $_POST["selectstatoredattore"];

            $query = "SELECT collaborante
                        FROM redattori
                        WHERE matricola = '$matricola'";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

            while ($tupla = mysqli_fetch_array($risultato)) {
                $statoservizio = $tupla["collaborante"];
            }
            mysqli_free_result($risultato);

            if ($statoservizio == 1) {
                $modificastatoservizio = 0;
            } else if ($statoservizio == 0) {
                $modificastatoservizio = 1;
            }

            $query = "UPDATE redattori
                        SET collaborante = '$modificastatoservizio'
                        WHERE matricola = '$matricola'";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

            echo "
                <tr>
                    <th> Conferma Operazione </th>
                </tr>
                <tr>
                    <td> Matricola $matricola - Modifica Stato Servizio effettuata con Successo </td>
                </tr>";
        }
        ?>
    </table>
    <br /><br />
    <table>
        <?php
        echo "
                    <tr>
                        <th> MATRICOLA </th>
                        <th> REDATTORE </th>
                        <th> STATO SERVIZIO [ATTIVO = 1] </th>
                    </tr>";

        $query = "SELECT matricola, cognome_redattore, nome_redattore, collaborante
                    FROM redattori
                    WHERE matricola <> 100 AND matricola <> 106";

        $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

        while ($tupla = mysqli_fetch_array($risultato)) {
            echo "
                <tr>
                    <td>$tupla[matricola]</td>
                    <td>$tupla[cognome_redattore] $tupla[nome_redattore]</td>
                    <td>$tupla[collaborante]</td>
                </tr>";
        }
        mysqli_free_result($risultato);
        ?>
    </table>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>