
<?php   

function confirm($query) {
    // function used to return error if there is a connection issue
    global $connection;
    if(!$query) {
        die("Query Failed, " . mysqli_error($connection));
    }
}

function select_users($user_name){
    
    // takes a username as a parameter and returns all data from users table
    global $connection;
    $query = "SELECT * FROM users WHERE user_name = '{$user_name}'";
    $access_profile = mysqli_query($connection, $query);
    confirm($access_profile);
    return $access_profile;
}


?>