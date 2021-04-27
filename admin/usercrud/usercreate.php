<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $address = $phone_no = $email = $gameimage = $mode = "";
$name_err = $address_err = $phone_no_err = $email_err = $gameimage_err = $mode_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    

    $input_mode = trim($_POST["mode"]);
    $input_mode = strtolower($input_mode);
    if(empty($input_mode))
    {
        $mode_err = "Please enter the mode of gaming.";
    } elseif($input_mode =='online'||$input_mode =='offline')
    {
        $mode = $input_mode;
    } else{
        
        $mode_err = "Please enter the valid online/offline mode of gaming";
    }

    // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter Game address.";
    } else{
        $address = $input_address;
    }

    // Validate salary
    $input_phone_no = trim($_POST["phone_no"]);
    if(empty($input_phone_no)){
        $phone_no_err = "Please enter the phone_no of game.";
    } elseif(!ctype_digit($input_phone_no)){
        $phone_no_err = "Please enter a positive integer value.";
    } else{
        $phone_no = $input_phone_no;
    }

    // Validate category
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter game category.";
    } else{
        $email = $input_email;
    }
    


    //Validate image
    $filename = $_FILES['gameimage']['name'];
    if(!empty($filename)){
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $new_filename = $name.'.'.$ext;
        move_uploaded_file($_FILES['gameimage']['tmp_name'], 'E:/XAMPP/htdocs/GAME HIVE/Gamehive/images/'.$new_filename);
    }
    else{
        $new_filename = '';
    }

    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($phone_no_err) && empty($email_err)&&empty($mode_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO gamestore (name, address, phone_no, email, gameimage, mode) VALUES (:name, :address, :phone_no, :email, :gameimage, :mode)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":address", $param_address);
            $stmt->bindParam(":phone_no", $param_phone_no);
            $stmt->bindParam(":email", $param_email);
            $stmt->bindParam(":gameimage", $param_gameimage);
            $stmt->bindParam(":mode", $param_mode);

            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_phone_no = $phone_no;
            $param_email = $email;
            $param_gameimage = $new_filename;
            $param_mode = $mode;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: gameindex.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><img src="" alt="LOGO" style="width:40px;"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Dashboard</a>
      </li>
      <!--li class="nav-item">
        <a class="nav-link" href="#">Sales</a>
      </li-->
      <li class="nav-item">
        <a class="nav-link" href="userindex.php">Users</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded = "false">
          Products
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="gearcrud/gearindex.php">Gear Store</a>
          <a class="dropdown-item" href="gamecrud/gameindex.php">Game Store</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
  </div>
</nav>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add new product into the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">

                            <label>address</label>
                            <textarea name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>phone_no</label>
                            <input type="text" name="phone_no" class="form-control <?php echo (!empty($phone_no_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone_no; ?>">
                            <span class="invalid-feedback"><?php echo $phone_no_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email;?></span>
                        </div>
                        <tr>
                            <td>Image:<input type="file" name="gameimage" accept="image/jpeg"></td>
                        </tr>
                        <div class="form-group">
                            <label>Mode</label>
                            <input type="text" name="mode" class="form-control <?php echo (!empty($mode_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mode; ?>">
                            <span class="invalid-feedback"><?php echo $mode_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="gameindex.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
