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
      $sqlAdd = "insert into instructor (instructor_name) value (?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("s", $_POST['iName']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New instructor added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update Section set section_number=? where section_id=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("si", $_POST['sNumber'], $_POST['sid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Course Number edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Section where section_id=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['sid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Course Number deleted.</div>';
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
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editCustomer1">
                Edit
              </button>
              <div class="modal fade" id="editCustomer1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editCustomer1Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editCustomer1Label">Edit Customer</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editCustomer1Name" class="form-label">Customer Name</label>
                          <input type="text" class="form-control" id="editCustomer1Name" aria-describedby="editCustomer1Help" name="cName" value="Tony Romo">
                          <div id="editCustomer1Help" class="form-text">Enter the Customer's name.</div>
                          <label for="EmployeeID" class="form-label">Employee ID</label>
                          <input type="text" class="form-control" id="sid" aria-describedby="nameHelp" name="eid" value="1">
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

      <!-- Modal -->
      <div class="modal fade" id="addCustomer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCustomerLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addCustomerLabel">Add Customer</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="instructorName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="cName" aria-describedby="nameHelp" name="cName">
                  <div id="nameHelp" class="form-text">Enter the Customer's name.</div>
                   <label for="EmployeeID" class="form-label">Employee ID</label>
                   <input type="text" class="form-control" id="sid" aria-describedby="nameHelp" name="eid">
                   <div id="nameHelp" class="form-text">Enter the Employee's ID</div>
                          <label for="ProductName" class="form-label">Product Name</label>
                          <input type="text" class="form-control" id="pName" aria-describedby="nameHelp" name="pName">
                          <div id="nameHelp" class="form-text">Enter the Product Name</div>
                          <label for="ProductCost" class="form-label">Product Cost</label>
                          <input type="text" class="form-control" id="pCost" aria-describedby="nameHelp" name="pCost">
                          <div id="nameHelp" class="form-text">Enter the Product's cost</div>
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
