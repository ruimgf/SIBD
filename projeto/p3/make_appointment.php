<?php session_start(); ?>
<?php

  include 'general.php';
  if($_REQUEST['doctor_id']== NULL || $_REQUEST['date'] == NULL || $_REQUEST['office']==NULL){
    echo "error";
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
    echo "Não pode marcar consultas para o passado <br/>";
    echo "<a href='newappointment.php'><button type='button'>Try another</button></a>";
    exit();
  }

  if(isWeekend($date)){
    echo("<p>");
    echo("The date that you chosed is a weekend");
    echo("</p>");
    echo "<a href='newappointment.php'>Try another Date</a>";
    exit();
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


  if($result){
    echo "<h1>Success</h1> </br>";
    echo "<a href='newappointment.php'><button type='button'>Make another Appoint</button></a>";
    echo "<a href='index.php'><button type='button'>Go to first Page</button></a></br>";
  }
  else{
    $array = $stmt->errorInfo();
    echo "Error <br/>";
    if(strpos($array[2], "Duplicate")==0){
      echo "consulta no mesmo dia <br/>";
    }
    echo "<a href='newappointment.php'><button type='button'>Try another</button></a>";
  }
  $connetion = NULL;
?>
