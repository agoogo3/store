<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "miniStore";

//Creating connection
$conn = new mysqli($servername,$username,$password, $dbname);

// if(!$conn){
//     die("connection failed");
// }else{
//     echo "Connection successfully";
// }


// $query = "SELECT * FROM users WHERE user_id = ?";

// $stmt = mysqli_prepare($conn, $query);

// if($stmt == false){
//     echo "Error Preparing " . mysqli_error($conn);
// }
// $user_id = 1;
// mysqli_stmt_bind_param($stmt,"i",$user_id);

// mysqli_stmt_execute($stmt);

// $result = mysqli_stmt_get_result($stmt);

// if(mysqli_num_rows($result) > 0){
//     while($row = mysqli_fetch_assoc($result)){
//         echo "Name: " . $row["fullname"];
//     }
// }else{
//     echo "No result found";
// }

// mysqli_stmt_close($stmt);






// mysqli_close($conn)

?>