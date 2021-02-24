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
    <div>
        <br /><br />
        <form id="formconferme" name="formconferme" action="caporedstatoservizioresults.php" method="POST">

            <select required id="selectstatoredattore" name="selectstatoredattore">
                <option value="" disabled selected> Seleziona Redattore: MODIFICA STATO SERVIZIO </option>

                <?php
                $query = "SELECT matricola, cognome_redattore, nome_redattore
                    FROM redattori
                    WHERE matricola <> '100' AND matricola <> '106'
                    ORDER BY matricola";

                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                while ($tupla = mysqli_fetch_array($risultato)) {
                    $matricola = $tupla["matricola"];
                    $cognomeredattore = $tupla["cognome_redattore"];
                    $nomeredattore = $tupla["nome_redattore"];

                    echo "<option value = '$matricola'> $cognomeredattore, $nomeredattore 
                                        (matricola: $matricola)</option> \n";
                }
                mysqli_free_result($risultato);
                ?>

            </select><br>
            <input type="submit" name="statoservizioredattore" value="Modifica Stato Servizio" />
        </form>
    </div>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>