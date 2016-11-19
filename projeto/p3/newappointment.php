<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Welcome to HealthCare </title>
  </head>
<body>
  <h1>Appointment</h1>
  <h2>Let's Make an Appointment</h2>
  <form action="make_appointment.php" method="post" id="form1">
    <?php
    include 'config.php';
    
    try {
      $connetion = new PDO($GLOBALS['dns'], $GLOBALS['user'],$GLOBALS['password'],
      array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    } catch (PDOException $exception) {
      echo("<p>Error: ");
      echo($exception->getMessage());
      echo("</p>");
    }
      $sql = "SELECT name,doctor_id FROM doctor";
      $result = $connetion->query($sql);
      echo ("patient".$_SESSION['patient_id']);
      echo "</br>";
      echo "<p>Doctor:";
      echo "<select name='doctor_id'>";
      foreach ($result as $value) {
            echo "<option value=";
            echo ($value['doctor_id']);
            echo '>';
            echo ($value['name']);
            echo "</option>";
      }
      echo  "</select>\n";
      echo  "</p>\n";
      $connetion = NULL;
    ?>



    Date:<br>
    <input type="date" name="date" min="<?php  date_default_timezone_set("America/New_York"); echo (date("Y-m-d")); ?>"><br>
    Office:<br>
    <input type="text" name="office"><br>
  </form>

  <button type="submit" form="form1" value="Submit">Submit</button>
</body>
</html>
<?php
?>
