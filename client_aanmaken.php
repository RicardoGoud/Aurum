<!DOCTYPE html>
<html lang="nl">
  <head>
    <title>Cliënt aanmaken</title>
    <link rel="stylesheet" href="./css/style.css"> <!-- Haal de algemene style op -->
    <link rel="stylesheet" href="./css/client_aanmaken.css"> <!-- Haal de stijl voor deze pagina op -->

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
    <div class="form-aanmaken-client-div">

        <form action="" method="POST" id="form-aanmaken-client">
            <div class="naamgegevens">

              <input type="text" name="voornaam" id="field" required autocomplete="off"> Voornaam <br />
              <input type="text" name="tussenvoegsel" id="field" autocomplete="off"> Tussenvoegsel <br />
              <input type="text" name="achternaam" required id="field" autocomplete="off"> Achternaam <br /><br />
            </div>

            <div class="medischegegevens">
            <label class="container">Man
              <input name="geslacht" type="radio" value="Man" id="radio_geslacht" required>
              <span class="checkmark"></span> 
            </label>                                                                                <!-- Geslacht -->

            <label class="container">Vrouw
              <input name="geslacht" type="radio" value="Vrouw" id="radio_geslacht">
              <span class="checkmark"></span> 
            </label><br /><br /><br />

              
              <input name="datum" type="date" id="field" required><br />                                       <!-- Geboortedatum -->
              <input name="lengte" type="number" id="field" autocomplete="off" required>Lengte (CM)<br /> <!-- Lengte -->
              
              <input name="gewicht" type="number" id="field" autocomplete="off" required>Gewicht (KG)<br /><br />                                <!-- Gewicht -->
              <select name="bloedgroep" id="bloedgroep" required>                                                   <!-- Bloedgroep -->
                  <option value="A+">A+</option>
                  <option value="A-">A-</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>
                  <option value="O+">O+</option>
                  <option value="O-">O-</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>
              </select><br /><br />
            </div>

            <div class="huisarts-verzekeraar">
              <!-- Ophalen en printen van momenteel geregistreerde huisartsen -->
              <?php 
                // Als de momenteel ingelogde gebruiker een huisarts is word deze geselecteerd
                if($_SESSION["rol"] == "huisarts"){ 
                  echo "<select name='huisarts' hidden required>  <option hidden selected value=" .$_SESSION['id']. "></option> </select>";
                }
                
                // Is de momenteel ingelogde gebruiker geen huisarts wordt er een lijst met momenteel aangesloten huisartsen getoond
                else{ 
                  echo 
                  "<select name='huisarts' id='multiselect' required><br />                               
                      <option selected disabled>Kies een huisarts</option>";
                  
                      $stmt = $verbinding->prepare("SELECT * FROM huisarts");
                      $stmt->execute();
                      $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

                  foreach($result as $huisarts){
                      $id = $huisarts["gebruiker_id"];
                      $naam = $huisarts["naam"];
                      
                      echo "<option value='$id'>$naam</option>";
                      }
                    
                    }
              ?>
              </select><br />
              

              <!-- Ophalen en printen van momenteel geregistreerde verzekeringsmaatschappijen -->
              
              <?php 
                // Als de momenteel ingelogde gebruiker een verzekeraar is word deze geselecteerd
                if($_SESSION["rol"] == "verzekeraar"){ 
                  echo "<input type='hidden' selected name='verzekeringsmaatschappij' value=" .$_SESSION['id']. ">";
                }

                // Is de momenteel ingelogde gebruiker geen verzekeraar wordt er een lijst met momenteel aangesloten verzekeraars getoond
                else{ 
                  echo 
                  "   <select name='verzekeringsmaatschappij' id='multiselect' required>
                      <option selected disabled>Kies een verzekeringsmaatschappij</option>";
                  
                      $stmt = $verbinding->prepare("SELECT * FROM verzekeringsmaatschappij");
                      $stmt->execute();
                      $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

                      foreach($result as $verzekeringsmaatschappij){
                          $id = $verzekeringsmaatschappij["id"];
                          $vestigingsnaam = $verzekeringsmaatschappij["vestigingsnaam"];

                          echo "<option value='$id'>$vestigingsnaam</option>";
                      }
                      echo "</select>";
                    }
              ?>
            </select>
            </div>  

            <input type="hidden" name="rol" value="client">                                                 <!-- Rol selectie -->

            

            <input type="text" name="adres" id="field" autocomplete="off" required>Straat + Huisnummer <br />
            <input type="text" name="postcode" id="field" autocomplete="off" required>Postcode <br />
            <input type="text" name="woonplaats" id="field" autocomplete="off" required>Woonplaats <br /><br />
            
            <div id="contactgegevens">
              <input type="number" name="telefoon" id="field" autocomplete="off" required>Telefoon <br />
              <input type="text" name="email" id="field" autocomplete="off" required>E-mailadres <br /><br />
            </div>

            <div id="inloggegevens">
              <input type="text" name="gebruikersnaam" autocomplete="off" id="field">Gebruikersnaam <br />
              <input type="password" name="wachtwoord" autocomplete="off" id="field">Wachtwoord <br /><br />
            </div>

            <input name="submit" type="submit">
        </form>

        <?php 
           if(isset($_POST["submit"])){
               $datum = $_POST["datum"];
               $lengte = $_POST["lengte"];
               $geslacht = $_POST["geslacht"];
               $gewicht = $_POST["gewicht"];
               $bloedgroep = $_POST["bloedgroep"];
               $huisarts = $_POST["huisarts"];
               $verzekeringsmaatschappij = $_POST["verzekeringsmaatschappij"];
               $voornaam = $_POST["voornaam"];
               $tussenvoegsel = $_POST["tussenvoegsel"];
               $achternaam = $_POST["achternaam"];
               $rol = $_POST["rol"];
               $adres = $_POST["adres"];
               $postcode = $_POST["postcode"];
               $woonplaats = $_POST["woonplaats"];
               $telefoon = $_POST["telefoon"];
               $email = $_POST["email"];
               $gebruikersnaam = $_POST["gebruikersnaam"];
               $wachtwoord = ($_POST['wachtwoord']);
               $wachtwoordHash = password_hash($wachtwoord, PASSWORD_DEFAULT);

               $stmt = $verbinding->prepare("INSERT INTO gebruiker (id, rol, gebruikersnaam, wachtwoord, voornaam, tussenvoegsel, achternaam, adres, postcode, woonplaats, telefoon, emailadres)
                       VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
               $stmt->execute(array($rol, $gebruikersnaam, $wachtwoordHash, $voornaam, $tussenvoegsel, $achternaam, $adres, $postcode, $woonplaats, $telefoon, $email));
               

               $stmt = $verbinding->prepare("INSERT INTO client (gebruiker_id, geboortedatum, lengte, geslacht, gewicht, bloedgroep, huisarts, verzekeringsmaatschappij) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
               $stmt->execute(array($verbinding->lastInsertId(), $datum, $lengte, $geslacht, $gewicht, $bloedgroep, $huisarts, $verzekeringsmaatschappij));

               echo "Cliënt is succesvol toegevoegd.";
           
           }
        ?>
        
    </div>
  </div>
  </body>