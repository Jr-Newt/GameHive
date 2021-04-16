<?php
// including the database connection file
include "config.php";
 
if(isset($_POST['update'])) {
    $id = $_POST['gear_id'];    
    $name = $_POST['gear_name'];
    $cat = $_POST['category'];
    $desp = $_POST['desp'];
    $price = $_POST['price'];
        
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
        //updating the table
        $sql = "UPDATE gear_store SET gear_name=:name, category=:cat, desp=:desp, price=:price WHERE gear_id=:id";
        $query = $dbConn->prepare($sql);
                
        //$query->bindparam(':id', $id);
        //$query->bindparam(':name', $name);
        //$query->bindparam(':age', $age);
        //$query->bindparam(':email', $email);
        $query->execute(array(':id'=>$id, ':name'=>$name, ':cat'=>$cat, ':desp'=>$desp, ':price'=>$price));
        //$query->execute();
        
        // Alternative to above bindparam and execute
        // $query->execute(array(':id' => $id, ':name' => $name, ':email' => $email, ':age' => $age));
                
        //redirectig to the display page. In our case, it is index.php
        header("Location: admin_gear.php");
    }
}
?>
<?php
//getting id from url
$id = $_GET['id'];
//$id = $_POST['gear_id'];

//selecting data associated with this particular id
$sql = "SELECT * FROM gear_store WHERE gear_id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));
 
while($row = $query->fetch(PDO::FETCH_ASSOC))
{
    //$id = $_POST['gear_id'];    
    $name = $row['gear_name'];
    $cat = $row['category'];
    $desp = $row['desp'];
    $price = $row['price'];
}
?>
<html>
<head>    
    <title>Edit Data</title>
</head>
 
<body>
    <a href="admin_gear.php">Home</a>
    <br/><br/>
    
    <form name="form1" method="post" action="edit_gear.php">
        <table border="0">
        <tr> 
                <td>gear_name</td>
                <td><input type="text" name="gear_name"></td>
            </tr>
            <tr> 
                <td>category</td>
                <td><input type="text" name="category"></td>
            </tr>
            <tr> 
                <td>description</td>
                <td><input type="text" name="desp"></td>
            </tr>
            <tr> 
                <td>price</td>
                <td><input type="text" name="price"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="gear_id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>