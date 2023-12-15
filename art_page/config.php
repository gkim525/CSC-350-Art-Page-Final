
    <?php
        // Needs to be run to create a connection to the database

    
        $con = new mysqli("localhost", "root", "", "gallery"); 

        if ($con->connect_error) {
            die("Failed to connect: ".$con->connect_error); 
        } else {

        }

    ?> 