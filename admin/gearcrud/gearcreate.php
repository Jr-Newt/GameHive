<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $description = $price = $gearcat = $gearimage = "";
$name_err = $description_err = $price_err = $gearcat_err = $gearimage_err = "";

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

    // Validate address
    $input_description = trim($_POST["description"]);
    if(empty($input_description)){
        $description_err = "Please enter product description.";
    } else{
        $description = $input_description;
    }

    // Validate salary
    $input_price = trim($_POST["price"]);
    if(empty($input_price)){
        $price_err = "Please enter the price amount.";
    } elseif(!ctype_digit($input_price)){
        $price_err = "Please enter a positive integer value.";
    } else{
        $price = $input_price;
    }

    // Validate category
    $input_gearcat = trim($_POST["gearcat"]);
    if(empty($input_gearcat)){
        $gearcat_err = "Please enter product description.";
    } else{
        $gearcat = $input_gearcat;
    }

    //Validate image
    $filename = $_FILES['gearimage']['name'];
    if(!empty($filename)){
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $new_filename = $name.'.'.$ext;
        move_uploaded_file($_FILES['gearimage']['tmp_name'], '../images/'.$new_filename);
    }
    else{
        $new_filename = '';
    }

    // Check input errors before inserting in database
    if(empty($name_err) && empty($description_err) && empty($price_err) && empty($gearcat_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO gearstore (name, description, price, gearcat, gearimage) VALUES (:name, :description, :price, :gearcat, :gearimage)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":description", $param_description);
            $stmt->bindParam(":price", $param_price);
            $stmt->bindParam(":gearcat", $param_gearcat);
            $stmt->bindParam(":gearimage", $param_gearimage);

            // Set parameters
            $param_name = $name;
            $param_description = $description;
            $param_price = $price;
            $param_gearcat = $gearcat;
            $param_gearimage = $new_filename;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: gearindex.php");
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
                            <input type="text" name="gearcat" class="form-control <?php echo (!empty($gearcat_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $gearcat; ?>">
                            <span class="invalid-feedback"><?php echo $gearcat;?></span>
                        </div>
                        <tr>
                            <td>Image:<input type="file" name="gearimage" accept="image/jpeg"></td>
                        </tr>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="gearindex.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
