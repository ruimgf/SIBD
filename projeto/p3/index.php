<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Welcome to HealthCare </title>
  </head>
<body>
  <h1>Welcome to your Health Care Web Page</h1>
  <h2>Please entry your name to continue</h2>
  <form action="check_name.php" method="post" id="form1">
    Patient Name:
    <input type="text" name="name" required><br>
  </form>
  <button type="submit" form="form1" value="Submit">Submit</button>

</body>
</html>
