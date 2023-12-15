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
$servername = "localhost";
$username = "root";
$dbpassword = ""; // Consider using a more secure method to store this
$dbname = "gallery";

// Create connection
$conn = new mysqli($servername, $username, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if parameters are provided
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = SHA1($_POST['pass']); // Assuming the password comes in plain text

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<h2>Please enter a valid email address</h2>";
        echo '<div class="continueshop2"><p><h3><a href="http://localhost/art_page/signup.html">Click here to try signing up again.</a></h3></p></div>';
    } else {
        // Check if email exists in the database
        $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            // Validate the password using password_verify()
            if ($data['pass'] === $password) {
                // Passwords match, proceed with account deletion
                $deleteQuery = $conn->prepare("DELETE FROM users WHERE email = ?");
                $deleteQuery->bind_param("s", $email);
                if ($deleteQuery->execute()) {
                    echo "<h2>User deleted successfully!</h2>";
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            } else {
                // Passwords do not match
                echo "<h2>Invalid password</h2>";
            }
        } else {
            // Email not found in the database
            echo "<h2>Email not found</h2>";
        }
    }
}

// Close the connection
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

