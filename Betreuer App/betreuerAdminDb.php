<?php
    require ("datenbankanbindung.php");

    $query = $pdo->prepare("SELECT * FROM betreuer");
    $query->execute();
    
    echo "<div class='table-responsive'>";
    echo "<table class='table table-striped table-sm'>";

    echo "<thead class='thead-dark'>";
    echo "<tr>";
    echo "<th scope='col'>" . "Name" . "</th>";
    echo "<th scope='col'>" . "E-Mail" . "</th>";
    echo "<th scope='col'>" . "Fächer" . "</th>";
    echo "<th>" . "</th>";
    echo "</tr>";
    echo "</thead>";
    
    echo "<tr>";
    while($betreuer = $query->fetch()){
        echo "<th scope='row'>" . $betreuer['titel'];
        echo " ";
        echo $betreuer['vorname'];
        echo " ";
        echo $betreuer['nachname'] . "</th>";
        echo "<td>" . $betreuer['email'] . "</td>";
        echo "<td>" . $betreuer['faecher'] . "</td>";
        echo "<td>" . "<form action='admin.php' method='post'>" . 
        "<input type='hidden' name='ID' value='". $betreuer['ID'] ."'>" . 
        "<button type='submit' class='d-flex justify-content-center btn btn-danger btn-sm' name='löschen'><img src='delete_outline.svg'></button</form>" . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    echo "</div>";
?>