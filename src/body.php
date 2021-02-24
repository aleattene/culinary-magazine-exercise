<!-- Inizio sezione Body che segue Header.php ed anticipa Footer.php-->
<div id="container">

    <div id="top-menu">
        <div id="button-menu">
            <?php echo "<input type=\"button\" 
            onclick=\"location.href='home.php'\" value=\"Home\"/>";
            ?>
        </div>
        <div id="button-menu">
            <?php echo "<input type=\"button\" 
            onclick=\"location.href='usercaricoricette.php'\" value=\"Carico Ricette\"/>";
            ?>
        </div>
        <div id="button-menu">
            <?php echo "<input type=\"button\" 
            onclick=\"location.href='userricercaricette.php'\" value=\"Ricerche\"/>";
            ?>
        </div>
        <div id="button-menu">
            <?php echo "<input type=\"button\" 
            onclick=\"location.href='usercalcolocalorie.php'\" value=\"Calcolo Calorie\"/>";
            ?>
        </div>
        <div id="button-menu">
            <?php echo "<input type=\"button\" 
            onclick=\"location.href='redvalidazione.php'\" value=\"Area Redattori\"/>";
            ?>
        </div>
        <div id="button-menu">
            <?php echo "<input type=\"button\" 
            onclick=\"location.href='caporedapprovazione.php'\" value=\"Area Caporedattore\"/>";
            ?>
        </div>
        <div id="button-menu">
            <?php echo "<input type=\"button\" 
            onclick=\"location.href='logout.php'\" value=\"Logout\"/>";
            ?>
        </div>
        <div id="button-menu">
            <?php echo "<input type=\"button\" 
            onclick=\"location.href='#'\" value=\"--------\"/>";
            ?>
        </div>

    </div>
    <!-- ricordarsi nei file collegati di chiudere il CONTAINER-->
    <!-- Fine sezione Body che segue Header.php ed anticipa Footer.php-->