<!doctype html>
<html lang="de-DE">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="index.css">
    <title>Rechnungen</title>
</head>
<body>

<?php
//speichert Status der Rechnung in Hauptbetreuer-Tabelle
    require ("datenbankanbindung.php");

    $id = @($_POST['ID']);
    if(isset($_POST['speichern'])):
        if( !strlen($_POST['statusRechnung']) > 0 
        ){
            echo "<script type='text/javascript'>alert('Status überprüfen');</script>";
        }
        else{
            $sql = "UPDATE `betreuteArbeiten` SET `statusRechnung` = '$_POST[statusRechnung]' WHERE `ID` = ? ";

            $query = $pdo->prepare($sql);
            $query->bindParam(':statusRechnung', $_POST['statusRechnung'], PDO::PARAM_STR);
            $query->bindParam(':ID', $_POST['ID'], PDO::PARAM_INT);
            $query->execute(array($id));

            echo "<script type='text/javascript'>alert('Eintrag bearbeitet');</script>";    
        }
        
    endif;
?>

<?php
//speichert Status der Rechnung in Zweitgutachter-Tabelle
    require ("datenbankanbindung.php");

    $id = @($_POST['ID']);
    if(isset($_POST['zgspeichern'])):
        if( !strlen($_POST['statusRechnung']) > 0 
        ){
            echo "<script type='text/javascript'>alert('Status überprüfen');</script>";
        }
        else{
            $sql = "UPDATE `alsZweitgutachterBetreuteArbeiten` SET `statusRechnung` = '$_POST[statusRechnung]' WHERE `ID` = ? ";

            $query = $pdo->prepare($sql);
            $query->bindParam(':statusRechnung', $_POST['statusRechnung'], PDO::PARAM_STR);
            $query->bindParam(':ID', $_POST['ID'], PDO::PARAM_INT);
            $query->execute(array($id));

            echo "<script type='text/javascript'>alert('Eintrag bearbeitet');</script>"; 
        }
    endif;
?>

<?php
//löscht Eintrag aus Hauptbetreuer-Tabelle
    require ("datenbankanbindung.php");

    if(isset($_POST['löschen'])):
        $sql = "DELETE FROM betreuteArbeiten WHERE ID=:ID ";
        $query = $pdo->prepare($sql);
        $query->bindParam(':ID', $_POST['ID']);
        $query->execute();

        echo "<script type='text/javascript'>alert('Eintrag gelöscht');</script>";

    endif;
?>

<?php
//löscht Eintrag aus Zweitgutachter-Tabelle
    require ("datenbankanbindung.php");

    if(isset($_POST['zglöschen'])):
        $sql = "DELETE FROM alsZweitgutachterBetreuteArbeiten WHERE ID=:ID ";
        $query = $pdo->prepare($sql);
        $query->bindParam(':ID', $_POST['ID']);
        $query->execute();

        echo "<script type='text/javascript'>alert('Eintrag gelöscht');</script>";

    endif;
?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <a class="navbar-brand" href="Tutor.html">Rechnungen</a>
        <a class="btn btn-danger" href="BetreuerApp.html">Logout</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <a class="nav-link" href="Themaausschreibung.php">Themaausschreibung</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Zweitgutachter.php">Zweitgutachter</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="BetreuteArbeiten.php">Betreute Arbeiten</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Rechnungen</a>
            </li>
            </ul>
        </div>
    </nav>
<div class="container">
    <h6>Als Hauptbetreuer:</h6>
    <?php require_once ("rechnungenDb.php"); ?>
    <h6>Als Zweitgutachter:</h6>
    <?php require_once ("rechnungenZgDb.php"); ?>
    <br>
    <p>Legende:</p>
    <p>Eine Rechnung kann folgende Werte haben:</p>
    <table class="table">
        <tr><td>nicht gestellt</td></tr>
        <tr><td>offen</td></tr>
        <tr><td>bezahlt</td></tr>
    </table>
</div>


    <script>
    
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>