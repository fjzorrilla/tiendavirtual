@extends('frontend.layouts.master')

@section('title','PUPPIES HUND || PÁGINA DE SUSCRIPCIONES')

@section('main-content')
	
		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="javascript:void(0);">{{$suscription->title}}</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
		<form action="{{route('shop.filter')}}" method="POST">
		@csrf
			<!-- Product Style 1 -->
			<section class="product-area shop-sidebar shop-list shop section">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-12 text-center ">
							<div class="box-suscription-intern box-suscription">
								<div class="title">
									Regular
								</div>
								<div class="price">
									S/{{$suscription->regular}}
								</div>

								@if(count($products))
									<div class="box-products">
										@foreach($products as $product)
											@if($product->condition == 'regular')
												<div class="row">
				                                    <div class="col-md-3">
				                                    	@php 
			                                                $photo=explode(',',$product->photo);
			                                            @endphp
			                                            <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
				                                    </div>
			                                        <div class="col-md-9 title-prod">
			                                        	<a href="{{route('product-detail',$product->slug)}}"> 
				                                            {{$product->title}}
				                                        </a>
			                                        </div>
				                                    
				                                </div>
											@endif
										@endforeach
									</div>
								@endif
								<div class="col-md-12 justify-content-center d-flex">
		                            <button class="btn">Adquirir Suscripcion</button>
		                        </div>
							</div>
							
						</div>
						<div class="col-lg-4 col-md-4 col-12 text-center ">
							<div class="box-suscription-intern box-suscription">
								<div class="title">
									Premium
								</div>
								<div class="price">
									S/{{$suscription->premium}}
								</div>

								@if(count($products))
									<div class="box-products">
										@foreach($products as $product)
										 
											@if($product->condition == 'premium')
												<div class="row">
				                                    <div class="col-md-3">
				                                    	@php 
			                                                $photo=explode(',',$product->photo);
			                                            @endphp
			                                            <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
				                                    </div>
			                                        <div class="col-md-9 title-prod">
			                                            <a href="{{route('product-detail',$product->slug)}}"> 
				                                            {{$product->title}}
				                                        </a>
			                                        </div>
				                                    
				                                </div>
											@endif
											<!-- End Single List -->
										@endforeach
									</div>
								@endif
								<div class="col-md-12 justify-content-center d-flex">
		                            <button class="btn">Adquirir Suscripcion</button>
		                        </div>
		                    </div>
						</div>
						<div class="col-lg-4 col-md-4 col-12 text-center">
							<div class="box-suscription-intern box-suscription">
								<div class="title">
									Super Premium
								</div>
								<div class="price">
									S/{{$suscription->superpremium}}
								</div>

								@if(count($products))
									<div class="box-products">
										@foreach($products as $product)
										 	@if($product->condition == 'superpremium')
											<div class="row">
			                                    <div class="col-md-3">
			                                    	@php 
		                                                $photo=explode(',',$product->photo);
		                                            @endphp
		                                            <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
			                                    </div>
		                                        <div class="col-md-9 title-prod">
	                                            	<a href="{{route('product-detail',$product->slug)}}"> 
			                                            {{$product->title}}
			                                        </a>
		                                        </div>
			                                    
			                                </div>
											@endif
										@endforeach
									</div>
								@endif
								<div class="col-md-12 justify-content-center d-flex">
		                            <button class="btn">Adquirir Suscripcion</button>
		                        </div>
		                    </div>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Product Style 1  -->	
		</form>
		<!-- Modal -->
		@if($products)
			@foreach($products as $key=>$product)
				<div class="modal fade" id="{{$product->id}}" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
								</div>
								<div class="modal-body">
									<div class="row no-gutters">
										<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
											<!-- Product Slider -->
												<div class="product-gallery">
													<div class="quickview-slider-active">
														@php 
															$photo=explode(',',$product->photo);
														// dd($photo);
														@endphp
														@foreach($photo as $data)
															<div class="single-slider">
																<img src="{{$data}}" alt="{{$data}}">
															</div>
														@endforeach
													</div>
												</div>
											<!-- End Product slider -->
										</div>
										<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
											<div class="quickview-content">
												<h2>{{$product->title}}</h2>
												<div class="quickview-ratting-review">
													<div class="quickview-ratting-wrap">
														<div class="quickview-ratting">
															{{-- <i class="yellow fa fa-star"></i>
															<i class="yellow fa fa-star"></i>
															<i class="yellow fa fa-star"></i>
															<i class="yellow fa fa-star"></i>
															<i class="fa fa-star"></i> --}}
															@php
																$rate=DB::table('product_reviews')->where('product_id',$product->id)->avg('rate');
																$rate_count=DB::table('product_reviews')->where('product_id',$product->id)->count();
															@endphp
															@for($i=1; $i<=5; $i++)
																@if($rate>=$i)
																	<i class="yellow fa fa-star"></i>
																@else 
																<i class="fa fa-star"></i>
																@endif
															@endfor
														</div>
														<a href="#"> ({{$rate_count}} customer review)</a>
													</div>
													<div class="quickview-stock">
														@if($product->stock >0)
														<span><i class="fa fa-check-circle-o"></i> {{$product->stock}} in stock</span>
														@else 
														<span><i class="fa fa-times-circle-o text-danger"></i> {{$product->stock}} out stock</span>
														@endif
													</div>
												</div>
												@php
													$after_discount=($product->price-($product->price*$product->discount)/100);
												@endphp
												<h3><small><del class="text-muted">${{number_format($product->price,2)}}</del></small>    ${{number_format($after_discount,2)}}  </h3>
												<div class="quickview-peragraph">
													<p>{!! html_entity_decode($product->summary) !!}</p>
												</div>
												@if($product->size)
													<div class="size">
														<h4>Size</h4>
														<ul>
															@php 
																$sizes=explode(',',$product->size);
																// dd($sizes);
															@endphp
															@foreach($sizes as $size)
															<li><a href="#" class="one">{{$size}}</a></li>
															@endforeach
														</ul>
													</div>
												@endif
												<form action="{{route('single-add-to-cart')}}" method="POST">
													@csrf 
													<div class="quantity">
														<!-- Input Order -->
														<div class="input-group">
															<div class="button minus">
																<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
																	<i class="ti-minus"></i>
																</button>
															</div>
															<input type="hidden" name="slug" value="{{$product->slug}}">
															<input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="1000" value="1">
															<div class="button plus">
																<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
																	<i class="ti-plus"></i>
																</button>
															</div>
														</div>
														<!--/ End Input Order -->
													</div>
													<div class="add-to-cart">
														<button type="submit" class="btn">Add to cart</button>
														<a href="{{route('add-to-wishlist',$product->slug)}}" class="btn min"><i class="ti-heart"></i></a>
													</div>
												</form>
												<div class="default-social">
												<!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
				</div>
			@endforeach
		@endif
			<!-- Modal end -->
