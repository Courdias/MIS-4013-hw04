<?php
  include "header.php";
?>
    <h1>Courses</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Prefix</th>
      <th>Number</th>
      <th>Description</th>
      <th></th>
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

$sql = "SELECT * from course";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["course_id"]?></td>
    <td><?=$row["prefix"]?></td>
    <td><?=$row["number"]?></td>
    <td><?=$row["description"]?></td>
    <td>
       <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editcourse<?=$row["course_id"]?>">
                Edit
              </button>
              <div class="modal fade" id="editInstructor<?=$row["instructor_id"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editInstructor<?=$row["instructor_id"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editInstructor<?=$row["instructor_id"]?>Label">Edit Instructor</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editInstructor<?=$row["instructor_id"]?>Name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="editInstructor<?=$row["instructor_id"]?>Name" aria-describedby="editInstructor<?=$row["instructor_id"]?>Help" name="iName" value="<?=$row['instructor_name']?>">
                          <div id="editInstructor<?=$row["instructor_id"]?>Help" class="form-text">Enter the instructor's name.</div>
                          
                          
                          
                        </div>
                        <input type="hidden" name="iid" value="<?=$row['instructor_id']?>">
                        <input type="hidden" name="saveType" value="Edit">
                        <input type="submit" class="btn btn-primary" value="Submit">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <form method="post" action="">
                <input type="hidden" name="iid" value="<?=$row["instructor_id"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <input type="submit" class="btn" onclick="return confirm('Are you sure?')" value="Delete">
              </form>
            </td>
          </tr>
    
    
      <form method="post" action="course-section.php">
        <input type="hidden" name="id" value="<?=$row["course_id"]?>" />
        <input type="submit" value="Sections" />
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
