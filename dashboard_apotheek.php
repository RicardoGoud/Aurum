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
    ?>
    <div id="big_wrapper">
        <table>
            <tr>
                <td>Cliënt</td>
                <td>Medicijn</td>
                <td>Datum Uitgeschreven</td>
                <td>Opgehaald</td>
                <td>Datum opgehaald</td>
                <td>Afgerond?</td>
            </tr>
                <?php 
                foreach($medicijn_orders as $medicijn_order){
                    $stmt = $verbinding->prepare("SELECT * FROM gebruiker WHERE id = ?");
                    $stmt->execute(array($medicijn_order["client_id"]));
                    $client_ids = $stmt -> fetch(PDO::FETCH_ASSOC);

                    $stmt = $verbinding->prepare("SELECT * FROM medicijnen WHERE id = ?");
                    $stmt->execute(array($medicijn_order["medicijn"]));
                    $medicijn = $stmt -> fetch(PDO::FETCH_ASSOC);

                    $medicijn_order_id = $medicijn_order["id"];

                    echo "<tr><td>" . $client_ids["voornaam"] . "</td>";

                    echo "<td>" . $medicijn["medicijn"] . "</td>";

                    echo "<td>" . $medicijn_order["datum_voorgeschreven"] . "</td>";

                    if($medicijn_order["opgehaald"] == 0){
                      $opgehaald = "Nee";
                    }else{
                        $opgehaald = "Ja";
                    }
                    echo "<td>" . $opgehaald . "</td>";

                    echo "<td>" . $medicijn_order["datum_opgehaald"] . "</td>";

                    if($medicijn_order["opgehaald"] == 0){
                    echo "<td> 
                          <form type='hidden' method='POST'>
                          <input type='hidden' name='order_id' value='$medicijn_order_id' required>
                          <input type='submit' name='submit' value='Afronden'>
                          </form>
                          </td></tr>";
                    }elseif($medicijn_order["opgehaald"] == 1){
                      echo "<td></td>";
                    }
                }

                if(isset($_POST["submit"])){
                  $order_id = $_POST["order_id"];
                  $date = date("Y/m/d");
                  $opgehaald_true = "1";

                  $stmt = $verbinding->prepare("SELECT * FROM medicijn_orders WHERE id = ?");
                  $stmt->execute(array($order_id));
                  $order = $stmt -> fetch(PDO::FETCH_ASSOC);

                  $stmt = $verbinding->prepare("UPDATE medicijn_orders SET opgehaald = ?, datum_opgehaald = ? WHERE id = ?");
                  $stmt->execute(array($opgehaald_true, $date, $order_id));
                  
                  header("Location: ./dashboard_apotheek.php");
                }
                ?>
        </table>
    </div>
        </body>
        </html>