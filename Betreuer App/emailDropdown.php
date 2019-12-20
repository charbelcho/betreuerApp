<?php
    require ("datenbankanbindung.php");

    $query = $pdo->prepare("SELECT `email` FROM betreuer");
    $query->execute();
   
    echo "<div class='form-group'>";
    echo "<select class='form-control' name='email'>";
    echo "<option>" . "</option>";
    
    while($betreuer = $query->fetch()){
        echo "<option value='" . $betreuer['email'] . "'>";
        echo $betreuer['email'];
        echo "</option>";
    }
    
    echo "</select>";
    echo "</div>";
?>