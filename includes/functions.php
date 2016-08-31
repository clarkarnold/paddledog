
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

function view_all_paddles($user_id){
    global $connection;
      $query = "SELECT * FROM paddles WHERE paddle_user = {$user_id}";
      $get_all_paddles = mysqli_query($connection,$query);
      confirm($get_all_paddles);

    if(mysqli_num_rows($get_all_paddles)>0){
        while($row = mysqli_fetch_assoc($get_all_paddles)){
            $paddle_id       = $row['paddle_id'];
            $paddle_date     = date("m-d-Y", strtotime($row['paddle_date']));
            $paddle_location = $row['paddle_location'];
            $paddle_distance = $row['paddle_distance'];
            $paddle_duration = $row['paddle_duration'];
            $paddle_image    = $row['paddle_image'];

            if(empty($paddle_image)){
                $paddle_image = "user_default.jpg";
            }


        echo "<tr >";
        echo "<td><a href='view_paddle.php?p_id={$paddle_id}' rel='tooltip' title='View Paddle'><img src='images/$paddle_image'' alt='' class='img-rounded img-raised' height='50px'></a></td>";
        echo "<td>$paddle_date</td>";
        echo "<td>$paddle_location</td>";
        echo "<td>$paddle_distance mi</td>";
        echo "<td>$paddle_duration min</td>";
        echo  "<td class='text-right'>
                <a rel='tooptip' title='Edit Paddle' href='edit_paddle.php?p_id={$paddle_id}' class='btn btn-info btn-simple btn-xs'>
                     <i class='fa fa-edit'></i>
                 </a>
                <a rel='tooltip' title='Delete Paddle' href='profile.php?delete={$paddle_id}' class='btn btn-danger btn-simple btn-xs'><i class='fa fa-times'></i></a>
            </td>";
        echo "</tr>";
         } // end while
    } else {
        echo "<tr><td>Nothing here?<a href='add_paddle.php?u_id=$user_id' class='btn btn-primary btn-large text-center'>Add a Paddle!</a></td></tr>";
    } // end else
}


?>