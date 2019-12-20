<!doctype html>
<html lang="de-DE">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="index.css">
    <title>Themenausschreibung</title>
</head>
<body>

<?php  
    require ("datenbankanbindung.php");

    if(count($_POST) > 0):
        if( !strlen(isset($_POST['themenname'])) > 0
            ||!strlen($_POST['beschreibung']) > 0
            ||!strlen($_POST['betreuer']) > 0
            ||!strlen($_POST['email']) > 0
        ){}
        else{
            $sql = "INSERT INTO themen "
                ."(themenname, beschreibung, email, betreuer) VALUES "
                ."(:themenname, :beschreibung, :email, :betreuer )";

            $query = $pdo->prepare($sql);
            $query->bindParam(':themenname', $_POST['themenname'], PDO::PARAM_STR);
            $query->bindParam(':beschreibung', $_POST['beschreibung'], PDO::PARAM_STR);
            $query->bindParam(':betreuer', $_POST['betreuer'], PDO::PARAM_STR);
            $query->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
            $query->execute();

            if($pdo->lastInsertId()){
                echo "<script type='text/javascript'>alert('Gespeichert');</script>";
            }
        }
    endif;
?>

<?php
    require ("datenbankanbindung.php");

    if(isset($_POST['ID'])):
        $sql = "DELETE FROM themen WHERE ID=:ID ";
        $query = $pdo->prepare($sql);
        $query->bindParam(':ID', $_POST['ID']);
        $query->execute();

        echo "<script type='text/javascript'>alert('Eintrag gelöscht');</script>"; 
    
    endif;


?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <a class="navbar-brand" href="Tutor.html">Themaausschreibung</a>
        <a class="btn btn-danger" href="BetreuerApp.html">Logout</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Themaausschreibung</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Zweitgutachter.php">Zweitgutachter</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="BetreuteArbeiten.php">Betreute Arbeiten</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Rechnungen.php">Rechnungen</a>
            </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h6>Thema hinzufügen:</h6>
        <form method="POST" class="formulare">
        <div class="form-group">
            <label for="thema">Name des Themas *</label>
            <input type="text" class="form-control form-control-sm" name="themenname" id="thema" placeholder="Name des Themas*">
        </div>
        <div class="form-group">
            <label for="beschreibung">Beschreibung *</label>
            <textarea class="form-control form-control-sm" name="beschreibung" id="beschreibung" rows="2"></textarea>
        </div>
        <div class="form-group">
            <label for="dropdownNameBetreuer">Name des Betreuers *</label>
            <div class="dropdown" id="dropdowNameBetreuer"><?php require ("betreuerThemenDropdown.php"); ?></div>
        </div>
        <div class='form-group'>
            <label for="dropdownEmailBetreuer">E-Mail des Betreuers *</label>
            <div class="dropdown" id="dropdowEmailBetreuer"><?php require ("emailDropdown.php"); ?></div>
        </div>
        <button type="submit" class="btn btn-primary btn-sm" value="Thema hinzufügen">Thema hinzufügen</button>
        </form>
        <br>
        <?php require_once ("themenAdminDb.php") ?>

    </div>
    <script></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>