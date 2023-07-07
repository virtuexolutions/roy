@extends('frontend.layouts.master')
@section('title','Cart Page')
@section('content')
<style>
		
.title{
    margin-bottom: 5vh;
}
.input-group {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
    flex-direction: row;
	flex-wrap: nowrap;
}
.card{
    margin: auto;
    max-width: 950px;
    width: 90%;
    box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    border-radius: 1rem;
    border: transparent;
}
@media(max-width:767px){
    .card{
        margin: 3vh auto;
    }
}
.cart{
    background-color: #fff;
    padding: 4vh 5vh;
    border-bottom-left-radius: 1rem;
    border-top-left-radius: 1rem;
}
@media(max-width:767px){
    .cart{
        padding: 4vh;
        border-bottom-left-radius: unset;
        border-top-right-radius: 1rem;
    }
}
.summary{
    background-color: #ddd;
    border-top-right-radius: 1rem;
    border-bottom-right-radius: 1rem;
    padding: 4vh;
    color: rgb(65, 65, 65);
}
@media(max-width:767px){
    .summary{
    border-top-right-radius: unset;
    border-bottom-left-radius: 1rem;
    }
}
.summary .col-2{
    padding: 0;
}
.summary .col-10
{
    padding: 0;
}.row{
    margin: 0;
}
.title b{
    font-size: 1.5rem;
}
.main{
    margin: 0;
    padding: 2vh 0;
    width: 100%;
}
.col-2, .col{
    padding: 0 1vh;
}
a{
    padding: 0 1vh;
}
.close{
    margin-left: auto;
    font-size: 0.7rem;
}
img{
    width: 3.5rem;
}
.back-to-shop{
    margin-top: 4.5rem;
}
h5{
    margin-top: 4vh;
}
hr{
    margin-top: 1.25rem;
}
form{
    padding: 2vh 0;
}
select{
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1.5vh 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247);
}
input{
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247);
}
input:focus::-webkit-input-placeholder
{
      color:transparent;
}

a{
    color: black; 
}
button.btn.btn-primary.btn-number {
    width: 20px;
    font-size: 10px;
    padding: 2px;
    margin: 10px
}
.btn-active{
	background-color: #FB9D4A;
	color: #fff;
	border-radius: 20px;
}
.btn-update{
	position: relative;
    font-weight: 500;
    font-size: 14px;
    color: #fff;
    background: #333;
    display: inline-block;
    -webkit-transition: all 0.4s ease;
    -moz-transition: all 0.4s ease;
    transition: all 0.4s ease;
    z-index: 5;
    display: inline-block;
    padding: 13px 32px;
    border-radius: 0px;
    text-transform: uppercase;
}
.btn-active:hover{
	background-color: '#FB9D4A'
}
a:hover{
    color: black;
    text-decoration: none;
}
 #code{
    background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253) , rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
    background-repeat: no-repeat;
    background-position-x: 95%;
    background-position-y: center;
}
	</style>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<section id="product-sec" class="product-sec product-bg">
	<div class="container" data-aos="fade-up">
		<div class="row">
			<div class="card">
				<div class="row">
					<div class="col-md-8 cart">
						<div class="title">
							<div class="row">
								<div class="col"><h4><b>Shopping Cart</b></h4></div>
								<div class="col align-self-center text-right text-muted"> {{(Helper::getAllProductFromCart()) ? count(Helper::getAllProductFromCart()) : 0}} items</div>
							</div>
						</div>    
						<form action="{{route('cart.update')}}" method="POST">
							@csrf
							@if(Helper::getAllProductFromCart())
							@foreach(Helper::getAllProductFromCart() as $key=>$cart)
								<div class="row border-top border-bottom">
									<div class="row main align-items-center">
										<div class="col-2"><img class="img-fluid" src="{{$cart->product['small_image']}}"></div>
										<div class="col">
											<div class="row text-muted">{{$cart->product['category']}}</div>
											<div class="row">{{$cart->product['title']}}</div>
										</div>
										<div class="col">
										<div class="input-group">
											<!-- <div class="button minus"> -->
												<button type="button" class="btn btn-primary btn-number minus" data-type="minus" data-field="quant[{{$key}}]">
													<i class="fa fa-minus"></i>
												</button>
											<!-- </div> -->
											<input type="text" name="quant[{{$key}}]" class="input-number"  data-min="1" data-max="100" value="{{$cart->quantity}}">
											
											<button type="button" class="btn btn-primary btn-number plus" data-type="plus" data-field="quant[{{$key}}]">
												<i class="fa fa-plus"></i>
											</button>
											<input type="hidden" name="qty_id[]" value="{{$cart->id}}">

										</div>
											<!-- <a href="#">-</a><a href="#" class="border">1</a><a href="#">+</a> -->
										</div>
										<div class="col">&dollar; {{$cart->price}} <a href="{{route('cart-delete',$cart->id)}}">

											<span class="close btn btn-danger">&#10005;</span>
										</a>
									</div>
									</div>
								</div>
							@endforeach
							@endif
							@if(Helper::getAllProductFromCart())
							<button class="btn float-right btn-update" type="submit">Update</button>
							@endif
						</form>
						
					</div>
					<div class="col-md-4 summary">
						<div><h5><b>Summary</b></h5></div>
						<hr>
						<div class="row">
							<div class="col" style="padding-left:0;">ITEMS {{(Helper::getAllProductFromCart()) ? count(Helper::getAllProductFromCart()) : 0}}</div>
							<div class="col text-right">{{number_format(Helper::totalCartPrice(),2)}}</div>
						</div>
						<form action="{{route('coupon-store')}}" method="POST">
							<!-- @csrf
							<p>GIVE CODE</p>
							<input id="code" name="code"  placeholder="Enter your code">
							<button class="btn btn-update">Apply</button> -->
						</form>
						@php
							$total_amount=Helper::totalCartPrice();
							if(session()->has('coupon'))
							{
								$total_amount=$total_amount-Session::get('coupon')['value'];
							}
						@endphp
						<div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
							<div class="col">TOTAL PRICE</div>
							<div class="col text-right">&dollar; {{number_format($total_amount,2)}}</div>
						</div>
						<a class="btn btn-active" @if(Helper::getAllProductFromCart()) href="{{route('checkout')}}" @endif >CHECKOUT</a>
						<div class="back-to-shop"><a href="{{route('product-lists')}}">&leftarrow;</a><span class="text-muted">Continue Shopping</span></div>
					</div>
				</div>
        	</div>
        </div>
    </div>
</section>

@endsection
