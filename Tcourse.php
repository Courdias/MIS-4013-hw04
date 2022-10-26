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
       <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editCustomer1">
                Edit
              </button>
              <div class="modal fade" id="editCustomer1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editCustomer1Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editCustomer1Label">Edit Course</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editCustomer1Name" class="form-label">Course Prefix</label>
                          <input type="text" class="form-control" id="editCustomer1Name" aria-describedby="editCustomer1Help" name="cName" value="MIS">
                          <div id="editCustomer1Help" class="form-text">Enter the Customer's name.</div>
                          <label for="EmployeeID" class="form-label">Course Number</label>
                          <input type="text" class="form-control" id="sid" aria-describedby="nameHelp" name="eid" value="4013">
                          <div id="nameHelp" class="form-text">Enter the Employee's ID</div>
                          <label for="ProductName" class="form-label">Product Name</label>
                          <input type="text" class="form-control" id="pName" aria-describedby="nameHelp" name="pName" value="Football">
                          <div id="nameHelp" class="form-text">Enter the Product Name</div>
                          <label for="ProductCost" class="form-label">Product Cost</label>
                          <input type="text" class="form-control" id="pCost" aria-describedby="nameHelp" name="pCost" value="19.99">
                          <div id="nameHelp" class="form-text">Enter the Product's cost</div>
                        </div>
                        <input type="hidden" name="cid" value="1">
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
                <input type="hidden" name="cid" value="1" />
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
