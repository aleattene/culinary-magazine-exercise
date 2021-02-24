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
        <form id="formricercamultipla" name="formricercamultipla" action="userricercaricettemultiplaresults.php" method="POST">

            <select required id="selecttipologia" name="selecttipologia">
                <option value="" disabled selected> Seleziona Tipologia </option>
                <?php

                $query = "SELECT id_tipologia, descr_tipologia
                            FROM tipologie
                            ORDER BY id_tipologia";

                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                while ($tupla = mysqli_fetch_array($risultato)) {
                    $idtipologia = $tupla["id_tipologia"];
                    $descrtipologia = $tupla["descr_tipologia"];
                    echo "
                             <option value = '$idtipologia'> $descrtipologia </option> \n";
                }
                ?>
                <option value="0"> Non considerare </option>
            </select>
            <select required id="selectingrediente" name="selectingrediente">
                <option value="" disabled selected> Seleziona Ingrediente </option>
                <?php
                $query = "SELECT id_ingrediente, descr_ingrediente
                            FROM ingredienti
                            ORDER BY descr_ingrediente";

                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                while ($tupla = mysqli_fetch_array($risultato)) {
                    $idingrediente2 = $tupla["id_ingrediente"];
                    $descringrediente2 = $tupla["descr_ingrediente"];
                    echo "
                             <option value = '$idingrediente2'> $descringrediente2 </option> \n";
                }
                ?>
                <option value="0"> Non considerare </option>
            </select>

            <select required id="selecttempocottura" name="selecttempocottura">
                <option value="" disabled selected> Seleziona Tempo Cottura </option>
                <?php
                $query = "SELECT DISTINCT tempo_cottura
                        FROM ricette
                        ORDER BY tempo_cottura";

                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                while ($tupla = mysqli_fetch_array($risultato)) {
                    $tempocottura = $tupla["tempo_cottura"];
                    echo "
                             <option value = '$tempocottura'> $tempocottura minuti </option> \n";
                }
                ?>
                <option value="0"> Non considerare </option>
            </select>
            <select required id="selectdifficolta" name="selectdifficolta">
                <option value="" disabled selected> Seleziona Livello Difficolta </option>
                <?php
                $query = "SELECT liv_difficolta, descrizione
                        FROM difficolta
                        ORDER BY liv_difficolta";

                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                while ($tupla = mysqli_fetch_array($risultato)) {
                    $iddifficolta = $tupla["liv_difficolta"];
                    $descrizione = $tupla["descrizione"];
                    echo "
                             <option value = '$iddifficolta'> $iddifficolta - $descrizione </option> \n";
                }
                ?>
                <option value="0"> Non considerare </option>
            </select>
            <br /><br />
            <input type="submit" name="submit" value="Effettua Ricerca" />
        </form>
    </div>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>