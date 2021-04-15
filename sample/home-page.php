<html>
<?php require_once "controller.php"; ?>
  <head>
    <title>Home Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <style>
    body{
      background-color: rgb(255, 197, 5);
    }

    .proj-title{
      text-align: center;
      margin-top: 20px;
      margin-right: 0px;
      margin-bottom: 0px;
      color: rgb(240, 194, 44);
      padding-top: 30px;
      background-color: black;
    }
    .about{
      display: grid;
      grid-template-columns: 1fr;
      grid-template-rows: 1fr;
      background-color: rgb(255, 197, 5);
      /*border-bottom:1px solid black ;*/

    }
    .desc-store-img{
      display: grid;
      background-color: rgb(255, 197, 5);
      grid-template-columns: 1fr 1fr;
      grid-template-rows: .25fr;
      padding-top: 20px;
      text-align: center;
      height: 300px;
      /*border-bottom :1px solid black ;*/
    }
    .desc-store-img div>img{
      width: 100%;
    }
    .desc-store-img div>h3>a{
      color: black;
    }
    .desc-store-img div>h3>a:hover{
      color: red;
      text-decoration: none;
    }
    .desc-store-p{
      display: grid;
      background-color: rgb(255, 197, 5);
      grid-template-columns: 1fr 1fr;
      grid-template-rows: .25fr;
      padding-top: 20px;
      text-align:left;
      height: 300px;
      grid-column-gap: 1em;
      /*border-bottom :1px solid black ;*/
    }


  </style>

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
            <a href="#" onclick= "document.getElementById('id01').style.display='block'" style="width:auto;" class="nav-link">Login</a>
            <div id="id01" class="modal">

              <form class="modal-content animate" action="/action_page.php" method="post">
                <div class="imgcontainer">
                  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                  <!--img src="" alt="Avatar" class="avatar"-->
                  <h5>LOGIN</h5>
                </div>

                <div class="container2">
                  <label for="uname"><b>Username</b></label>
                  <input type="text" placeholder="Enter Username" name="email" required>

                  <label for="psw" ><b>Password</b></label>
                  <input type="password" placeholder="Enter Password" name="password" required>

                  <button type="submit" name="login">Login</button>
                  <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                  </label>
                </div>

                <div class="container2" style="background-color:#f1f1f1">
                  <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                  <span class="psw">New User?<a href="registration.html">Register Here</a></span>
                </div>
              </form>
            </div>
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
    <div class="proj-title"><h1>GAME HIVE</h1></div>
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="692032.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>GAME STORE</h5>
            <p>Check out the awesome colllection of PC and Console games</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="934032.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>GEAR STORE</h5>
            <span style="color: black;">All the gaming</span><p>Gears you need!!!</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="2669050.jpg" class="d-block w-100" alt="">
          <div class="carousel-caption d-none d-md-block">
            <h5>Efficient way of shopping</h5>
            <p></p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <div class="about">
        <h1>About Us</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe suscipit aut accusantium optio eum maiores libero repellat non nihil maxime laudantium alias sequi quo similique nesciunt odit, accusamus nemo. Placeat!</p>
      </div>
      <h1 style="background-color: rgb(255, 197, 5);margin: 0;">What We Offer</h1>
      <div class="desc-store-img">
        <div><h3><a href="#">Gear Store</a></h3><img src="ac.jpg" style="height: 200px;width: 60%;"alt=""></div>
        <div><h3><a href="#">Game Store</a></h3><img src="pexels-tima-miroshnichenko-5303633.jpg" alt=""style="height: 24%;width: 60%;"></div>
      </div>
      <div class="desc-store-p"><p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Recusandae quisquam explicabo distinctio totam facere nemo minus optio, amet quidem libero!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus sapiente sint dolorum illum magni animi ullam optio laudantium perferendis esse.</p></div>
      <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>
  </body>
</html>
