<?php
  include "header.php";
?>

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
      $sqlAdd = "insert into ta (ta_name) value (?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("s", $_POST['sName']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New student added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update ta set ta_name=? where ta_id=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("si", $_POST['sName'], $_POST['iid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Student edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from ta where ta_id=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['iid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Student deleted.</div>';
      break;
  }
}
?>
    
      <h1>Teacher Assistants</h1>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          
<?php
$sql = "SELECT * from ta";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
            <td><?=$row["ta_id"]?></td>
            <td><?=$row["ta_name"]?></td>
            <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editTA<?=$row["ta_id"]?>">
                Edit
              </button>
              <div class="modal fade" id="editStudent<?=$row["ta_id"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editTA<?=$row["ta_id"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editTA<?=$row["ta_id"]?>Label">Edit Teacher Assisant</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editTA<?=$row["ta_id"]?>Name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="editTA<?=$row["ta_id"]?>Name" aria-describedby="editTA<?=$row["ta_id"]?>Help" name="sName" value="<?=$row['ta_name']?>">
                          <div id="editTA<?=$row["ta_id"]?>Help" class="form-text">Enter the Teacher Assistant's name.</div>
                        </div>
                        <input type="hidden" name="iid" value="<?=$row['ta_id']?>">
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
                <input type="hidden" name="iid" value="<?=$row["ta_id"]?>" />
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
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudent">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addStudent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addStudentLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addStudentLabel">Add Teacher Assistant</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="taName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="taName" aria-describedby="snameHelp" name="sName">
                  <div id="nameHelp" class="form-text">Enter the Teacher Assisstant's name.</div>
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
