<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome to HealtCare </title>
</head>
<body>

  <?php

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


  try {
    $stmt = $connetion->prepare("SELECT patient_id FROM
      patient WHERE name=:name");
  } catch (PDOException $exception) {
      echo("<p>Error: ");
      echo($exception->getMessage());
      echo("</p>");
  }

  $stmt->bindParam(':name', $name,PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetchAll();


    if($result == NULL){
      echo "Name not found in data base</br>";
      echo "<a href='patient.php'>Regist new patient</a></br>";
      echo "<a href='index.php'>try another</a>";
    }else {
      echo "<table border='1pt'>";
      echo '<tr>
        <th>Name</th>
        <th>patient_id</th>
      </tr>';
      echo "Name found</br>";
      $_SESSION['patient_id'] = $result['patient_id'];
      foreach( $result as $row)
      {
        echo "<td>$name</td>";
        echo "<td>";
        echo $row['patient_id'];
        echo "</td>";
        $_SESSION['patient_id'] = $row['patient_id'];
      }
      echo "</table>";
      echo "<a href='newappointment.php'>Make Appoint</a></br>";
      echo "<a href='index.php'>try another</a>";
    }

    $connetion = NULL;

    ?>
  </body>
  </html>
