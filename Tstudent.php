<?php
  include "header.php";
?>
    <h1>Students</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Student ID</th>
      <th>Student Name</th>

    </tr>
  </thead>
  <tbody>
    <?php
$servername = "localhost";
$username = "buidemac_homework3";
$password = "homework3user";
$dbname = "buidemac_homework3";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "select student_id, student_name from student";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
        <h1>Students</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Student ID</th>
      <th>Student Name</th>

    </tr>
  </thead>
  <tbody>
  <tr>
    <td><?=$row["student_id"]?></td>
    <td><?=$row["student_name"]?></td>
  </tr>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
  </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
