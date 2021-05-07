<?php
 require_once "controllerUserData.php";
include "config.php";
error_reporting( error_reporting() & ~E_NOTICE );
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
// Check existence of id parameter before processing further
error_reporting( error_reporting() & ~E_NOTICE );
if(isset($_SESSION["user_id"]) && !empty(trim($_SESSION["user_id"]))){
    // Include config file
    require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM userlogin WHERE id = :id";

    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);

        // Set parameters
        //$param_id = trim($_GET["id"]);
        $param_id = $_SESSION['user_id'];
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Retrieve individual field value
                $name = $row["name"];
                $address = $row["address"];
                $phone_no = $row["phone_no"];
                $email = $row["email"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: gameerror.php");
                exit();
            }

        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    unset($stmt);

    // Close connection
    unset($pdo);
} else{
    // URL doesn't contain id parameter. Redirect to gameerror page
    header("location: gameerror.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
            margin-top: 50px;
        }
    </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
          <a class="navbar-brand" href="homepagenew.php"><img src="../images/bee-logo-linear-vector-icon_126523-265.jpg" alt="Logo" style="width:40px;"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="gear_display.php">Gear Comb</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="game_display.php">Game Comb</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><?php echo $_SESSION['name']; ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-cart2" style="font-size: 1.28em;"></i></a>
              </li>

              </ul>
              <!--div class="flex-row-reverse"--><ul class="navbar-nav">
              <li class="nav-item flex-row-reverse">
                <a class="nav-link" href="logout-user.php">Logout<span class="sr-only">(current)</span></a>
              </li>
              </ul>


              <!--form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Search</button>
              </form-->


              </div>
              </nav>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Profile</h1>
                    <div class="form-group">
                        <label>Name</label>
                        <p><b><?php echo $row["name"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <p><b><?php echo $row["address"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Phone no</label>
                        <p><b><?php echo $row["phone_no"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <p><b><?php echo $row["email"]; ?></b></p>
                    </div>

                    <p><a href="homepagenew.php" class="btn btn-primary">Back</a></p>
                    <p><a href="profile_update.php?id=<?php echo $_SESSION['user_id'];?>" class="btn btn-success">Update details</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
