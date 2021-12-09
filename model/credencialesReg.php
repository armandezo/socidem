<?php 
    
    $type = 'REGISTER';
    include 'config.php';
    
    $client = new Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectUri_registro_paciente);
    $client->addScope("email");
    $client->addScope("profile");


 
?>