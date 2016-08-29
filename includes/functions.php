
<?php   

function confirm($query) {
    // function used to return error if there is a connection issue
    global $connection;
    if(!$query) {
        die("Query Failed, " . mysqli_error($connection));
    }
}



?>