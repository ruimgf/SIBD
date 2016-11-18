<!DOCTYPE html>
<html>
  <head>
    <title>Welcome to HealtCare </title>
  </head>
<body>
<?php
  include 'config.php';

  try {
     $connetion = new PDO($GLOBALS['dns'], $GLOBALS['user'],$GLOBALS['password'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
  } catch (PDOException $exception) {
        echo("<p>Error: ");
        echo($exception->getMessage());
        echo("</p>");
  }


  $name = $_REQUEST['name'];
  echo $name.'</br>';


  try {
    $stmt = $connetion->prepare('SELECT patient_id FROM
    patient WHERE name=:name');
  } catch (PDOException $exception) {
    echo("<p>Error: ");
    echo($exception->getMessage());
    echo("</p>");
  }


  $stmt->bindParam(':name', $name,PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetchAll();


  if($result == NULL){
    echo "Name not find in data base";
  }else {
    foreach( $result as $row)
    {
      echo($row['patient_id']).'</br>';
    }
  }

  $connetion = NULL;
?>
</body>
</html>
