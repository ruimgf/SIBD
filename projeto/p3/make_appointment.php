<?php session_start(); ?>
<!DOCTYPE html>

<html>
<meta charset="utf-8" />
<head>
  <title>Welcome to HealtCare </title>
</head>
<body>

<?php

  include 'general.php';
  // Validate Parametes
  if($_REQUEST['doctor_id']== NULL || $_REQUEST['date'] == NULL || $_REQUEST['office']==NULL){
    echo "error some arguments are NULL";
    exit();
  }

  $doctor_id = $_REQUEST['doctor_id'];
  $patient_id = $_SESSION['patient_id'];
  $office = $_REQUEST['office'];

  $date = strtotime($_REQUEST['date']);
  $date = date('Y-m-d',$date);

  $today = date("Y-m-d");
  if($today > $date) {
    echo "Error <br/>";
    echo "You cannot make an appointment to a date before today <br/>";
    echo "<a href='newappointment.php'><button type='button'>Try another</button></a>";
    $connetion=NULL;
    exit();
  }

  if(isWeekend($date)){
    echo("<p>");
    echo("The date that you chose is a weekend");
    echo("</p>");
    echo "<a href='newappointment.php'>Try another Date</a>";
    $connetion=NULL;
    exit();
  }

  try {
    $stmt = $connetion->prepare("INSERT INTO appointment (patient_id,doctor_id,appointment_date,office)
    VALUES (:patient_id,:doctor_id,:date,:office)");
  } catch (PDOException $exception) {
      echo("<p>Error: ");
      echo($exception->getMessage());
      echo("</p>");
      $connetion=NULL;
      exit();
  }

  $stmt->bindParam(':patient_id', $patient_id,PDO::PARAM_STR);
  $stmt->bindParam(':doctor_id', $doctor_id,PDO::PARAM_STR);
  $stmt->bindParam(':date', $date,PDO::PARAM_STR);
  $stmt->bindParam(':office', $office,PDO::PARAM_STR);

  $result = $stmt->execute();


  if($result){
    echo "<h1>Success</h1> </br>";
    echo "<a href='newappointment.php'><button type='button'>Make another Appoint</button></a>";
    echo "<a href='index.php'><button type='button'>Go to first Page</button></a></br>";
  }
  else{
    $array = $stmt->errorInfo();
    echo "Error <br/>";
    if(strpos($array[2], "Duplicate")==0){ // check if is a duplicate key mensage error
      echo "You have yet a appointment is this day with this doctor <br/>";
    }
    echo "<a href='newappointment.php'><button type='button'>Try another</button></a>";
  }
  $connetion = NULL;
?>
</body>
</html>
