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

  if($_REQUEST['doctor_id'] != NULL || $_REQUEST['birthday'] != NULL || $_REQUEST['address'] != NULL ){
    $doctor_id = $_REQUEST['doctor_id'];
    $date = $_REQUEST['date'];
    $office = $_REQUEST['office'];
  }else{
    echo "error";
    $connetion = NULL;
    exit();
  }

  if(isWeekend($date)){
    echo("<p>");
    echo("The date that you chosed is a weekend");
    echo("</p>");
    echo "<a href='newpatient.php'>Try another Date</a>";
    exit();
  }


  $patient_id = sha1($name.$birtday.$address);
  $connetion->beginTransaction();
  try {
    $stmt1 = $connetion->prepare("INSERT INTO patient (patient_id,name,birthday,address)
    VALUES (:patient_id,:name,:birthday,:address);");
  } catch (PDOException $exception) {
      echo("<p>Error: ");
      echo($exception->getMessage());
      echo("</p>");
  }

  try {
    $stmt2 = $connetion->prepare("INSERT INTO appointment (patient_id,doctor_id,appointment_date,office)
    VALUES (:patient_id,:doctor_id,:date,:office);");
  } catch (PDOException $exception) {
      echo("<p>Error: ");
      echo($exception->getMessage());
      echo("</p>");
  }


  $stmt1->bindParam(':patient_id', $patient_id,PDO::PARAM_STR);
  $stmt1->bindParam(':name', $name,PDO::PARAM_STR);
  $stmt1->bindParam(':birthday', $birtday,PDO::PARAM_STR);
  $stmt1->bindParam(':address', $address,PDO::PARAM_STR);
  $stmt2->bindParam(':patient_id', $patient_id,PDO::PARAM_STR);
  $stmt2->bindParam(':doctor_id', $doctor_id,PDO::PARAM_STR);
  $stmt2->bindParam(':date', $date,PDO::PARAM_STR);
  $stmt2->bindParam(':office', $office,PDO::PARAM_STR);


  $result1 = $stmt1->execute();
  $result2 = $stmt2->execute();
  if($result1 && $result2){
    echo "Success </br>";
    $connetion->commit();
    $_SESSION['patient_id'] = $patient_id;
    echo "<a href='newappointment.php'>Make another Appoint</a></br>";
    echo "<a href='index.php'>Go to first Page</a>";
  }else {
    echo "error";
    $connetion->rollback();
  }



  $connetion = NULL;
?>
