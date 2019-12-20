<?php
    require ("datenbankanbindung.php");

    $query = $pdo->prepare("SELECT * FROM themen");
    $query->execute();

    echo "<div class='table-responsive'>";
    echo "<table class='table table-striped table-sm'>";
    
    echo "<thead class='thead-dark'>";
    echo "<tr>";
    echo "<th scope='col'>" . "Name des Themas" . "</th>";
    echo "<th scope='col'>" . "Beschreibung" . "</th>";
    echo "<th scope='col'>" . "E-Mail" . "</th>";
    echo "<th scope='col'>" . "Betreuer" . "</th>";
    echo "</tr>";
    echo "</thead>";
    
    echo "<tr>";
    while($thema = $query->fetch()){
        echo "<td>" . $thema['themenname'] . "</td>";
        echo "<td>" . $thema['beschreibung'] . "</td>";
        echo "<td>" . "<a href='mailto:" . $thema['email'] . "'>" . $thema['email'] . "</td>";
        echo "<td>" . $thema['andererGutachter'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    echo "</div>";
?>