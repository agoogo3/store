<?php
session_start();
include "db.php";





//Login proceess for the admin
if (isset($_POST["number"]) && isset($_POST["password"])) {
    $num = filter_var($_POST["number"], FILTER_SANITIZE_NUMBER_INT);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_SPECIAL_CHARS);

    $sql = "SELECT * FROM users WHERE contact = ? AND password =  ?";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt == false) {
        echo "Error: " . mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $num, $password);
        mysqli_stmt_execute($stmt);
        $data = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($data) > 0) {
            $message = array("success" => "login successful");
            while ($row = mysqli_fetch_assoc($data)) {
                $_SESSION["name"] = $row["fullname"];
                $_SESSION["id"] = $row["user_id"];
            }

            echo json_encode($message);
        } else {
            $message = array("failed" => "Invalid credentials");
            echo json_encode($message);
        }
    }




    exit;
}



//Fetching data on load
if (isset($_POST["data"])) {
    $sql = "SELECT orders.order_id,orders.customer_name,orders.c_contact,products.name,orders.price,orders.quantity,orders.address,orders.status, orders.order_date FROM `orders` INNER JOIN products ON products.id = orders.product_id ORDER BY order_date DESC";

    $status = "SELECT COUNT(CASE WHEN status = 'pending' then 1 end)AS pending_count,COUNT(CASE WHEN status = 'delivered' THEN 1 end) as delivered_count, COUNT(CASE WHEN status = 'cancelled' THEN 1 end) as cancelled_count FROM orders";


    $query = mysqli_query($conn, $sql);
    $stat_query = mysqli_query($conn, $status);
    $data = array();
    $status_array = array();

    if (!$query) {
        echo json_encode(array("error" => "Error: " . mysqli_error($conn)));
    } else {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
        // echo json_encode($data); 
    }

    if (!$stat_query) {
        echo json_encode(array("error" => "Error: " . mysqli_error($conn)));
    } else {
        $row = mysqli_fetch_assoc($stat_query);


        echo json_encode(["data" => $data, "status" => $row]);
    }
}


//Updating products based on the update selected
if (isset($_POST["index"]) && isset($_POST["id"])) {
    $index = filter_var($_POST['index'], FILTER_SANITIZE_NUMBER_INT);

    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    echo $id;

    if ($index == 0) {
        $sql = "UPDATE orders SET status = 'delivered' WHERE order_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt == false) {
            echo "Error: " . mysqli_error($conn);
        } else {
            mysqli_stmt_bind_param($stmt, "i", $id);
            if (mysqli_stmt_execute($stmt)) {
                echo "Update successful";
            }
        }
    } else if ($index == 1) {
        $sql = "UPDATE orders SET status = 'cancelled' WHERE order_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt == false) {
            echo "Error: " . mysqli_error($conn);
        } else {
            mysqli_stmt_bind_param($stmt, "i", $id);
            if (mysqli_stmt_execute($stmt)) {
                echo "Update successful";
            }
        }
    } else {
        $sql = "DELETE from orders WHERE order_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt == false) {
            echo "Error: " . mysqli_error($conn);
        } else {
            mysqli_stmt_bind_param($stmt, "i", $id);
            if (mysqli_stmt_execute($stmt)) {
                echo "Update successful";
            }
        }
    }
}


//File management
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_FILES["images"])) {
    $name = filter_var($_POST["name"], FILTER_SANITIZE_SPECIAL_CHARS);
    $price_one = filter_var($_POST['price_one'], FILTER_SANITIZE_NUMBER_INT);
    $price_two = filter_var($_POST['price_two'], FILTER_SANITIZE_NUMBER_INT);
    $price_three = filter_var($_POST['price_three'], FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT);
    $primary_desc = filter_var($_POST['primaryDesc'], FILTER_SANITIZE_SPECIAL_CHARS);
    $secondary_desc = filter_var($_POST['secondaryDesc'], FILTER_SANITIZE_SPECIAL_CHARS);
    $ingredients = filter_var($_POST['ingredient'], FILTER_SANITIZE_SPECIAL_CHARS);
    $usage = filter_var($_POST['usage'], FILTER_SANITIZE_SPECIAL_CHARS);

    $advance = 1;
    $id;


    $sql = "INSERT INTO products(name,price_one,price_two,price_three,sec_description,main_description,usages,ingredients) VALUES(?,?,?,?,?,?,?,?)";

    $stmt = $conn->prepare($sql);

    if ($stmt == false) {
        $advance = 0;
        echo "Error: " . $conn->error;
    } else {
        $stmt->bind_param("siiissss", $name, $price_one, $price_two, $price_three, $secondary_desc, $primary_desc, $usage, $ingredients);

        if ($stmt->execute()) {
            $advance = 1;
            $id = $conn->insert_id;

            echo "Input successful";
        } else {
            $advance = 0;
            echo "Error: " . $conn->error;
        }
    }

    if($advance == 1){
        $count = count($_FILES['images']['name']);
        $dir = "../images/";
        $suc = 1;

        for ($i = 0; $i < $count; $i++) {
            $path = $dir . $_FILES['images']['name'][$i];
            $sub = substr($path,3);
            $tmp_name = $_FILES['images']['tmp_name'][$i];
            $check = getimagesize($tmp_name);
            if ($check == false) {
                $suc = 0;

                echo "Not an image";
            } else {
                if (!move_uploaded_file($tmp_name, $path)) {
                    echo json_encode("Move failed");
                    $suc = 0;
                } else {
                    $query = "INSERT INTO product_image(product_id,image_path) VALUES(?,?)";
                    $istmt = $conn->prepare($query);
                    if ($istmt == false) {
                        echo "Image upload error: " . $conn->error;
                    }

                    $istmt->bind_param("is", $id, $sub);
                    if ($istmt->execute()) {
                        echo "File uploaded successfully";
                    }




                    // echo json_encode("Move successful");
                }
            }
        }

    }




    exit;
}
