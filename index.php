<?php include 'db.php';

//Edit Data
if (isset($_GET['edit'])) {
  $update = true;
  $id = $_GET['edit'];
  $sql_edit = "SELECT * FROM info WHERE id=$id";
  $record = mysqli_query($dbConn,$sql_edit);


  if (mysqli_num_rows($record) == 1) {
    $row = mysqli_fetch_array($record);
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $course = $row['course'];
    $admission = $row['admission'];
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Students Details</title>
    <style>
      .btn-close{
        cursor: pointer;
      }
      .alert-success{
        display: flex;
        justify-content: space-between;
      }
    </style>
  </head>
  <body>
    <div class="container">

      <?php if(isset($_SESSION['message'])): ?>

        <div class="alert alert-success" role="alert" id="alert">
          <h4><?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']);
          ?>
          </h4>
          <button type="button" class="btn-close" aria-label="Close" id="close"></button>
        </div>
        
      <?php endif;?>

      <div class="row mb-5 mt-5">
        <div class="col-8">
          <h2 class="">Student Details</h2>
        </div>
      </div>

      <!-- Display Data -->
      <?php 
        $sql = "SELECT * FROM info"; 
        $result = mysqli_query($dbConn, $sql);
      ?>
      <table class="table mb-5">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Firstname</th>
            <th scope="col">Lastname</th>
            <th scope="col">Course</th>
            <th scope="col">Admission Date</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <th scope="row"><?php echo $row['id']; ?></th>
            <td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['lastname']; ?></td>
            <td><?php echo $row['course']; ?></td>
            <td><?php echo $row['admission']; ?></td>
            <td>
              <a href="index.php?edit=<?php echo $row['id']?>" class="btn btn-info"><i data-feather="edit"></i> Edit</a>
              <a href="index.php?del=<?php echo $row['id']?>" class="btn btn-danger"><i data-feather="trash"></i> Delete</a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>

      <hr>
      <!-- Add Student Form -->
      <form method="post" action="db.php"> 
        <h2>Add New Student</h2>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="mb-3">
          <label for="fn" class="form-label">Firstname</label>
          <input type="text" class="form-control" id="fn" aria-describedby="emailHelp" name="firstname" value="<?php echo $firstname; ?>">
        </div>
        <div class="mb-3">
          <label for="ln" class="form-label">Lastname</label>
          <input type="text" class="form-control" id="ln" name="lastname" value="<?php echo $lastname ;?>">
        </div>
        <div class="mb-3">
          <label for="course" class="form-label">Course</label>
          <input type="text" class="form-control" id="course" aria-describedby="emailHelp" name="course" value="<?php echo $course; ?>">
        </div>
        <div class="mb-3">
          <label for="ad" class="form-label">Admission Date</label>
          <input type="date" class="form-control" id="ad" name="admission" value="<?php echo $admission; ?>">
        </div> 

        <?php if($update == 1): ?>
          <button type="submit" class="btn btn-success" name="update"><i data-feather="edit-3"></i> Update Student</button>

        <?php else: ?>
          <button type="submit" class="btn btn-success" name="add"><i data-feather="plus"></i> Add New Student</button>

        <?php endif; ?>

      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
    <script>
      let close = document.getElementById('close');
      let alert = document.getElementById('alert');

      close.addEventListener('click', () => {
        alert.style.display = "none";
      });
    </script>
  </body>
</html>