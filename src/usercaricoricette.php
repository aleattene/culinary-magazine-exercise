<?php
include "sessioncontrol.php";
include "header.php";
include "body.php";
include "dbconnection.php";

?>

<div id="project-section">

    <div id="subprojecttable">
        <form id="formricette" name="formicette" action="usercaricoricetteingredienti.php" method="POST">

            <table>
                <tr>
                    <th colspan="4"> INSERIMENTO RICETTA </th>
                </tr>
                <tr>
                    <td colspan="3" class="ricette"><input required type="text" id="titoloricetta" name="titoloricetta" placeholder="Titolo Ricetta" maxlength="50" />
                    </td>
                    <td class="ingredienti">
                        <select class="ricetta" required id="selecttipologia" name="selecttipologia">
                            <option value="" disabled selected> Tipologia </option>
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
                        </select>
                    </td>
                <tr>
                    <td class="mod" colspan="4">
                        <textarea required cols="5" rows="4" id="modpreparazione" name="modpreparazione" placeholder="Modalità di Preparazione" maxlength="1000"></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="insert">
                        <input required type="text" id="tempocottura" name="tempocottura" placeholder="Cottura (minuti)" maxlength="5" />
                    </td>
                    <td class="insert">
                        <input required type="text" id="calorie" name="calorie" placeholder="Calorie Ricetta" maxlength="5" />
                    </td>
                    <td class="insert">
                        <input required type="text" id="numporzioni" name="numporzioni" placeholder="Num. Porzioni" maxlength="2" />
                    </td>
                    <td class="insert">
                        <select class="ricetta" required id="selectdifficolta" name="selectdifficolta">
                            <option value="" disabled selected> Liv. Difficolta </option>
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
                        </select>
                    </td>

                    </td>
                </tr>
                <tr>
                    <td class="mod" colspan="4">
                        <textarea cols="5" rows="4" id="note" name="note" placeholder="Note eventuali" maxlength="200"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="mod">
                        <input type="submit" name="submit" value="Step Successivo" />
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>