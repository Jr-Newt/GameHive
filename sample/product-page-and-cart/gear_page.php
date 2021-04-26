<html>
<head>
<title>Gear-page</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="gear_style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="home-page.html"><img src="bee-logo-linear-vector-icon_126523-265.jpg" alt="Logo" style="width:40px;"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Game Comb<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Gear Comb</a>
          </li>
<li class="nav-item">
            <a class="nav-link" href="#">My Cart</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
    <br>
    <?php
    include "config.php";
    if(isset($_GET["id"]) && !empty(trim($_GET["id"])))
    {
      $id = trim($_GET["id"]);
      $sql = "SELECT * FROM product WHERE id = :id";
        if($stmt = $pdo->prepare($sql))
        {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if($stmt->execute())
            {
                if($stmt->rowCount() == 1)
                {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Retrieve individual field value
                    $name = $row["name"];
                    $description = $row["description"];
                    $price = $row["price"];
                    $gamecat= $row["gearcat"];
                    $image = $row['gearimage'];
                    $stock = $row['no_of_stock'];
                }}}

    }

    ?>
    <div class="body">
        <div class="header"><h4><?php echo $name;?></h4></div>
        <div class="main-content">
            <div class="prod_image">
                <img src="..\..\images\<?php echo $image;?>" alt="">
            </div>
            <div class="prod_desc">
                <div class="desc"><p><?php echo $description;?></p></div>
                <div class="price"><?php echo $price;?></div>
            </div>
        </div>
        <form action="" method="post">
            <div class="section2">
                <button><a href="">Add to cart</a></button>
            </div>
        </form>
    </div>
</body>
</html>