<?php
    require ("datenbankanbindung.php");

    $query = $pdo->prepare("SELECT * FROM alsZweitgutachterBetreuteArbeiten ");
    $query->execute();
    
    echo "<div class='table-responsive'>";
    echo "<table class='table table-striped table-sm'>";

    echo "<thead class='thead-dark'>";
    echo "<tr>";
    echo "<th scope='col'>" . "Titel der Arbeit" . "</th>";
    echo "<th scope='col'>" . "Name des Studenten" . "</th>";
    echo "<th scope='col'>" . "Zustand der Arbeit" . "</th>"; 
    echo "<th scope='col'>" . "Abgabetermin" . "</th>";
    echo "<th scope='col'>" . "Hauptbetreuer" . "</th>";
    echo "</tr>";
    echo "</thead>";

    echo "<tr>";
    while($betreutearbeit = $query->fetch()){
        echo "<td>" . $betreutearbeit['titelDerArbeit'] . "</td>";
        echo "<td>" . $betreutearbeit['nameDesStudenten'] . "</td>";
        echo "<td>" . "<form action='BetreuteArbeiten.php' method='post'>" . 
        "<input type='text' name='zustand' size='15' value='" . $betreutearbeit['zustand'] . "'>" . 
        "<input type='hidden' name='ID' value='". $betreutearbeit['ID'] ."'>" . 
        "<button type='submit' class='d-flex justify-content-center btn btn-success btn-sm' name='zgspeichern'><img src='done.svg'></button></form>" . "</td>";
        echo "<td>" . $betreutearbeit['abgabetag']; 
        echo $betreutearbeit['abgabemonat'];
        echo $betreutearbeit['abgabejahr'] . "</td>";
        echo "<td>" . $betreutearbeit['andererGutachter'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
?>