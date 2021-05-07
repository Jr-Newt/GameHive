<?php
error_reporting( error_reporting() & ~E_NOTICE );
 include "controllerUserData.php";
 include "config.php";
?>
<html>
<head><title>gear page</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="gear_display.css">
</head>
<body>
  <?php
  include "config.php";
  $sql = "SELECT * FROM gearstore";
  $result = $pdo->query($sql);
  ?>
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
              <a class="nav-link" href="cartfinal.php">My Cart</a>
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
    <br>
    <div class="body">
        <div class="header">
            <div><h3>GEAR STORE</h3></div>
        </div>
        <div class="section1">
          <div><!--button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Filters</button--><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Filters
</button></div>
            <div class="drop">
              <select id="category"   class="form-control">
                <option selected>Sort</option>
                <option>...</option>
              </select>
            </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div>
      <!--?php
      filter_err();
                /*{
                  echo "can't apply this filter..pls give the input correctly";
                }*/
      ?-->
      </div>
      <div class="modal-body">
      <form action="gear_disp2.php" method="post">
      <div class="form-group">
        <label for="">price range</label>
        <select class="form-control" name="minprice">
                <option value="">Select Price Range</option>
                <option value="range1">Rs. 500</option>
                <option value="range2">Rs. 1000</option>
				<option value="range3">Rs 5000</option>
                <option value="range4">Rs 10000</option>
                <option value="range5">Rs 15000</option>
            </select>
            <select class="form-control" name="maxprice">
                <option value="">Select Price Range</option>
                <option value="range1">Rs. 1000</option>
                <option value="range2">Rs. 15000</option>
				<option value="range3">Rs 20000</option>
                <option value="range4">Rs 40000</option>
                <option value="range5">Rs 40000+</option>
            </select>
        </div>
        <div class="form-group">
        <label for="">category</label>
        <select class="form-control" name="category">
                <option value="">Select Category</option>
                <?php
                  //pdo_connect();

                  while($row = $result->fetch(PDO::FETCH_ASSOC))
                  {
                  ?>
                  <option value="<?php echo $row['gearcat'];?>"><?php echo $row['gearcat'];?></option>
                  <?php
                  }
                  ?>
        </select>
        </div>
        <div class="form-group">
            <label for="">include out of stock items</label>
            <input type="checkbox" name="out_of_stock" id="" value="0">
        </div>
        <!--a href="gear_disp2.php" class="btn btn-primary" type="submit" name="apply">Apply</a-->
        <button type="submit" class="btn btn-primary" style="width:25%" name="apply">Apply</button>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!--button type="button" class="btn btn-primary">Save changes</button-->
      </div>
    </div>
  </div>
</div>
<?php
$result = $pdo->query($sql);
?>
<div class="main-content">
          <div class = "product-layout">
            <?php
            while($row = $result->fetch(PDO::FETCH_ASSOC))
            {
              $name = $row['name'];
              $price = $row['price'];
              $image = $row['gearimage'];
              $category = $row['gearcat'];

            ?>

              <div class="each-product">
                <div class="image"><img src="..\images\<?php echo $image;?>" alt="" style="width:100%"></div>
                <div class="name"><a href="gear_page.php?id=<?php echo $row['id'];?>"><?php echo $name;?></a></div>
                <div class="details">$<?php echo $price;?></div>
              </div>

              <?php
            }
            ?>
          </div>
        <div>
    </div>

          </body>
          </html>
