@extends('layouts.default')
@section('style')
<style>
/*
** Style Simple Ecommerce Theme for Bootstrap 4
** Created by T-PHP https://t-php.fr/43-theme-ecommerce-bootstrap-4.html
*/
.bloc_left_price {
    color: #c01508;
    text-align: center;
    font-weight: bold;
    font-size: 150%;
}
.category_block li:hover {
    background-color: #007bff;
}
.category_block li:hover a {
    color: #ffffff;
}
.category_block li a {
    color: #343a40;
}
.add_to_cart_block .price {
    color: #c01508;
    text-align: center;
    font-weight: bold;
    font-size: 200%;
    margin-bottom: 0;
}
.add_to_cart_block .price_discounted {
    color: #343a40;
    text-align: center;
    text-decoration: line-through;
    font-size: 140%;
}
.product_rassurance {
    padding: 10px;
    margin-top: 15px;
    background: #ffffff;
    border: 1px solid #6c757d;
    color: #6c757d;
}
.product_rassurance .list-inline {
    margin-bottom: 0;
    text-transform: uppercase;
    text-align: center;
}
.product_rassurance .list-inline li:hover {
    color: #343a40;
}
.reviews_product .fa-star {
    color: gold;
}
.pagination {
    margin-top: 20px;
}
footer {
    background: #343a40;
    padding: 40px;
}
footer a {
    color: #f8f9fa!important
}

</style>
@endsection
@section('body')
	@foreach ($product as $p)

    <div class="container" style="padding:30px;">
<div class="page-wrapper">
		<nav class="navbar navbar-expand-md navbar-album">
		  <div class="paymefull"> 
			<div class="row">
			<div class="profile-img"> 
			  <a href="/page">
				<img src="{{asset('img/product_image/'.$p->image)}}" class="rounded-circle" width="75" height="75" alt="">
				</a>
			</div>      
			<span class="profile-name">{{$p->name}}</span>
		  </div>
	
	
		  </div>
         </nav>
         
		<div class="paymefull">
		  <div class="row"> 
		  <div class="col-xl-10 col-md-12"> 
		  <h4 class="header-index" style="margin-bottom: 30px;">{{$p->name}}<small class="text-muted"> • {{$p->id}}</small></h4>
			<div class="main-album" style="min-height: 400px;">  
	
			  <div class="cards-album"> 
					<div class="container">
							<div class="row">
								<!-- Image -->
								<div class="col-12 col-lg-6" >
									
															<img class="d-block w-100" src="{{ asset('/img/product_images/'.$p->image) }}" alt="First slide">
														
								</div>
						
								<!-- Add to cart -->
								<div class="col-12 col-lg-6 add_to_cart_block">

									<div class="card bg-light mb-3">
										<div class="card-body">
										<p class="price">R$ {{ number_format($p->cost, 2, ',', '.') }}</p>										
											{{-- <p class="price_discounted">149.90 $</p> --}}
                                            <form method="post" action="{{route('addtocart')}}">		
                                                @csrf									
												<div class="form-group">
													<script>
														$(document).ready(function(){
															$('.quantity-left-minus').click(function(){
																let quantityVal = parseInt($('#quantity').val(), 10);

																if(quantityVal > 1){
																	let nqv = quantityVal-1;
																	$('#quantity').val(nqv);
																}
															});

																$('.quantity-right-plus').click(function(){
																	let quantityVal = $('#quantity').val();
																	let max = $('#quantity').data('max');
																	let pease = parseInt(quantityVal, 10);
																	let quantityMore = pease+1;
																	if(quantityMore < max || quantityMore == max ){
																		$('#quantity').val(quantityMore);
																	}

																});
																									
														});
													</script>
													<label>Quantity :</label>
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
																<i class="fa fa-minus"></i>
															</button>
														</div>
													<input type="number" class="form-control" id="quantity" name="quantity" data-min="1" data-max="{{$p->quantity}}" value="1" readonly>

														<div class="input-group-append">
															<button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
																<i class="fa fa-plus"></i>
															</button>
														</div>
													</div>
												</div>
												
																					
                                            <div style="margin-top:20px;">
                                                
                                            <input type="hidden" value="{{$p->id}}" name="id">
                                            <input type="hidden" value="{{$p->quantity}}" name="maxQuantity">
                                            <input type="hidden" value="{{$p->cost}}" name="cost">
											<button type="submit" style="border-radius:0px;" class="btn btn-info btn-lg btn-block text-uppercase">
													<i class="fa fa-shopping-cart"></i> Add To Cart
												</button>
                                            </div>
                                        </form>
										</div>
										
									</div>
								</div>
							</div>
						
							<div class="row" style="margin-top:1em;">
								<!-- Description -->
								<div class="col-12">
									<div class="card border-light mb-3"  style="background:transparent;">
										<div class="card-header text-white text-uppercase" style="background-color:#2b2b2b;"><i class="fa fa-align-justify"></i> Description</div>
										<div class="card-body" >
											<p class="card-text">
												{{$p->description}}	
											</p>											
										</div>
									</div>
								</div>
						
							</div>
						</div>
			  </div>
	
			</div>
          </div>
          @endforeach
		  </div>	
        </div>	
    </div>	
</div>


@endsection