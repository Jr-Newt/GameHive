<?php
error_reporting( error_reporting() & ~E_NOTICE );
require_once "controllerUserData.php";
include "config.php";
include "connection.php";
?>
<!--?php
include('connection.php');
$status="";
if (isset($_POST['gearcat']) && $_POST['gearcat']!=""){
  error_reporting( error_reporting() & ~E_NOTICE );
$gearcat = $_POST['gearcat'];
$result1 = mysqli_query($con,"SELECT * FROM `gearstore` WHERE `gearcat`='$gearcat'");
$row1 = mysqli_fetch_assoc($result1);
$name1 = $row1['name'];
$gearcat = $row1['gearcat'];
$price1 = $row1['price'];
$image1 = $row1['gearimage'];

$cartArray =
	array(
	'name'=>$name1,
	'gearcat'=>$gearcat,
	'price'=>$price1,
	'quantity'=>1,
	'image'=>$image1)
;

if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
	$status = "<div class='box'>Product is added to your cart!</div>";
}else{
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($gearcat,$array_keys)) {
		$status = "<div class='box' style='color:red;'>
		Product is already added to your cart!</div>";
	} else {
	$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	$status = "<div class='box'>Product is added to your cart!</div>";
	}

	}
}
?-->
<!--?php
    if(isset($_POST['cart']))
    {
      include "config.php";
      $sql = "INSERT INTO cart (user_id, product_id, qty) VALUES (:user_id, :product_id, :qty)";
      if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":product_id", $product_id);
        $stmt->bindParam(":qty", $qty);

        // Set parameters
        $user_id = $_SESSION['user_id'];
        $product_id = $id;
        $qty = 1;

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Records created successfully. Redirect to landing page
            $msg = "added to cart successfully"
        } else{
            $msg = "Oops! Something went wrong. Please try again later.";
        }
    }
    }
    ?-->
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
    <?php
    include "config.php";
    if(isset($_GET["id"]) && !empty(trim($_GET["id"])))
    {
      $id = trim($_GET["id"]);
      $sql = "SELECT * FROM gearstore WHERE id = :id";
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
                    $id = $row['id'];
                    $name = $row["name"];
                    $description = $row["description"];
                    $price = $row["price"];
                    $gearcat= $row["gearcat"];
                    $image = $row['gearimage'];
                    $stock = $row['no_of_stock'];
                }}}

    }

    ?>
    <div class="body">
        <div class="header"><h3><?php echo $name;?></h3></div>
        <div class="main-content">
            <div class="prod_image">
                <img src="../images/<?php echo $image;?>" alt="">
            </div>
            <div class="prod_desc">
                <div class="desc"><p><?php echo $description;?></p></div>
                <div class="price">Rs.<?php echo $price;?></div>
            </div>
        </div>
        <form action="cartfinal.php" method="post">
            <div class="section2">
            <input type="number" name="quantity" value="1" min="1" max="<?php echo $stock;?>" placeholder="Quantity" required>
            <input type="hidden" name="product_id" value="<?php echo $id;?>">
            <input type="submit" value="Add To Cart" name="cart" class="btn btn-outline-warning cartbtn">
            </div>
        </form>
    </div>
    </div>
            <div class="message_box">
              <?php echo $msg;?>
            </div>
</body>
</html>
