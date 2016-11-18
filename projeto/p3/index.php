<?php
include 'config.php';


try {
   $connetion = new PDO($GLOBALS['dns'], $GLOBALS['user'],$GLOBALS['password']);
} catch (PDOException $exception) {
      echo("<p>Error: ");
      echo($exception->getMessage());
      echo("</p>");
}

  $connetion = NULL;


?>
