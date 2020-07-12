@extends('layouts.main')

@section('header')
    @include('partials.header.logo')
@endsection


@section('content')

    <!-- Hero Slides-->
    <div class="hero-slides owl-carousel">
          <!-- Single Hero Slide-->
        <div class="single-hero-slide" style="background-image: url('{{asset('img/bg-img/1.jpg')}}")}}')">
            <div class="slide-content h-100 d-flex align-items-center">
                <div class="container">
                    <h4 class="text-white mb-0" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">Amazon Echo</h4>
                    <p class="text-white" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">3rd Generation, Charcoal</p><a class="btn btn-primary btn-sm" href="#" data-animation="fadeInUp" data-delay="800ms" data-wow-duration="1000ms">Buy Now</a>
                </div>
            </div>
        </div>
        <!-- Single Hero Slide-->
        <div class="single-hero-slide" style="background-image: url('{{asset('img/bg-img/2.jpg')}}")}}')">
            <div class="slide-content h-100 d-flex align-items-center">
                <div class="container">
                    <h4 class="text-white mb-0" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">Light Candle</h4>
                    <p class="text-white" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">Now only &#8377;1322</p><a class="btn btn-success btn-sm" href="#" data-animation="fadeInUp" data-delay="500ms" data-wow-duration="1000ms">Buy Now</a>
                </div>
            </div>
        </div>
        <!-- Single Hero Slide-->
        <div class="single-hero-slide" style="background-image: url('{{asset('img/bg-img/3.jpg')}}")}}')">
            <div class="slide-content h-100 d-flex align-items-center">
                <div class="container">
                    <h4 class="text-white mb-0" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">Best Furniture</h4>
                    <p class="text-white" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">3 years warranty</p><a class="btn btn-danger btn-sm" href="#" data-animation="fadeInUp" data-delay="800ms" data-wow-duration="1000ms">Buy Now</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Catagories-->
    <div class="product-catagories-wrapper pt-3">
        <div class="container">
            <div class="section-heading">
                <h6 class="ml-1">Product Category</h6>
            </div>
            <div class="product-catagory-wrap">
                <div class="row">
                    <div class="col-4">
                        <div class="card mb-3 catagory-card">
                            <div class="card-body"><a href="catagory.html"><i class="lni-slim"></i><span>Women's</span></a></div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card mb-3 catagory-card">
                            <div class="card-body"><a href="catagory.html"><i class="lni-apartment"></i><span>Lifestyle</span></a></div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card mb-3 catagory-card">
                            <div class="card-body"><a href="catagory.html"><i class="lni-burger"></i><span>Foods</span></a></div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card mb-3 catagory-card">
                            <div class="card-body"><a href="catagory.html"><i class="lni-cup"></i><span>Sports</span></a></div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card mb-3 catagory-card">
                            <div class="card-body"><a href="catagory.html"><i class="lni-tshirt"></i><span>Men's</span></a></div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card mb-3 catagory-card">
                            <div class="card-body"><a href="catagory.html"><i class="lni-island"></i><span>Travel</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Flash Sale Slide-->
    <div class="flash-sale-wrapper pb-3">
      <div class="container">
        <div class="section-heading d-flex align-items-center justify-content-between">
          <h6 class="ml-1">Flash Sale</h6><a class="btn btn-primary btn-sm" href="#">View All</a>
        </div>
        <!-- Flash Sale Slide-->
        <div class="flash-sale-slide owl-carousel">
          <!-- Single Flash Sale Card-->
          <div class="card flash-sale-card">
            <div class="card-body"><a href="#single-product"><img src="{{asset('img/product/1.jpg')}}" alt=""><span class="product-title">Short Cotton Tops</span>
                <p class="sale-price">&#8377;877.99<span class="real-price">&#8377;1015</span></p><span class="progress-title">33% Sold Out</span>
                <!-- Progress Bar-->
                <div class="progress">
                  <div class="progress-bar" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                </div></a></div>
          </div>
          <!-- Single Flash Sale Card-->
          <div class="card flash-sale-card">
            <div class="card-body"><a href="#single-product"><img src="{{asset('img/product/2.jpg')}}" alt=""><span class="product-title">Flower Shape Baby Dress</span>
                <p class="sale-price">&#8377;1014<span class="real-price">&#8377;1621</span></p><span class="progress-title">57% Sold Out</span>
                <!-- Progress Bar-->
                <div class="progress">
                  <div class="progress-bar" role="progressbar" style="width: 57%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                </div></a></div>
          </div>
          <!-- Single Flash Sale Card-->
          <div class="card flash-sale-card">
            <div class="card-body"><a href="#single-product"><img src="{{asset('img/product/3.jpg')}}" alt=""><span class="product-title">Floral Long Sleve Salowar </span>
                <p class="sale-price">&#8377;2536<span class="real-price">&#8377;3549</span></p><span class="progress-title">100% Sold Out</span>
                <!-- Progress Bar-->
                <div class="progress">
                  <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div></a></div>
          </div>
          <!-- Single Flash Sale Card-->
          <div class="card flash-sale-card">
            <div class="card-body"><a href="#single-product"><img src="{{asset('img/product/1.jpg')}}" alt=""><span class="product-title">Short Cotton Tops</span>
                <p class="sale-price">&#8377;797.99<span class="real-price">&#8377;1015</span></p><span class="progress-title">33% Sold Out</span>
                <!-- Progress Bar-->
                <div class="progress">
                  <div class="progress-bar" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                </div></a></div>
          </div>
          <!-- Single Flash Sale Card-->
          <div class="card flash-sale-card">
            <div class="card-body"><a href="#single-product"><img src="{{asset('img/product/2.jpg')}}" alt=""><span class="product-title">Flower Shape Baby Dress</span>
                <p class="sale-price">&#8377;1014<span class="real-price">&#8377;1521</span></p><span class="progress-title">57% Sold Out</span>
                <!-- Progress Bar-->
                <div class="progress">
                  <div class="progress-bar" role="progressbar" style="width: 57%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                </div></a></div>
          </div>
          <!-- Single Flash Sale Card-->
          <div class="card flash-sale-card">
            <div class="card-body"><a href="#single-product"><img src="{{asset('img/product/3.jpg')}}" alt=""><span class="product-title">Floral Long Sleve Salowar </span>
                <p class="sale-price">&#8377;2536<span class="real-price">&#8377;3549</span></p><span class="progress-title">100% Sold Out</span>
                <!-- Progress Bar-->
                <div class="progress">
                  <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div></a></div>
          </div>
        </div>
      </div>
    </div>
    <!-- Top Products-->
    <div class="top-products-area clearfix">
      <div class="container">
        <div class="section-heading d-flex align-items-center justify-content-between">
          <h6 class="ml-1">Top Products</h6><a class="btn btn-danger btn-sm" href="#">View All</a>
        </div>
        <div class="row">
          <!-- Single Top Product Card-->
          <div class="col-6 col-sm-4 col-lg-3">
            <div class="card top-product-card mb-3">
              <div class="card-body"><span class="badge badge-success">Sale</span><a class="wishlist-btn" href="#"><i class="lni-heart-filled"></i></a><a class="product-thumbnail d-block" href="#single-product"><img class="mb-2" src="{{asset('img/product/11.jpg')}}" alt=""></a><a class="product-title d-block" href="#single-product">Women's Caps</a>
                <p class="sale-price">&#8377;913<span>&#8377;3242</span></p>
                <div class="product-rating"><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i></div><a class="btn btn-success btn-sm add2cart-notify" href="#"><i class="lni-plus"></i></a>
              </div>
            </div>
          </div>
          <!-- Single Top Product Card-->
          <div class="col-6 col-sm-4 col-lg-3">
            <div class="card top-product-card mb-3">
              <div class="card-body"><span class="badge badge-primary">New</span><a class="wishlist-btn" href="#"><i class="lni-heart-filled"></i></a><a class="product-thumbnail d-block" href="#single-product"><img class="mb-2" src="{{asset('img/product/5.jpg')}}" alt=""></a><a class="product-title d-block" href="#single-product">Ciramic Pots</a>
                <p class="sale-price">&#8377;5674<span>&#8377;7899</span></p>
                <div class="product-rating"><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i></div><a class="btn btn-success btn-sm add2cart-notify" href="#"><i class="lni-plus"></i></a>
              </div>
            </div>
          </div>
          <!-- Single Top Product Card-->
          <div class="col-6 col-sm-4 col-lg-3">
            <div class="card top-product-card mb-3">
              <div class="card-body"><span class="badge badge-success">Sale</span><a class="wishlist-btn" href="#"><i class="lni-heart-filled"></i></a><a class="product-thumbnail d-block" href="#single-product"><img class="mb-2" src="{{asset('img/product/6.jpg')}}" alt=""></a><a class="product-title d-block" href="#single-product">Roof Lamp</a>
                <p class="sale-price">&#8377;7899<span>&#8377;9113</span></p>
                <div class="product-rating"><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i></div><a class="btn btn-success btn-sm add2cart-notify" href="#"><i class="lni-plus"></i></a>
              </div>
            </div>
          </div>
          <!-- Single Top Product Card-->
          <div class="col-6 col-sm-4 col-lg-3">
            <div class="card top-product-card mb-3">
              <div class="card-body"><span class="badge badge-danger">-15%</span><a class="wishlist-btn" href="#"><i class="lni-heart-filled"></i></a><a class="product-thumbnail d-block" href="#single-product"><img class="mb-2" src="{{asset('img/product/9.jpg')}}" alt=""></a><a class="product-title d-block" href="#single-product">Black Shoes</a>
                <p class="sale-price">&#8377;7887<span>&#8377;8792</span></p>
                <div class="product-rating"><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i></div><a class="btn btn-success btn-sm add2cart-notify" href="#"><i class="lni-plus"></i></a>
              </div>
            </div>
          </div>
          <!-- Single Top Product Card-->
          <div class="col-6 col-sm-4 col-lg-3">
            <div class="card top-product-card mb-3">
              <div class="card-body"><span class="badge badge-danger">-11%</span><a class="wishlist-btn" href="#"><i class="lni-heart-filled"></i></a><a class="product-thumbnail d-block" href="#single-product"><img class="mb-2" src="{{asset('img/product/8.jpg')}}" alt=""></a><a class="product-title d-block" href="#single-product">White Dress</a>
                <p class="sale-price">&#8377;1521<span>&#8377;1725</span></p>
                <div class="product-rating"><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i></div><a class="btn btn-success btn-sm add2cart-notify" href="#"><i class="lni-plus"></i></a>
              </div>
            </div>
          </div>
          <!-- Single Top Product Card-->
          <div class="col-6 col-sm-4 col-lg-3">
            <div class="card top-product-card mb-3">
              <div class="card-body"><span class="badge badge-warning">Hot</span><a class="wishlist-btn" href="#"><i class="lni-heart-filled"></i></a><a class="product-thumbnail d-block" href="#single-product"><img class="mb-2" src="{{asset('img/product/4.jpg')}}" alt=""></a><a class="product-title d-block" href="#single-product">Polo Shirts</a>
                <p class="sale-price">&#8377;4538<span>&#8377;5541</span></p>
                <div class="product-rating"><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i></div><a class="btn btn-success btn-sm add2cart-notify" href="#"><i class="lni-plus"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Cool Facts Area-->
    <div class="cta-area">
      <div class="container">
        <div class="cta-text p-4 p-lg-5" style="background-image: url({{asset('img/bg-img/24.jpg')}}")}})">
          <h4>Winter Sale 20% Off</h4>
          <p>Suha is a multipurpose, creative &amp; <br>modern mobile template.</p><a class="btn btn-danger" href="#">Shop Today</a>
        </div>
      </div>
    </div>
    <!-- Weekly Best Sellers-->
    <div class="weekly-best-seller-area pt-3">
      <div class="container">
        <div class="section-heading d-flex align-items-center justify-content-between">
          <h6 class="pl-1">Weekly Best Sellers</h6><a class="btn btn-success btn-sm" href="#shop-list">View All</a>
        </div>
        <div class="row">
          <!-- Single Weekly Product Card-->
          <div class="col-12 col-md-6">
            <div class="card weekly-product-card mb-3">
              <div class="card-body d-flex align-items-center">
                <div class="product-thumbnail-side"><span class="badge badge-success">Sale</span><a class="wishlist-btn" href="#"><i class="lni-heart-filled"></i></a><a class="product-thumbnail d-block" href="#single-product"><img src="{{asset('img/product/10.jpg')}}" alt=""></a></div>
                <div class="product-description"><a class="product-title d-block" href="#single-product">Light Cotton Tops</a>
                  <p class="sale-price"><i class="lni-dollar"></i>&#8377;6564<span>&#8377;8589</span></p>
                  <div class="product-rating"><i class="lni-star-filled"></i>4.88 (39)</div><a class="btn btn-success btn-sm add2cart-notify" href="#"><i class="mr-1 lni-cart"></i>Buy</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Single Weekly Product Card-->
          <div class="col-12 col-md-6">
            <div class="card weekly-product-card mb-3">
              <div class="card-body d-flex align-items-center">
                <div class="product-thumbnail-side"><span class="badge badge-primary">Pre Order</span><a class="wishlist-btn" href="#"><i class="lni-heart-filled"></i></a><a class="product-thumbnail d-block" href="#single-product"><img src="{{asset('img/product/7.jpg')}}" alt=""></a></div>
                <div class="product-description"><a class="product-title d-block" href="#single-product">Modern Gray Tops</a>
                  <p class="sale-price"><i class="lni-dollar"></i>&#8377;7100<span>&#8377;8160</span></p>
                  <div class="product-rating"><i class="lni-star-filled"></i>4.82 (125)</div><a class="btn btn-success btn-sm add2cart-notify" href="#"><i class="mr-1 lni-cart"></i>Buy</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Single Weekly Product Card-->
          <div class="col-12 col-md-6">
            <div class="card weekly-product-card mb-3">
              <div class="card-body d-flex align-items-center">
                <div class="product-thumbnail-side"><span class="badge badge-danger">-10%</span><a class="wishlist-btn" href="#"><i class="lni-heart-filled"></i></a><a class="product-thumbnail d-block" href="#single-product"><img src="{{asset('img/product/12.jpg')}}" alt=""></a></div>
                <div class="product-description"><a class="product-title d-block" href="#single-product">Sun Glasses</a>
                  <p class="sale-price"><i class="lni-dollar"></i>&#8377;1424<span>&#8377;1732</span></p>
                  <div class="product-rating"><i class="lni-star-filled"></i>4.79 (63)</div><a class="btn btn-success btn-sm add2cart-notify" href="#"><i class="mr-1 lni-cart"></i>Buy</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Single Weekly Product Card-->
          <div class="col-12 col-md-6">
            <div class="card weekly-product-card mb-3">
              <div class="card-body d-flex align-items-center">
                <div class="product-thumbnail-side"><span class="badge badge-warning">Featured</span><a class="wishlist-btn" href="#"><i class="lni-heart-filled"></i></a><a class="product-thumbnail d-block" href="#single-product"><img src="{{asset('img/product/13.jpg')}}" alt=""></a></div>
                <div class="product-description"><a class="product-title d-block" href="#single-product">Wall Clock</a>
                  <p class="sale-price"><i class="lni-dollar"></i>&#8377;2531<span>&#8377;3547</span></p>
                  <div class="product-rating"><i class="lni-star-filled"></i>4.99 (7)</div><a class="btn btn-success btn-sm add2cart-notify" href="#"><i class="mr-1 lni-cart"></i>Buy</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection
