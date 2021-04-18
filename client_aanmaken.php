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
    
    <div class="form-aanmaken-client-div">

        <form action="" method="POST" id="form-aanmaken-client">
            <div class="naamgegevens">
              <input type="text" name="voornaam" required>Voornaam <br />
              <input type="text" name="tussenvoegsel">Tussenvoegsel <br />
              <input type="text" name="achternaam" required>Achternaam <br /><br />
            </div>

            <div class="medischegegevens">
              <input name="geslacht" type="radio" value="Man" required>Man</input>                  <!-- Geslacht -->
              <input name="geslacht" type="radio" value="Vrouw">Vrouw</input><br />

              <input name="datum" type="date" required><br />                                       <!-- Geboortedatum -->
              <input name="lengte" type="number" placeholder="lengte" required>CM<br /> <!-- Lengte -->
              
              <input name="gewicht" type="number" required>KG<br />                                 <!-- Gewicht -->
              <select name="bloedgroep" required>                                                   <!-- Bloedgroep -->
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
                  "<select name='huisarts' required><br />                               
                      <option selected disabled>Kies een huisarts</option>";
                  
                      $stmt = $verbinding->prepare("SELECT * FROM huisarts");
                      $stmt->execute();
                      $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

                  foreach($result as $huisarts){
                      $id = $huisarts["id"];
                      $naam = $huisarts["naam"];

                      echo "<option value='$id'>$naam</option>";
                      }
                    }
              ?>
              </select><br />
              

              <!-- Ophalen en printen van momenteel geregistreerde verzekeringsmaatschappijen -->
              <select name="verzekeringsmaatschappij" required>
              <?php 
                // Als de momenteel ingelogde gebruiker een verzekeraar is word deze geselecteerd
                if($_SESSION["rol"] == "verzekeraar"){ 
                  echo "<option selected value=" .$_SESSION['id']. "></option>";
                }

                // Is de momenteel ingelogde gebruiker geen verzekeraar wordt er een lijst met momenteel aangesloten verzekeraars getoond
                else{ 
                  echo 
                  "                
                      <option selected disabled>Kies een verzekeringsmaatschappij</option>";
                  
                      $stmt = $verbinding->prepare("SELECT * FROM verzekeringsmaatschappij");
                      $stmt->execute();
                      $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

                      foreach($result as $verzekeringsmaatschappij){
                          $id = $verzekeringsmaatschappij["id"];
                          $vestigingsnaam = $verzekeringsmaatschappij["vestigingsnaam"];

                          echo "<option value='$id'>$vestigingsnaam</option>";
                      }
                    }
              ?>
            </select><br /><br />
            </div>  

            <input type="hidden" name="rol" value="client">                                                 <!-- Rol selectie -->

            

            <input type="text" name="adres" required>Straat + Huisnummer <br />
            <input type="text" name="postcode" required>Postcode <br />
            <input type="text" name="woonplaats" required>Woonplaats <br /><br />

            <input type="number" name="telefoon" required>Telefoon <br />
            <input type="text" name="email" required>E-mailadres <br /><br />

            <input type="text" name="gebruikersnaam">Gebruikersnaam <br />
            <input type="password" name="wachtwoord">Wachtwoord <br /><br />
          

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
  </body>