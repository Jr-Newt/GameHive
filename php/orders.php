<?php
error_reporting( error_reporting() & ~E_NOTICE );
// Include config file
require_once "controllerUserData.php";
include "config.php";
$name = $_SESSION['name'];
require_once "config.php";?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
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
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded = "false">
                  <?php echo $_SESSION['name']; ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <!--a class="dropdown-item" href="user_profile.php?id=<!?php echo $_SESSION['user_id'];?>">Profile</a-->
                  <a class="dropdown-item" href="user_profile.php">Profile</a>
                  <a class="dropdown-item" href="orders.php">My orders</a>
                  <div class="dropdown-divider"></div>
                  <!--a class="dropdown-item" href="#">Something else here</a-->
                </div>
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
              </div>
              </nav>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">My Orders</h2>
                    <p>Please enter the transaction ID that you recieved in your mail.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Transaction ID</label>
                            <input type="text" name="transact" class="form-control <?php echo (!empty($transact_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $transact; ?>">
                            <span class="invalid-feedback"><?php echo $transact_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="homepagenew.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                    <div class="from-group">
                    <?php
// Define variables and initialize with empty values
require_once "config.php";
$transact= "";
$transact_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $input_transact = trim($_POST["transact"]);
    if(empty($input_transact)){
        $transact_err = "Please enter the transaction ID.";
    } elseif(!ctype_digit($input_transact)){
        $transact_err = "Incorrect entry";
    } else{
        $transact= $input_transact;
    }
    if(empty($transact_err)){
        $sql = "SELECT * FROM orders WHERE transact_id = :id";

    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);

        // Set parameters
        $param_id = $transact;

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount()>0){
                while($row = $stmt->fetch()){
                    if($row['game_id']==0){
                        $l = "gear";
                        $qty = $row['qty'];
                        $q = "SELECT * FROM gearstore WHERE id = :id";
                        if($result = $pdo->prepare($q)){
                            $result->bindParam(":id", $gear_id);
                            $gear_id = $row['gear_id'];
                            if($result->execute()){
                                if($result->rowCount() == 1){
                                    /* Fetch result row as an associative array. Since the result set
                                    contains only one row, we don't need to use while loop */
                                    $r = $result->fetch(PDO::FETCH_ASSOC);

                                    // Retrieve individual field value
                                    $name = $r["name"];
                                    $description = $r["description"];
                                    $price = $r["price"];
                                    $gamecat = $r["gearcat"];
                                    //$mode = $row["mode"];
                                }
                            }
                        }
                    }
                    elseif($row['gear_id']==0){
                        $l="game";
                        $qty=1;
                        $q = "SELECT * FROM gamestore WHERE id = :id";
                        if($result = $pdo->prepare($q)){
                            $result->bindParam(":id", $game_id);
                            $game_id = $row['game_id'];
                            if($result->execute()){
                                if($result->rowCount() == 1){
                                    /* Fetch result row as an associative array. Since the result set
                                    contains only one row, we don't need to use while loop */
                                    $r = $result->fetch(PDO::FETCH_ASSOC);

                                    // Retrieve individual field value
                                    $name = $r["name"];
                                    $description = $r["description"];
                                    $price = $r["price"];
                                    $gamecat = $r["gamecat"];
                                    //$mode = $row["mode"];
                                }
                            }
                        }
                    }
                    else{
                        //header("location: gameerror.php");
                        //exit();
                        echo "something went wrong. Try again later";
                    }
                    ?>
                    <div class="form-group">
                        <label><?php echo $l;?></label>
                        <p><b><?php echo $name; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <p><b><?php echo $description; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <p><b><?php echo $price; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <p><b><?php echo $gamecat; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <p><b><?php echo $qty;?></b></p>
                    </div>
                    <hr>
                    <?php
                }
            }


        }
    }
}}
?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
