<!DOCTYPE html>
<html lang="nl">
  <head>
    <title>Aurum</title>
    <link rel="stylesheet" href="./css/style.css"> <!-- Haal de algemene style op -->
    <link rel="stylesheet" href="./css/dashboard.css"> <!-- Haal de style voor dashboard elementen op -->
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
    <div id=achtergrond_div>
    <div id="groet">
        <a style="color: #226282; font-size: 50px;">Hallo</a><br />
        <?php echo $_SESSION["voornaam"] ." ". $_SESSION["tussenvoegsel"] ." ". $_SESSION["achternaam"]; ?>.<br />
        <hr style="width: 280px; border-width:0; color: #226282; background-color: #226282; height: 3px;">
        <a style="font-size:20px; font-family: Arial;">laten we beginnen.</a>
    </div>

    <?php
    if($_SESSION["rol"] == "verzekeraar" || $_SESSION["rol"] == "admin" || $_SESSION["rol"] == "huisarts" ){
        echo '
            <div id="main_wrapper">
            <div class="div-dashboard" style="float: left;">
            <i class="fas fa-user" style="font-size: 35px;"></i>
            <p>Cliënt<br /> aanmaken</p>
            <button onclick="location.href=`./client_aanmaken.php`" type="button">Start</button>
            </div>

            <div class="div-dashboard" style="float: left;">
            <i class="fas fa-user-cog" style="font-size: 35px;"></i>
            <p>Gebruiker aanmaken</p>
            <button onclick="location.href=`./gebruiker_aanmaken_keuze.php`" type="button">Start</button>
            </div>

            
            <div class="div-dashboard" style="float: left;">
            <i class="fas fa-users" style="font-size: 35px;"></i>
            <p>Overzicht verzekerden</p>
            <button onclick="location.href=`./overzicht_verzekerden.php`" type="button">Start</button>
            </div>

            <div class="div-dashboard" style="float: left;">
            <i class="fas fa-bacterium" style="font-size: 35px;"></i>
            <p>Aandoening aanmaken</p>
            <button onclick="location.href=`./aandoening_aanmaken.php`" type="button">Start</button>
            </div>
            </div>
        ';
    }elseif($_SESSION["rol"] == "apotheek"){
        header("Location: ./dashboard_apotheek.php");
    }
    ?>



  </div>
    </body>
</html>