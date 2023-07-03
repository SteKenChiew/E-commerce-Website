<?php // continue.php
  session_start();

  if (isset($_SESSION['name']))
  {
    $name = htmlspecialchars($_SESSION['name']);
    
    destroy_session_and_data();
    header("location:index.php");
  }
  // else echo "Please <a href='logintest.php'>Click Here</a> to log in.";
  
  function destroy_session_and_data()
{
   //session_start();
   //$_SESSION = array();
  
   unset($_SESSION['name']);
   $_SESSION = array();
   session_unset();
   setcookie(session_name(), '', time() - 2592000, '/');
   session_destroy();
}
?>
