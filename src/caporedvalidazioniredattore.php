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
    <div id=subproject1>
        <?php
        echo "<input type=\"button\" 
        onclick=\"location.href='caporedricetteapprovateelenco.php'\" value=\"Ricette Approvate\"/>";
        ?>
        <?php
        echo "<input type=\"button\" 
        onclick=\"location.href='caporedapprovazione.php'\" value=\"Approva Ricette\"/>";
        ?>
    </div>

    <div id=subproject2>
        <?php
        echo "<input type=\"button\" 
        onclick=\"location.href='caporedvalidazioniredattore.php'\" value=\"Validazioni Redattore\"/>";
        ?>
        <?php
        echo "<input type=\"button\" 
        onclick=\"location.href='caporedgestioneredattori.php'\" value=\"Gestione Redattori\"/>";
        ?>
    </div>

    <div id="subproject3"> <br /><br />
        <form id="formselectredattore" name="formslectredattore" action="caporedvalidateview.php" method="POST">

            <select required id="selectredattore" name="selectredattore">
                <option value="" disabled selected> Seleziona Redattore </option>

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
            </select>

            <input type="submit" name="ricetteredattore" value="Effettua Ricerca" />

    </div>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>