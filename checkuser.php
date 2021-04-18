<?php 
include("./DBConfig.php"); // Sessie is gestart in DBConfig.php

$gebruikersnaam = $_POST["username"]; // Variabele gebruikersnaam invullen met wat er gepost is in het form op inloggen.php
$wachtwoord = $_POST["password"];     // Variabele wachtwoord invullen met wat er gepost is in het form op inloggen.php

$stmt = $verbinding->prepare("SELECT * FROM gebruiker WHERE gebruikersnaam = ?"); // Bereid de variabele $stmt voor
$stmt->execute(array($gebruikersnaam));
$result = $stmt -> fetch(PDO::FETCH_ASSOC);

if ($result) {
    
    if (password_verify(htmlspecialchars($_POST['password']), $result['wachtwoord'])) {

    // Maak sessie van de desbetreffende gebruiker zijn gegevens als het wachtwoord klopt
    $_SESSION["id"] = $result["id"];
    $_SESSION["rol"] = $result["rol"];
    $_SESSION["gebruikersnaam"] = $result["gebruikersnaam"];
    $_SESSION["wachtwoord"] = $result["wachtwoord"];
    $_SESSION["voornaam"] = $result["voornaam"];
    $_SESSION["tussenvoegsel"] = $result["tussenvoegsel"];
    $_SESSION["achternaam"] = $result["achternaam"];
    $_SESSION["adres"] = $result["adres"];
    $_SESSION["postcode"] = $result["postcode"];
    $_SESSION["woonplaats"] = $result["woonplaats"];
    $_SESSION["telefoon"] = $result["telefoon"];
    $_SESSION["emailadres"] = $result["emailadres"];

    // Stuur de gebruiker door naar het dashboard
    header("Location: ./dashboard.php");
    }
}else{
    header("Location: ./inloggen.php");
}

?>