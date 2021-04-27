
<header class="header shop">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            @php
                                $settings=DB::table('settings')->get();

                            @endphp
                            {{--<li>
                                <i class="ti-headphone-alt"></i>
                                    @foreach($settings as $data) 
                                        {{$data->phone}} 
                                    @endforeach
                            </li>
                            <li>
                                <i class="ti-email"></i> 
                                    @foreach($settings as $data) 
                                        {{$data->email}} 
                                    @endforeach
                            </li>--}}
                        </ul>
                    </div>
                    <!--/ End Top Left -->
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
                        {{--<li><i class="ti-location-pin"></i> <a href="{{route('order.track')}}">Track Order</a></li>--}}
                            {{-- <li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li> --}}
                            @auth
                                @if(Auth::user()->role=='admin')
                                   <li><i class="ti-user"></i> <a href="{{route('admin')}}"  target="_blank">Dashboard</a></li>
                                @else
                                    <li><i class="ti-location-pin"></i> <a href="{{route('order.track')}}">Track Order</a></li>
                                    <li><i class="ti-user"></i> <a href="{{route('user')}}"  target="_blank">Perfil</a></li>
                                @endif
                                <li><i class="ti-power-off"></i> <a href="{{route('user.logout')}}">Cerrar Sesion</a></li>

                            @else
                                <li><i class="ti-power-off"></i><a href="{{route('login.form')}}">Iniciar Sesión /</a> <a href="{{route('register.form')}}">Registrar</a></li>
                            @endauth
                        </ul>
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-12">
                    <!-- Logo -->
                    <div class="logo">
                        @php
                            $settings=DB::table('settings')->get();
                        @endphp
                        <a href="{{route('home')}}"><img src="@foreach($settings as $data) {{$data->logo}} @endforeach" alt="logo"></a>
                    </div>
                    <!--/ End Logo -->
                    <!-- Search Formulario -->
                    {{--<div class="search-top">
                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                        <!-- Search Form -->
                        <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="Search here..." name="search">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                        <!--/ End Search Form -->
                    </div>--}}
                    <!--/ End Search Form -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-9 col-md-9 col-12">
                    
                </div>
                
            </div>
        </div>
    </div>
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-3 col-12">
                        <div class="logo main hide">
                            @php
                                $settings=DB::table('settings')->get();
                            @endphp
                            <a href="{{route('home')}}">
                                <img src="@foreach($settings as $data) {{$data->logo}} @endforeach" alt="logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="menu-area">
                            <div class="menu category">
                                <ul>
                                  <li><a href="#">Inicio</a></li>
                                  <li>
                                    <a href="">Perros</a>
                                    <ul>
                                      <li><a href="#">Alimentos</a>
                                        <ul>
                                          <li><a href="#">Alimentos Secos</a></li>
                                        </ul>
                                      </li>
                                      <li>
                                        
                                      </li>
                                      <li>
                                        
                                      </li>
                                      <li>
                                        <img src="{{ asset('img/perro.png') }}" alt="sample38"/>
                                      </li>
                                    </ul>
                                  </li>
                                  <li>
                                    <a href="">Gatos</a>
                                    <ul>
                                      <li><a href="#">Alimentos</a>
                                        <ul>
                                          <li><a href="#">Alimentos Secos</a></li>
                                        </ul>
                                      </li>
                                    </ul>
                                  </li>
                                  <li>
                                    <a href="">Humano / Mascota</a>
                                    <ul>
                                      <li><a href="#">Alimentos</a>
                                        <ul>
                                          <li><a href="#">Alimentos Secos</a></li>
                                        </ul>
                                      </li>

                                    </ul>
                                  </li>
                                </ul>
                              </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="left-content main hide">
                            <ul class="list-main">
                            {{--<li><i class="ti-location-pin"></i> <a href="{{route('order.track')}}">Track Order</a></li>--}}
                                {{-- <li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li> --}}
                                @auth
                                    @if(Auth::user()->role=='admin')
                                       <!-- <li><i class="ti-user"></i> <a href="{{route('admin')}}"  target="_blank">Dashboard</a></li>-->
                                    @else
                                        <li> 
                                            <a href="{{route('order.track')}}" title="Ordenes">
                                                <i class="ti-location-pin"></i></a>
                                        </li>
                                        <li>
                                             
                                            <a href="{{route('user')}}"  target="_blank" title="Perfil">
                                                <i class="ti-user"></i></a>
                                        </li>
                                        <li>
                                            
                                            <a href="{{route('user.logout')}}" title="Cerrar Sesión">
                                                <i class="ti-power-off"></i> 
                                            </a>
                                        </li>
                                    @endif
                                    
                                    

                                @else
                                    <li>
                                        <i class="ti-power-off"></i>
                                            <a href="{{route('login.form')}}">Iniciar Sesión /</a> 
                                            <a href="{{route('register.form')}}">Registrar</a>
                                        </li>
                                @endauth
                            </ul>
                            
                        </div>
                        <div class="right-content sinlge-bar shopping">
                            <a href="{{route('cart')}}" class="single-icon"><i class="ti-bag"></i> <span class="total-count">{{Helper::cartCount()}}</span></a>
                            <!-- Shopping Item -->
                            @auth
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{count(Helper::getAllProductFromCart())}} Items</span>
                                        <a href="{{route('cart')}}">Ver Carrito</a>
                                    </div>
                                    <ul class="shopping-list">
                                        {{-- {{Helper::getAllProductFromCart()}} --}}
                                            @foreach(Helper::getAllProductFromCart() as $data)
                                                    @php
                                                        $photo=explode(',',$data->product['photo']);
                                                    @endphp
                                                    <li>
                                                        <a href="{{route('cart-delete',$data->id)}}" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                                        <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
                                                        <h4><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h4>
                                                        <p class="quantity">{{$data->quantity}} x - <span class="amount">${{number_format($data->price,2)}}</span></p>
                                                    </li>
                                            @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">${{number_format(Helper::totalCartPrice(),2)}}</span>
                                        </div>
                                        <a href="{{route('checkout')}}" class="btn animate">Comprar</a>
                                    </div>
                                </div>
                            @endauth
                            <!--/ End Shopping Item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>