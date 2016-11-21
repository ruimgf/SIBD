<?php
    if(isset($_SESSION)){
      session_destroy();
    }
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome to HealthCare </title>
</head>
  <body>
  <h1>Register New Patient</h1>

  <form action="newpatient.php" method="post" id="form1">
    name:<br>
    <input type="text" name="name" value="<?php echo($_SESSION['name'])?> " required><br>
    birthday:<br>
    <input type="date" name="birthday" max="<?php  date_default_timezone_set("America/New_York"); echo (date("Y-m-d")); ?>" required><br>
    Address:<br>
    <input type="address" name="address" required><br>

    <h1>Appointment</h1>

    <?php
      include 'config.php';
      echo_doctor();
    ?>

    Date:<br>
    <input type="date" name="date" min="<?php  date_default_timezone_set("America/New_York"); echo (date("Y-m-d")); ?>" required><br>
    Office:<br>
    <input type="text" name="office" required><br>

    </form>
    <button type="submit" form="form1" value="Submit">Submit</button>

  </body>
</html>
