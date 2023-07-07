@extends('frontend/layouts/master')
@section('content')

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row gy-4">

        <div class="col-lg-7 order-1 order-lg-1 hero-img">
          <img src="{{asset('/frontend')}}/assets/img/hero-img.sv" class="img-fluid animated" alt="">
        </div>

        <div class="col-lg-5 order-2 order-lg-2 d-flex flex-column justify-content-center">
          <h1>Lorem Ipsum Dolor <span>Sit Amet Consectetur</span> Adi</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam tempus, tortor non facilisis faucibus, sem massa convallis nulla, ornare volutpat nunc eros id ligula.</p>
          <div>
            <a href="#" class="btn-get-started scrollto">Contact Now</a>
          </div>
        </div>
        
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-lg-5 d-flex align-items-center justify-content-center about-img">
            <img src="{{asset('/frontend')}}/assets/img/about.png" class="img-fluid" alt="" data-aos="zoom-in">
          </div>
          <div class="col-lg-6 pt-5 pt-lg-0">
            <h3 data-aos="fade-up">Lorem Ipsum <span>Dolor Sit</span> A Met, Consectetur</h3>
            <br data-aos="fade-up" data-aos-delay="100">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam tempus, tortor non facilisis faucibus, sem massa convallis nulla, ornare volutpat nunc eros id ligula.Ves ibulum laoreet lorem mauris, vel commodo ipsum malesuada tempus. Morbi libero<br>
              <br>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliqu facilisis faucibus, sem massa convallis nulla, ornare volutpat nunc eros id ligula.Ves ibulum laoreet lorem mauris, vel commodo ipsum
            </p>
            <div class="row">
              <div class="col-md-8" data-aos="fade-up" data-aos-delay="100">
                <h4>Lorem ipsum dolor</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipi facilisis faucibus, sem massa convallis nulla, eros id ligula.Ves ibulum laoreet lorem mauris.</p>
              </div>
              <div>
                <a href="#" class="btn-get-started scrollto">Expert Team</a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Lorem Ipsum <span>Dolor Sit</span> A <br><span><strong>Met, Consectetur</strong></span></h2>
        </div>

        <div class="row">
          @if($category_lists)
            @foreach($category_lists as $row)
              <div class="col-md-6 col-lg-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                <div class="icon-box">
                  <div class="card-img"><img src="{{ ($row->photo != '') ? $row->photo : asset('/frontend/assets/img/no-image-icon.png') }}" alt=""></div>
                  <h4 class="title">{{$row->title}}</h4>
                  <a href="{{route('product-cat',$row->slug)}}" class="card-btn">View All<i class='bx bx-right-arrow-alt'></i></a>
                </div>
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </section>
    <!-- End Services Section -->

    <!-- ======= Section-3 ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-lg-6 pt-5 pt-lg-0">
            <h3 data-aos="fade-up">Lorem Ipsum Dolor Sit A Met, Consectetur</h3>
            <br data-aos="fade-up" data-aos-delay="100">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam tempus, tortor non facilisis faucibus, sem massa convallis nulla, ornare volutpat nunc eros id ligula.Ves ibulum laoreet lorem mauris, vel commodo ipsum malesuada tempus. Morbi libero<br>
              <br>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliqu facilisis faucibus, sem massa convallis nulla, ornare volutpat nunc eros id ligula.Ves ibulum laoreet lorem mauris, vel commodo ipsum
            </p>
            <div class="row">
              <div class="col-md-8" data-aos="fade-up" data-aos-delay="100">
                <h4>Lorem ipsum dolor</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipi facilisis faucibus, sem massa convallis nulla, eros id ligula.Ves ibulum laoreet lorem mauris.</p>
              </div>
              <div>
                <a href="#" class="btn-get-started scrollto">Read More</a>
              </div>
            </div>
          </div>
          <div class="col-lg-6 d-flex align-items-center justify-content-center about-img">
            <img src="{{asset('/frontend')}}/assets/img/sec-3.png" class="img-fluid" alt="" data-aos="zoom-in">
          </div>
        </div>

      </div>
    </section><!-- End Section-3 -->
    
<!-- ======= Section-4 ======= -->
<section id="sec-4" class="sec-4">
  <div class="container">

    <div class="row justify-content-between align-items-center">
      <div class="col-lg-6 pt-5 pt-lg-0">
        <h3 data-aos="fade-up">Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Aliquam Tempus</h3>
        <br data-aos="fade-up" data-aos-delay="100">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam tempus, tortor non facilisis faucibus, sem massa convallis nulla, ornare volutpat nunc eros id ligula. Vestibulum laoreet lorem mauris.
        </p>
        <div>
          <a href="#" class="btn-get-started scrollto">Order Now</a>
        </div>
      </div>
      <div class="col-lg-6 d-flex align-items-center justify-content-center about-img">
        <img src="{{asset('/frontend')}}/assets/img/sec4.png" class="img-fluid" alt="" data-aos="zoom-in">
      </div>
    </div>

  </div>
</section><!-- End Section-4 -->

 <!-- ======= Product-Section ======= -->
 <section id="product-sec" class="product-sec product-bg">
  <div class="container" data-aos="fade-up">

    <div class="pro-title">
      <h2>All Product</h2>
    </div>
	@if($product_lists)
    <div class="row">
		 @foreach($product_lists as $row)
      <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
        <div class="icon-box">
          <div class="card-img"> <a href="{{route('product-detail',$row->slug)}}"><img src="{{$row->small_image}}" alt=""></a></div>
          <h4 class="title">{{$row->title}}</h4>
          <p class="price-p">${{$row->wholsale_price}}</p>
          <a href="{{route('product-detail',$row->slug)}}" class="card-btn">View<i class='bx bx-right-arrow-alt'></i></a>
        </div>
		 
      </div>
		 @endforeach
	
      <div class="all-prod-btn">
        <a href="{{route('product-lists')}}" class="btn-get-started scrollto">View All</a>
      </div>
		
    </div>
	  @endif

  </div>
</section>
<!-- End Product-Section -->

<!-- ======= Section-6 ======= -->
<section id="sec-6" class="sec-6">
  <div class="container">

    <div class="row justify-content-between align-items-center">
      <div class="col-lg-6 d-flex align-items-center justify-content-center about-img">
        <img src="{{asset('/frontend')}}/assets/img/sec-6.png" class="img-fluid" alt="" data-aos="zoom-in">
      </div>
      <div class="col-lg-6 pt-0 pt-lg-0">
          <div class="row">
             <div class="col-lg-12">
                <div class="items">
                   <div class="card0">
                      <div class="card-boxi">
                         <p class="lead">"I absolutely love the designs and styles that Ehya creates..They are so different and innovative. I have bought several times from the collections and what I love is that they really are timeless pieces.</p>
                         <h3 class="text-left py-4">Anje Keizer - Ehya Cosmetics Customer</h3>
                      </div>
                   </div>
                  <div class="card0">
                      <div class="card-boxi">
                         <p class="lead">"I absolutely love the designs and styles that Ehya creates..They are so different and innovative. I have bought several times from the collections and what I love is that they really are timeless pieces.</p>
                         <h3 class="text-left py-4">Anje Keizer - Ehya Cosmetics Customer</h3>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div> 
    </div>
    <div class="tesi-img">
      <img src="../Roy/assets/img/quote-left.png" alt="">
    </div>
  </div>
</section>
<!-- End Section-6 -->

  </main>
  @endsection