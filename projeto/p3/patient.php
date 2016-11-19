<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Welcome to HealthCare </title>
  </head>
<body>
  <h1>Register New Patient</h1>
  <h2>Please entry your name to continue</h2>
  <form action="newpatient.php" method="post" id="form1">
    name:<br>
    <input type="text" name="name"><br>
    birthday:<br>
    <input type="date" name="birthday" max="<?php  date_default_timezone_set("America/New_York"); echo (date("Y-m-d")); ?>"><br>
    Address:<br>
    <input type="address" name="address"><br>
  </form>
  <button type="submit" form="form1" value="Submit">Submit</button>

</body>
</html>
