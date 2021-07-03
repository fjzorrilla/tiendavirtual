<div class="owl-carousel owl-theme slider-principal">
  @foreach($banners as $banner)
    <div class="owl-slide d-flex align-items-center cover" style="background-image: url('{{$banner->photo}}');">
      <div class="container">
        <div class="row justify-content-center justify-content-md-start">
          <div class="col-10 col-md-6 static">
            <div class="owl-slide-text">
              <h2 class="owl-slide-title" style="color: #460e0dd1;text-shadow: 15px 6px 17px rgb(0 0 0 / 97%);">{{$banner->title}}</h2>
              <div class="owl-slide-subtitle mb-3">
                {!! $banner->description !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!--/owl-slide-->
  @endforeach
</div>