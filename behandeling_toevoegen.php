<!DOCTYPE html>
<html lang="nl">
  <head>
    <title>Aurum</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/behandeling_toevoegen.css">
    <script src="https://kit.fontawesome.com/c9b427fe35.js" crossorigin="anonymous"></script> <!-- Link naar fontawesome -->
    <?php
    include("./DBConfig.php"); // Sessie is gestart in DBConfig
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
        <button onclick="location.href='./overzicht_verzekerden.php'" type="button">Terug</button>
      </div>
    </div>
    <!-- Eind logo + inlog -->
    <div id=achtergrond_div>
    <div class="behandeling_toevoegen_div">

    <?php 
    // Statement voor de gebruiker informatie
    $stmt = $verbinding->prepare("SELECT * FROM gebruiker WHERE id = ?");
    $stmt->execute(array($_GET['client']));
    $gebruiker = $stmt -> fetch(PDO::FETCH_ASSOC);


    // Statement voor de cliënt informatie
    $stmt = $verbinding->prepare("SELECT * FROM client WHERE gebruiker_id = ?");
    $stmt->execute(array($_GET['client']));
    $gebruiker = $stmt -> fetch(PDO::FETCH_ASSOC);

    ?>
    
    <form name="behandeling_toevoegen" method="POST" action="">
      <div id="aandoening_allergie_div">
      <!-- Haalt alle aandoeningen uit de database op -->
      <select id="multiselect" name="aandoening">
        <option selected disabled>Kies een aandoening</option>
        <?php
        // Statement voor alle aandoeningen
        $stmt = $verbinding->prepare("SELECT * FROM aandoening");
        $stmt->execute();
        $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

        foreach($result as $aandoening){
          $id = $aandoening["id"];
          $naam = $aandoening["aandoening"];

          echo "<option value='$id'>$naam</option>";
        }
        ?>
      </select><br />

      <!-- Haalt alle allergieën uit de database op -->
      <select id="multiselect" name="allergie">
        <option selected disabled>Kies een allergie</option>
        <?php
        // Statement voor alle allergieën
        $stmt = $verbinding->prepare("SELECT * FROM allergie");
        $stmt->execute();
        $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

        foreach($result as $allergie){
          $id = $allergie["id"];
          $naam = $allergie["allergie"];

          echo "<option value='$id'>$naam</option>";
        }
        ?>
      </select>
      </div>
      <div id="medicijn_order_div">
      <!-- Haalt alle medicijnen uit de database op -->
      <select id="multiselect" name="medicijn">
        <option selected disabled>Kies een medicijn</option>
        <?php
        // Statement voor alle allergieën
        $stmt = $verbinding->prepare("SELECT * FROM medicijnen");
        $stmt->execute();
        $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

        foreach($result as $medicijn){
          $id = $medicijn["id"];
          $naam = $medicijn["medicijn"];

          echo "<option value='$id'>$naam</option>";
        }
        ?>
      </select><br />

        <!-- Haalt alle apothekers uit de database op -->
        <select id="multiselect" name="apotheek">
        <option selected disabled>Kies een apotheker</option>
        <?php
        // Statement voor alle apothekers
        $stmt = $verbinding->prepare("SELECT * FROM apothekers");
        $stmt->execute();
        $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

        foreach($result as $apotheek){
          $id = $apotheek["gebruiker_id"];
          $naam = $apotheek["vestigingsnaam"];

          echo "<option value='$id'>$naam</option>";
        }
        ?>
        </select><br />

        <input type="text" id="multiselect" name="datum" value="<?php echo date("Y-m-d")?>" required readonly/></input><br />
      </div>
        
        <textarea id="multiselect" name="opmerking" rows="5" cols="30" required></textarea>

        <input type="submit" name="submit" value="Bevestigen"></input>
    </form>

    <?php 
           if(isset($_POST["submit"])){
              $datum = $_POST["datum"];
              $client = $_GET["client"];
              $opgehaald = 0;


              (isset($_POST['aandoening'])) ? $aandoening = $_POST['aandoening'] : $aandoening = NULL;
              if(!is_null($aandoening)) {
              // Voeg de aandoening toe aan de desbetreffende gebruiker
              $sql = "UPDATE client SET aandoening=? WHERE gebruiker_id=?";
              $stmt= $verbinding->prepare($sql);
              $stmt->execute([$aandoening, $client]);
              }


              (isset($_POST['allergie'])) ? $allergie = $_POST['allergie'] : $allergie = NULL;
              if(!is_null($allergie)) {
              // Voeg de allergie toe aan de desbetreffende gebruiker
              $sql = "UPDATE client SET allergie=? WHERE gebruiker_id=?";
              $stmt= $verbinding->prepare($sql);
              $stmt->execute([$allergie, $client]);
              }

              (isset($_POST['medicijn'])) ? $medicijn = $_POST['medicijn'] : $medicijn = NULL;
              if(!is_null($medicijn)) {
              // Voegt de medicijnen toe aan een nieuwe order
              $stmt = $verbinding->prepare("INSERT INTO medicijn_orders (client_id, medicijn, apotheker, datum_voorgeschreven, opgehaald)
              VALUES (?, ?, ?, ?, ?)");
              $stmt->execute(array($client, $medicijn, $id, $datum, $opgehaald));
              }
              

              (isset($_POST['opmerking'])) ? $opmerking = $_POST['opmerking'] : $opmerking = NULL;
              // Voegt de opmerking toe aan de 'behandeling' tabel
              $stmt = $verbinding->prepare("INSERT INTO behandeling (client_id, datum, opmerking)
              VALUES (?, ?, ?)");
              $stmt->execute(array($client, $datum, $opmerking));
              

               echo "Behandeling is succesvol toegevoegd.";
           }
        ?>
        </div>
        </div>
        </body>
    </html>