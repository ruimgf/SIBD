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
      echo "Name not found in data base";
    }else {
      echo "<table border='1pt'>";
      echo '<tr>
        <th>Name</th>
        <th>patient_id</th>
      </tr>';
      foreach( $result as $row)
      {
        echo "<td>$name</td>";
        echo "<td>";
        echo $row['patient_id'];
        echo "</td>";
      }
      echo "</table>";
      echo "Name found</br>";
      echo "<a href='newappointment.php'>Go Make Appoint</a>";
    }

    $connetion = NULL;

    ?>
  </body>
  </html>
