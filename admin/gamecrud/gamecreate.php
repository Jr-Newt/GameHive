<?php
error_reporting( error_reporting() & ~E_NOTICE );
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $description = $price = $gamecat = $gameimage = $mode = "";
$name_err = $description_err = $price_err = $gamecat_err = $gameimage_err = $mode_err = "";

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
    if(empty($input_mode)){
        $mode_err = "Please enter the mode of gaming.";
    } elseif($input_mode =='online'||$input_mode=='offline'){
        $mode = $input_mode;
    } else{

        $mode_err = "Please enter the valid online/offline mode of gaming";
    }

    // Validate address
    $input_description = trim($_POST["description"]);
    if(empty($input_description)){
        $description_err = "Please enter Game description.";
    } else{
        $description = $input_description;
    }

    // Validate salary
    $input_price = trim($_POST["price"]);
    if(empty($input_price)){
        $price_err = "Please enter the price of game.";
    } elseif(!ctype_digit($input_price)){
        $price_err = "Please enter a positive integer value.";
    } else{
        $price = $input_price;
    }

    // Validate category
    $input_gamecat = trim($_POST["gamecat"]);
    if(empty($input_gamecat)){
        $gamecat_err = "Please enter game category.";
    } else{
        $gamecat = $input_gamecat;
    }



    //Validate image
    $filename = $_FILES['gameimage']['name'];
    if(!empty($filename)){
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $new_filename = $name.'.'.$ext;
        move_uploaded_file($_FILES['gameimage']['tmp_name'], 'C:/xampp/htdocs/gamehive/images'.$new_filename);
    }
    else{
        $new_filename = '';
    }

    // Check input errors before inserting in database
    if(empty($name_err) && empty($description_err) && empty($price_err) && empty($gamecat_err)&&empty($mode_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO gamestore (name, description, price, gamecat, gameimage, mode) VALUES (:name, :description, :price, :gamecat, :gameimage, :mode)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":description", $param_description);
            $stmt->bindParam(":price", $param_price);
            $stmt->bindParam(":gamecat", $param_gamecat);
            $stmt->bindParam(":gameimage", $param_gameimage);
            $stmt->bindParam(":mode", $param_mode);

            // Set parameters
            $param_name = $name;
            $param_description = $description;
            $param_price = $price;
            $param_gamecat = $gamecat;
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
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
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

                            <label>Description</label>
                            <textarea name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                            <span class="invalid-feedback"><?php echo $description_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $price; ?>">
                            <span class="invalid-feedback"><?php echo $price_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" name="gamecat" class="form-control <?php echo (!empty($gamecat_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $gamecat; ?>">
                            <span class="invalid-feedback"><?php echo $gamecat;?></span>
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
