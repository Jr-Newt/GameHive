<?php
 require_once "controllerUserData.php";
include "config.php";
error_reporting( error_reporting() & ~E_NOTICE );
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
// Check existence of id parameter before processing further
error_reporting( error_reporting() & ~E_NOTICE );
$name = $address = $phone_no = $gamecat = $gameimage = $mode = "";
$name_err = $address_err = $phone_no_err = $gamecat_err = $gameimage_err = $mode_err = "";

if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Validate name
    $id = $_POST['id'];
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
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter address.";
    } else{
        $address = $input_address;
    }

    // Validate salary
    $input_phone_no = trim($_POST["phone_no"]);
    if(empty($input_phone_no)){
        $phone_no_err = "Please enter the phone_no ";
    } elseif(strlen($input_phone_no)!=10){
        $phone_no_err = "Please enter a 10 digit mobile number.";
    } 
    elseif(!ctype_digit($input_phone_no)){
        $phone_no_err = "Please enter a positive integer value.";
    } else{
        $phone_no = $input_phone_no;
    }

    // Validate category
    $input_gamecat = trim($_POST["gamecat"]);
    if(empty($input_gamecat)){
        $gamecat_err = "Please enter game category.";
    } else{
        $gamecat = $input_gamecat;
    }

    // Check input errors before inserting in database
    if(empty($address_err) && empty($phone_no_err)){
        // Prepare an update statement
        $sql = "UPDATE userlogin SET address=:address, phone_no=:phone_no WHERE id=:id";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
           
            $stmt->bindParam(":address", $param_address);
            $stmt->bindParam(":phone_no", $param_phone_no);
            $stmt->bindParam(":id", $param_id);

            // Set parameters
            
            $param_address = $address;
            $param_phone_no = $phone_no;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: user_profile.php");
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
else{
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    $id = trim($_GET["id"]);
    require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM userlogin WHERE id = :id";

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
                $address = $row["address"];
                $phone_no = $row["phone_no"];
                $email = $row["email"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
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
} else{
    // URL doesn't contain id parameter. Redirect to gameerror page
    header("location: gameerror.php");
    exit();
}}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                    <h2 class="mt-5">Update Profile</h2>
                    <p>Please edit the input values and submit to update the user information.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <p><b><?php echo $_SESSION["name"]; ?></b></p>
                    </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Phone no:</label>
                            <input type="number" name="phone_no" class="form-control <?php echo (!empty($phone_no_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone_no; ?>">
                            <span class="invalid-feedback"><?php echo $phone_no_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $_SESSION['user_id']; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="user_profile.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
