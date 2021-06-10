<?php 
error_reporting( error_reporting() & ~E_NOTICE );
require_once "controllerUserData.php";
include "config.php";
include "connection.php";
include "cart_config.php";
?>
<!--?php
include('connection.php');
$status="";
if (isset($_POST['gamecat']) && $_POST['gamecat']!=""){
  error_reporting( error_reporting() & ~E_NOTICE );
$gamecat = $_POST['gamecat'];
$result1 = mysqli_query($con,"SELECT * FROM `gamestore` WHERE `gamecat`='$gamecat'");
$row1 = mysqli_fetch_assoc($result1);
$name1 = $row1['name'];
$gamecat = $row1['gamecat'];
$price1 = $row1['price'];
$image1 = $row1['gameimage'];

$cartArray = 
	array(
	'name'=>$name1,
	'gamecat'=>$gamecat,
	'price'=>$price1,
	'quantity'=>1,
	'image'=>$image1)
;

if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
	$status = "<div class='box'>Product is added to your cart!</div>";
}else{
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($gamecat,$array_keys)) {
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
<title>Game-page</title>
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
      $sql = "SELECT * FROM gamestore WHERE id = :id";
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
                    $gamecat= $row["gamecat"];
                    $image = $row['gameimage'];
                    $stock = $row['mode'];
                }}}

    }

    ?>
    <div class="body">
        <div class="header"><h3><?php echo $name;?></h3></div>
        <div class="main-content">
            <div class="prod_image">
                <img src="..\images\<?php echo $image;?>" alt="">
            </div>
            <div class="prod_desc">
                <div class="desc"><p><?php echo $description;?></p></div>
                <div class="price">$<?php echo $price;?></div>
            </div>
        </div>
        <form action=" " method="post">
            <div class="section2">
            <!--input type="number" name="quantity" value="1" min="1" max="<//?php echo $stock;?>" placeholder="Quantity" required-->
            <input type="hidden" name="product_id" value="<?php echo $id;?>">
            <input type="hidden" name="price" value="<?php echo $price;?>">
            <input type="hidden" name="quantity" value="1">
            <input type="submit" value="Purchase" name="purchase" class="btn btn-outline-warning">
            </div>
        </form>
        <?php
        if(isset($_POST['purchase']))
    {
?>
            <!-- PayPal payment form for displaying the buy button -->
            <form action="<?php echo PAYPAL_URL; ?>" method="post">
                    <!-- Identify your business so that you can collect the payments. -->
                    <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
					
                    <!-- Specify a Buy Now button. -->
                    <input type="hidden" name="cmd" value="_xclick">
					
                    <!-- Specify details about the item that buyers will purchase. -->
                    <input type="hidden" name="item_name" value="<?php echo"product1"; ?>">
                    <input type="hidden" name="item_number" value="<?php echo"id"; ?>">
                    <input type="hidden" name="amount" value="<?php echo $price; ?>">
                    <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">
					
                    <!-- Specify URLs -->
                    <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
                    <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
                    <input type="hidden" name="notify_url" value="<?php echo PAYPAL_NOTIFY_URL; ?>">
                    <!--input type="hidden" name="notify_url" value="https://www.codexworld.com/paypal_ipn.php"-->
					
                    <!-- Display the payment button. -->
                    <input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif">
                </form>
                <?php
                $_SESSION['game'] = $name;
                date_default_timezone_set('Asia/Kolkata');
                $trans = date('y-m-d h:i:s');
                $_SESSION['transact']  = str_replace( array(':','-',' '),'', $trans);
            //unset($_SESSION['cart']);
            include "config.php";

            $sql = "INSERT INTO orders (user_id,game_id,transact_id,price,qty,status) VALUES (:user_id,:gear_id,:transact_id,:price,:qty,:status)";
            if($stmt = $pdo->prepare($sql)){
              // Bind variables to the prepared statement as parameters
              $stmt->bindParam(":user_id", $user_id);
              $stmt->bindParam(":gear_id", $gear_id);
              $stmt->bindParam(":transact_id", $transact);
              $stmt->bindParam(":price", $sub);
              $stmt->bindParam(":qty", $qty);
              $stmt->bindParam(":status", $s);
                $s = 0;
                $transact = $_SESSION['transact'];
              // Set parameters
              $user_id = $_SESSION['user_id'];
              $gear_id = $_POST['product_id'];
              $qty = $_POST['quantity'];
              //$transact = date('y-m-d h:i:s');
              $sub= $_POST['price'];
              $stmt->execute();
             }
             $sql = "INSERT INTO payments (user_id,price,transact_id,status) VALUES (:user_id,:price,:transact_id,:status)";
            if($stmt = $pdo->prepare($sql)){
              // Bind variables to the prepared statement as parameters
              $stmt->bindParam(":user_id", $user_id);
              $stmt->bindParam(":transact_id", $transact);
              $stmt->bindParam(":price", $sub);
              $stmt->bindParam(":status", $s);

              // Set parameters
              $user_id = $_SESSION['user_id'];
              $s = 0;
              
                
                $transact = $_SESSION['transact'];
              //$transact = date('y-m-d h:i:s');
              $sub= $_POST['price'];
              $stmt->execute();

            }
              ?>
   <?php
    }
    ?>
    </div>
    </div>
            <div class="message_box">
              <?php echo $msg;?>
            </div>
</body>
</html>