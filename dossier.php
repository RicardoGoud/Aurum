<!DOCTYPE html>
<html lang="nl">
  <head>
    <title>Aurum</title>
    <link rel="stylesheet" href="./css/style.css"> <!-- Haal de algemene style op -->
    <link rel="stylesheet" href="./css/dossier.css"> <!-- Haal de style voor het dossier op -->
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
      <button onclick="location.href=`./overzicht_verzekerden.php`">Terug</button>
      </div>
      <button onclick="location.href=`./behandeling_toevoegen.php?client=<?php echo $_GET['client']; ?>`" type="button">Behandeling toevoegen</button>
    </div>

    <?php
    include('./DBConfig.php');

    $stmt = $verbinding->prepare("SELECT * FROM client WHERE gebruiker_id = ?"); // Bereid de variabele $stmt voor
    $stmt->execute(array($_GET['client']));
    $client = $stmt -> fetch(PDO::FETCH_ASSOC);

    
    $stmt = $verbinding->prepare("SELECT * FROM gebruiker WHERE id = ?"); // Bereid de variabele $stmt voor
    $stmt->execute(array($_GET['client']));
    $gebruiker = $stmt -> fetch(PDO::FETCH_ASSOC);
    ?>
    <!-- Eind logo + inlog -->

      <?php
        $voornaam = $gebruiker["voornaam"];
        $tussenvoegsel = $gebruiker["tussenvoegsel"];
        $achternaam = $gebruiker["achternaam"];
        $adres = $gebruiker["adres"];
        $postcode = $gebruiker["postcode"];
        $woonplaats = $gebruiker["woonplaats"];
        $telefoon = $gebruiker["telefoon"];
        $emailadres = $gebruiker["emailadres"];
        $geboortedatum = $client["geboortedatum"];
        $lengte = $client["lengte"];
        $geslacht = $client["geslacht"];
        $gewicht = $client["gewicht"];
        $bloedgroep = $client["bloedgroep"];

        $huisarts_id = $client["huisarts"];
        $stmt = $verbinding->prepare("SELECT * FROM huisarts WHERE gebruiker_id = ?");
        $stmt->execute(array($huisarts_id));
        $huisarts = $stmt -> fetch(PDO::FETCH_ASSOC);

        $verzekeringsmaatschappij_id = $client["verzekeringsmaatschappij"];
        $stmt = $verbinding->prepare("SELECT * FROM verzekeringsmaatschappij WHERE id = ?");
        $stmt->execute(array($verzekeringsmaatschappij_id));
        $verzekeringsmaatschappij = $stmt -> fetch(PDO::FETCH_ASSOC);

        $aandoening_id = $client["aandoening"];
        $stmt = $verbinding->prepare("SELECT * FROM aandoening WHERE id = ?");
        $stmt->execute(array($aandoening_id));
        $aandoening = $stmt -> fetch(PDO::FETCH_ASSOC);
            
        $allergie_id = $client["allergie"];
        $stmt = $verbinding->prepare("SELECT * FROM allergie WHERE id = ?");
        $stmt->execute(array($allergie_id));
        $allergie = $stmt -> fetch(PDO::FETCH_ASSOC);

        $stmt = $verbinding->prepare("SELECT * FROM medicijn_orders WHERE client_id = ?");
        $stmt->execute(array($_GET["client"]));
        $medicatie = $stmt -> fetchAll(PDO::FETCH_ASSOC);
      ?>

  <div class="big_wrapper">    

    <div class="persoonlijke_informatie">
      <p style="font-size: 35px;">Persoonsgegevens</p>
      <hr style="height: 3px; margin: 5px; margin-left: 0px; border-width:0; color: #ffffff; background-color: #ffffff;">

      <table>
        <tr>
          <td>Voornaam:</td>
          <td style="font-family: Segoe UI;"><?php echo $voornaam; ?></td>
        </tr>
        <tr>
          <td>Tussenvoegsel:</td>
          <td style="font-family: Segoe UI;"><?php echo $tussenvoegsel; ?></td>
        </tr>
        <tr>
          <td>Achternaam:</td>
          <td style="font-family: Segoe UI;"><?php echo $achternaam; ?></td>
        </tr>
        <tr>
          <td>Geboortedatum:</td>
          <td style="font-family: Segoe UI;"><?php echo $geboortedatum; ?></td>
        </tr>

        <tr>
          <td><br />Adres:</td>
          <td style="font-family: Segoe UI;"><br /><?php echo $adres; ?></td>
        </tr>
        <tr>
          <td>Postcode:</td>
          <td style="font-family: Segoe UI;"><?php echo $postcode; ?></td>
        </tr>
        <tr>
          <td>Woonplaats:</td>
          <td style="font-family: Segoe UI;"><?php echo $woonplaats; ?></td>
        </tr>

        <tr>
          <td><br />Telefoonnummer:</td>
          <td style="font-family: Segoe UI;"><br /><?php echo $telefoon; ?></td>
        </tr>
        <tr>
          <td>E-mailadres:</td>
          <td style="font-family: Segoe UI;"><?php echo $emailadres; ?></td>
        </tr>

        <tr>
          <td><br />Huisarts:</td>
          <td style="font-family: Segoe UI;"><br /><?php echo $huisarts["naam"]; ?></td>
        </tr>
        <tr>
          <td>Verzekeringsmaatschappij:</td>
          <td style="font-family: Segoe UI;"><?php echo $verzekeringsmaatschappij["vestigingsnaam"]; ?></td>
        </tr>
      </table>
    </div>
    

    <div class="medische_informatie">
      <p style="font-size: 35px;">Medische gegevens</p>
      <hr style="height: 3px; margin: 5px; margin-left: 0px; border-width:0; color: #226282; background-color: #226282;">

      <table>
        <tr>
          <td>Geslacht:</td>
          <td style="font-family: Segoe UI;"><?php echo $geslacht; ?></td>
        </tr>
        <tr>
          <td>Bloedgroep:</td>
          <td style="font-family: Segoe UI;"><?php echo $bloedgroep; ?></td>
        </tr>

        <tr>
          <td><br />Lengte:</td>
          <td style="font-family: Segoe UI;"><br /><?php echo $lengte; ?> CM</td>
        </tr>
        <tr>
          <td>Gewicht:</td>
          <td style="font-family: Segoe UI;"><?php echo $gewicht; ?> KG</td>
        </tr>

        <tr>
          <td><br />Aandoening:</td>
          <td style="font-family: Segoe UI;"><br /><?php echo $aandoening["aandoening"];?></td>
        </tr>
        <tr>
          <td>Allergie:</td>
          <td style="font-family: Segoe UI;"><?php echo $allergie["allergie"];?></td>
        </tr>
        <tr>
          <td>Medicatie:</td>
          <td style="font-family: Segoe UI;">
          <?php
          foreach($medicatie as $medicijn ){
            $stmt = $verbinding->prepare("SELECT * FROM medicijnen WHERE id = ?");
            $stmt->execute(array($medicijn["medicijn"]));
            $medicijn_result = $stmt -> fetch(PDO::FETCH_ASSOC);
            echo $medicijn_result["medicijn"];
            break;
          };
            ?>
          </td>
        </tr>
      </table>
    </div>
  </div>

  <div class="medische_historie">
      <p style="font-size: 35px;">Medische Historie</p>
      <hr style="height: 3px; margin: 5px; margin-left: 0px; border-width:0; color: #ffffff; background-color: #ffffff;">

      <table>
         <tr id="header">
           <td>Medicijn</td>
           <td>Datum voorgeschreven</td>
           <td>Apotheek</td>
           <td>Opgehaald</td>
           <td>Datum opgehaald</td>
         </tr>
        <?php 
          foreach($medicatie as $medicijn){
            // Haalt de namen van de medicijnen van alle orders voor de desbtetreffende cliënt op
            $stmt = $verbinding->prepare("SELECT * FROM medicijnen WHERE id = ?");
            $stmt->execute(array($medicijn["medicijn"]));
            $medicijn_result = $stmt -> fetch(PDO::FETCH_ASSOC);

            $stmt = $verbinding->prepare("SELECT * FROM apothekers WHERE gebruiker_id = ?");
            $stmt->execute(array($medicijn["apotheker"]));
            $apotheker = $stmt -> fetch(PDO::FETCH_ASSOC);



            echo "<tr> <td>" . $medicijn_result["medicijn"] . "</td>";
            echo "<td>" . $medicijn["datum_voorgeschreven"] . "</td>";
            echo "<td>" . $apotheker["vestigingsnaam"] . "</td>";
          } 
        ?>
        </tr>
      </table>
    </div>

    