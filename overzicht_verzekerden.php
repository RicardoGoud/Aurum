<!DOCTYPE html>
<html lang="nl">
  <head>
    <title>Aurum</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://kit.fontawesome.com/c9b427fe35.js" crossorigin="anonymous"></script> <!-- Link naar fontawesome -->
    <?php
    include("./DBConfig.php"); // Sessie is gestart in DBConfig
    ?>
  </head>
  <body>
    <!-- Begin header bar -->
    <div class='header_bar'>
      <div id='support'>
        <i class='fas fa-comment'></i> support@aurum.nl
      </div>
      <div id='adres'>
        <i class='fas fa-map-marker'></i> Adres: Carnissesingel 210, 3084 NA Rotterdam
      </div>
      <div id='telefoon'>
        <i class='fas fa-phone-alt'></i> Bel nu: 085 486 8005
      </div>
    </div>
    <!-- Eind header -->

    <!-- Begin logo + inlog -->
    <div class='logo_inlog_bar'>
      <div id='logo-div'>
        <img src='./img/Aurum.png' alt='logo' width='300px' height='80px'>
      </div>
      <div id='inlogknop-div'>
        <button onclick="location.href='./dashboard.php'" type='button'>Terug</button>
      </div>
    </div>
    <!-- Eind logo + inlog -->

    <table>
    <?php 
    if($_SESSION["rol"] == "verzekeraar" ){
      $stmt = $verbinding->prepare("SELECT * FROM client WHERE verzekeringsmaatschappij = ?");
      $stmt->execute(array($_SESSION["id"])); // Selecteer alles uit de tabel client waar het id van de verzekering gelijk is aan het momenteel ingelogde id
      $clienten = $stmt -> fetchAll(PDO::FETCH_ASSOC); 
    
      
      foreach($clienten as $client){ // Voor elk resultaat wat opgehaald is in $clienten word er $client van gemaakt
        $stmt = $verbinding->prepare("SELECT * FROM gebruiker WHERE id = ?"); 
        $stmt->execute(array($client['gebruiker_id']));
        $gebruiker = $stmt -> fetch(PDO::FETCH_ASSOC); // Selecteert de gebruikersinformatie per client

        $id = $client['gebruiker_id'];        

        $voornaam = $gebruiker['voornaam'];
        $tussenvoegsel = $gebruiker['tussenvoegsel'];
        $achternaam = $gebruiker['achternaam'];

        echo     "<tr>
                  <td>$voornaam</td>
                  <td>$tussenvoegsel</td>
                  <td>$achternaam</td>
                  <td><button onclick='javascript:location.href=\"dossier.php?client=$id\"'>dossier</button></td>
                  </tr>
                  <input hidden value='$id' name='client_id' />";
      }

    }elseif($_SESSION["rol"] == "admin" ){
      $stmt = $verbinding->prepare("SELECT * FROM client");
      $stmt->execute(); // Selecteer alles uit de tabel client
      $clienten = $stmt -> fetchAll(PDO::FETCH_ASSOC); 
    
      
      foreach($clienten as $client){ // Voor elk resultaat wat opgehaald is in $clienten word er $client van gemaakt
        $stmt = $verbinding->prepare("SELECT * FROM gebruiker WHERE id = ?"); 
        $stmt->execute(array($client['gebruiker_id']));
        $gebruiker = $stmt -> fetch(PDO::FETCH_ASSOC); // Selecteert de gebruikersinformatie per client

        $id = $client['gebruiker_id'];        

        $voornaam = $gebruiker['voornaam'];
        $tussenvoegsel = $gebruiker['tussenvoegsel'];
        $achternaam = $gebruiker['achternaam'];

        echo     "<tr>
                  <td>$voornaam</td>
                  <td>$tussenvoegsel</td>
                  <td>$achternaam</td>
                  <td><button onclick='javascript:location.href=\"dossier.php?client=$id\"'>dossier</button></td>
                  </tr>";
      }

    }elseif($_SESSION["rol"] == "huisarts" ){
      $stmt = $verbinding->prepare("SELECT * FROM client WHERE huisarts = ?");
      $stmt->execute(array($_SESSION["id"])); // Selecteer alles uit de tabel client waar het id van de verzekering gelijk is aan het momenteel ingelogde id
      $clienten = $stmt -> fetchAll(PDO::FETCH_ASSOC); 
    
      
      foreach($clienten as $client){ // Voor elk resultaat wat opgehaald is in $clienten word er $client van gemaakt
        $stmt = $verbinding->prepare("SELECT * FROM gebruiker WHERE id = ?"); 
        $stmt->execute(array($client['gebruiker_id']));
        $gebruiker = $stmt -> fetch(PDO::FETCH_ASSOC); // Selecteert de gebruikersinformatie per client

        $id = $client['gebruiker_id'];        

        $voornaam = $gebruiker['voornaam'];
        $tussenvoegsel = $gebruiker['tussenvoegsel'];
        $achternaam = $gebruiker['achternaam'];

        echo     "<tr>
                  <td>$voornaam $tussenvoegsel $achternaam</td>
                  <td><button onclick='javascript:location.href=\"dossier.php?client=$id\"'>dossier</button></td>
                  </tr>";
      }
    }
    ?>
    </table>
  </body>
</html>
