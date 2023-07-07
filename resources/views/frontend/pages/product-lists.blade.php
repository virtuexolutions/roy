@extends('frontend.layouts.master')

@section('title','Roy || PRODUCT PAGE')

@section('content')

		<!-- End Breadcrumbs -->
	
			<!-- Product Style 1 -->
			<section id="product-sec" class="product-sec product-bg">
  <div class="container" data-aos="fade-up">
					<div class="row">
								@if(count($products))
									@foreach($products as $row)
									 	<div class="col-md-6 pt-5 mt-5 col-lg-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
											<div class="icon-box">
											  <div class="card-img"><a href="{{route('product-detail',$row->slug)}}"><img src="{{$row->small_image}}" alt=""></a></div>
											  <h4 class="title">{{$row->title}}</h4>
											  <p class="price-p">${{$row->wholsale_price}}</p>
											  <a href="{{route('product-detail',$row->slug)}}" class="card-btn">View<i class='bx bx-right-arrow-alt'></i></a>
											</div>

										  </div>
										<!-- End Single List -->
									@endforeach
								@else
									<h4 class="text-warning" style="margin:100px auto;">There are no products.</h4>
								@endif

                            </div>
                            <br>
                            {{ $products->links('custom-pagination-links') }}
                        </div>
                    </section>
			<!--/ End Product Style 1  -->	
		
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
        })
    </script>

@endpush