<?php
  $type = 'REGISTER';
  include 'config.php';
  
  $helper = $fb->getRedirectLoginHelper();
  
  $permissions = ['email']; // Optional permissions
  $loginUrl = $helper->getLoginUrl($url_face_reg_pacientes , $permissions);
   