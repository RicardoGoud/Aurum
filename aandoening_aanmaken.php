<!DOCTYPE html>
<html lang="nl">
  <head>
    <title>Cliënt aanmaken</title>
    <link rel="stylesheet" href="./css/style.css"> <!-- Haal de algemene style op -->
    <link rel="stylesheet" href="./css/aandoening_aanmaken.css"> <!-- Haal de algemene style op -->

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
    <div id=achtergrond_div>

    <div id="inhoud_div">
      <div id="aandoening_aanmaken">
        <p>Vul hieronder een aandoening in. Deze zal toegevoegd worden aan de database.</p><p> Let op: Hoofdlettergevoelig!</p><br /><br />
    <form action="" method="POST" id="form-aandoening_aanmaken">
        <input type="text" name="aandoening" required placeholder="b.v.b. Paracetamol"><br /><br />
        <input type="submit" name="submit" value="Aanmaken">
    </form>

    <?php 
        if(isset($_POST["submit"])){
            $aandoening = $_POST["aandoening"];

        $stmt = $verbinding->prepare("INSERT INTO aandoening (aandoening)
                       VALUES (?)");
               $stmt->execute(array($aandoening));
               
               echo "Aandoening is succesvol toegevoegd.";
        }
    ?>
      </div>
    </div>
    </div>
  </body>
  </html>