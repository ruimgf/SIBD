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


  $name = $_REQUEST['name'];
  $birtday = $_REQUEST['birthday'];
  $address = $_REQUEST['address'];
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
  $connetion = NULL;
  if($result){
    echo "Success";
    // go to principal page
    // make another appointment
  }
  else{
    echo "Error";

  }
?>
