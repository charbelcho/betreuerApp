<!doctype html>
<html lang="de-DE">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="index.css">
    <title>Admin</title>
</head>
<body>
<?php
//fügt einen weiteren Betreuer in der Tabelle ein  
    require ("datenbankanbindung.php");

    if(count($_POST) > 0):
        if( !strlen(isset($_POST['vorname'])) > 0
            ||!strlen($_POST['nachname']) > 0
            ||!strlen($_POST['email']) > 0
            ||!strlen($_POST['faecher']) > 0 

        ){}
        else{
            $sql = "INSERT INTO betreuer "
                ."(titel, vorname, nachname, email, faecher) VALUES "
                ."(:titel, :vorname, :nachname, :email, :faecher)";

            $query = $pdo->prepare($sql);
            $query->bindParam(':titel', $_POST['titel'], PDO::PARAM_STR);
            $query->bindParam(':vorname', $_POST['vorname'], PDO::PARAM_STR);
            $query->bindParam(':nachname', $_POST['nachname'], PDO::PARAM_STR);
            $query->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
            $query->bindParam(':faecher', $_POST['faecher'], PDO::PARAM_STR);
            $query->execute();

            if($pdo->lastInsertId()){
                echo "<script type='text/javascript'>alert('Gespeichert');</script>";
            }
        }

    
    endif;
?>

<?php
//löscht den Betreuer in der jeweiligen Zeile
    require ("datenbankanbindung.php");

    if(isset($_POST['löschen'])):
        $sql = "DELETE FROM betreuer WHERE ID=:ID ";
        $query = $pdo->prepare($sql);
        $query->bindParam(':ID', $_POST['ID']);
        $query->execute();

        echo "<script type='text/javascript'>alert('Eintrag gelöscht');</script>"; 

    endif;
?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <a class="navbar-brand" href="#">Betreuer-App Admin</a>
        <a class="btn btn-danger" href="BetreuerApp.html">Logout</a>
    </nav>

    <div class="container">
        <h6 class="pt-3">Betreuer hinzufügen:</h6>
        <form method="POST" class="formulare">
        <div class="form-group">
            <label for="selectTitel">Titel *</label>
            <select class="form-control" name="titel" id="selectTitel">
            <option></option>
            <option>Dr.</option>
            <option>Professor</option>
            <option>Professor Dr.</option>
            </select>
        </div>
        <div class="form-group">
            <label for="vorname">Vorname *</label>
            <input type="text" class="form-control" name="vorname" id="vorname" placeholder="Vorname *">
        </div>
        <div class="form-group">
            <label for="nachname">Nachname *</label>
            <input type="text" class="form-control" name="nachname" id="nachname" placeholder="Nachname *">
        </div>
        <div class="form-group">
            <label for="email">E-Mail *</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="E-Mail *">
        </div>
        <div class="form-group">
            <label for="faecher">Fächer *</label>
            <input type="text" class="form-control" name="faecher" id="faecher" placeholder="Fächer *">
        </div>
        
        <button type="submit" class="btn btn-primary" name="hinzufügen" value="Betreuer hinzufügen">Betreuer hinzufügen</button>
        </form>
        <br>

        <?php require_once ("betreuerAdminDb.php"); ?>
        
    </div>
    
    <script></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>