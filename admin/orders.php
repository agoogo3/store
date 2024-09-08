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
  <title>Orders</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="../style/admin.css" />
</head>
<header>
  <nav class="header-nav">
    <span
      class="material-symbols-outlined"
      style="padding-left: 1rem; font-weight: 300; cursor: pointer"
      onclick="closeSide()">
      menu
    </span>
    <ul style="display: flex; position: relative">
      <li>
        <span
          class="material-symbols-outlined"
          style="
              font-weight: 400;
              position: relative;
              right: 2.5rem;
              top: 50%;
            ">
          notifications
        </span>
      </li>
      <li>
        <span
          class="material-symbols-outlined"
          style="
              font-size: 2.5rem;
              font-weight: 300;
              position: absolute;
              bottom: 50%;
              left: 2rem;
              transform: translateY(75%);
            ">
          person
        </span>
      </li>
    </ul>
  </nav>
</header>
<br /><br />

<body>
  <div class="card cardd" id="card" style="width: 21rem">
    <span
      style="
          position: absolute;
          left: 90%;
          font-size: 1.5rem;
          cursor: pointer;
          font-weight: 300;
        "
      onclick="closeCard()">&cross;</span>
    <div class="card-body">
      <h5 class="card-title">Perfect x cream</h5>
      <ul class="list-group">
        <li class="list-group-item details">
          <span>Order: </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span style="color: blue" class="sec">#234</span>
        </li>
        <li class="list-group-item details">
          <span>Date: </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span class="sec">20th April, 2015</span>
        </li>
        <li class="list-group-item details">
          <span>Customer: </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span class="sec">Junior Agoogo</span>
        </li>
        <li class="list-group-item details">
          <span>Phone: </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span class="sec">0503351984</span>
        </li>

        <li class="list-group-item details">
          <span>Quantity: </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span class="sec"> x 3</span>
        </li>
        <li class="list-group-item details">
          <span>Price: </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span class="sec"> GHC 25.00</span>
        </li>
        <li class="list-group-item details">
          <span>Status: </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <p class="stat sec" style="left: 7.9rem; transform: translateY(125%)">
            Delivered
          </p>
        </li>
        <li class="list-group-item details" style="position: relative">
          <span style="position: relative; bottom: 0.3rem">Action: </span>
          <div
            class="card"
            id="pop"

            style="position: absolute; left: 0%; height: 4rem; width: 160px; bottom: 6rem; box-shadow: 0px 0px 8px rgb(199, 182, 182); display: none;">
            <ul class="list-group" style="cursor: pointer;">
              <li class="list-group-item status">Delivered</li>
              <li class="list-group-item status">Cancel</li>
              <li class="list-group-item status">Delete</li>

            </ul>
          </div>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span
            onclick="viewPop()"
            class="material-symbols-outlined"
            style="
                background-color: rgb(224, 230, 236);
                border-radius: 100%;
                padding: 0.2rem;
                font-weight: 200;
                cursor: pointer;
                user-select: none;
              ">
            more_vert
          </span>
        </li>
      </ul>
    </div>
  </div>

  <div class="statistics">
    <ul class="order_summary">
      <li class="o_summary">
        <div class="summary">
          <h3 class="status_num"></h3>
          <br />
          <span class="text">Pending Orders</span>
          <span
            class="material-symbols-outlined out"
            style="
                background-color: rgb(225, 227, 228);
                float: right;
                margin-bottom: 0.4rem;
              ">
            pending_actions
          </span>
        </div>
      </li>
      <li class="o_summary">
        <div class="summary">
          <h3 class="status_num"></h3>
          <br />
          <span class="text">Completed Orders</span>
          <span
            class="material-symbols-outlined out"
            style="background-color: rgb(225, 227, 228); float: right">
            check_circle
          </span>
        </div>
      </li>
      <li class="o_summary">
        <div class="summary">
          <h3 class="status_num">56</h3>
          <br />
          <span class="text">Cancelled Orders</span>
          <span
            class="material-symbols-outlined out"
            style="background-color: rgb(225, 227, 228); float: right">
            cancel
          </span>
        </div>
      </li>
    </ul>
  </div>
  <br />

  <div class="statistics">
    <input
      type="search"
      id="search_tf"
      placeholder="Search for orders"
      style="
          border-radius: 3px;
          border: 1px solid rgb(158, 146, 146);
          padding: 0.4rem;
          position: relative;
          left: 50%;
          transform: translateX(-50%);
        " />
    <hr style="opacity: 0.4; margin: 1.5rem" />
    <p style="text-align: center">ORDERS</p>
    <ul class="list-group orders" id="order_list">

      <!-- <li class="list-group-item">
          <div class="order">
            <p class="plus">+</p>
            <div class="customer">
              <span>Junior Agoogo</span><br />
              <span class="number">0503351984</span>
            </div>
          </div>
          <p class="stat">Delivered</p>
        </li>
        <li class="list-group-item">
          <div class="order">
            <p class="plus">+</p>
            <div class="customer">
              <span>Junior Agoogo</span><br />
              <span class="number">0503351984</span>
            </div>
          </div>
          <p class="stat">Delivered</p>
        </li>
        <li class="list-group-item">
          <div class="order">
            <p class="plus">+</p>
            <div class="customer">
              <span>Junior Agoogo</span><br />
              <span class="number">0503351984</span>
            </div>
          </div>
          <p class="stat">Delivered</p>
        </li> -->
    </ul>
  </div>
  <br />

  <aside class="side_nav" id="side_nav">
    <div class="side_head" style="margin-top: 1rem">
      <h3 style="display: inline">Label</h3>
      <span
        style="
            float: right;
            position: relative;
            right: 0.5rem;
            cursor: pointer;
            font-size: 1.3em;
          "
        onclick="openSide()">&cross;</span>
    </div>
    <br />
    <ul class="side_list">
      <li><a href="dashboard">Dashboard</a></li>
      <li><a href="orders">Orders</a></li>

      <li><a href="products.html">Products List</a></li>
      <li><a href="add-product">Add Product</a></li>
      <li><a href="customers.html">Customers</a></li>
    </ul>
  </aside>
  <div class="bg" id="bg"></div>
</body>
<script src="../script/adminBack.js"></script>


</html>