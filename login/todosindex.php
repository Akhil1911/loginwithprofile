<?php
// session_start();
include 'welcome.php';
include 'partials/_dbconnect.php';
?>
<?php
$insert = false;
$errorInsert = false;
$sameDataerror = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $srno = $_POST['srno'];
    $tile = $_POST['title'];
    $description = $_POST['description'];
    $semail = $_SESSION['email'];

    if (empty($_POST['title']) && empty($_POST['description'])) {
        $sameDataerror = true;
    } else {
        $sql = "INSERT INTO `atodos` (`title`, `description`, `date` , `email`) VALUES ('$tile', '$description', current_timestamp() , '$semail')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $insert = true;
        } else {
            $errorInsert = true;
        }
    }
}

?>

<style>
    .container label {
        color: black;
        font-size: larger;
        font-weight: 500;
    }
</style>
<?php
if ($insert) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Congrats!</strong> Your Data has been added Successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if ($errorInsert) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Error In Adding Data
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if ($sameDataerror) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Please enter some data.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
?>
<div class="container my-4">
    <form action="" method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Title :</label>
            <input type="text" class="form-control" name="title" id="title">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description :</label>
            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
        </div>
        <button type="submit" name="addtodo" class="btn btn-success col-md-2  m-2">Add TODO</button>
        <a href="/login/todofetch.php" class="btn btn-success col-md-2 m-2" role="button">Show All TODOs</a>

    </form>

</div>