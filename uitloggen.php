<?php 
    include("./DBConfig.php");

    session_destroy();
    header("Location: ./index.html");
?>
