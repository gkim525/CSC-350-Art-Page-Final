

<?php
function pdo_connect_mysql()
{
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'gallery';

    try {
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
        exit('Failed to connect to database.');
    }
}

function template_header($title)
{
    echo <<<EOT
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
EOT;
}



function template_footer()
{
    echo <<<EOT
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
EOT;
}

?>