@extends('frontend.layouts.master')

@section('title','AMOR BONITO || Delivery')

@section('main-content')
@php
	$title = $delivery->title;
	$description1 = $delivery->description1;
	$description2 = $delivery->description2;
	$description3 = $delivery->description3;
@endphp
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="javascript:void(0);">{{$title}}</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
	
	<!-- About Us -->
	<section class="about-us section pt-2">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-12">
						<div class="about-content">
							{!!$description1!!}
			
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<div class="about-content">
							{!!$description2!!}
			
						</div>
					</div>
					<div class="col-12 pt-4">
						{!!$description3!!}
					</div>
				</div>
			</div>
	</section>
	<!-- End About Us -->
	
	
	<!-- Start Shop Services Area -->
	<section class="shop-services section home pb-3 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-rocket"></i>
                        <h4>Envio Gratis</h4>
                        <p>Algunas Zonas</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-lock"></i>
                        <h4>Pago Seguro</h4>
                        <p>100% pago Seguro</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-tag"></i>
                        <h4>Lo Mejor</h4>
                        <p>Los mejores Productos</p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>
	<!-- End Shop Services Area -->
	
	@include('frontend.layouts.newsletter')
@endsection