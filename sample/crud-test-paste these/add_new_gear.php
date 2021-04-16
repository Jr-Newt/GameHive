<html>
<head>
    <title>Add Data</title>
</head>
 
<body>
<?php
//including the database connection file
include "config.php";
 
if(isset($_POST['Submit'])) {
    $id = $_POST['gear_id'];    
    $name = $_POST['gear_name'];
    $cat = $_POST['category'];
    $desp = $_POST['desp'];
    $price = $_POST['price'];
    $filename = $_FILES['photo']['name'];
    if(!empty($filename)){
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $new_filename = $name.'.'.$ext;
        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$new_filename);	
    }
    else{
        $new_filename = '';
    }
        
    // checking empty fields
    if(empty($id)||empty($name) || empty($cat) || empty($desp)||empty($price)) {
                
        if(empty($id)) {
            echo "<font color='red'>gear_id field is empty.</font><br/>";
        }
        if(empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($cat)) {
            echo "<font color='red'>category field is empty.</font><br/>";
        }
        
        if(empty($desp)) {
            echo "<font color='red'>description field is empty.</font><br/>";
        }
        if(empty($price)) {
            echo "<font color='red'>price field is empty.</font><br/>";
        }
        
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else { 
        // if all the fields are filled (not empty) 
            
        //insert data to database        
        $sql = "INSERT INTO gear_store(gear_id, gear_name, category, desp, price, photo) VALUES(:gear_id, :gear_name, :category, :desp, :price, :photo)";
        $query = $dbConn->prepare($sql);
                
        //$query->bindparam(':name', $name);
        //$query->bindparam(':age', $age);
        //$query->bindparam(':email', $email);
        $query->execute(array('gear_id'=>$id, 'gear_name'=>$name, 'category'=>$cat, 'desp'=>$desp, 'price'=>$price, 'photo'=>$new_filename));
        
        // Alternative to above bindparam and execute
        // $query->execute(array(':name' => $name, ':email' => $email, ':age' => $age));
        
        //display success message
        echo "<font color='green'>Data added successfully.";
        echo "<br/><a href='admin_gear.php'>View Result</a>";
    }
}
?>
</body>
</html>