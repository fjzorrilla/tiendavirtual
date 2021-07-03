
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
                                <li><i class="ti-power-off"></i><a data-toggle="modal" data-target="#registerModal" title="Iniciar Sesión / Registrar" href="#">Iniciar Sesión / Registrar</a></li>
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
                            <div class="menu home">
                                <ul>
                                  <li><a href="#">Inicio</a></li>
                                  <li>
                                    <a href="">Más Vendidos</a>
                                    <ul>
                                      @if(count($moresale) > 0)
                                      @foreach($moresale[""] as $key => $product)
                                        @php
                                          $product = Helper::productDetails($product);
                                          $photo=explode(',',$product[0]->photo);
                                        @endphp
                                        <li>
                                          <ul>
                                            <li>
                                              <a href="{{route('product-detail',$product[0]->slug)}}">
                                                <img src="{{$photo[0]}}" alt="sample38"/>
                                              </a>
                                            </li>
                                          </ul>
                                        </li>
                                      @endforeach
                                      @endif
                                      
                                    </ul>
                                  </li>
                                  <li>
                                    <a href="">Ofertas</a>
                                    <ul>
                                      @foreach($ofertas as $key => $oferta)
                                        @php
                                          $photo=explode(',',$oferta->photo);
                                        @endphp
                                        <li>
                                          <ul>
                                            <li>
                                              <a href="{{route('product-detail',$oferta->slug)}}">
                                                <img src="{{$photo[0]}}" alt="sample38"/>
                                              </a>
                                            </li>
                                          </ul>
                                        </li>
                                      @endforeach
                                    </ul>
                                  </li>
                                  <li>
                                    <a href="">Humano / Mascota</a>
                                    <ul>
                                      @foreach($humanoMascota as $key => $humano)
                                        @php
                                          $photo=explode(',',$humano->photo);
                                        @endphp
                                        <li>
                                          <ul>
                                            <li>
                                              <a href="{{route('product-detail',$humano->slug)}}">
                                                <img src="{{$photo[0]}}" alt="sample38"/>
                                              </a>
                                            </li>
                                          </ul>
                                        </li>
                                      @endforeach
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
                                            <a data-toggle="modal" data-target="#registerModal" title="Iniciar Sesión / Registrar" href="#">Iniciar Sesión / Registrar</a>
                                        </li>
                                @endauth
                            </ul>
                            
                        </div>
                        <div class="right-content sinlge-bar shopping">
                            <a href="javascript:void(0)" class="single-icon"><i class="ti-bag"></i> <span class="total-count">{{Helper::cartCount()}}</span></a>
                            <!-- Shopping Item -->
                            @auth
                                <div class="shopping-item">
                                    <div class="closeCart">
                                       X     
                                    </div>
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
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header container mt-4" style="display: flow-root;">
                <div class="row justify-content-center">
                    <div class="col-md-1">
                        
                    </div>
                    <div class="col-md-5 text-center">
                        <div class="linkForm linkLogin active">
                            <span>Iniciar Sesion</span>
                        </div>
                    </div>
                    <div class="col-md-5 text-center">
                        <div class="linkForm linkRegister">
                            <span>Registrarse</span>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="container">
                    <!-- Outer Row -->
                    <div class="row justify-content-center">

                      <div class="col-xl-10 col-lg-12 col-md-12 mt-5">
                        <div class="card o-hidden border-0 shadow-lg my-5 formlogin">
                          <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="p-5">
                                  <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Bienvenidos</h1>
                                  </div>
                                  <form class="user row"  method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group col-md-6">
                                      <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..."  required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                      <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Password"  name="password" required autocomplete="current-password">
                                         @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                      Login
                                    </button>
                                  </form>
                                  <hr>
                                   
                                  <div class="text-center">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link small" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card o-hidden border-0 shadow-lg my-5 hide formregister">
                          <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="p-5">
                                  <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Registrarme</h1>
                                  </div>
                                  <form method="POST" action="{{ route('register.submit') }}">
                                        @csrf 

                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Register') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>

                  </div>
            </div>
        </div>
    </div>
</div>