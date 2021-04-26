<?php 
include "controllerUserData.php";
include "config.php";
?>
<html>
<head><title>Game Store</title>
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
  //$sql = "SELECT * FROM gamestore";
  //$result = $pdo->query($sql);
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
            <div><h3>GAME STORE</h3></div>
        </div>
        <div class="section1">
          <div><!--button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Filters</button--><button type="button" class="btn btn-danger"><a href="game_display.php">clear filters</a>
</button></div>
            <div class="drop">
            <form action="" method="post">
              <select id="category"  name="sort" class="form-control">
                <option selected>Sort By</option>
                <option value="asc">low to high</option>
                <option value="desc">high to low</option>
              </select>
              </form>
            </div>
            <!--div class="input-group">
  <div class="input-group-prepend">
    <button class="btn btn-outline-secondary" type="button">Button</button>
  </div>
  <select class="custom-select" id="inputGroupSelect03" aria-label="Example select with button addon">
    <option selected>Choose...</option>
    <option value="asc">low to high</option>
    <option value="desc">high to low</option>
  </select>
</div>
</form-->
        </div>
                
        <?php
        /*if(isset($_POST['apply']))
        {
          echo $_POST['minprice'];
        }*/
        
        
        if(isset($_POST['apply']))
        {
          error_reporting( error_reporting() & ~E_NOTICE );
              if(isset($_POST['minprice']))
              {
                if($_POST['minprice']=='range1')
                {
                  $low = 500;
                }
                elseif($_POST['minprice']=='range2')
                {
                  $low = 1000;
                }
                elseif($_POST['minprice']=='range3')
                {
                  $low = 5000;
                }
                elseif($_POST['minprice']=='range4')
                {
                  $low = 10000;
                }
                elseif($_POST['minprice']=='range5')
                {
                  $low = 15000;
                }
              }
              if(isset($_POST['maxprice']))
              {
                if($_POST['maxprice']=='range1')
                {
                  $high = 1000;
                }
                elseif($_POST['maxprice']=='range2')
                {
                  $high = 15000;
                }
                elseif($_POST['maxprice']=='range3')
                {
                  $high = 20000;
                }
                elseif($_POST['maxprice']=='range4')
                {
                  $high = 40000;
                }
                elseif($_POST['maxprice']=='range5')
                {
                  $high= 100000;
                }
              }
              if(isset($_POST['minprice'])&&isset($_POST['maxprice'])&&$high<$low)
              {
                //filter_err();
                echo "try agian";
              }

              //$cat = $_POST['category'];
              
              //echo $_POST['category'];
              if(isset($_POST['minprice'])&&isset($_POST['maxprice'])&&isset($_POST['category'])&&isset($_POST['out_of_stock']))
              {
                //$out = $_POST['out_of_stock'];
                $sql = "SELECT * FROM gamestore WHERE price BETWEEN :low AND :high AND gamecat = :cat AND no_of_stock = :out";
                $result = $pdo->prepare($sql);
                $result->execute(array(':low'=>$low, ':high'=>$high, ':cat'=>$_POST['category'], ':out'=>$_POST['out_of_stock']));
              }
              if(isset($_POST['minprice'])&&isset($_POST['maxprice'])&&isset($_POST['category']))//&&$_POST['out_of_stock']==NULL//)
              {
                $sql = "SELECT * FROM gamestore WHERE price BETWEEN :low AND :high AND gamecat = :cat";
                $result = $pdo->prepare($sql);
                $result->execute(array(':low'=>$low, ':high'=>$high, ':cat'=>$_POST['category']));
              }
              if(isset($_POST['minprice'])&&isset($_POST['maxprice'])&&/*isset($_POST['category'])&&*/isset($_POST['out_of_stock']))
              {
                $sql = "SELECT * FROM gamestore WHERE price BETWEEN :low AND :high AND no_of_stock = :out";
                $result = $pdo->prepare($sql);
                $result->execute(array(':low'=>$low, ':high'=>$high, ':out'=>$_POST['out_of_stock']));
              }
              if(/*isset($_POST['minprice'])&&*/isset($_POST['maxprice'])&&isset($_POST['category'])&&isset($_POST['out_of_stock']))
              {
                $sql = "SELECT * FROM gamestore WHERE price<=:high AND gamecat = :cat AND no_of_stock = :out";
                $result = $pdo->prepare($sql);
                $result->execute(array(':high'=>$high, ':out'=>$_POST['out_of_stock'], ':cat'=> $_POST['category']));
              }
              if(isset($_POST['minprice'])&&/*isset($_POST['maxprice'])&&*/isset($_POST['category'])&&isset($_POST['out_of_stock']))
                {
                  $sql = "SELECT * FROM gamestore WHERE price>=:low AND gamecat = :cat AND no_of_stock = :out";
                  $result = $pdo->prepare($sql);
                  $result->execute(array(':low'=>$low, ':out'=>$_POST['out_of_stock'], ':cat'=> $_POST['category']));
                }


        
        else
        {
          //$sql = "SELECT * FROM gamestore";
          //pdo_connect();
          //$result = $pdo->query($sql);
        }
        //$result = $pdo->query($sql);

        /*function pdo_connect(Type $var = null)
        {
          
        }*/
      }
        ?>

        <div class="main-content">
          <div class =  "product-layout">
            <?php
            //require_once "config.php";
            /*if(isset($_POST['minprice'])&&isset($_POST['maxprice'])&&isset($_POST['category'])&&isset($_POST['out_of_stock']))
            {
              $sql = "SELECT * FROM gamestore WHERE price BETWEEN :low AND :high AND gamecat = :cat AND no_of_stock = :out";
              if($result = $pdo->prepare($sql))
              {
                $result->bindParam(":low",$low);
                $result->bindParam(":high",$high);
                $result->bindParam(":cat",$cat);
                $result->bindParam(":out",$out);
                
              }
              //$result->execute(array(':low' , $low, ':high', $high, ':cat',$cat, ':out',$out));
            }*/
            while($row = $result->fetch(PDO::FETCH_ASSOC)) 
            {
              $name = $row['name'];
              $price = $row['price'];
              $image = $row['gameimage'];
              $category = $row['gamecat'];
          
            ?>
              <div class="each-product">
                <div class="image"><img src="..\images\<?php echo $image;?>" alt="" style="width:100%"></div>
                <div class="name"><a href="game_page.php?id=<?php echo $row['id'];?>"><?php echo $name;?></a></div>
                <div class="details"><?php echo $price;?></div>
              </div>
              <?php
            }
            ?>
          </div>
        <div>
    </div>
    
          </body>
          </html>