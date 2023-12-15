<!DOCTYPE html>
<html>

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

    <?php
    error_reporting(0);
    //MYSQL updates must be placed here
    // If we buy 5 starry nights, then quantity must decrease by 5 to 195 from 200
    // $sql = "UPDATE art SET quantity='$quantity' WHERE id = '$id'"

    session_start();
    // Create connection
    $connect = mysqli_connect("localhost", "root", "", "gallery");

    // Check connection
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

   // Check if the "add_to_cart" form is submitted
  if (isset($_POST["add_to_cart"])) {
      // Check if the cart is not empty
      if (isset($_SESSION["cart"])) {
          // Get the item ID to add from the URL
          $item_id_to_add = $_GET["id"];
          $item_exists = false;

          // Check if the item with the same ID already exists in the cart
          foreach ($_SESSION["cart"] as $keys => $values) {
              if ($values["item_id"] == $item_id_to_add) {
                  // Increase the quantity of the existing item
                  $_SESSION["cart"][$keys]["quantity"] += $_POST["quantity"];
                    $quantity = $_SESSION["cart"][$keys]["quantity"];
                  // Decrease the quantity in the art table (mysql)
                    //$sql = "UPDATE art SET quantity=quantity-$quantity WHERE id='$item_id_to_add'";
                    $sql = "UPDATE art SET quantity=quantity-$quantity WHERE id='$item_id_to_add'";

                    $result = mysqli_query($connect, $sql);

                    $item_exists = true;
                  break;
              }
          }

          // If the item doesn't exist in the cart, add it as a new entry
          if (!$item_exists) {
              $count = count($_SESSION["cart"]);
                $quantity2 = $_SESSION["cart"][$keys]["quantity"];
                $sql2 = "UPDATE art SET quantity=quantity-$quantity2 WHERE id='$item_id'";
                $result = mysqli_query($connect, $sql2);

              $item_array = array(
                  'item_id' => $item_id_to_add,
                  'item_name' => $_POST["hidden_name"],
                  'price' => $_POST["hidden_price"],
                  'quantity' => $_POST["quantity"]

              );
              $_SESSION["cart"][$count] = $item_array;

          }
      } else {
          // If the cart is empty, add the item as a new entry

            $quantity3 = $_POST["quantity"];
            $sql3 = "UPDATE art SET quantity=quantity-$quantity3 WHERE id='$item_id_to_add'";
            $result = mysqli_query($connect, $sql3);

          $item_array = array(
              'item_id' => $_GET["id"],
              'item_name' => $_POST["hidden_name"],
              'price' => $_POST["hidden_price"],
              'quantity' => $_POST["quantity"]
          );
          $_SESSION["cart"][0] = $item_array;

	}
   }

   // Check if the "action" parameter is set in the URL
   if (isset($_GET["action"])) {
      // Check if the action is to delete an item
      	 if ($_GET["action"] == "clear") {

	// Clear the entire cart
        unset($_SESSION["cart"]);



        }
        if ($_GET["action"] == "delete") {
          // Loop through the items in the cart
          foreach ($_SESSION["cart"] as $keys => $values) {
              // Check if the "item_id" key exists in the array and if it matches the target item ID
              if (isset($values["item_id"]) && $values["item_id"] == $_GET["id"]) {
                  // Check if there is more than one quantity
                  if ($values["quantity"] > 1) {
                      // If there is more than one quantity, decrease the quantity by 1
                      $_SESSION["cart"][$keys]["quantity"]--;
                  } else {
                      // If there is only one quantity, remove the entire item
                      unset($_SESSION["cart"][$keys]);
                  }
                  break; // Stop the loop after processing the item
              }
          }
      }
  }

   // Code below prints the table that displays items
    ?>
    <?php
    $query = "SELECT * FROM art";
    $result = mysqli_query($connect, $query);


    if (mysqli_num_rows($result) >= 0) { //if results are greater or equal to 0, print elements in the art table
        echo '<div class ="checkoutResultsContainer">';
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <div class="checkoutResultsItem">

                <!--The line below should print id-->
                <form method="post" action="checkout.php?action=add&id=<?php echo $row["id"]; ?>"> 

                    <!--product styling-->
                    <div class="indexContainer">
		    <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
                        <img src="<?php echo $row["image"]; ?>" width="300", height="300" /><br />

                        <!--<h4 class="text-info"><?php // echo $row["id"]; ?></h4> this does print the product ID number-->
                        <h4 class="text-info"><?php echo $row["item_name"]; ?></h4>
                        <h4 class="text-info">By: <?php echo $row["artist_name"]; ?></h4>
                        <h4 class="text-info">$ <?php echo $row["price"]; ?></h4>
                       
                        <input type="text" name="quantity" class="form-control" value="1" />
                        <input type="hidden" name="hidden_name" value="<?php echo $row["item_name"]; ?>" />
                        <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                     </div>   
			<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
                    </div>
                </form>
            </div>
            <?php
        }
    }
    ?>

    <br />
    <br /> 
    <div style="clear:both"></div>
    <br />
    
    <div class = "orderContainer">
        <h3 align="center">Order Details</h3>
        <table class="checkoutResults">
            
            <tr >
                <td width="30%"><b align="center">Item Name</b></td>
                <td width="20%"><b align="center">Quantity</b></td>
                <td width="20%"><b align="center">Price</b></td>
                <td width="15%"><b align="center">Total</b></td>
                <td width="15%"><b align="center">Remove?</b></td>
		<form method="post" action="checkout.php?action=clear">
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
                <td><a href="checkout.php?action=delete&id=<?php echo $values["item_id"]; ?>">Remove</a></td>
            </tr>
            <?php
                    $total = $total + ($values["quantity"] * $values["price"]);
                }
            ?>
            <br />
            <br />
            <tr>
                <td colspan="3" align="right">Total</td>
                <td align="right">$ <?php echo number_format($total, 2); ?></td>
                <td></td>
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
