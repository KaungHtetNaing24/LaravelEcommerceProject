<?php
 use App\Http\Controllers\Frontend\CartController;
 $total = CartController::cartItem();
?>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark shadow">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">My Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/') ? 'active':'' }}" aria-current="page" href=" {{ url('/') }} ">Home</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Category
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            @foreach($categories as $category)
            <li>
              <a class="dropdown-item" href="{{ url('category/'.$category->slug) }}">{{ $category->name }}</a>
            </li>
            @endforeach

          </ul>
          @if(Auth::check())
          <li class="nav-item">
          <a class="nav-link {{ Request::is('cart') ? 'active':'' }}" aria-current="page" href="{{ url('/cart') }}">
           @if($total > 0)
          <i class="fa fa-shopping-cart" aria-hidden="true"></i>
          <div class="badge bg-danger">{{ $total }}</div>
          @else
          Cart<i class="fa fa-shopping-cart" aria-hidden="true"></i>
          @endif
          </a>
            </li>
                  @foreach(Auth::user()->roles as $role)
                    @if($role->name == 'Manager' || $role->name == 'Staff')
                    <li class="nav-item">
                      <a class="nav-link" href="{{ url('/admin/dashboard') }}">Administration</a>
                    </li>
                    @endif
                  @endforeach
            @endif
        </li>
      </ul>
      <form class="d-flex ms-auto searchbar" action="{{ url('search') }}" method="GET">
        <input class="form-control me-2" type="search" name="search" placeholder="Search Products..." aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>
      <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('login') ? 'active':'' }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('register') ? 'active':'' }}" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ Request::is('profile') ? 'active':'' }}" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ url('profile') }}">
                                <i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;My Profile
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="{{ url('my-orders') }}">
                                <i class="fa fa-history" aria-hidden="true"></i></i>&nbsp;&nbsp;My Orders
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;{{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                            
                        </li>
                            
                        @endguest
                    </ul>
    </div>
  </div>
</nav>