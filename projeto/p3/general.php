<?php

  $db = "ist178247";
  $host = "db.ist.utl.pt";
  $user = "ist178247";
  $password = "htcp2526";
  $dns = "mysql:host=db.ist.utl.pt;dbname=ist178247";
  date_default_timezone_set("America/New_York");
  try {
    $connetion = new PDO($GLOBALS['dns'], $GLOBALS['user'],$GLOBALS['password']);
  } catch (PDOException $exception) {
    echo("<p>Error: ");
    echo($exception->getMessage());
    echo("</p>");
  }

  function echo_doctor(){
    try {
      $connetion = new PDO($GLOBALS['dns'], $GLOBALS['user'],$GLOBALS['password'],
      array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    } catch (PDOException $exception) {
      echo("<p>Error: ");
        echo($exception->getMessage());
        echo("</p>");
    }
    $sql = "SELECT * FROM doctor";
    $result = $connetion->query($sql);

    echo "<p>Doctor:";
    echo "<select name='doctor_id'>";
    foreach ($result as $value) {
      echo "<option value=";
      echo ($value['doctor_id']);
      echo '>';
      echo ("Doctor name : ". $value['name']);
      echo (" | Speciality: ".$value['speciality']);
      echo "</option>";
    }
    echo  "</select>\n";
    echo  "</p>\n";
    $connetion = NULL;

  }



  function isWeekend($date) {
      date_default_timezone_set("America/New_York");
      return (date('N', strtotime($date)) >= 6);
  }
?>