<?php
include "controllerUserData.php";
include "config2.php";
error_reporting( error_reporting() & ~E_NOTICE );
?>
<html>
<head><title>Admin-Home</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
  body{
    background-color:rgb(255, 197, 5);
  }
    .row.r1{
      margin-top:60px;
      margin-bottom:5px;
    }
    .row.r2{
      margin-top:10px;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php"><img src="/gamehive/images/bee-logo-linear-vector-icon_126523-265.jpg" alt="LOGO" style="width:30px;"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Dashboard<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Users</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><?php echo $_SESSION['admin'];?></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded = "false">
          Products
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="gearcrud/gearindex.php">Gear Store</a>
          <a class="dropdown-item" href="gamecrud/gameindex.php">Game Store</a>
          <div class="dropdown-divider"></div>
          <!--a class="dropdown-item" href="#">Something else here</a-->
        </div>
      </li>
      <!--li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li-->
    </ul>
    <ul class="navbar-nav">
            <li class="nav-item flex-row-reverse">
              <a class="nav-link" href="../php/logout-user.php">Logout<span class="sr-only">(current)</span></a>
            </li>
            </ul>
  </div>
</nav>
<?php
if(!empty($_SESSION['admin']))
{
  $q1 = "SELECT * FROM userlogin";
  if($result = $pdo->query($q1))
  {
    $users = $result->rowCount();
}
/*$q2 = "SELECT SUM(price) AS sum FROM payments";
$pdo->prepare($q2);
$result->execute();
  
    $sales = $result->fetch(PDO::FETCH_NUM);*/
    $soma = $pdo->query("SELECT SUM(price) AS total FROM payments")->fetchColumn();

// Imprimindo o resultado.
//print $soma;
$q3 = "SELECT * FROM gamestore";
  if($result = $pdo->query($q3))
  {
    $games = $result->rowCount();
}
$q4 = "SELECT * FROM gearstore";
  if($result = $pdo->query($q4))
  {
    $products = $result->rowCount();
}
}
?>
<div class="header" style="margin-bottom:10px;"><h1 style="text-align:center;">Overview</h1></div>
<div class="row r1">
  <div class="col-sm-6 c1">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">No of users</h5>
        <p class="card-text"><?php echo $users;?> </p>

      </div>
    </div>
  </div>
  <div class="col-sm-6 c2">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">No of products</h5>
        <p class="card-text"><?php echo $products;?> </p>

      </div>
    </div>
  </div>
  </div>
  <div class="row r2">
  <div class="col-sm-6 c3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">No of games</h5>
        <p class="card-text"><?php echo $games;?> </p>

      </div>
    </div>
  </div>
  <div class="col-sm-6 c4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Total Sales</h5>
        <p class="card-text"><?php echo $soma;?> </p>

      </div>
    </div>
  </div>
</div>
<div class="graph-section"></div>
</body>
</html>
