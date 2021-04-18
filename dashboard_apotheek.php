<!DOCTYPE html>
<html lang="nl">
  <head>
    <title>Aurum</title>
    <link rel="stylesheet" href="./css/style.css"> <!-- Haal de algemene style op -->
    <link rel="stylesheet" href="./css/dashboard_apotheek.css"> <!-- Haal de style voor dashboard elementen op -->
    <?php
    include("./DBConfig.php"); //Sessie is gestart in DBConfig
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
      <button onclick="uitloggen()">Uitloggen</button>
        <script type="text/javascript"> 
            function uitloggen(){
                var redirect;
                if (confirm("Weet u zeker dat u wilt uitloggen?")) {
                    redirect = window.location.href = "./index.html";
                } else {
                    
                }
            }
        </script>
      </div>
    </div>
    <!-- Eind logo + inlog -->
    
    <?php 
    // Haal alle orders op
    $stmt = $verbinding->prepare("SELECT * FROM medicijn_orders WHERE apotheker = ?");
    $stmt->execute(array($_SESSION["id"]));
    $medicijn_orders = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    print_r($_SESSION["id"]);
    ?>
    <div id="big_wrapper">
        <table>
            <tr>
                <td>Cliënt</td>
                <td>Medicijn</td>
                <td>Datum Uitgeschreven</td>
                <td>Opgehaald</td>
                <td>Datum opgehaald</td>
                <td></td>
            </tr>
                <?php 
                foreach($medicijn_orders as $client_id){
                    $stmt = $verbinding->prepare("SELECT * FROM gebruiker WHERE id = ?");
                    $stmt->execute(array($client_id["client_id"]));
                    $client_ids = $stmt -> fetch(PDO::FETCH_ASSOC);
                    echo "<tr><td>" . $client_ids["voornaam"] . "</td>";
                }
                foreach($medicijn_orders as $medicijn_id){
                    $stmt = $verbinding->prepare("SELECT * FROM medicijnen WHERE id = ?");
                    $stmt->execute(array($medicijn_id["medicijn"]));
                    $medicijn_ids = $stmt -> fetch(PDO::FETCH_ASSOC);
                    echo "<td>" . $medicijn_ids["medicijn"] . "</td>";
                }
                foreach($medicijn_orders as $datum_voorgeschreven){
                    echo "<td>" . $datum_voorgeschreven["datum_voorgeschreven"] . "</td>";
                }
                foreach($medicijn_orders as $opgehaald_id){
                    if($opgehaald_id["opgehaald"] == 0){
                        $opgehaald = "Nee";
                    }else{
                        $opgehaald = "Ja";
                    }
                    echo "<td>" . $opgehaald . "</td>";
                }
                foreach($medicijn_orders as $datum_opgehaald){
                    echo "<td>" . $datum_opgehaald["datum_opgehaald"] . "</td>";
                }
                foreach($medicijn_orders as $knop){
                    echo "<td> <button>Afronden</button> </td></tr>";
                }
                ?>
        </table>
    </div>
        </body>
        </html>