<?php
session_start();
include('databases.php');
$status="";
if (isset($_POST['id']) && $_POST['id']!=""){
$code = $_POST['id'];
$result = mysqli_query($con,"SELECT * FROM `products` WHERE `id`='$code'");
$row = mysqli_fetch_assoc($result);
$name = $row['Product name'];
$code = $row['id'];
$price = $row['Price'];
$image = $row['Image'];
 
$cartArray = array(
	$code=>array(
	'Product name'=>$name,
	'id'=>$code,
	'Price'=>$price,
	'quantity'=>1,
	'Image'=>$image)
);
 
if(empty($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = $cartArray;
    $status = "<div class='box'>Product is added to your cart!</div>";
}else{
    $array_keys = array_keys($_SESSION["shopping_cart"]);
    if(in_array($code,$array_keys)) 
    {
	$status = "<div class='box' style='color:red;'>
	Product is already added to your cart!</div>";	
    } 
    else 
    {
    $_SESSION["shopping_cart"] = array_merge(
    $_SESSION["shopping_cart"],
    $cartArray
    );
    $status = "<div class='box'>Product is added to your cart!</div>";
	}
 
	}
}
?>
<html>
    <head>
        <title>
            Purchasing
        </title>
        <link rel='stylesheet' href='cart.css' type='text/css' media='all' />
    </head>
    <body>
<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
<div class="cart_div">
<a href="cart.php"><img src="cart1.jpg" alt="cart" /> Cart<span>
<?php echo $cart_count; ?></span></a>
</div>
<?php
}
?>
<?php
$result = mysqli_query($con,"SELECT * FROM `products`");
while($row = mysqli_fetch_assoc($result))
{
    echo"<div class='product_wrapper'>
          <form method='post' action=''>
          <input type='hidden' name='id' value=".$row['id']." />
          <div class='image'><img src='".$row['Image']."' /></div>
          <div class='name'>".$row['Product name']."</div>
          <div class='price'>$".$row['Price']."</div>
          <button type='submit' class='buy'>Buy Now</button>
          </form>
        </div>";
     
}
mysqli_close($con);
?>
 <div style="clear:both;"></div>
 
 <div class="message_box" style="margin:10px 0px;">
 <?php echo $status; ?>
 </div>
</body>
</html>
 <?php
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
    foreach($_SESSION["shopping_cart"] as $key => $value) {
      if($_POST["id"] == $key){
      unset($_SESSION["shopping_cart"][$key]);
      $status = "<div class='box' style='color:red;'>
      Product is removed from your cart!</div>";
      }
      if(empty($_SESSION["shopping_cart"]))
      unset($_SESSION["shopping_cart"]);
      }		
}
}
 
if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['id'] === $_POST["id"]){
        $value['quantity'] = $_POST["quantity"];
        break; 
    }
}
  	
}
?>
<div class="cart">
<?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>	
<table class="table">
<tbody>
<tr>
<td></td>
<td>Product name</td>
<td>Quantity</td>
<td>Unit price</td>
<td>Total</td>
</tr>	
<?php		
foreach ($_SESSION["shopping_cart"] as $product){
?>
<tr>
<td>
<img src='<?php echo $product["Image"]; ?>' width="50" height="40" />
</td>
<td><?php echo $product["Product name"]; ?><br />
<form method='post' action=''>
<input type='hidden' name='id' value="<?php echo $product["id"]; ?>" />
<input type='hidden' name='action' value="remove" />
<button type='submit' class='remove'>Remove Item</button>
</form>
</td>
<td>
<form method='post' action=''>
<input type='hidden' name='id' value="<?php echo $product["id"]; ?>" />
<input type='hidden' name='action' value="change" />
<select name='quantity' class='quantity' onChange="this.form.submit()">
<option <?php if($product["quantity"]==1) echo "selected";?>
value="1">1</option>
<option <?php if($product["quantity"]==2) echo "selected";?>
value="2">2</option>
<option <?php if($product["quantity"]==3) echo "selected";?>
value="3">3</option>
<option <?php if($product["quantity"]==4) echo "selected";?>
value="4">4</option>
<option <?php if($product["quantity"]==5) echo "selected";?>
value="5">5</option>
</select>
</form>
</td>
<td><?php echo "$".$product["Price"]; ?></td>
<td><?php echo "$".$product["Price"]*$product["quantity"]; ?></td>
</tr>
<?php
$total_price += ($product["Price"]*$product["quantity"]);
}
?>
<tr>
<td colspan="5" align="right">
<strong>TOTAL: <?php echo "$".$total_price; ?></strong>
</td>
</tr>
</tbody>
</table>		
  <?php
}
else{
	echo "<h3>Your cart is empty!</h3>";
	}
?>
</div>
 
<div style="clear:both;"></div>
 
<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>
</body>
</html>
