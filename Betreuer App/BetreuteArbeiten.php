<!doctype html>
<html lang="de-DE">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="index.css">
    <title>Betreute Arbeiten</title>
</head>
<body>

<?php
//fügt eine betreute Arbeit in die Datenbank ein  
    require ("datenbankanbindung.php");

    if(isset($_POST['arbeithinzufügen']) > 0):
        if( !strlen($_POST['titelDerArbeit']) > 0
            ||!strlen($_POST['nameDesStudenten']) > 0
            ||!strlen($_POST['andererGutachter']) > 0
        ){}
        else if($_POST['betreuerstatus']=="hauptbetreuer"){
            $sql = "INSERT INTO betreuteArbeiten "
                ."(titelDerArbeit, nameDesStudenten, abgabetag, abgabemonat, abgabejahr, andererGutachter) VALUES "
                ."(:titelDerArbeit, :nameDesStudenten, :abgabetag, :abgabemonat, :abgabejahr, :andererGutachter)";


            $query = $pdo->prepare($sql);
            $query->bindParam(':titelDerArbeit', $_POST['titelDerArbeit'], PDO::PARAM_STR);
            $query->bindParam(':nameDesStudenten', $_POST['nameDesStudenten'], PDO::PARAM_STR);
            $query->bindParam(':abgabetag', $_POST['abgabetag'], PDO::PARAM_STR);
            $query->bindParam(':abgabemonat', $_POST['abgabemonat'], PDO::PARAM_STR);
            $query->bindParam(':abgabejahr', $_POST['abgabejahr'], PDO::PARAM_STR);
            $query->bindParam(':andererGutachter', $_POST['andererGutachter'], PDO::PARAM_STR);
            $query->execute();

            if($pdo->lastInsertId()){
                echo "<script type='text/javascript'>alert('Gespeichert');</script>";
            }
        }
        else if($_POST['betreuerstatus']=="zweitgutachter"){
            $sql = "INSERT INTO alsZweitgutachterBetreuteArbeiten "
                ."(titelDerArbeit, nameDesStudenten, abgabetag, abgabemonat, abgabejahr, andererGutachter) VALUES "
                ."(:titelDerArbeit, :nameDesStudenten, :abgabetag, :abgabemonat, :abgabejahr, :andererGutachter)";


            $query = $pdo->prepare($sql);
            $query->bindParam(':titelDerArbeit', $_POST['titelDerArbeit'], PDO::PARAM_STR);
            $query->bindParam(':nameDesStudenten', $_POST['nameDesStudenten'], PDO::PARAM_STR);
            $query->bindParam(':abgabetag', $_POST['abgabetag'], PDO::PARAM_STR);
            $query->bindParam(':abgabemonat', $_POST['abgabemonat'], PDO::PARAM_STR);
            $query->bindParam(':abgabejahr', $_POST['abgabejahr'], PDO::PARAM_STR);
            $query->bindParam(':andererGutachter', $_POST['andererGutachter'], PDO::PARAM_STR);
            $query->execute();

            if($pdo->lastInsertId()){
                echo "<script type='text/javascript'>alert('Gespeichert');</script>";
            }
        }
        else{
            echo "<script type='text/javascript'>alert('Bitte auswählen ob sie Hauptbetreuer oder Zweitgutachter sind!');</script>";
        }

    endif;
?>
<?php
//speichert den Zustand der Arbeit in der Hauptbetreuer-Tabelle
    require ("datenbankanbindung.php");

    $id = @($_POST['ID']);
    if(isset($_POST['speichern'])):
        if( !strlen($_POST['zustand']) > 0 
        ){
            echo "<script type='text/javascript'>alert('Zustand überprüfen');</script>";
        }
        else{
            $sql = "UPDATE `betreuteArbeiten` SET `zustand` = '$_POST[zustand]' WHERE `ID` = ? ";

            $query = $pdo->prepare($sql);
            $query->bindParam(':zustand', $_POST['zustand'], PDO::PARAM_STR);
            $query->bindParam(':ID', $_POST['ID'], PDO::PARAM_INT);
            $query->execute(array($id));

            echo "<script type='text/javascript'>alert('Eintrag bearbeitet');</script>"; 
        }
        
    endif;
?>

<?php
//speichert den Zustand der Arbeit in der Zweitgutachter-Tabelle
    require ("datenbankanbindung.php");

    $id = @($_POST['ID']);
    if(isset($_POST['zgspeichern'])):
        $sql = "UPDATE `alsZweitgutachterBetreuteArbeiten` SET `zustand` = '$_POST[zustand]' WHERE `ID` = ? ";

        $query = $pdo->prepare($sql);
        $query->bindParam(':zustand', $_POST['zustand'], PDO::PARAM_STR);
        $query->bindParam(':ID', $_POST['ID'], PDO::PARAM_INT);
        $query->execute(array($id));

        echo "<script type='text/javascript'>alert('Eintrag bearbeitet');</script>";
    
    endif;
