<!DOCTYPE html>
<html lang="nl">
  <head>
    <title>Gebruiker aanmaken</title>
    <link rel="stylesheet" href="./css/style.css"> <!-- Haal de algemene style op -->
    <?php
    include("./DBConfig.php"); // Sessie is gestart in DBConfig
    ?>
    <script src="https://kit.fontawesome.com/c9b427fe35.js" crossorigin="anonymous"></script> <!-- Link naar fontawesome -->
  </head>
  <body>

    <!-- Begin header bar -->
    <div class="header_bar">
      <div id="support">
        <i class="fas fa-comment"></i> support@aurum.nl
      </div>
      <div id="adres">
        <i class="fas fa-map-marker"></i> Adres: Carnissesingel 210, 3084 NA Rotterdam
      </div>
      <div id="telefoon">
        <i class="fas fa-phone-alt"></i> Bel nu: 085 486 8005
      </div>
    </div>
    <!-- Eind header -->

    <!-- Begin logo + inlog -->
    <div class="logo_inlog_bar">
      <div id="logo-div">
        <img src="./img/Aurum.png" alt="logo" width="300px" height="80px">
      </div>
      <div id="inlogknop-div">
      <button onclick="location.href='./dashboard.php'" type="button">Terug</button>
      </div>
    </div>
    <!-- Eind logo + inlog -->

    <div class="form-aanmaken-gebruiker-div">

        <form action="" method="POST" id="form-aanmaken-gebruiker">

            <input type="text" name="voornaam" required>Voornaam <br />
            <input type="text" name="tussenvoegsel">Tussenvoegsel <br />
            <input type="text" name="achternaam" required>Achternaam <br /><br />

            <input type="text" name="vestigingsnaam" required>Vestigingsnaam <br /><br />

            <input type="hidden" name="rol" value="huisarts">                                                 <!-- Rol selectie -->

            <input type="text" name="gebruikersnaam">Gebruikersnaam <br />
            <input type="password" name="wachtwoord">Wachtwoord <br /><br />

            <input type="text" name="adres" required>Straat + Huisnummer <br />
            <input type="text" name="postcode" required>Postcode <br />
            <input type="text" name="woonplaats" required>Woonplaats <br /><br />

            <input type="number" name="telefoon" required>Telefoon <br />
            <input type="text" name="email" required>E-mailadres <br /><br />

            <input name="submit" type="submit">
        </form>

        <?php 
           if(isset($_POST["submit"])){
               $voornaam = $_POST["voornaam"];
               $tussenvoegsel = $_POST["tussenvoegsel"];
               $achternaam = $_POST["achternaam"];
               $vestigingsnaam = $_POST["vestigingsnaam"];
               $rol = $_POST["rol"];
               $gebruikersnaam = $_POST["gebruikersnaam"];
               $wachtwoord = ($_POST['wachtwoord']);
               $adres = $_POST["adres"];
               $postcode = $_POST["postcode"];
               $woonplaats = $_POST["woonplaats"];
               $telefoon = $_POST["telefoon"];
               $email = $_POST["email"];

               $wachtwoordHash = password_hash($wachtwoord, PASSWORD_DEFAULT);
               $volledigenaam = $voornaam ." ". $tussenvoegsel ." ". $achternaam;


               $stmt = $verbinding->prepare("INSERT INTO gebruiker (id, rol, gebruikersnaam, wachtwoord, voornaam, tussenvoegsel, achternaam, adres, postcode, woonplaats, telefoon, emailadres)
                       VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
               $stmt->execute(array($rol, $gebruikersnaam, $wachtwoordHash, $voornaam, $tussenvoegsel, $achternaam, $adres, $postcode, $woonplaats, $telefoon, $email));
               

               $stmt = $verbinding->prepare("INSERT INTO huisarts (gebruiker_id, naam, vestigingsnaam, vestigingsadres) 
                       VALUES (?, ?, ?, ?)");
               $stmt->execute(array($verbinding->lastInsertId(), $volledigenaam, $vestigingsnaam, $adres));

               echo "Gebruiker is succesvol toegevoegd.";
           }
        ?>
        
    </div>
  </body>