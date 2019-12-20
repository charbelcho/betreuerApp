<?php
    require ("datenbankanbindung.php");

    $query = $pdo->prepare("SELECT * FROM betreuteArbeiten");
    $query->execute();

    echo "<div class='table-responsive'>";
    echo "<table class='table table-striped table-sm'>";

    echo "<thead class='thead-dark'>";
    echo "<tr>";
    echo "<th scope='col'>" . "Titel Der Arbeit" . "</th>";
    echo "<th scope='col'>" . "Name Des Studenten" . "</th>";
    echo "<th scope='col'>" . "Status der Rechnung" . "</th>";
    echo "<th>" . "</th>";
    echo "</tr>";
    echo "</thead>";

    echo "<tr>";
    while($rechnungen = $query->fetch()){
        echo "<td>" . $rechnungen['titelDerArbeit'] . "</td>";
        echo "<td>" . $rechnungen['nameDesStudenten'] . "</td>";
        echo "<td>" . "<form action='Rechnungen.php' method='post'>" . 
        "<input type='text' name='statusRechnung' size='15' value='" . $rechnungen['statusRechnung'] . "'>" . 
        "<input type='hidden' name='ID' value='". $rechnungen['ID'] ."'>" . 
        "<button type='submit' class='d-flex justify-content-center btn btn-success btn-sm' name='speichern'><img src='done.svg'></button></form>" . "</td>";
        echo "<td>" . "<form action='Rechnungen.php' method='post'>" . 
        "<input type='hidden' name='ID' value='". $rechnungen['ID'] ."'>" . 
        "<button type='submit' class='d-flex justify-content-center löschen btn btn-danger btn-sm' name='löschen'><img src='delete_outline.svg'></button></form>" . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    echo "</div>";
?>