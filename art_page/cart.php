<?php
session_start();

// Retrieve order details from the session
$orderDetails = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

// Create connection
$connect = mysqli_connect("localhost", "root", "", "gallery");

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}



// Check if the "action" parameter is set in the URL
if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete" && isset($_GET["id"])) {
        // Delete a specific item
        $item_id_to_delete = $_GET["id"];
        
        // Loop through the items in the cart
        foreach ($_SESSION["cart"] as $keys => $values) {
            // Check if the "item_id" matches the target item ID
            if ($values["item_id"] == $item_id_to_delete) {
                // If there is more than one quantity, decrease the quantity by 1
                if ($values["quantity"] > 1) {
                    $_SESSION["cart"][$keys]["quantity"]--;
                } else {
                    // If there is only one quantity, remove the entire item
                    unset($_SESSION["cart"][$keys]);
                }
                break; // Stop the loop after processing the item
            }
        }
    } elseif ($_GET["action"] == "clear") {
        // Clear the entire cart
        $_SESSION["cart"] = [];
    } elseif ($_GET["action"] == "checkout") {
        // Redirect to the checkout page
        header("Location: checkout.html");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Art Gallery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://localhost/art_page/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="script.js"></script>
</head>
<body>
<!-- HEADER (LOGO, SEARCH, LOGIN, CART)-->
  <header>
    <div class="logo">
    <img src="http://localhost/art_page/Images/logo.png" alt="logo" width="250" height="250">
      <span><a style="text-decoration:none" href="http://localhost/art_page/index.php"><b>John's Art Store</b></a></span>
    </div>
    <div class="myaccount">
      <a href="http://localhost/login.html"><i class="fa fa-user-circle-o"></i> My Account </a>
    </div>
    <div class="cart">
      <a href="cart.php"><i class="fa fa-cart-arrow-down"></i> Cart </a>
    </div>
  </header>
  <!-- Navigaton Bar -->
  <div class="navbar">
    <div class="categories">
      <button onclick="dropDownButton()" class="dropbtn">Categories
        <i class="fa fa-caret-down"></i>
      </button>
      <div id="myDropdown" class="dropdown-content">
        <a href="http://localhost/art_page/paintings.html"> Paintings</a>
        <a href="http://localhost/art_page/sculptures.html"> Sculptures</a>
        <a href="http://localhost/art_page/mixed.html"> Mixed Media</a>
      </div>
    </div>
    <a href="http://localhost/art_page/locations.html">Locations</a>
    <a href="http://localhost/art_page/returns.html">Returns</a>
    <a href="http://localhost/art_page/contact.html">Contact Us</a>
  </div>


  <br>
  <br>


    <div class = "orderContainer">
        <h3 align="center">Order Details</h3>
        <table class="checkoutResults">
            
            <tr >
                <td width="30%"><b align="center">Item Name</b></td>
                <td width="20%"><b align="center">Quantity</b></td>
                <td width="20%"><b align="center">Price</b></td>
                <td width="15%"><b align="center">Total</b></td>
                <td width="15%"><b align="center">Remove?</b></td>
		<form method="post" action="cart.php?action=clear">
    			<input type="submit" name="clear_cart" class="btn btn-danger" value="Clear Cart" />
  	   	</form>
	    </tr>
	  
            <?php
            if (!empty($_SESSION["cart"])) {
                $total = 0;
                foreach ($_SESSION["cart"] as $keys => $values) {
            ?>
            <tr>
                <td><?php echo $values["item_name"]; ?></td>
                <td><?php echo $values["quantity"]; ?></td>
                <td>$ <?php echo $values["price"]; ?></td>
                <td>$ <?php echo number_format($values["quantity"] * $values["price"], 2); ?></td>
                <td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>">Remove</a></td>
             
            </tr>
            <tr>
                <?php
                    $total = $total + ($values["quantity"] * $values["price"]);
                }
                ?>
            </tr>
            <br />
            <br />
            <tr>
                <td colspan="3" align="right">Total</td>
                <td align="right">$ <?php echo number_format($total, 2); ?></td>
		
                <td></td>
            </tr>
         
            <tr>
                <td align="right"><a href="final.html"> Press HERE to checkout </a></td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>

	<br>
	<br>

  <footer class="row">
    <table class = "ltable" style="width:100%">
      <tr>
        <td><a href="http://localhost/art_page/contact.html">Contact Us</a></td>
        <td><a href="http://localhost/art_page/TAC.html">Terms and Conditions</a></td>
        <td><a href="http://localhost/art_page/story.html">Our Story</a></td>
      </tr>

      <tr>
        <td><a href="http://localhost/art_page/account.html">Account Management</a></td>
        <td><a href="http://localhost/art_page/policy.html">Privacy Policy</a></td>
        <td><a href="http://localhost/art_page/locations.html">Locations</a></td>
      </tr>

      <tr>
        <td><a href="http://localhost/art_page/returns.html">Returns</a></td>
        <td><a href="http://localhost/art_page/legal.html">Legal Notices</a></td>
      </tr>

    </table>
  </footer>



</body>
</html>