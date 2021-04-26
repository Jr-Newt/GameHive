<?php
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

    $input_mode = strtolower(trim($_POST["mode"]));
    if(empty($input_mode)){
        $mode_err = "Please enter the mode of gaming.";
    } elseif($input_mode!='online'||$input_mode!='offline'){
        $mode_err = "Please enter the valid online/offline mode of gaming";
    } else{
        $mode = $input_mode;
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

    // Check input errors before inserting in database
    if(empty($name_err) && empty($description_err) && empty($price_err) && empty($gamecat_err)&&empty($mode_err)){
        // Prepare an update statement
        $sql = "UPDATE gamestore SET name=:name, description=:description, gamecat=:gamecat price=:price, mode=:mode WHERE id=:id";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":description", $param_description);
            $stmt->bindParam(":gamecat", $param_gamecat);
            $stmt->bindParam(":price", $param_price);
            $stmt->bindParam(":id", $param_id);
            $stmt->bindParam(":mode", $param_mode);

            // Set parameters
            $param_name = $name;
            $param_description = $description;
            $param_gamecat = $gamecat;
            $param_price = $price;
            $param_id = $id;
            $param_mode = $mode;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
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
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM gamestore WHERE id = :id";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Retrieve individual field value
                    $name = $row["name"];
                    $description = $row["description"];
                    $price = $row["price"];
                    $gamecat= $row["gamecat"];
                    $gameimage = $row["gameimage"];
                $mode = $row["mode"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: gameerror.php");
                    exit();
                }

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);

        // Close connection
        unset($pdo);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: gameerror.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                    <h2 class="mt-5">Update Product</h2>
                    <p>Please edit the input values and submit to update the product.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
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
                        <div class="form-group">
                            <label>Mode</label>
                            <input type="text" name="mode" class="form-control <?php echo (!empty($mode_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mode; ?>">
                            <span class="invalid-feedback"><?php echo $mode_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="gameindex.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
