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
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Check if parameters are provided
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $oldpass = sha1($_POST['oldpass']);
    $newpass = sha1($_POST['newpass']);
    
    // Validate form data 
    if (empty($email) || empty($oldpass) || empty($newpass)) {
        echo "<h2>All fields are required</h2>";
        echo '<div class="passupdate"><p><h3><a href="http://localhost/art_page/passupdate.html">Click here to try again.</a></h3></p></div>';
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	echo "<h2>Please enter a valid email address</h2>";
	echo '<div class = "continueshop2"><p><h3><a href = "http://localhost/art_page/passupdate.html">Click here to try again.</a></h3></p></div>"';
    } 
  elseif($oldpass == $newpass)
     {
	echo "<h2>The new password you entered is identical to your new password</h2>";
  echo '<div class = "continueshop2"><p><h3><a href = "http://localhost/art_page/passupdate.html">Click here to try again.</a></h3></p></div>"';
     } 
    else {

	//Validate old pass
	$valid = $conn->query("SELECT * FROM users WHERE email ='$email' AND pass= '$oldpass'");
	

        // sql to update a record
        if($valid->num_rows > 0){
		$sql = "UPDATE users SET pass='$newpass' WHERE email = '$email' AND pass='$oldpass'";

        	if ($conn->query($sql) === TRUE) {
            		echo "<h2>Password updated successfully!</h2>";
         	} else {
            		echo "Error updating record: " . $conn->error;
                } 
	} 
  else {
		echo "<h2>Invalid password entered</h2>";
	}
     }  
 }

$conn->close();
?>
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