<div class="product-area most-popular section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <h2>Más Vendidos</h2>
        </div>
      </div>
    </div>
    @php
        $product_lists=DB::table('products')->where('status','active')->orderBy('id','DESC')->get();
    @endphp
    <div class="row">
      <div class="col-12">
        <div class="owl-carousel popular-slider">
          <!-- Start Single Product -->
          @foreach($product_lists as $key => $product)
            <div class="col-12 single-product">
              <div class="product-img">
                <a href="{{route('product-detail',$product->slug)}}">
                  @php
                      $photo=explode(',',$product->photo);
                      //dd($photo[0]);
                  @endphp
                  <img class="default-img" src="{{$photo[0]}}" alt="#">
                  <img class="hover-img" src="{{$photo[0]}}" alt="#">
                  @if($product->discount > 0)
                    <span class="out-of-stock">Oferta {{$product->discount}}%</span>
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
                <h3><a href="{{route('product-detail',$product->slug)}}">{{ $product->title}}</a></h3>
                <div class="product-price">
                  @if($product->discount > 0)
                    <span class="old">${{$product->price}}</span>
                    <span>${{$product->price - (($product->price * $product->discount) / 100)}}</span>
                  @else
                    <span>${{$product->price}}</span>
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