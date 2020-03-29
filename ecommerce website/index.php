<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>
<HTML>
<HEAD>
<TITLE>Simple PHP Shopping Cart</TITLE>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
        }
        body {
            background-image: url(ekart2.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }
        .right-menu li
{
    display: inline-block;
    margin-top: 30px !important;
    
}

.right-menu li .fa
{
    font-size: 18px;
    margin-right: 10px;
    cursor: pointer;
    
}
.navbar-brand img
{
    width: 150px;
    height: 70px;
}
.navbar-brand
{
    top: 25px;
    left: 50%;
    transform: translateX(-50%);
    position: absolute;
}
.Header{
    background-color: #c7c7c7;
    margin-bottom: 80px;
}
.navbar
{
    padding: 0 35px; !important
}
.navbar-toggler
{
    border: none;
    outline: none;
    padding: 0;
    margin-top: 30px;
}
.navbar-toggler .fa
{
    font-size: 30px;
    cursor: pointer;
}
    #shopping-cart {
	margin: 40px;
}

#product-grid {
	margin: 80px;
}

#shopping-cart table {
	width: 100%;
	background-color: #F0F0F0;
}

#shopping-cart table td {
	background-color: #FFFFFF;
}

.txt-heading {
	color: #211a1a;
	border-bottom: 1px solid #E0E0E0;
	overflow: auto;
}

#btnEmpty {
	background-color: #ffffff;
	border: #d00000 1px solid;
	padding: 5px 10px;
	color: #d00000;
	float: right;
	text-decoration: none;
	border-radius: 3px;
	margin: 10px 0px;
}

.btnAddAction {
    padding: 5px 10px;
    margin-left: 5px;
    background-color: #efefef;
    border: #E0E0E0 1px solid;
    color: #211a1a;
    float: right;
    text-decoration: none;
    border-radius: 3px;
    cursor: pointer;
}

#product-grid .txt-heading {
	margin-bottom: 50px;
}

.product-item {
    margin-bottom: 250px;
	float: left;
	background: #ffffff;
	margin: 30px 30px 0px 0px;
	border: #E0E0E0 1px solid;
}

.product-image {
	height: 155px;
	width: 250px;
	background-color: #FFF;
}

.clear-float {
	clear: both;
}

.demo-input-box {
	border-radius: 2px;
	border: #CCC 1px solid;
	padding: 2px 1px;
}

.tbl-cart {
	font-size: 0.9em;
}

.tbl-cart th {
	font-weight: normal;
}

.product-title {
	margin-bottom: 20px;
}

.product-price {
	float:left;
}

.cart-action {
	float: right;
}

.product-quantity {
    padding: 5px 10px;
    border-radius: 3px;
    border: #E0E0E0 1px solid;
}

.product-tile-footer {
    padding: 15px 15px 0px 15px;
    overflow: auto;
}

.cart-item-image {
	width: 30px;
    height: 30px;
    border-radius: 50%;
    border: #E0E0E0 1px solid;
    padding: 5px;
    vertical-align: middle;
    margin-right: 15px;
}
.no-records {
	text-align: center;
	clear: both;
	margin: 38px 0px;
}
        .title-style h1
{
    padding: 40px 0;
}
.title-style
{
    margin: 0 auto 80px;
    height: 120px;
    width: 80%;
    max-width: 700px;
    background-color: #fff;
    position: relative;
    box-shadow: 0 4px 5px 0 rgba(0,0,50,0.5);
}
.title-style::after
{
    content: '';
    height: 100px;
    width: 200px;
    background-color: #c7c7c7;
    position: absolute;
    top: -10px;
    left: -10px;
    z-index: -1;
}
.title-style::before
{
    content: '';
    height: 100px;
    width: 200px;
    background-color: #c7c7c7;
    position: absolute;
    bottom: -10px;
    right: -10px;
    z-index: -1;
}
        .footer
{
    margin-top: 700px;
    background: #c7c7c7;
}
.payment,.insta-img,.app-download
{
    margin: 50px auto;
}
.payment img
{
    width: 300px;
    cursor: pointer;
}
.insta-img img
{
    width: 75px;
    padding: 5px;
    cursor: pointer;
}
.app-download img
{
    width: 200px;
    cursor: pointer;
    padding: 5px;
}
.footer h5
{
    margin-bottom: 50px;
}
.footer h5::before
{
    content: '';
    width: 70px;
    height: 3px;
    background: #4f74e8;
    top: 75px;
    position: absolute;
}
.footer-icons
{
    text-align: right;
    
}
.footer-icons .fa
{
    margin: 0 10px auto;
    font-size: 20px;
    
}

    </style>
</HEAD>
<BODY>
    <section class="Header">
        <nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="incarnate.php" target="_blank"><img src="logo.jpg"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fa fa-bars"></i>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index1.php" target="_blank" >Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php" target="_blank">About us</a>
      </li>
     <li class="nav-item">
        <a class="nav-link" href="new.php" target="_blank">Login/Register</a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="index.php" target="_blank">Cart</a>
      </li>
    </ul>
      <ul class="right-menu ml-auto">
          <li><i class="fa fa-facebook"></i></li>
          <li><i class="fa fa-instagram"></i></li>
          <li><i class="fa fa-twitter"></i></li>
          <li><div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
           <div class="input-group-append">
               <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
          </div>
</div></li>
      </ul>
  </div>
</nav>
        </section>
     <div class="title-style text-center">
                    <h1>Welcome to our cart</h1>
                </div>
<div id="shopping-cart">
<div class="txt-heading">Shopping Cart</div>

<a id="btnEmpty" href="index.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>		
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>
</div>

<div id="product-grid">
	<div class="txt-heading">Products</div>
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item">
			<form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"></div>
			<div class="product-tile-footer">
			<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
			<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><a href="https://www.myntra.com/"><input type="submit" value="Add to Cart" class="btnAddAction" /></a></div>
			</div>
			</form>
		</div>
	<?php
		}
	}
	?>
</div>
     <section class="footer">
        <div class="container">
            <div class="row">
            <div class="col-md-4">
                <div class="payment">
                <h5>PAYMENT GATEWAYS</h5>
                <img src="footer/payment.jpg">
                    </div>
                </div>
                 <div class="col-md-4">
                <div class="insta-img">
                <h5>INSTAGRAM PICS</h5>
                <img src="footer/insta1.jpg">
                    <img src="footer/insta2.jpg">
                    <img src="footer/insta3.jpg">
                    <img src="footer/insta4.jpg">
                    <img src="footer/insta5.jpg">
                    <img src="footer/insta6.jpg">
                    <img src="footer/insta7.jpg">
                    <img src="footer/insta8.jpg">
                    </div>
                </div>
                 <div class="col-md-4">
                     <div class="app-download">
                     <h5>DOWNLOAD MOBILE APP</h5>
                         <img src="footer/google play.jpg">
                         <img src="footer/app store.jpg">
                     </div>
                </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-md-8">
                <p class="copyright">Designed with <i class="fa fa-heart"> By Mukund and Prajwal</i></p>
                </div>
                <div class="col-md-4">
                <div class="footer-icons">
                    <i class="fa fa-facebook"></i>
                    <i class="fa fa-instagram"></i>
                    <i class="fa fa-youtube-play"></i>
                    <i class="fa fa-linkedin"></i>
                    <i class="fa fa-twitter"></i>
                    </div>
                </div>
            
            </div>
            </div>
        
        </section>
    <script type="text/javascript">
    alert("The page has been loaded succesfully");
    </script>
</BODY>
</HTML>