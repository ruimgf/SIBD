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
      echo_doctor();

      if($_SESSION['patient_id']==NULL){
        $_SESSION['patient_id'] = $_REQUEST['patient_id'];
      }
    ?>
    Date:<br>
    <input type="date" name="date" min="<?php  date_default_timezone_set("America/New_York"); echo (date("Y-m-d")); ?>" required><br>
    Office:<br>
    <input type="text" name="office" required><br>
  </form>

  <button type="submit" form="form1" value="Submit">Submit</button>
</body>
</html>
<?php
?>
