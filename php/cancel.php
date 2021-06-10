<html>
<head>
<title>Cancel</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
              <style>
              .ack{
                margin-top:20px;
                display:grid;
                grid-template-columns: 1fr;
                grid-template-rows: 1fr;
                justify-content: center;
                margin-bottom:30px;
              }
              .card{
                justify-self: center;
              }
              </style>
</head>
<BODY>

<h1 style="text-align:center;">Order Cancelled!!</h1>
<form action="cancelprocess.php" method="post">
<div class="ack">
              <div class="card" style="width: 18rem;">
                <img src="..\images\cross.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <p class="card-text">Your PayPal Transaction has been Canceled</p>
                </div>
              </div>
            </div>
        <input type="hidden" name="transact" value="<?php echo $_SESSION['transact'];?>">
        <button type="submit" name="back" class="btn btn-danger">back</button>
    </form>
            
            
</BODY>
</html>


