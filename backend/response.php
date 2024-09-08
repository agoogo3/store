<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include "db.php";


if (isset($_POST["name"]) && isset($_POST["number"]) && isset($_POST["address"]) && isset($_POST["price_rate"])) {
    $name = filter_var($_POST["name"], FILTER_SANITIZE_SPECIAL_CHARS);
    $number = filter_var($_POST["number"],FILTER_SANITIZE_NUMBER_INT);
    $address = filter_var($_POST["address"],FILTER_SANITIZE_SPECIAL_CHARS);
    $price_rate = filter_var($_POST["price_rate"],FILTER_SANITIZE_NUMBER_INT);

    $id =  $_POST["id"];

    $fetch = "SELECT name, price_one,price_two,price_three FROM products WHERE id = ?";    

    $stmt = mysqli_prepare($conn,$fetch);
    $p_name;
    $price;
    $order_id;
    if($stmt ==  false){
        echo "Error: " . mysqli_error($conn);

    }else{
        mysqli_stmt_bind_param($stmt,"i",$id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result) > 0){
            while($row =  mysqli_fetch_assoc($result)){
               $p_name =  $row["name"];
               if($price_rate == 1){
                $price = $row["price_one"];
               }else if($price_rate == 2){
                $price = $row["price_two"];
               }else{
                $price = $row["price_three"];
               }
            }
            $input = "INSERT INTO orders(customer_name,c_contact,product_id,quantity,price,address) VALUES(?,?,?,?,?,?)";

            $prepare = mysqli_prepare($conn, $input);
            if($prepare == false){
                echo "Error: ". mysqli_error($conn);
            }else{
                mysqli_stmt_bind_param($prepare,"ssiiis",$name,$number,$id,$price_rate,$price,$address);
                $res = mysqli_stmt_execute($prepare);
                if(!$res){
                    echo "Insert error: " . mysqli_error($conn);
                }else{
                    $order_id = mysqli_insert_id($conn);

                }
            }
            echo json_encode(array("id" => $order_id,"productName" => $p_name,"price" => $price,"quantity" => $price_rate, "location" => $address ));
        
        }


        
    }

    // if(filter_var($_POST["name"],FILTER_SANITIZE_SPECIAL_CHARS)){
    //     echo "Name validated";
    //     echo filter_var($_POST["name"], FILTER_SANITIZE_SPECIAL_CHARS);
    // }else{
    //     echo "Invalid name";

    // }
    exit;
}






if(isset($_POST["data"])){

    $data = array();

    // SQL query to get products with their associated images
    $sql = "SELECT products.id, products.name, products.sec_description, product_image.image_path FROM products LEFT JOIN product_image ON products.id = product_image.product_id";

    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        // Group products by ID
        $products = array();

        while ($row = mysqli_fetch_assoc($query)) {
            $product_id = $row['id'];

            // If this product hasn't been added yet, add it
            if (!isset($products[$product_id])) {
                $products[$product_id] = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'sec_description' => $row['sec_description'],
                    'images' => array()
                );
            }

            // Add the image path if it's available
            if ($row['image_path']) {
                $products[$product_id]['images'][] = $row['image_path'];
            }
        }

        // Re-index the products array for easier handling
        $data = array_values($products);
    } else {
        echo json_encode("No data returned");
        exit;
    }

    // Output the final JSON data
    echo json_encode($data);

    exit;
   
}



if(isset($_POST["id"])){
    $id = $_POST["id"];

    $sql = "SELECT * FROM products WHERE id = ?";
        
    $product = array();
    $images = array();
    $stmt = mysqli_prepare($conn,$sql);

    if($stmt == false){
        echo "Error: " . mysqli_error($conn);
    }else{

        mysqli_stmt_bind_param($stmt,"i",$id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)) {
                $product[] = $row;
            }
        }else{
            $error = array("error" => "Product not found");
        }
        



        mysqli_stmt_close($stmt);
    }
    $sql = "SELECT image_path FROM product_image WHERE product_id = ?";

    $data = array();
    $images = array();
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt == false) {
        echo "Error: " . mysqli_error($conn);
    } else {

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_all($result)) {
            $images[] = $row;
        }



        mysqli_stmt_close($stmt);
    }
    $product = array("data"=> $product, "image" => $images);



    echo json_encode($product);


}





mysqli_close($conn)



?>