<?php session_start(); ?>
<?php

  include 'config.php';
  if($_REQUEST['doctor_id']== NULL || $_REQUEST['date'] == NULL || $_REQUEST['office']==NULL){
    echo "error";
    exit();
  }

  $doctor_id = $_REQUEST['doctor_id'];
  $patient_id = $_SESSION['patient_id'];
  $date = $_REQUEST['date'];
  $office = $_REQUEST['office'];


  try {
    $connetion = new PDO($GLOBALS['dns'], $GLOBALS['user'],$GLOBALS['password'],
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
  } catch (PDOException $exception) {
    echo("<p>Error: ");
    echo($exception->getMessage());
    echo("</p>");
  }


  try {
    $stmt = $connetion->prepare("INSERT INTO appointment (patient_id,doctor_id,appointment_date,office)
    VALUES (:patient_id,:doctor_id,:date,:office)");
  } catch (PDOException $exception) {
      echo("<p>Error: ");
      echo($exception->getMessage());
      echo("</p>");
  }

  $stmt->bindParam(':patient_id', $patient_id,PDO::PARAM_STR);
  $stmt->bindParam(':doctor_id', $doctor_id,PDO::PARAM_STR);
  $stmt->bindParam(':date', $date,PDO::PARAM_STR);
  $stmt->bindParam(':office', $office,PDO::PARAM_STR);
  $result = $stmt->execute();
  $connetion = NULL;
  if($result){
    echo "Success </br>";
    
    echo "<a href='newappointment.php'>Make another Appoint</a></br>";
    echo "<a href='index.php'>Go to first Page</a>";
  }
  else{
    echo "Error";

  }
?>
