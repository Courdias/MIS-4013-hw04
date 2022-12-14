<?php
  include "header.php";
?>
    <h1>Edit Section</h1>
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

$sql = "SELECT * from Section where section_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_POST['id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
<form method="post" action="section-edit-save.php">
  <div class="mb-3">
    <label for="sectionNumber" class="form-label">Section number</label>
    <input type="text" class="form-control" id="sectionNumber" aria-describedby="nameHelp" name="sNumber" value="<?=$row['section_number']?>">
    <div id="nameHelp" class="form-text">Enter the section number.</div>
  </div>
  <div class="mb-3">
  <label for="instructorList" class="form-label">Instructor</label>
<select class="form-select" aria-label="Select Instructor" id="instructorList" name="iid">
<?php
    $instructorSql = "select * from Instructor order by instructor_name";
    $instructorResult = $conn->query($instructorSql);
    while($instructorRow = $instructorResult->fetch_assoc()) {
      if ($instructorRow['instructor_id'] == $row['instructor_id']) {
        $selText = " selected";
      } else {
        $selText = "";
      }
?>
  <option value="<?=$instructorRow['instructor_id']?>"<?=$selText?>><?=$instructorRow['instructor_name']?></option>
<?php
    }
?>
</select>
  </div>
  <input type="hidden" name="iid" value="<?=$row['section_id']?>">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
