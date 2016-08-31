
<?php   

function confirm($query) {
    // function used to return error if there is a connection issue
    global $connection;
    if(!$query) {
        die("Query Failed, " . mysqli_error($connection));
    }
}

function select_users($user_id){
    
    // takes a user id as a parameter and returns all data from users table
    global $connection;
    $query = "SELECT * FROM users WHERE user_id = '{$user_id}'";
    $access_profile = mysqli_query($connection, $query);
    confirm($access_profile);
    return $access_profile;
}


?>