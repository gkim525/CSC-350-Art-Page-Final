	<?php     
	DEFINE('DB_USER', 'root'); 
	DEFINE('DB_PASSWORD', ""); 
	DEFINE('DB_HOST', 'localhost'); 
	DEFINE('DB_NAME', 'sitename'); 

	$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, "3307") OR die ('Could not connect to MySQL: ' .mysqli_connect_error() ); 

	$result = mysqli_query($dbc, $add); 

	$add = "INSERT INTO users (first_name, last_name, email, pass, registration_date) VALUES ('James', 'Smith', 'jsmith@google.com', SHA1('1234567'), NOW())"; 
	$add2 = "INSERT INTO users (first_name, last_name, email, pass, registration_date) VALUES ('Mary', 'Davis', 'davism@bing.com', SHA1('hello_there'), NOW())";

	mysqli_close($dbc, $add); 
	?> 