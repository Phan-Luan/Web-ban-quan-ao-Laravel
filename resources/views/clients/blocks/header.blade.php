<div class="container-menu-desktop">
  <!-- Topbar -->
  <div class="top-bar">
    <div class="content-topbar flex-sb-m h-full container">
        <div class="left-top-bar">
           
        </div>
        <div class="right-top-bar flex-w h-full">
          @if (auth()->check())
            <a href="{{route('client.profile',auth()->user()->id)}}" class="flex-c-m trans-04 p-lr-25">
                My Account
            </a>
            @endif
            <div class="flex-c-m  ">
                @if (auth()->check())
               
                    <a class="nav-item nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                    <a href="{{route('register')}}" class="nav-item nav-link">Register</a>
                @endif
            </div>

        </div>
    </div>
</div>


  <div class="wrap-menu-desktop">
    <nav class="limiter-menu-desktop container">
      
      <!-- Logo desktop -->		
      <a href="#" class="logo">
        <img src="{{asset('assets/clients/images/icons/logo-01.png')}}" alt="IMG-LOGO">
      </a>

      <!-- Menu desktop -->
      <div class="menu-desktop">
        <ul class="main-menu">
          <li class="active-menu">
            <a href="{{route('home')}}">Home</a>
          </li>

          <li>
            <a href="{{route('product')}}">Shop</a>
          </li>

          <li class="label1" data-label1="hot">
            <a href="shoping-cart.html">Features</a>
          </li>

          <li>
            <a href="blog.html">Blog</a>
          </li>

          <li>
            <a href="about.html">About</a>
          </li>

          <li>
            <a href="contact.html">Contact</a>
          </li>
        </ul>
      </div>	

      <!-- Icon header -->
      <div class="wrap-icon-header flex-w flex-r-m">
        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
          <i class="zmdi zmdi-search"></i>
        </div>
          <a href="{{ route('client.carts.index') }}" 
          class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
          data-notify="{{ $countProductInCart }}">
          <i class="zmdi zmdi-shopping-cart"></i>
          </a>

        <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
          <i class="zmdi zmdi-favorite-outline"></i>
        </a>
        
      </div>
    </nav>
  </div>	
</div>