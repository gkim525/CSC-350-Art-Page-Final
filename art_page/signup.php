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
      <span><a style="text-decoration:none" href="http://localhost/art_page/index.html"><b>John's Art Store</b></a></span>
    </div>
    <div class="myaccount">
      <a href="http://localhost/login.html"><i class="fa fa-user-circle-o"></i> My Account </a>
    </div>
    <div class="cart">
      <a href="checkout.html"><i class="fa fa-cart-arrow-down"></i> Cart </a>
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
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Trim whitespace from the password
    //$password = trim($password);

  
    // Validate form data (You can add more validation as needed)
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password))
     {
        echo "<h2>All fields are required</h2>";
        echo '<div class="continueshop2"><p><h3><a href="http://localhost/art_page/signup.html">Click here to try signing up again.</a></h3></p></div>';
     } 
     elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
     {
              echo "<h2>Please enter a valid email address</h2>";
              echo '<div class = "continueshop"><p><h3><a href = "http://localhost/art_page/signup.html">Click here to try again.</a></h3></p></div>"';
     } 
     else {
     
        // Connect to your database 
        $servername = "localhost";
        $username = "root";
        $dbpassword = "";
        $dbname = "gallery";

        // Create a connection
        $conn = new mysqli($servername, $username, $dbpassword, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Hash the password
        $hashedPassword = sha1($password);


        // Insert user data into the database
        $sql = "INSERT INTO users (first_name, last_name, email, pass, registration_date) VALUES ('$firstname', '$lastname', '$email', '$hashedPassword', NOW())";

       
        if ($conn->query($sql) === TRUE)
        {
            echo "<h2>Signup successful!</h2>";
            echo '<div class="continueshop"><p><h3><a href="http://localhost/art_page/index.html">Click here to continue shopping</a></h3></p></div>';
        } 
        else
         {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
      
        // Close the database connection
        $conn->close();
    }
}
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


