<?php
include "config.php"; 
$_SESSION['view'] = 1;
$date = date('Y-m-d');
echo $date;
echo "<br>";
if(isset($_SESSION['view']))
{
    $query=mysqli_query($con,"select no_of_views, time from views where  id=1");
    $row=mysqli_fetch_array($query);
    if($date ==$row['time'])
    {
        $row['no_of_views'] = $_SESSION['view']+$row['no_of_views'];
    }
    else{
        $row['no_of_views'] = 0;
    }
    
    echo $row['no_of_views'];
    $query=mysqli_query($con,"update views set no_of_views ='".$row[no_of_views]."' where id=1");
}
?>
<html>
<head><title>contentpage</title>
</head>
<body>
    hello
</body>
</html>