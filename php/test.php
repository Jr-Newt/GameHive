<html>
<head><title>test-login</title></head>
<body>
    <?php
    $a=array(name=>shaun, sal=>5000)
    $d=[]
    foreach($a as $details=>$v){
        $details
        $d=$details
    }
    $d
    ?>
</body>
</html>

<!--?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com
*/
session_start()
$status=
if (isset($_POST['action']) && $_POST['action']==remove){
if(!empty($_SESSION[shopping_cart])) {
	foreach($_SESSION[shopping_cart] as $key => $value) {
		if($_POST[gearcat] == $key){
		unset($_SESSION[shopping_cart][$key])
		$status = <div class='box' style='color:red'>
		Product is removed from your cart!</div>
		}
		if(empty($_SESSION[shopping_cart]))
		unset($_SESSION[shopping_cart])
			}		
		}
}

if (isset($_POST['action']) && $_POST['action']==change)
{
  /*foreach($_SESSION[shopping_cart] as $value){
    if($value['gearcat'] === $_POST[gearcat]){
        $value['quantity'] = $_POST[quantity]
        break // Stop the loop after we've found the product
    }*/
	while
}
  	
}
?>
<html>
<head>
<title>Demo Shopping Cart - AllPHPTricks.com</title>
<link rel='stylesheet' href='cart_style.css' type='text/css' media='all' />
</head>
<body>
<div style=width:700px margin:50 auto>

<h2>Demo Shopping Cart</h2>   

</*?php
if(!empty($_SESSION[shopping_cart])) {
$cart_count = count(array_keys($_SESSION[shopping_cart]))
?>
<div class=cart_div>
<a href=cart.php>
<img src=cart-icon.png /> Cart
<span><?php $cart_count ?></span></a>
</div>
<?php
}
?>

<div class=cart>
<?php
if(isset($_SESSION[shopping_cart])){
    $total_price = 0
?>	
<table class=table>
<tbody>
<tr>
<td></td>
<td>ITEM NAME</td>
<td>QUANTITY</td>
<td>UNIT PRICE</td>
<td>ITEMS TOTAL</td>
</tr>	
<!--?php		
foreach ($_SESSION[shopping_cart] as $product){
?-->
<?php
$name = $_SESSION[shopping_cart]['name']
$name
$price = $_SESSION[shopping_cart]['price']
$gearcat = $_SESSION[shopping_cart]['gearcat']
$qty = $_SESSION[shopping_cart]['quantity']
$image = $_SESSION[shopping_cart]['image']
?>
<tr>
<td><img src='<?php $image ?>' width=50 height=40 /></td>
<td><?php $name ?><br />
<form method='post' action=''>
<input type='hidden' name='gearcat' value=<?php $gearcat ?> />
<input type='hidden' name='action' value=remove />
<button type='submit' class='remove'>Remove Item</button>
</form>
</td>
<td>
<form method='post' action=''>
<input type='hidden' name='gearcat' value=<?php $gearcat ?> />
<input type='hidden' name='action' value=change />
<select name='quantity' class='quantity' onchange=this.form.submit()>
<option <?php if($qty==1) selected?> value=1>1</option>
<option <?php if($qty==2) selected?> value=2>2</option>
<option <?php if($qty==3) selected?> value=3>3</option>
<option <?php if($qty==4) selected?> value=4>4</option>
<option <?php if($qty==5) selected?> value=5>5</option>
</select>
</form>
</td>
<td><?php $.$price ?></td>
<td><?php $.$price*$qty ?></td>
</tr>
<?php
$total_price += ($price*$qty)

?>
<tr>
<td colspan=5 align=right>
<strong>TOTAL: <?php $.$total_price ?></strong>
</td>
</tr>
</tbody>
</table>		
  <?php
}
else{
	<h3>Your cart is empty!</h3>
	}
?>
</div>

<div style=clear:both></div>

<div class=message_box style=margin:10px 0px>
<?php $status ?>
</div>


<br /><br />
<a href=https://www.allphptricks.com/simple-shopping-cart-using-php-and-mysql/><strong>Tutorial Link</strong></a> <br /><br />
For More Web Development Tutorials Visit: <a href=https://www.allphptricks.com/><strong>AllPHPTricks.com</strong></a>
</div>
</body>
</html-->
<table class=table table-bordered table-striped>'
                                <thead>
                                    <tr>
										<th>#</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>SubTotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                while($row = $stmt->fetch()){
                                    <tr>
                                        <td><img src= . $row['id'] . </td>
                                        <td> . $row['name'] . </td>
                                        <td> . $row['description'] . </td>
                                        <td> . $row['price'] . </td>
                                        <td> . $row['gamecat'] . </td>
                                        <td> . $row['gameimage'] . </td>
                                        <td>
                                            '<a href=gameread.php?id='. $row['id'] .' class=mr-0 title=View Record data-toggle=tooltip><span class=fa fa-eye></span></a>'
                                            '<a href=gameupdate.php?id='. $row['id'] .' class=mr-0 title=Update Record data-toggle=tooltip><span class=fa fa-pencil></span></a>'
                                            '<a href=gamedelete.php?id='. $row['id'] .' title=Delete Record data-toggle=tooltip><span class=fa fa-trash></span></a>'
                                        </td>
                                    </tr>
                                }
                                </tbody>
                            </table>