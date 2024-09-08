<header>
    <nav class="header-nav">
        <span
            class="material-symbols-outlined"
            style="padding-left: 1rem; font-weight: 300; cursor: pointer"
            onclick="closeSide()">
            menu
        </span>
        <ul class="head_list" style="display: flex; position: relative">
            <li>
                <span
                    class="material-symbols-outlined"
                    style="font-weight: 400; position: relative; right: 2.5rem">
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
              transform: translateY(50%);
            ">
                    person
                </span>
            </li>
        </ul>
    </nav>

</header>
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
    </div> <br>
    <ul class="side_list">
        <li><a href="dashboard">Dashboard</a></li>
        <li><a href="orders">Orders</a></li>

        <li><a href="products.html">Products List</a></li>
        <li><a href="add-product">Add Product</a></li>
        <li><a href="customers.html">Customers</a></li>
    </ul>
</aside>