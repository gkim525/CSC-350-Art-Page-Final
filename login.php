<!DOCTYPE html>
<html>

<head>
    <title>Art Gallery</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="http://localhost/art_page/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="script.js"></script>
</head>

<body>
    <!-- HEADER (LOGO, SEARCH, LOGIN, CART)-->
    <header>
        <div class="logo">
            <img src="http://localhost/art_page/Images/logo.png" alt="logo" width="250" height="250" />
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
            <button onclick="dropDownButton()" class="dropbtn">
                Categories
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


    <br />
    <br />


    <br />
    <br />

    <?php

session_start();
// Define variables to store user input
$servername = "localhost";
$username = "root";
$dbname = "gallery";

$email = $_POST['email'];
$password = SHA1($_POST['pass']);

//echo $email; This works
//echo $password; works. prints encrypted password.

$con = new mysqli("localhost", "root", "", "gallery");
if($con->connect_error) {
	die("Failed to connect : ".$con->connect_error);
} else {
	$res = $con->prepare("SELECT * from users where email = ?");
	$res->bind_param("s", $email); //email is a string type
	$res->execute();
	$res_result = $res->get_result();

	if($res_result->num_rows != 0) { //if there is at least one row with the submitted email, the user account exists
		$data = $res_result->fetch_assoc();
		if($data['pass'] === $password) {
			$_SESSION['user_email'] = $email;
			echo "<h2>Login Successful</h2>";
			echo '<div class = "buttoncenter"> <p> <button type = "button"></b><a href="http://localhost/art_page/index.html"><b>Click here to continue shopping</b></a></button></p></div>';
		} else {
		echo "<h2>Incorrect password!</h2>";
		echo '<div class = "buttoncenter"> <p> <button type = "button"></b><a href="http://localhost/login.html"><b>Click here to try logging in again</b></a></button></p></div>';
		}
	} else {
		echo "<h2>Invalid email or password</h2>";
		echo '<div class = "buttoncenter"> <p> <button type = "button"></b><a href="http://localhost/login.html"><b>Click here to try logging in again</b></a></button></p></div>';
	}
	}
 session_write_close();
    ?>
    <br />
    <br />

    <footer class="row">
        <table class="ltable" style="width:100%">
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


