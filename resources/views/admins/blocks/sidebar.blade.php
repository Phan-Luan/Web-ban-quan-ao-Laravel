<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Karma Shop</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse0"
        aria-expanded="true" aria-controls="collapse0">
        <i class="fas fa-fw fa-user"></i>
        <span>Member</span>
    </a>
    <div id="collapse0" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Action:</h6>
            <a class="collapse-item" href="buttons.html"><i class="fas fa-fw fa-plus"></i> New Member</a>
            <a class="collapse-item" href="cards.html"><i class="fas fa-fw fa-list"></i> List Members</a>
        </div>
    </div>
</li>
<hr class="sidebar-divider d-none d-md-block">
  <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1"
          aria-expanded="true" aria-controls="collapse1">
          <i class="fas fa-fw fa-cog"></i>
          <span>Category</span>
      </a>
      <div id="collapse1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Action:</h6>
              <a class="collapse-item" href="{{route('categories.create')}}"><i class="fas fa-fw fa-plus"></i> New Category</a>
              <a class="collapse-item" href="{{route('categories.index')}}"><i class="fas fa-fw fa-list"></i> List Categories</a>
          </div>
      </div>
  </li>
  <hr class="sidebar-divider d-none d-md-block">
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2"
        aria-expanded="true" aria-controls="collapse2">
        <i class="fas fa-fw fa-cog"></i>
        <span>Product</span>
    </a>
    <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Action:</h6>
            <a class="collapse-item" href="{{route('products.create')}}"><i class="fas fa-fw fa-plus"></i> New Product</a>
            <a class="collapse-item" href="{{route('products.index')}}"><i class="fas fa-fw fa-list"></i> List Products</a>
        </div>
    </div>
</li>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3"
        aria-expanded="true" aria-controls="collapse3">
        <i class="fas fa-fw fa-wallet"></i>
        <span>Bills</span>
    </a>
    {{-- <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Action:</h6>
            <a class="collapse-item" href="buttons.html"><i class="fas fa-fw fa-plus"></i> New Bill</a>
            <a class="collapse-item" href="cards.html"><i class="fas fa-fw fa-list"></i> List Bills</a>
        </div>
    </div> --}}
</li>
<hr class="sidebar-divider d-none d-md-block">
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse5"
      aria-expanded="true" aria-controls="collapse5">
      <i class="fas fa-fw fa-percent"></i>
      <span>Discount</span>
  </a>
  <div id="collapse5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Action:</h6>
          <a class="collapse-item" href="buttons.html"><i class="fas fa-fw fa-plus"></i> New Couple</a>
          <a class="collapse-item" href="cards.html"><i class="fas fa-fw fa-list"></i> List Couple</a>
      </div>
  </div>
</li>
<hr class="sidebar-divider d-none d-md-block">
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4"
      aria-expanded="true" aria-controls="collapse4">
      <i class="fas fa-fw fa-comment"></i>
      <span>Comment</span>
  </a>
  {{-- <div id="collapse4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Action:</h6>
          <a class="collapse-item" href="buttons.html"><i class="fas fa-fw fa-plus"></i> New Product</a>
          <a class="collapse-item" href="cards.html"><i class="fas fa-fw fa-list"></i> List Products</a>
      </div>
  </div> --}}
</li>
</ul>