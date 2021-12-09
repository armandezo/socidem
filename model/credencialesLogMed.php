<?php 
 $type = 'LOGIN';
 include 'config.php';
 
 $client = new Google_Client();
 $client->setClientId($clientID);
 $client->setClientSecret($clientSecret);
 $client->setRedirectUri($redirectUri_login_medico); 
 $client->addScope("email");
 $client->addScope("profile");



?>