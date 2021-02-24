<?php
include "sessioncontrol.php";
include "header.php";
include "body.php";
include "dbconnection.php";

?>

<div id="project-section">
    <table>
        <?php
        $idtipologia = $_POST["selecttipologia"];
        $idingrediente = $_POST["selectingrediente"];
        $idtempocottura = $_POST["selecttempocottura"];
        $livdifficolta = $_POST["selectdifficolta"];
        echo "
                    <tr>
                        <th> RICETTA </th>
                        <th> TITOLO </th>
                        <th> TIPOLOGIA </th>
                        <th> DIFFICOLTA' </th>
                        <th> COTTURA </th>
                        <th> INGREDIENTI </th>
                        <th> AUTORE </th>
                    </tr>";

        $query = "SELECT DISTINCT r.id_ricetta , r.titolo_ricetta, r.tempo_cottura,
                          t.descr_tipologia, d.descrizione, a.cognome, a.nome
                    FROM ricette as r
                    INNER JOIN tipologie as t
                    ON r.id_tipologia = t.id_tipologia
                    INNER JOIN difficolta as d
                    ON r.liv_difficolta = d.liv_difficolta
                    INNER JOIN autori as a
                    ON r.id_autore = a.id_autore
                    INNER JOIN composizioni as c
                    ON r.id_ricetta = c.id_ricetta
                    INNER JOIN ingredienti as i
                    ON c.id_ingrediente = i.id_ingrediente
                    WHERE r.id_ricetta > '0' ";

        if ($idtipologia != 0) {
            $query .= "AND t.id_tipologia = '$idtipologia' ";
        }

        if ($idingrediente != 0) {
            $query .= "AND i.id_ingrediente = '$idingrediente' ";
        }

        if ($idtempocottura != 0) {
            $query .= "AND r.tempo_cottura = '$idtempocottura' ";
        }

        if ($livdifficolta != 0) {
            $query .= "AND d.liv_difficolta = '$livdifficolta' ";
        }

        $query .= "GROUP BY id_ricetta ORDER BY r.data_approvazione ";

        $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');


        while ($tupla = mysqli_fetch_array($risultato)) {
            $ricetta = $tupla["id_ricetta"];

            echo "
                <tr>
                    <td>n. $tupla[id_ricetta]</td>
                    <td>$tupla[titolo_ricetta]</td>
                    <td>$tupla[descr_tipologia] </td>
                    <td>$tupla[descrizione] </td>
                    <td>$tupla[tempo_cottura] minuti</td>
                    <td>";
            $queryin = "SELECT i.descr_ingrediente
                                        FROM ingredienti as i
                                        INNER JOIN composizioni as c
                                        ON c.id_ingrediente = i.id_ingrediente
                                        WHERE c.id_ricetta = '$ricetta' 
                                                AND c.id_ingrediente = i.id_ingrediente";

            $risultatoin = mysqli_query($dbconnection, $queryin) or
                die('Query non eseguibile');

            while ($tuplain = mysqli_fetch_array($risultatoin)) {
                echo $tuplain["descr_ingrediente"] . " ";
            }

            echo "</td>
                        <td>$tupla[cognome] $tupla[nome]</td>
                        </tr>";
            mysqli_free_result($risultatoin);
        }

        mysqli_free_result($risultato);

        ?>
    </table>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>