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
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editInstructor<?=$row["instructor_id"]?>">
                Edit
              </button>
              <div class="modal fade" id="editSection<?=$row["section_id"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editSection<?=$row["section_id"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editSection<?=$row["section_id"]?>Label">Edit Prefix</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          
                          <label for="editSection<?=$row["section_id"]?>Prefix" class="form-label">Prefix</label>
                          <input type="text" class="form-control" id="editSection<?=$row["section_id"]?>Name" aria-describedby="editSection<?=$row["section_id"]?>Help" name="sName" value="<?=$row['prefix']?>">
                          <div id="editSection<?=$row["section_id"]?>Help" class="form-text">Enter the Course's Prefix.</div>
                          

                          <label for="editSection<?=$row["instructor_id"]?>Name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="editInstructor<?=$row["instructor_id"]?>Name" aria-describedby="editInstructor<?=$row["instructor_id"]?>Help" name="iName" value="<?=$row['instructor_name']?>">
                          <div id="editSection<?=$row["instructor_id"]?>Help" class="form-text">Enter the instructor's name.</div>
                          
                        </div>
                        <input type="hidden" name="sid" value="1">
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
                <input type="hidden" name="sid" value="1" />
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
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSection">
        Add New
      </button>
