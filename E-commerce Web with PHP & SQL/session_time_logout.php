<?php


  if (isset($_SESSION['name']))
  {
    $name = htmlspecialchars($_SESSION['name']);
       
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 900)) {
        destroy_session_and_data();
        header("location:index.php");
        
        
    }
    else{
          
        }
    $_SESSION['LAST_ACTIVITY'] = time(); 
  
      }

  function destroy_session_and_data(){
  
   unset($_SESSION['name']);
   $_SESSION = array();
   session_unset();
   setcookie(session_name(), '', time() - 2592000, '/');
   session_destroy();
}
?>