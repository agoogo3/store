<?php
session_start();

if (!isset($_SESSION["id"]))
    header("Location: ../admin.html")

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=SUSE:wght@100..800&display=swap" rel="stylesheet">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
    <link>
    <link rel="stylesheet" href="../style/style.css">
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../style/admin.css" />

    <link rel="stylesheet" href="../style/add_product.css">
    <title>Add Product</title>
    <style>
        .head_list {
            position: relative;
            top: 10px;
        }
    </style>

</head>
<?php include('header.php') ?>

<body>
    <h2 class="head">Add a new Product</h1>
        <span class="head" style="opacity:.7; position:relative; bottom:27px; font-size:10">Add new products to your store</span>

        <div class="card_wrapper">
            <div class="card card_one">
                <div class="card-body">
                    <h4>Product information</h4>
                    <form id="form" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" >

                        </div>
                        <div class="mb-3">
                            <label for="price_one" class="form-label">First price</label>
                            <input type="text" inputmode="numeric"
                                pattern="^[0-9]+$"
                                title=" Only numbers required"
                                name="price_one"
                                class="form-control" id="price_one">

                        </div>
                        <div class="mb-3">
                            <label for="price_two" class="form-label">Second price</label>
                            <input type="text" inputmode="numeric"
                                pattern="^[0-9]+$"
                                name="price_two"
                                title="Only numbers required"
                                
                                class="form-control" id="price_two">

                        </div>
                        <div class="mb-3">
                            <label for="price_three" class="form-label">Third price</label>
                            <input type="text" inputmode="numeric"
                                pattern="^[0-9]+$"
                                name="price_three"
                                title="Only numbers required"
                                class="form-control" id="price_two">

                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="text" inputmode="numeric"
                                pattern="^[0-9]+$"
                                name="quantity"
                                title="Only numbers required"
                                class="form-control" id="price_two">

                        </div>
                        <div class="form-floating">
                            <textarea class="form-control"  placeholder="Primary Description"
                                name="primaryDesc" id="primaryDesc"></textarea>
                            <label for="primaryDesc">Primary Description</label>
                        </div><br>
                        <div class="form-floating">
                            <textarea class="form-control"
                                name="secondaryDesc" placeholder="Secondary Description" id="secondaryDesc"></textarea>
                            <label for="secondaryDesc">Secondary Description</label>
                        </div>
                        <br>
                        <div class=" card image_wrapper" id="image_wrapper">
                            <div class="card image_input_wrapper">
                                <label for="image_input" class="image_input">
                                    <br>
                                    <span class="material-symbols-outlined upload">
                                        upload
                                    </span>
                                    <h3>Upload your images here</h3>
                                    <input type="file" accept="image/*"  multiple id="image_input" required>
                                </label>
                            </div>

                            <!-- <div class="images_wrap">
                                <span class="close">&cross;</span>
                                <img src="../images//perfectx.png" class="img-thumbnail" alt="...">
                            </div>
                            <div class="images_wrap">
                                <span class="close">&cross;</span>
                                <img src="../images//perfectx.png" class="img-thumbnail" alt="...">
                            </div>
                            <div class="images_wrap">
                                <span class="close">&cross;</span>
                                <img src="../images//perfectx.png" class="img-thumbnail" alt="...">
                            </div> -->

                        </div>
                        <br>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Ingredients" id="ingredient" name="ingredient"></textarea>
                            <label for="ingredient">Ingredients</label>
                        </div>
                        <br>
                        <div class="form-floating">
                            <textarea class="form-control" required placeholder="Usage" name="usage" id="usage"></textarea>
                            <label for="fusage">How to use</label>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary" id="submit" style="width: 100%;">Submit</button>
                    </form>
                </div>
            </div>

        </div>



</body>

<script src="../script/adminBack.js"></script>
<script src="../script/addProduct.js"></script>

</html>