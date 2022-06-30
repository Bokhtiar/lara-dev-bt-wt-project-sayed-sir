<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="@route('admin.dashboard')">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-banner" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Banner</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-banner" class="nav-content collapse " data-bs-parent="#sidebar-banner">
          <li>
            <a href="@route('admin.banner.index')">
              <i class="bi bi-circle"></i><span>List Of Banner</span>
            </a>
          </li>
          <li>
            <a href="@route('admin.banner.create')">
              <i class="bi bi-circle"></i><span>Create Of Banner</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

        <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-category" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Category</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-category" class="nav-content collapse " data-bs-parent="#sidebar-category">
          <li>
            <a href="@route('admin.category.index')">
              <i class="bi bi-circle"></i><span>List Of Category</span>
            </a>
          </li>
          <li>
            <a href="@route('admin.category.create')">
              <i class="bi bi-circle"></i><span>Create Of Category</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-medicine" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Medicine</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-medicine" class="nav-content collapse " data-bs-parent="#sidebar-medicine">
          <li>
            <a href="@route('admin.medicine.index')">
              <i class="bi bi-circle"></i><span>List Of Medicine</span>
            </a>
          </li>
          <li>
            <a href="@route('admin.medicine.create')">
              <i class="bi bi-circle"></i><span>Create Of Medicine</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-product" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-product" class="nav-content collapse " data-bs-parent="#sidebar-product">
          <li>
            <a href="@route('admin.product.index')">
              <i class="bi bi-circle"></i><span>List Of Product</span>
            </a>
          </li>
          <li>
            <a href="@route('admin.product.create')">
              <i class="bi bi-circle"></i><span>Create Of Product</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="@route('admin.logout')">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Logout</span>
        </a>
      </li><!-- End Login Page Nav -->


    </ul>

  </aside>
