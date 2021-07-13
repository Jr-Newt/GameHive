<?php
error_reporting( error_reporting() & ~E_NOTICE );
include "../controllerUserData.php";
include "../connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
        .appadd{
            width: 200px;
  white-space: nowrap;
  overflow: hidden;
  display: inline-block;
  text-overflow: ellipsis;
  margin: 0;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/gamehive/admin/index.php"><img src="/gamehive/images/G.png" alt="LOGO" style="width:30px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/gamehive/admin/index.php">Dashboard<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><?php echo $_SESSION['admin'];?></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded = "false">
            Products
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/gamehive/admin/gearcrud/gearindex.php">Gear Store</a>
            <a class="dropdown-item" href="/gamehive/admin/gamecrud/gameindex.php">Game Store</a>
            <div class="dropdown-divider"></div>
            <!--a class="dropdown-item" href="#">Something else here</a-->
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/gamehive/admin/usercrud/userindex.php">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/gamehive/admin/paycrud/payindex.php">Payments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/gamehive/admin/ordercrud/orderindex.php">Orders</a>
        </li>
        <!--li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li-->
      </ul>
      <ul class="navbar-nav">
              <li class="nav-item flex-row-reverse">
                <a class="nav-link" href="/gamehive/php/logout-user.php">Logout<span class="sr-only">(current)</span></a>
              </li>
              </ul>
    </div>
  </nav>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">User Details</h2>

                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM orders";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Transaction Number</th>";
                                        echo "<th>User ID</th>";
                                        echo "<th>Amount</th>";
                                        echo "<th>Quantity</th>";
                                        echo "<th>Action</th>";

                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['transact_id'] . "</td>";
                                        echo "<td>" . $row['user_id'] . "</td>";
                                        echo "<td>" . $row['price'] . "</td>";
                                        echo "<td>" . $row['qty'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="orderread.php?id='. $row['id'] .'" class="mr-0" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            #echo '<a href="userupdate.php?id='. $row['id'] .'" class="mr-0" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="orderdelete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close connection
                    unset($pdo);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
