
@php
  use Illuminate\Support\Facades\Crypt;
@endphp

<header class="header-area sticky-bar">
        <div class="main-header-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo pt-40">
                            <a href="index.html">
                                <h3>Mimi Shop</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 ">
                        <div class="main-menu">
                            <nav>
                                <ul>
                                    <li class="angle-shape">
                                      <a href="{{url('/')}}"> Home </a>
                                    </li>
                                    @if (Auth::check())
                                      @if (Auth::user()->role == "admin")
                                        <li class="angle-shape">
                                          <a href="{{url('/managefeedback')}}"> Manage Feedback </a>
                                        </li>
                                        <li class="angle-shape">
                                          <a href="{{url('/managecategory')}}"> Manage Category </a>
                                        </li>
                                        <li class="angle-shape">
                                          <a href="{{url('/manageuser')}}"> Manage Account </a>
                                        </li>
                                      @elseif (Auth::user()->role == "member")
                                        <li class="angle-shape">
                                          <a href="{{url('/feedback')}}"> Feedback </a>
                                        </li>
                                      @endif
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3">
                        <div class="header-right-wrap pt-40">

                            <div class="cart-wrap">
                                <button class="icon-cart-active">
                                    <span class="icon-cart">
                                        <i class="sli sli-bag"></i>
                                        <span class="count-style">02</span>
                                    </span>
                                </button>
                                <div class="shopping-cart-content">
                                    <div class="shopping-cart-top">
                                        <h4>Shoping Cart</h4>
                                        <a class="cart-close" href="#"><i class="sli sli-close"></i></a>
                                    </div>
                                    <ul>
                                        <li class="single-shopping-cart">
                                            <div class="shopping-cart-img">
                                                <a href="#"><img alt="" src="assets/img/cart/cart-1.svg"></a>
                                                <div class="item-close">
                                                    <a href="#"><i class="sli sli-close"></i></a>
                                                </div>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="#">Product Name </a></h4>
                                                <span>1 x 90.00</span>
                                            </div>
                                        </li>
                                        <li class="single-shopping-cart">
                                            <div class="shopping-cart-img">
                                                <a href="#"><img alt="" src="assets/img/cart/cart-2.svg"></a>
                                                <div class="item-close">
                                                    <a href="#"><i class="sli sli-close"></i></a>
                                                </div>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="#">Product Name</a></h4>
                                                <span>1 x 90.00</span>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="shopping-cart-bottom">
                                        <div class="shopping-cart-total">
                                            <h4>Total : <span class="shop-total">$260.00</span></h4>
                                        </div>
                                        <div class="shopping-cart-btn btn-hover text-center">
                                            <a class="default-btn" href="checkout.html">checkout</a>
                                            <a class="default-btn" href="{{url('cartlist')}}">view cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="setting-wrap">
                                <button class="setting-active">
                                    <i class="sli sli-settings"></i>
                                </button>
                                <div class="setting-content">
                                    <ul>
                                        <li>
                                            <h4>Account</h4>
                                            <ul>
                                              @if (Auth::check() == true)

                                              @else
                                                <li><a href="{{url('login')}}">Login</a></li>
                                                <li><a href="{{url('register')}}">Create Account</a></li>
                                              @endif
                                              @if (Auth::check() == true)
                                                <li><a href="{{url('myaccount')}}/{{encrypt(Auth::user()->id_account)}}">My Account - {{Auth::user()->fullname}}</a></li>
                                              @endif
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main-search start -->
            <div class="main-search-active">
                <div class="sidebar-search-icon">
                    <button class="search-close"><span class="sli sli-close"></span></button>
                </div>
                <div class="sidebar-search-input">
                    <form>
                        <div class="form-search">
                            <input id="search" class="input-text" value="" placeholder="Search Now" type="search">
                            <button>
                                <i class="sli sli-magnifier"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="header-small-mobile">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="mobile-logo">
                            <a href="index.html">
                                <img alt="" src="assets/img/logo/logo.png">
                            </a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="header-right-wrap">
                            <div class="cart-wrap">
                                <button class="icon-cart-active">
                                    <span class="icon-cart">
                                        <i class="sli sli-bag"></i>
                                        <span class="count-style">02</span>
                                    </span>
                                    <span class="cart-price">
                                        $320.00
                                    </span>
                                </button>
                                <div class="shopping-cart-content">
                                    <div class="shopping-cart-top">
                                        <h4>Shoping Cart</h4>
                                        <a class="cart-close" href="#"><i class="sli sli-close"></i></a>
                                    </div>
                                    <ul>
                                        <li class="single-shopping-cart">
                                            <div class="shopping-cart-img">
                                                <a href="#"><img alt="" src="assets/img/cart/cart-1.svg"></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="#">Product Name </a></h4>
                                                <span>1 x 90.00</span>
                                            </div>
                                        </li>
                                        <li class="single-shopping-cart">
                                            <div class="shopping-cart-img">
                                                <a href="#"><img alt="" src="assets/img/cart/cart-2.svg"></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="#">Product Name</a></h4>
                                                <span>1 x 90.00</span>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="shopping-cart-bottom">
                                        <div class="shopping-cart-total">
                                            <h4>Total : <span class="shop-total">$260.00</span></h4>
                                        </div>
                                        <div class="shopping-cart-btn btn-hover text-center">
                                            <a class="default-btn" href="checkout.html">checkout</a>
                                            <a class="default-btn" href="{{url('cartlist')}}">view cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mobile-off-canvas">
                                <a class="mobile-aside-button" href="#"><i class="sli sli-menu"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-off-canvas-active">
        <a class="mobile-aside-close"><i class="sli sli-close"></i></a>
        <div class="header-mobile-aside-wrap">
            <div class="mobile-search">
                <form class="search-form" action="#">
                    <input type="text" placeholder="Search entire store…">
                    <button class="button-search"><i class="sli sli-magnifier"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap">
                <!-- mobile menu start -->
                <div class="mobile-navigation">
                    <!-- mobile menu navigation start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children ">
                              <a href="{{url('/')}}">Home</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- mobile menu navigation end -->
                </div>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-curr-lang-wrap">
                <div class="single-mobile-curr-lang">
                    <a class="mobile-account-active" href="#">Account <i class="sli sli-arrow-down"></i></a>
                    <div class="lang-curr-dropdown account-dropdown-active">
                        <ul>
                          @if (Auth::check() == true)

                          @else
                            <li><a href="{{url('login')}}">Login</a></li>
                            <li><a href="{{url('register')}}">Create Account</a></li>
                          @endif
                          @if (Auth::check() == true)
                            <li><a href="{{url('myaccount')}}/{{encrypt(Auth::user()->id_account)}}">My Account - {{Auth::user()->fullname}}</a></li>
                          @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
