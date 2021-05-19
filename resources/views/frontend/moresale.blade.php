<div class="product-area most-popular section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <h2>Más Vendidos</h2>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-12"> 
        <div class="owl-carousel popular-slider">
          <!-- Start Single Product -->
          @foreach($moresale[""] as $key => $product)
         
            @php
              $product = Helper::productDetails($product);
            @endphp
            <div class="col-12 single-product">
              <div class="product-img">
                <a href="{{route('product-detail',$product[0]->slug)}}">
                  @php
                      $photo=explode(',',$product[0]->photo);
                      //dd($photo[0]);
                  @endphp
                  <img class="default-img" src="{{$photo[0]}}" alt="#">
                  <img class="hover-img" src="{{$photo[0]}}" alt="#">
                  @if($product[0]->discount > 0)
                    <span class="out-of-stock">Oferta {{$product[0]->discount}}%</span>
                  @endif
                    
                </a>
                <div class="button-head">
                  <div class="product-action">
                    <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Ver</span></a>
                    
                  </div>
                  <div class="product-action-2">
                    <a title="Add to cart" href="#">a Carrito</a>
                  </div>
                </div>
              </div>
              <div class="product-content">
                <h3><a href="{{route('product-detail',$product[0]->slug)}}">{{ $product[0]->title}}</a></h3>
                <div class="product-price">
                  @if($product[0]->discount > 0)
                    <span class="old">${{$product[0]->price}}</span>
                    <span>${{$product[0]->price - (($product[0]->price * $product[0]->discount) / 100)}}</span>
                  @else
                    <span>${{$product[0]->price}}</span>
                  @endif
                </div>
              </div>
            </div>
          @endforeach
          <!-- End Single Product -->
        </div>
      </div>
    </div>
  </div>
</div>