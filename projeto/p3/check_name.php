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

  $name = $_REQUEST['name'];
  $_SESSION['name'] = $name;
  try {
    $stmt = $connetion->prepare("SELECT * FROM
      patient WHERE name like CONCAT('%',:name, '%')");
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
    }else {
      echo "<table border='1pt'>";
      echo '<tr>
        <th>SELECT</th>
        <th>Name</th>
        <th>patient_id</th>
        <th>Birthday</th>
        <th>Address</th>
      </tr>';
      echo "<form action='newappointment.php' id='form1' method='post'>";
      // lets print all patient founded
      foreach( $result as $row)
      {
        echo "<tr>";
        echo ("<td> <input type='radio' name='patient_id' value='");
        echo $row['patient_id'];
        echo "' checked></td>";
        echo "<td>";
        echo utf8_encode ($row['name']);
        echo "</td>";
        echo "<td>";
        echo $row['patient_id'];
        echo "</td>";
        echo "<td>";
        echo $row['birthday'];
        echo "</td>";
        echo "<td>";
        echo $row['address'];
        echo "</td>";
        echo "</tr>";
      }

      echo "</form>";
      echo "</table>";
      echo "</br>";
      echo "</br>";
      echo "<button type='submit' form='form1' value='Submit'>Go to Make appointment</button>";
      echo "</br>";
      echo "</br>";

    }
    echo "<a href='patient.php'><button type='button'>Regist new patient</button></a></br>";
    echo "<a href='index.php'><button type='button'>Try another</button></a>";

    //close connetion
    $connetion = NULL;

    ?>
  </body>
  </html>
