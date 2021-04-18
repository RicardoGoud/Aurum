<!DOCTYPE html>
<html lang="nl">
  <head>
    <title>Log in a.u.b.</title>
    <link rel="stylesheet" href="./css/inloggen.css">
    <meta charset="utf-8">
    <script src="https://kit.fontawesome.com/c9b427fe35.js" crossorigin="anonymous"></script> <!-- Link naar fontawesome -->
    <?php 
      include("./DBConfig.php"); // Sessie is gestart in DBConfig.php
    ?>
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
        <button onclick="location.href='./index.html'" type="button">Home</button>
      </div>
    </div>
    <!-- Eind logo + inlog -->

    <!-- Begin inlog div -->
    <div class="inlogdiv">
      <div id="inlog">
        <p style="font-size: 23px; color: #ffffff; padding: 25px;">Vul hieronder uw gegevens in:</p>

        <form action="./checkuser.php" method="POST">
          <label for="username" id="form-subtitel">Gebruikersnaam</label><br>
          <input type="text" id="opmaak-form" name="username" placeholder="Gebruikersnaam" required><br />

          <label style="color: #ffffff; padding-left: 25px;"><input type="checkbox" name="checkbox">E-mail onthouden</label><br /><br /><br />

          <label for="password" id="form-subtitel">Wachtwoord</label><br>
          <input type="password" id="opmaak-form" name="password" placeholder="*******" required><br />
          <a id="wachtwoordvergeten" href="./wachtwoordvergeten.html">Wachtwoord vergeten?</a><br><br><br />

          <input id="submit" type="submit" value="Aan de slag">
        </form>
  
        <p id="copyrightclaim">© 2021 - AURM, alle rechten voorbehouden</p>
      </div>
      <img src="./img/achtergrond-inlog.png" alt="Achtergrond" id="background-img">
    </div>
    <!-- Eind inlog div -->
  
    </body>
    </html>
