<?php
session_start();

if (!isset($_SESSION["id"]))
  header("Location: ../admin.html")

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="../style/admin.css" />
</head>
<?php include('header.php') ?>

<br /><br />

<body>
  <div class="statistics">
    <h3 class="head">Statistics</h3>
    <div class="statistics_grid">
      <div class="divider">
        <div class="s_tools">
          <span
            class="material-symbols-outlined outlined"
            style="background-color: rgb(182, 182, 238); color: blue">
            sell
          </span>
          <span class="quantity">320</span>
          <span class="title">Sales</span>
        </div>
        <div class="s_tools">
          <span
            class="material-symbols-outlined outlined"
            style="background-color: rgb(240, 178, 178); color: red">
            inventory_2
          </span>
          <span class="quantity">320</span>
          <span class="title">Products</span>
        </div>
      </div>
      <br />
      <div class="divider">
        <div class="s_tools">
          <span
            class="material-symbols-outlined outlined"
            style="
                background-color: rgb(253, 253, 166);
                color: rgb(179, 179, 17);
              ">
            group
          </span>
          <span class="quantity">320</span>
          <span class="title">Customers</span>
        </div>
        <div class="s_tools">
          <span
            class="material-symbols-outlined outlined"
            style="background-color: rgb(190, 241, 190); color: green">
            order_play
          </span>
          <span class="quantity">320</span>
          <span class="title">Orders</span>
        </div>
      </div>
    </div>
  </div>
  <br />
  <div class="statistics_wrapper">
    <div class="statistics">
      <h3 class="head">Profit</h3>
      <div class="line_chart">
        <canvas id="line"></canvas>
        <h3 style="opacity: 0.5; display: inline">GHC200</h3>
        <span style="color: green; font-size: 0.9rem; float: right">+8%</span>
      </div>
    </div>
    <div class="statistics">
      <h3 class="head">Revenue</h3>
      <div class="dougnut_chart">
        <canvas id="dougnut"></canvas>
        <h3 style="opacity: 0.5; display: inline">GHC200</h3>
        <span style="color: green; font-size: 0.9rem; float: right">+8%</span>
      </div>
    </div>
    <div class="statistics">
      <h3 class="head">Report</h3>
      <div class="bar">
        <canvas id="bar"></canvas>
        <h3 style="opacity: 0.5; display: inline">GHC200</h3>
        <span style="color: green; font-size: 0.9rem; float: right">+8%</span>
      </div>
    </div>
    <div class="statistics">
      <h3 class="head">Popular Products</h3>
      <span
        style="
            position: relative;
            bottom: 1.4rem;
            font-size: 13px;
            opacity: 0.8;
          ">Total 10 orders</span>
      <div class="products">
        <ul class="product_list">
          <li>
            <div class="product_div">
              <img src="../images/perfectx.png" alt="product_image" />
              <div class="pro_info">
                <p class="pro_name">perfectx cream</p>
                <span class="pro_id">item #89045</span>
              </div>
              <span class="price">GHC500.00</span>
            </div>
          </li>
          <li>
            <div class="product_div">
              <img src="../images/perfectx.png" alt="product_image" />
              <div class="pro_info">
                <p class="pro_name">perfectx cream</p>
                <span class="pro_id">item #89045</span>
              </div>
              <span class="price">GHC500.00</span>
            </div>
          </li>
          <li>
            <div class="product_div">
              <img src="../images/perfectx.png" alt="product_image" />
              <div class="pro_info">
                <p class="pro_name">perfectx cream</p>
                <span class="pro_id">item #89045</span>
              </div>
              <span class="price">GHC500.00</span>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div><br><br>
 
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../script/admin.js"></script>
<script src="../script/adminBack.js"></script>

</html>