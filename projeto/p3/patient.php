<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome to HealthCare </title>
</head>
  <body>
  <h1>Register New Patient</h1>
  <!-- All paremeters are required but this cannot work in some webrowsers -->
  <form action="newpatient.php" method="post" id="form1">
    name:<br>
    <input type="text" name="name" value="<?php echo($_SESSION['name'])?> " required><br>
    birthday:<br>
    <!-- Define a max to date cannot work in some browsers  -->
    <input type="date" name="birthday" max="<?php  date_default_timezone_set("Europe/Lisbon"); echo (date("Y-m-d")); ?>" required><br>
    Address:<br>
    <input type="address" name="address" required><br>
    <h1>Appointment</h1>
    <?php
      include 'general.php';
      echo_doctor();// echo all doctors funtion on general.php
    ?>
    Date:<br>
    <!-- Define a min to date cannot work in some browsers  -->
    <input type="date" name="date" min="<?php  date_default_timezone_set("Europe/Lisbon"); echo (date("Y-m-d")); ?>" required><br>
    Office:<br>
    <input type="text" name="office" required><br>

    </form>
    <button type="submit" form="form1" value="Submit">Submit</button>

  </body>
</html>
