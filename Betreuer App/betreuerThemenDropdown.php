<?php
    require ("datenbankanbindung.php");

    $query = $pdo->prepare("SELECT `titel`, `vorname`, `nachname` FROM betreuer");
    $query->execute();
   
    echo "<div class='form-group'>";
    echo "<select class='form-control' name='betreuer'>";
    echo "<option>" . "</option>";
    
    while($betreuer = $query->fetch()){
        echo "<option value='".$betreuer['titel'] . " " . $betreuer['vorname'] . " " . $betreuer['nachname'] . "'>";
        echo $betreuer['titel'] . " " . $betreuer['vorname'] . " " . $betreuer['nachname'];
        echo "</option>";
    }
    
    echo "</select>";
    echo "</div>";
?>