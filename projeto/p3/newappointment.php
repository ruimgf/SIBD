<!DOCTYPE html>
<html>
  <head>
    <title>Welcome to HealthCare </title>
  </head>
<body>
  <h1>
    Appointment
  </h1>
  <h2>
    Let's Make a Appointment
  </h2>
  <form action="make_appointment.php" method="post" id="form1">

    <?php

    include 'config.php';

    try {
      $connetion = new PDO($GLOBALS['dns'], $GLOBALS['user'],$GLOBALS['password'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    } catch (PDOException $exception) {
      echo("<p>Error: ");
      echo($exception->getMessage());
      echo("</p>");
    }
      $sql = "SELECT * FROM doctor";
      $result = $connetion->query($sql);
      echo "<p>Doctor:";
      echo "<select name='branch_name'>";
      foreach ($result as $value) {
            echo "<option value=";
            echo ($value['doctor_id']);
            echo '>';
            echo ($value['name']);
            echo "</option>";
      }
      echo  "</select>\n";
      echo  "</p>\n";
    ?>
    Date:<br>
    <input type="date" name="date"><br>
  </form>


</body>
</html>
<?php
?>
