<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo"><a href="#" class="simple-text logo-normal">
          My Shop
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item {{ Request::is('admin/managers') ? 'active':'' }}">
            <a class="nav-link" href="{{ url('admin/managers') }}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/categories') }}">
              <h4><b>Category</b></h4>
            </a>
          </li>      
                <ul style="list-style-type: none;">
                  <li class="nav-item {{ Request::is('admin/categories') ? 'active':'' }}">
                    <a class="nav-link" href="{{ url('admin/categories') }}">
                      <i class="material-icons">category</i>
                      <p>Categories</p>
                    </a>
                  </li>
                  <li class="nav-item {{ Request::is('admin/add-category') ? 'active':'' }}">
                    <a class="nav-link" href="{{ url('admin/add-category') }}">
                      <i class="material-icons">add_box</i>
                      <p>Add Category</p>
                    </a>
                  </li>
                </ul>
          <li class="nav-item ">
            <a class="nav-link" href="{{ url('admin/products') }}">
              <h4><b>Product</b></h4>
            </a>
          </li> 
                <ul style="list-style-type: none;">
                  <li class="nav-item {{ Request::is('admin/products') ? 'active':'' }}">
                    <a class="nav-link" href="{{ url('admin/products') }}">
                      <i class="material-icons">shopping_cart</i>
                      <p>Products</p>
                    </a>
                  </li>
                  <li class="nav-item {{ Request::is('admin/add-product') ? 'active':'' }}">
                    <a class="nav-link" href="{{ url('admin/add-product') }}">
                      <i class="material-icons">add_box</i>
                      <p>Add Product</p>
                    </a>
                  </li>
                </ul>
          <li class="nav-item ">
            <a class="nav-link" href="./tables.html">
              <i class="material-icons">bubble_chart</i>
              <p>Orders</p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('admin/users') ? 'active':'' }}">
            <a class="nav-link" href="{{ url('admin/users') }}">
              <i class="material-icons">person</i>
              <p>Users</p>
            </a>
          </li>
          
        </ul>
      </div>
    </div>