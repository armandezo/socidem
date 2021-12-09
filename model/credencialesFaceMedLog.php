<?php
  $type = 'LOGIN';
  include 'config.php';
  
  $helper = $fb->getRedirectLoginHelper();
  
  $permissions = ['email']; // Optional permissions
  $loginUrl = $helper->getLoginUrl($url_face_login_medicos , $permissions);
   

