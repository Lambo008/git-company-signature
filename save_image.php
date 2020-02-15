<?php
    $DATABASE_HOST = 'localhost:3307';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'companysignature';
    // Try and connect using the info above.
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if ( mysqli_connect_errno() ) {
        // If there is an error with the connection, stop the script and display the error.
        die ('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    if( isset($_POST['imageData']) ){
        $logo = $_POST['imageData']['logo'];
        $iso = $_POST['imageData']['iso'];
        $service = $_POST['imageData']['service'];
        $sql = "INSERT INTO default_image (logo, iso, service_image, state) VALUES ('".$logo."','".$iso."','".$service."', 1 )";
        if(mysqli_query($con, $sql)){
            echo Json_encode("images inserted successfully.");
        } else{
            echo Json_encode(mysqli_error($con));
        }
    }else{
        echo Json_encode("error");
    }
    mysqli_close($con);
?>