@endsection
@push ('styles')
<style>
	 .pagination{
        display:inline-flex;
    }
	.filter_button{
        /* height:20px; */
        text-align: center;
        background:#F7941D;
        padding:8px 16px;
        margin-top:10px;
        color: white;
    }
    .priceSpan{
    	font-size: 38px;
    }
    /*.default-img{
    	width: 35px;
    }*/
    .box-suscription{
    	border: 1px solid #fed100;
    	padding-left: 0px;
    	padding-right: 0px; 
    	padding-bottom: 15px;
    }
    .box-suscription .price{
    	padding: 20px;
    	color: #fed100;
    	font-size: 22px;
    }
    .box-suscription .title{
    	background: #ffbc005e;
    	padding: 15px;
    	border-bottom:1px solid #fed100;
    }
    .box-products{
    	margin: 25px;
		/*border: 1px solid #fed100;*/
		padding: 15px;
		border-radius: 5px;
    }
    .box-products .row{
		border-bottom: 1px solid #fed100;
		margin-bottom: 10px;
		padding-bottom: 10px;
    }
    .title-prod{
    	padding-top: 5px;
    	text-align: left;
    }
</style>
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    {{-- <script>
        $('.cart').click(function(){
            var quantity=1;
            var pro_id=$(this).data('id');
            $.ajax({
                url:"{{route('add-to-cart')}}",
                type:"POST",
                data:{
                    _token:"{{csrf_token()}}",
                    quantity:quantity,
                    pro_id:pro_id
                },
                success:function(response){
                    console.log(response);
					if(typeof(response)!='object'){
						response=$.parseJSON(response);
					}
					if(response.status){
						swal('success',response.msg,'success').then(function(){
							document.location.href=document.location.href;
						});
					}
					else{
                        swal('error',response.msg,'error').then(function(){
							// document.location.href=document.location.href;
						}); 
                    }
                }
            })
        });
	</script> --}}
	<script>
        $(document).ready(function(){
        /*----------------------------------------------------*/
        /*  Jquery Ui slider js
        /*----------------------------------------------------*/
	        if ($("#slider-range").length > 0) {
	            const max_value = parseInt( $("#slider-range").data('max') ) || 500;
	            const min_value = parseInt($("#slider-range").data('min')) || 0;
	            const currency = $("#slider-range").data('currency') || '';
	            let price_range = min_value+'-'+max_value;
	            if($("#price_range").length > 0 && $("#price_range").val()){
	                price_range = $("#price_range").val().trim();
	            }
	            
	            let price = price_range.split('-');
	            $("#slider-range").slider({
	                range: true,
	                min: min_value,
	                max: max_value,
	                values: price,
	                slide: function (event, ui) {
	                    $("#amount").val(currency + ui.values[0] + " -  "+currency+ ui.values[1]);
	                    $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
	                }
	            });
	        }
	        if ($("#amount").length > 0) {
	            const m_currency = $("#slider-range").data('currency') || '';
	            $("#amount").val(m_currency + $("#slider-range").slider("values", 0) +
	                "  -  "+m_currency + $("#slider-range").slider("values", 1));
	        }
	        $("#condition").change(function(){
	        	$(".producto-card").hide('fade')
	        	let price = $(this).val().split('-')
	        	$(".priceSpan").html('S/'+price[1]);
	        	console.log($(this).val())
			    $("."+$(this).val()).show('slow')
				
	        })
        })

    </script>

@endpush