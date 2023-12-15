<?php
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
                  $item_exists = true;
                  break;
              }
          }

          // If the item doesn't exist in the cart, add it as a new entry
          if (!$item_exists) {
              $count = count($_SESSION["cart"]);
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
	 
          $item_array = array(
              'item_id' => $_GET["id"],
              'item_name' => $_POST["hidden_name"],
              'price' => $_POST["hidden_price"],
              'quantity' => $_POST["quantity"]
          );
          $_SESSION["cart"][0] = $item_array;
      	
	}
   }
?>

<!DOCTYPE html>
<html>

<head>
  <title>Art Gallery</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="script.js"></script>
</head>

<body>
  <!-- HEADER (LOGO, SEARCH, LOGIN, CART)-->
  <header>
    <div class="logo">
	  <img src="Images/logo.png" alt="logo" width="250" height="250">
      <span><a style="text-decoration:none" href="index.php"><b>John's Art Store</b></a></span>
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
        <a href="paintings.html"> Paintings</a>
        <a href="sculptures.html"> Sculptures</a>
        <a href="mixed.html"> Mixed Media</a>
        <!--<a href="#cat3"> Music</a>
        <a href="#cat3"> Photographies</a>
        <a href="#cat3"> Drawings</a>-->
      </div>
    </div>
    <a href="locations.html">Locations</a>
    <a href="returns.html">Returns</a>
    <a href="contact.html">Contact Us</a>
  </div>


	<br>
	<br>

<body>

      <h2>Paintings</h2>
      <br>

    
   <div class = "container"> 
        <div class="productimg">
          <img src="Images/nighthawks.jpg" alt="Nighthawks painting" style="width:500px;height:330px;">
        </div> 
        <div class="paintingtext"> 
          <h2>Nighthawks</h2>
          <p>Artist: Edward Hopper</p>
          <p><i>Published: 1942</i></p>
          <p>Price: $15</p>
          <br> 
   
        </div>
      </div>   
    
      <br>

  <?php
    $query = "SELECT * FROM art WHERE id=2";
    $result = mysqli_query($connect, $query);


    if (mysqli_num_rows($result) >= 0) { //if results are greater or equal to 0, print elements in the art table
        echo '<div class ="checkoutResultsContainer">';
        if($row = mysqli_fetch_array($result) ) {
            ?>
            <div class="checkoutResultsItem">

                <!--The line below should print id-->
                <form method="post" action="nighthawks.php?action=add&id=<?php echo $row["id"]; ?>"> 

                    <!--product styling-->
                    <div class="productContainer">
		    <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">

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
  </div>

   <footer class="row">
     <table class = "ltable" style="width:100%">
         <tr>
           <td><a href="contact.html">Contact Us</a></td>
           <td><a href="TAC.html">Terms and Conditions</a></td>
           <td><a href="story.html">Our Story</a></td>
          </tr>
  
          <tr>
            <td><a href="account.html">Account Management</a></td>
            <td><a href="policy.html">Privacy Policy</a></td>
            <td><a href="locations.html">Locations</a></td>
          </tr>
  
          <tr>
            <td><a href="returns.html">Returns</a></td>
            <td><a href="legal.html">Legal Notices</a></td>
          </tr>
  
        </table>
 </footer>
  
  
  
  
</body>
</html>
  