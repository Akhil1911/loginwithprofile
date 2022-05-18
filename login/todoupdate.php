<?php
include 'partials/_dbconnect.php';
include("functions.php");
?>
<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>TODOs</title>
</head>

<body>

    <!-- ================================================================================================ -->
    <!-- navbar -->
    <!-- ================================================================================================ -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/login/welcome.php">TODOs</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-ltr" href="/login/todofetch.php">Go Back</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-ltr" aria-current="page" href="#">Welcome - <?php echo $_SESSION['username']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-ltr" aria-current="page" href="/login/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
    $sql = "SELECT * FROM `atodos`";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $srno = $row['srno'];
        $title = $row['title'];
        $description = $row['description'];
    }
    ?>

    <!-- --------------------Read Data-------------------- -->
    <?php
     if(isset($_GET['srnoid'])){
         $srnoid = $_GET['srnoid'];
    $sql = "SELECT * FROM `atodos` where srno = '$srnoid'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo '    <div class="container my-4">
        <form class="row" action="/login/todoupdate.php" method="post">
            <div class="mb-3 col-md-4" hidden>
              <label for="srno" class="form-label">Sr No</label>
              <input type="text" class="form-control" name="srno" value = "' . $row['srno'] . '" id="srno" autocomplete="off">
            </div>
            <div class="mb-3 col-md-4">
            <label for="title" class="form-label">Title :</label>
            <input type="text" class="form-control" name="title" value = "' . $row['title'] . '" id="title" autocomplete="off">
          </div>
            <div class="mb-3 col-md-12">
                <label for="description" class="form-label">Description :</label>
                <textarea class="form-control" name="description" id="description" rows="3" autocomplete="off">' . $row['description'] . '</textarea>
            </div>
            <button type="submit" name="updatetododata" class="btn btn-success col-md-2  m-2">Update TODO</button>
            <a href="/login/todofetch.php" class="btn btn-success col-md-2 m-2" role="button">Go Back</a>
        </form>
    </div><hr>';
    }
}
else{
    echo "<script> window.open('todofetch.php' , '_self'); </script>";
}
    ?>


    <?php
$sameDataerror = false;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['updatetododata'])) {
            $srno = $_POST['srno'];
            $title = $_POST['title'];
            $description = $_POST['description'];

            if (empty($_POST['title']) && empty($_POST['description'])) {
                $sameDataerror = true;
            } else {
                

                $sql = "UPDATE `atodos` SET `title` = '$title' , `description` = '$description' WHERE srno = '$srno'";
                echo $sql;
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    echo "UPDated";
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong>Due to some technical issues , Data has not been Updated.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
                }
            }
        }
    }
    if ($sameDataerror) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Please enter some data.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>

    <!-- ================================================================================================ -->
    <!-- script -->
    <!-- ================================================================================================ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>