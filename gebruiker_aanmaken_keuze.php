<!DOCTYPE html>
<html lang="nl">
  <head>
    <title>Gebruiker aanmaken</title>
    <link rel="stylesheet" href="./css/style.css"> <!-- Haal de algemene style op -->
    <link rel="stylesheet" href="./css/gebruiker_aanmaken_keuze.css"> <!-- Haal de style voor deze pagina op -->
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
    <div id="achtergrond_div">

    <p>Welke gebruiker wilt u aanmaken?</p>
    <h4>Mocht de gewenste gebruiker er niet tussenstaan, <br />neem dan contact op met de beheerder.</h4>
    <div id="alle_gebruikers_div">
        <a href="./huisarts_aanmaken.php">
            <div id="huisarts">
                <i class="fas fa-user-md" style="font-size: 100px; padding: 10px; color: #ffffff; padding-top: 50px;"></i><br />
                <p id="subtitel">Huisarts<p>
            </div>
        </a>

        <a href="./apotheek_aanmaken.php">
            <div id="apotheek">
                <i class="fas fa-user-tag" style="font-size: 100px; padding: 10px; color: #ffffff; padding-top: 50px;"></i><br />
                <p id="subtitel">Apotheker</p>
            </div>
        </a>
    </div>
  </div>
  </body>