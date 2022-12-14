<?php
  include "header.php";
?>
    <h1>Sections</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Prefix</th>
      <th>Number</th>
      <th>Section</th>
      <th>Instructor</th>
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
    case 'Add':
      $sqlAdd = "insert into Section (prefix, number, description, instructor) value (?,?,?,?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("siis", $_POST['cpf'], $_POST['cnb'], $_POST['csect'], $_POST['cins']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Section added.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Section where section_id=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['id']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Section deleted.</div>';
      break;
  }
}
$sql = "select section_id, section_number, i.instructor_name, c.prefix, c.number from Section s join Instructor i on i.instructor_id = s.instructor_id join course c on c.course_id = s.course_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["section_id"]?></td>
    <td><?=$row["prefix"]?></td>
    <td><?=$row["number"]?></td>
    <td><?=$row["section_number"]?></td>
    <td><?=$row["instructor_name"]?></td>
     <td>
      <form method="post" action="section-edit.php">
        <input type="hidden" name="id" value="<?=$row["section_id"]?>">
        <input type="submit" value="Edit">
      </form>
    </td>
  </tr>
     <td>
              <form method="post" action="">
                <input type="hidden" name="id" value="<?=$row["section_id"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <input type="submit" class="btn" onclick="return confirm('Are you sure?')" value="Delete">
              </form>
            </td>
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
      <br />
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourse">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addCourse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCourseLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addCourseLabel">Add Course</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="prefix" class="form-label">Course Prefix</label>
                  <input type="text" class="form-control" id="cpf" aria-describedby="courseHelp" name="cpf">
                  <div id="courseHelp" class="form-text">Enter the course prefix.</div>
                  
                   <label for="number" class="form-label">Course Number</label>
                   <input type="text" class="form-control" id="cnb" aria-describedby="nameHelp" name="cnb">
                   <div id="nameHelp" class="form-text">Enter the course number.</div>
                  
                   <label for="description" class="form-label">Course Section</label>
                   <input type="text" class="form-control" id="csect" aria-describedby="courseHelp" name="csect">
                   <div id="courseHelp" class="form-text">Enter the course section.</div>
                  
                   <label for="description" class="form-label">Instructor</label>
                   <input type="text" class="form-control" id="cins" aria-describedby="courseHelp" name="cins">
                   <div id="courseHelp" class="form-text">Enter the course instructor.</div>
                  
                </div>
                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
