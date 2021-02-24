<?php
include "sessioncontrol.php";
include "header.php";
include "body.php";
include "dbconnection.php";

?>

<div id="project-section">
    <div id=subproject1>
        <?php
        echo "<input type=\"button\" 
            onclick=\"location.href='userricercaricette.php'\" value=\"Ricerca per Calorie\"/>";
        ?>
    </div>

    <div id=subproject2>
        <?php
        echo "<input type=\"button\" 
            onclick=\"location.href='userricercaricettemultipla.php'\" value=\"Ricerca Multipla\"/>";
        ?>
    </div>

    <div id="subproject3">
        <form id="formricercacalorie" name="formricercacalorie" action="userricercaricetteresults.php" method="POST">

            <select required id="selectcalorie" name="selectcalorie">
                <option value="" disabled selected> Selezionare Numero Calorie </option>
                <?php
                $query = "SELECT DISTINCT calorie 
                        FROM ricette
                        WHERE ric_approvata = 1
                        ORDER BY calorie";

                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                while ($tupla = mysqli_fetch_array($risultato)) {
                    $caloriecercare = $tupla["calorie"];
                    echo "
                             <option value = '$caloriecercare'> $caloriecercare </option> \n";
                }
                ?>
            </select>
            <input type="submit" name="submit" value="Effettua Ricerca" />
        </form>
    </div>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>