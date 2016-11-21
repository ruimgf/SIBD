<?php session_start(); ?>
<?php
  session_start();
  include 'config.php';
  try {
  $connetion = new PDO($GLOBALS['dns'], $GLOBALS['user'],$GLOBALS['password'],
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
  } catch (PDOException $exception) {
    echo("<p>Error: ");
    echo($exception->getMessage());
    echo("</p>");
  }

  if($_REQUEST['name'] != NULL || $_REQUEST['birthday'] != NULL || $_REQUEST['address'] != NULL ){
    $name = $_REQUEST['name'];
    $birtday = $_REQUEST['birthday'];
    $address = $_REQUEST['address'];
  }else{
    echo "some arguments are NULL";
    $connetion = NULL;
    exit();
  }

  $patient_id = sha1($name.$birtday.$address);
  try {
    $stmt = $connetion->prepare("INSERT INTO patient (patient_id,name,birthday,address)
    VALUES (:patient_id,:name,:birthday,:address)");
  } catch (PDOException $exception) {
      echo("<p>Error: ");
      echo($exception->getMessage());
      echo("</p>");
  }

  $stmt->bindParam(':patient_id', $patient_id,PDO::PARAM_STR);
  $stmt->bindParam(':name', $name,PDO::PARAM_STR);
  $stmt->bindParam(':birthday', $birtday,PDO::PARAM_STR);
  $stmt->bindParam(':address', $address,PDO::PARAM_STR);
  $result = $stmt->execute();

  if($result){
    if($_REQUEST['doctor_id'] != NULL || $_REQUEST['birthday'] != NULL || $_REQUEST['address'] != NULL ){
      $doctor_id = $_REQUEST['doctor_id'];
      $date = $_REQUEST['date'];
      $office = $_REQUEST['office'];
    }else{
      echo "error";
      $connetion = NULL;
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
      echo "Success </br>";
      $_SESSION['patient_id'] = $patient_id;
      echo "<a href='newappointment.php'>Make another Appoint</a></br>";
      echo "<a href='index.php'>Go to first Page</a>";
    }else {
      echo "error";
    }

  }
  else{
    echo "Error";

  }

  $connetion = NULL;
?>
