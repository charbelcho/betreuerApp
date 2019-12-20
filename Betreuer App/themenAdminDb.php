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
    echo "<th scope='col'>" . "</th>";
    echo "</tr>";
    echo "</thead>";
    
    echo "<tr>";
    while($thema = $query->fetch()){
        echo "<td>" . $thema['themenname'] . "</td>";
        echo "<td>" . $thema['beschreibung'] . "</td>";
        echo "<td>" . "<a href='mailto:" . $thema['email'] . "'>" . $thema['email'] . "</a></td>";
        echo "<td>" . $thema['betreuer'] . "</td>";
        echo "<td>" . "<form action='Themaausschreibung.php' method='post'>" . 
        "<input type='hidden' name='ID' value='". $thema['ID'] ."'>" . 
        "<button type='submit' class='d-flex justify-content-center btn btn-danger btn-sm' name='submit'><img src='delete_outline.svg'></button></form>" . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    echo "</div>";
?>