?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <a class="navbar-brand" href="Tutor.html">Betreute Arbeiten</a>
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
            <li class="nav-item active">
                <a class="nav-link" href="#">Betreute Arbeiten</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Rechnungen.php">Rechnungen</a>
            </li>
            </ul>
        </div>
    </nav>

<div class="container">
        <h6>Betreute Arbeit hinzufügen:</h6>
    <form method="POST" class="formulare">
        <div class="form-group">
            <label for="titelDerArbeit">Titel der Arbeit *</label>
            <input type="text" class="form-control form-control-sm" name="titelDerArbeit" id="titelDerArbeit" placeholder="Titel der Arbeit *">
        </div>
        <div class="form-group">
            <label for="nameDesStudenten">Name des Studenten *</label>
            <input type="text" class="form-control form-control-sm" name="nameDesStudenten" id="nameDesStudenten" placeholder="Name des Studenten *">
        </div>
        
        <div class="form-group ">
            <label>Abgabetermin *</label>
            <div class="d-flex bd-highlight">
            <select class="form-control col-3 form-control-sm" name="abgabetag" id="tag">
                <option></option>
                <option>01.</option>
                <option>02.</option>
                <option>03.</option>
                <option>04.</option>
                <option>05.</option>
                <option>06.</option>
                <option>07.</option>
                <option>08.</option>
                <option>09.</option>
                <option>10.</option>
                <option>11.</option>
                <option>12.</option>
                <option>13.</option>
                <option>14.</option>
                <option>15.</option>
                <option>16.</option>
                <option>17.</option>
                <option>18.</option>
                <option>19.</option>
                <option>20.</option>
                <option>21.</option>
                <option>22.</option>
                <option>23.</option>
                <option>24.</option>
                <option>25.</option>
                <option>26.</option>
                <option>27.</option>
                <option>28.</option>
                <option>29.</option>
                <option>30.</option>
                <option>31.</option>
            </select>
            <select class="form-control col-3 form-control-sm" name="abgabemonat" id="monat">
                <option></option>
                <option>01.</option>
                <option>02.</option>
                <option>03.</option>
                <option>04.</option>
                <option>05.</option>
                <option>06.</option>
                <option>07.</option>
                <option>08.</option>
                <option>09.</option>
                <option>10.</option>
                <option>11.</option>
                <option>12.</option>
            </select>
            <select class="form-control col-3 form-control-sm" name="abgabejahr" id="jahr">
                <option></option>
                <option>2019</option>
                <option>2020</option>
                <option>2021</option>
                <option>2022</option>
                <option>2023</option>
                <option>2024</option>
                <option>2025</option>
                <option>2026</option>
                <option>2027</option>
                <option>2028</option>
                <option>2029</option>
            </select>
            </div>
        </div>
        
        
        
        <div class="form-group">
            <label>Ich betreue die Arbeit als: *</label>
            <div class="d-flex bd-highlight">
                <input type="radio" class="form-control form-control-sm" name="betreuerstatus" value="hauptbetreuer">Hauptbetreuer
                <input type="radio" class="form-control form-control-sm" name="betreuerstatus" value="zweitgutachter">Zweitgutachter
            </div>
        </div>
        <div class="form-group">
            <label for="auswahl">Hauptbetreuer/Zweitgutachter *</label>
            <div class="dropdown" id="auswahl"><?php require_once ("betreuerDropdown.php"); ?></div>
            
        </div>
        <button type="submit" class="btn btn-primary btn-sm" name="arbeithinzufügen" value="Betreute Arbeit hinzufügen">Betreute Arbeit hinzufügen</button>
    </form>
    <br>
    <h6>Als Hauptbetreuer:</h6>
    <?php require_once ("betreuteArbeitenDb.php"); ?>
    <h6>Als Zweitgutachter:</h6>
    <?php require_once ("zweitgutachterBetreuteArbeitenDb.php"); ?>
    <br>
    <p>Legende:</p>
    <table class="table table-sm">
        <thead class="thead-dark"></thead>
        <tr><th scope="col">Eine Arbeit kann folgende Zustände haben:</th></tr>
        <tr><td>in Abstimmung</td></tr>
        <tr><td>angemeldet</td></tr>
        <tr><td>abgegeben</td></tr>
        <tr><td>Kolloquium abgehalten</td></tr>
    </table>
</div>

    <script></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>