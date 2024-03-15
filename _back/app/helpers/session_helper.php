<?php
  session_start();

function adminIsLoggedIn(){
    if(isset($_SESSION['user_id'])  && $_SESSION['roleId'] == 1){
      return true;
    } else {
      return false;
    }
    
  }