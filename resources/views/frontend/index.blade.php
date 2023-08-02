@extends('frontend.master')
@section('main')
@include('frontend.home.home_slide')
<!--End hero slider-->
@include('frontend.home.home_features_category')
<!--End category slider-->
@include('frontend.home.home_banner')
<!--End banners-->
@include('frontend.home.home_new_product')
<!--Products Tabs-->
@include('frontend.home.home_features_product')
<!--End Best Sales-->
<!-- TV @if(session()->get('language') == 'bangla') 
   {{ $skip_category_0->category_name_bn }}
   @else 
   {{ $skip_category_0->category_name_en }}
   @endif -->
<section class="product-tabs section-padding position-relative">
   <div class="container">
      <div class="section-title style-2 wow animate__animated animate__fadeIn">
         <h3>
            @if(session()->get('language') == 'bangla') 
            {{ $skip_category_0->category_name_bn }} ক্যাটেগরি
            @else 
            {{ $skip_category_0->category_name_en }} Category
            @endif
         </h3>
      </div>
      <!--End nav-tabs-->
      <div class="tab-content" id="myTabContent">
         <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
            <div class="row product-grid-4">
               @foreach($skip_product_0 as $product)
               <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                  <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                     <div class="product-img-action-wrap">
                        <div class="product-img product-img-zoom">
                           <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                           <img class="default-img" src="{{ asset( $product->product_thambnail ) }}" alt="" />
                           </a>
                        </div>
                        <div class="product-action-1">
                        
                           <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                           <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                           <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)" ><i class="fi-rs-eye"></i></a>
                        </div>
                        @php
                        $amount = $product->selling_price - $product->discount_price;
                        $discount = ($amount/$product->selling_price) * 100;
                        @endphp
                        <div class="product-badges product-badges-position product-badges-mrg">
                           @if($product->discount_price == NULL)
                           <span class="new">New</span>
                           @else
                           <span class="hot"> {{ round($discount) }} %</span>
                           @endif
                        </div>
                     </div>
                     <div class="product-content-wrap">
                        <div class="product-category">
                           <a href="shop-grid-right.html">{{ $product['category']['category_name'] }}</a>
                        </div>
                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                           @if(session()->get('language') == 'bangla') 
                           {{ $product->product_name_bn }}
                           @else 
                           {{ $product->product_name_en }}
                           @endif
                           </a>
                        </h2>
                        @php
                        $reviewcount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                        $avarage = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                        @endphp
                        <div class="product-rate d-inline-block">
                           @if($avarage == 0)

                           @elseif($avarage == 1 || $avarage < 2)                     
                        <div class="product-rating" style="width: 20%"></div>
                           @elseif($avarage == 2 || $avarage < 3)                     
                        <div class="product-rating" style="width: 40%"></div>
                           @elseif($avarage == 3 || $avarage < 4)                     
                        <div class="product-rating" style="width: 60%"></div>
                           @elseif($avarage == 4 || $avarage < 5)                     
                        <div class="product-rating" style="width: 80%"></div>
                           @elseif($avarage == 5 || $avarage < 5)                     
                        <div class="product-rating" style="width: 100%"></div>
                        @endif
                        <span class="font-small ml-5 text-muted"> ({{count($reviewcount)}})</span>
                        </div>
                        @if($product->discount_price == NULL)
                        <div class="product-price mt-10">
                           <span>${{ $product->selling_price }} </span>
                        </div>
                        @else
                        <div class="product-price mt-10">
                           <span>${{ $product->discount_price }} </span>
                           <span class="old-price">${{ $product->selling_price }}</span>
                        </div>
                        @endif
                        <div class="sold mt-15 mb-15">
                           <div class="progress mb-5">
                              <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                           <span class="font-xs text-heading"> Sold: 90/120</span>
                        </div>
                        <a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                     </div>
                  </div>
               </div>
               <!--end product card-->
               @endforeach
            </div>
            <!--End product-grid-4-->
         </div>
      </div>
      <!--End tab-content-->
   </div>
</section>
<!--End TV Category -->
<!--  @if(session()->get('language') == 'bangla') 
   {{ $skip_category_2->category_name_bn }}
   @else 
   {{ $skip_category_2->category_name_en }}
   @endif
   Category -->
<section class="product-tabs section-padding position-relative">
   <div class="container">
      <div class="section-title style-2 wow animate__animated animate__fadeIn">
         <h3>
            @if(session()->get('language') == 'bangla') 
            {{ $skip_category_2->category_name_bn }} ক্যাটেগরি
            @else 
            {{ $skip_category_2->category_name_en }} Category
            @endif
         </h3>
      </div>
      <!--End nav-tabs-->
      <div class="tab-content" id="myTabContent">
         <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
            <div class="row product-grid-4">
               @foreach($skip_product_2 as $product)
               <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                  <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                     <div class="product-img-action-wrap">
                        <div class="product-img product-img-zoom">
                           <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                           <img class="default-img" src="{{ asset( $product->product_thambnail ) }}" alt="" />
                           </a>
                        </div>
                        <div class="product-action-1">
                           <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  ><i class="fi-rs-heart"></i></a>
                           <a aria-label="Compare" class="action-btn"  id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                           <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)" ><i class="fi-rs-eye"></i></a>
                        </div>
                        @php
                        $amount = $product->selling_price - $product->discount_price;
                        $discount = ($amount/$product->selling_price) * 100;
                        @endphp
                        <div class="product-badges product-badges-position product-badges-mrg">
                           @if($product->discount_price == NULL)
                           <span class="new">New</span>
                           @else
                           <span class="hot"> {{ round($discount) }} %</span>
                           @endif
                        </div>
                     </div>
                     <div class="product-content-wrap">
                        <div class="product-category">
                           <a href="shop-grid-right.html">{{ $product['category']['category_name'] }}</a>
                        </div>
                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                           @if(session()->get('language') == 'bangla') 
                           {{ $product->product_name_bn }}
                           @else 
                           {{ $product->product_name_en }}
                           @endif
                           </a>
                        </h2>
                        @php
                        $reviewcount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                        $avarage = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                        @endphp
                        <div class="product-rate d-inline-block">
                           @if($avarage == 0)

                           @elseif($avarage == 1 || $avarage < 2)                     
                        <div class="product-rating" style="width: 20%"></div>
                           @elseif($avarage == 2 || $avarage < 3)                     
                        <div class="product-rating" style="width: 40%"></div>
                           @elseif($avarage == 3 || $avarage < 4)                     
                        <div class="product-rating" style="width: 60%"></div>
                           @elseif($avarage == 4 || $avarage < 5)                     
                        <div class="product-rating" style="width: 80%"></div>
                           @elseif($avarage == 5 || $avarage < 5)                     
                        <div class="product-rating" style="width: 100%"></div>
                        @endif
                        <span class="font-small ml-5 text-muted"> ({{count($reviewcount)}})</span>
                        </div>
                        @if($product->discount_price == NULL)
                        <div class="product-price mt-10">
                           <span>${{ $product->selling_price }} </span>
                        </div>
                        @else
                        <div class="product-price mt-10">
                           <span>${{ $product->discount_price }} </span>
                           <span class="old-price">${{ $product->selling_price }}</span>
                        </div>
                        @endif
                        <div class="sold mt-15 mb-15">
                           <div class="progress mb-5">
                              <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                           <span class="font-xs text-heading"> Sold: 90/120</span>
                        </div>
                        <a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                     </div>
                  </div>
               </div>
               <!--end product card-->
               @endforeach
            </div>
            <!--End product-grid-4-->
         </div>
      </div>
      <!--End tab-content-->
   </div>
</section>
<!--End Tshirt Category -->
<!--@if(session()->get('language') == 'bangla') 
   {{ $skip_category_2->category_name_bn }}
   @else 
   {{ $skip_category_2->category_name_en }}
   @endif Category -->
<section class="product-tabs section-padding position-relative">
   <div class="container">
      <div class="section-title style-2 wow animate__animated animate__fadeIn">
         <h3>
            @if(session()->get('language') == 'bangla') 
            {{ $skip_category_7->category_name_bn }} ক্যাটেগরি
            @else 
            {{ $skip_category_7->category_name_en }} Category
            @endif
         </h3>
      </div>
      <!--End nav-tabs-->
      <div class="tab-content" id="myTabContent">
         <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
            <div class="row product-grid-4">
               @foreach($skip_product_7 as $product)
               <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                  <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                     <div class="product-img-action-wrap">
                        <div class="product-img product-img-zoom">
                           <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                           <img class="default-img" src="{{ asset( $product->product_thambnail ) }}" alt="" />
                           </a>
                        </div>
                        <div class="product-action-1">
                        
                           <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                           <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                           <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)" ><i class="fi-rs-eye"></i></a>
                        </div>
                        @php
                        $amount = $product->selling_price - $product->discount_price;
                        $discount = ($amount/$product->selling_price) * 100;
                        @endphp
                        <div class="product-badges product-badges-position product-badges-mrg">
                           @if($product->discount_price == NULL)
                           <span class="new">New</span>
                           @else
                           <span class="hot"> {{ round($discount) }} %</span>
                           @endif
                        </div>
                     </div>
                     <div class="product-content-wrap">
                        <div class="product-category">
                           <a href="shop-grid-right.html">{{ $product['category']['category_name'] }}</a>
                        </div>
                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                           @if(session()->get('language') == 'bangla') 
                           {{ $product->product_name_bn }}
                           @else 
                           {{ $product->product_name_en }}
                           @endif
                           </a>
                        </h2>
                        <div class="product-rate d-inline-block">
                           <div class="product-rating" style="width: 80%"></div>
                        </div>
                        @if($product->discount_price == NULL)
                        <div class="product-price mt-10">
                           <span>${{ $product->selling_price }} </span>
                        </div>
                        @else
                        <div class="product-price mt-10">
                           <span>${{ $product->discount_price }} </span>
                           <span class="old-price">${{ $product->selling_price }}</span>
                        </div>
                        @endif
                        <div class="sold mt-15 mb-15">
                           <div class="progress mb-5">
                              <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                           <span class="font-xs text-heading"> Sold: 90/120</span>
                        </div>
                        <a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                     </div>
                  </div>
               </div>
               <!--end product card-->
               @endforeach
            </div>
            <!--End product-grid-4-->
         </div>
      </div>
      <!--End tab-content-->
   </div>
</section>
<!--End Computer Category -->
<section class="section-padding mb-30">
   <div class="container">
      <div class="row">
         <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
            <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
            <div class="product-list-small animated animated">
               @foreach($hot_deals as $item)                   
               <article class="row align-items-center hover-up">
                  <figure class="col-md-4 mb-0">
                     <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"><img src="{{ asset( $item->product_thambnail ) }}" alt="" /></a>
                  </figure>
                  <div class="col-md-8 mb-0">
                     <h6>
                        <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                        @if(session()->get('language') == 'bangla') 
                        {{ $product->product_name_bn }}
                        @else 
                        {{ $product->product_name_en }}
                        @endif
                        </a>
                     </h6>
                     @php
                     $reviewcount = App\Models\Review::where('product_id',$item->id)->where('status',1)->latest()->get();
                     $avarage = App\Models\Review::where('product_id',$item->id)->where('status',1)->avg('rating');
                     @endphp
                     <div class="product-rate-cover">
                        <div class="product-rate d-inline-block">
                           @if($avarage == 0)

                           @elseif($avarage == 1 || $avarage < 2)                     
                        <div class="product-rating" style="width: 20%"></div>
                           @elseif($avarage == 2 || $avarage < 3)                     
                        <div class="product-rating" style="width: 40%"></div>
                           @elseif($avarage == 3 || $avarage < 4)                     
                        <div class="product-rating" style="width: 60%"></div>
                           @elseif($avarage == 4 || $avarage < 5)                     
                        <div class="product-rating" style="width: 80%"></div>
                           @elseif($avarage == 5 || $avarage < 5)                     
                        <div class="product-rating" style="width: 100%"></div>
                        @endif
                        </div>
                        <span class="font-small ml-5 text-muted"> ({{count($reviewcount)}})</span>
                     </div>
                     @if($item->discount_price == NULL)
                     <div class="product-price">
                        <span>${{ $item->selling_price }}</span>
                     </div>
                     @else
                     <div class="product-price">
                        <span>${{ $item->discount_price }}</span>
                        <span class="old-price">${{ $item->selling_price }}</span>
                     </div>
                     @endif
                  </div>
               </article>
               @endforeach
            </div>
         </div>
         <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
            <h4 class="section-title style-1 mb-30 animated animated">  Special Offer </h4>
            <div class="product-list-small animated animated">
               @foreach($special_offer  as $item)                   
               <article class="row align-items-center hover-up">
                  <figure class="col-md-4 mb-0">
                     <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"><img src="{{ asset( $item->product_thambnail ) }}" alt="" /></a>
                  </figure>
                  <div class="col-md-8 mb-0">
                     <h6>
                        <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                        @if(session()->get('language') == 'bangla') 
                        {{ $product->product_name_bn }}
                        @else 
                        {{ $product->product_name_en }}
                        @endif
                        </a>
                     </h6>
                    @php
                    $reviewcount = App\Models\Review::where('product_id',$item->id)->where('status',1)->latest()->get();
                    $avarage = App\Models\Review::where('product_id',$item->id)->where('status',1)->avg('rating');
                    @endphp
                     <div class="product-rate-cover">
                        <div class="product-rate d-inline-block">
                           @if($avarage == 0)

                           @elseif($avarage == 1 || $avarage < 2)                     
                        <div class="product-rating" style="width: 20%"></div>
                           @elseif($avarage == 2 || $avarage < 3)                     
                        <div class="product-rating" style="width: 40%"></div>
                           @elseif($avarage == 3 || $avarage < 4)                     
                        <div class="product-rating" style="width: 60%"></div>
                           @elseif($avarage == 4 || $avarage < 5)                     
                        <div class="product-rating" style="width: 80%"></div>
                           @elseif($avarage == 5 || $avarage < 5)                     
                        <div class="product-rating" style="width: 100%"></div>
                        @endif
                        </div>
                        <span class="font-small ml-5 text-muted"> ({{count($reviewcount)}})</span>
                     </div>
                     @if($item->discount_price == NULL)
                     <div class="product-price">
                        <span>${{ $item->selling_price }}</span>
                     </div>
                     @else
                     <div class="product-price">
                        <span>${{ $item->discount_price }}</span>
                        <span class="old-price">${{ $item->selling_price }}</span>
                     </div>
                     @endif
                  </div>
               </article>
            @endforeach
            </div>
         </div>
         <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
            <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
            <div class="product-list-small animated animated">
               @foreach($new as $item)                   
               <article class="row align-items-center hover-up">
                  <figure class="col-md-4 mb-0">
                     <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"><img src="{{ asset( $item->product_thambnail ) }}" alt="" /></a>
                  </figure>
                  <div class="col-md-8 mb-0">
                     <h6>
                        <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                        @if(session()->get('language') == 'bangla') 
                        {{ $product->product_name_bn }}
                        @else 
                        {{ $product->product_name_en }}
                        @endif
                        </a>
                     </h6>
                     @php
                     $reviewcount = App\Models\Review::where('product_id',$item->id)->where('status',1)->latest()->get();
                     $avarage = App\Models\Review::where('product_id',$item->id)->where('status',1)->avg('rating');
                     @endphp
                     <div class="product-rate-cover">
                        <div class="product-rate d-inline-block">
                           @if($avarage == 0)

                           @elseif($avarage == 1 || $avarage < 2)                     
                        <div class="product-rating" style="width: 20%"></div>
                           @elseif($avarage == 2 || $avarage < 3)                     
                        <div class="product-rating" style="width: 40%"></div>
                           @elseif($avarage == 3 || $avarage < 4)                     
                        <div class="product-rating" style="width: 60%"></div>
                           @elseif($avarage == 4 || $avarage < 5)                     
                        <div class="product-rating" style="width: 80%"></div>
                           @elseif($avarage == 5 || $avarage < 5)                     
                        <div class="product-rating" style="width: 100%"></div>
                        @endif
                        </div>
                        <span class="font-small ml-5 text-muted"> ({{count($reviewcount)}})</span>
                     </div>
                     @if($item->discount_price == NULL)
                     <div class="product-price">
                        <span>${{ $item->selling_price }}</span>
                     </div>
                     @else
                     <div class="product-price">
                        <span>${{ $item->discount_price }}</span>
                        <span class="old-price">${{ $item->selling_price }}</span>
                     </div>
                     @endif
                  </div>
               </article>
               @endforeach
            </div>
         </div>
         <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
            <h4 class="section-title style-1 mb-30 animated animated"> Special Deals </h4>
            <div class="product-list-small animated animated">
               @foreach($special_deals  as $item)                   
               <article class="row align-items-center hover-up">
                  <figure class="col-md-4 mb-0">
                     <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"><img src="{{ asset( $item->product_thambnail ) }}" alt="" /></a>
                  </figure>
                  <div class="col-md-8 mb-0">
                     <h6>
                        <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                        @if(session()->get('language') == 'bangla') 
                        {{ $product->product_name_bn }}
                        @else 
                        {{ $product->product_name_en }}
                        @endif
                        </a>
                     </h6>
                     @php
                     $reviewcount = App\Models\Review::where('product_id',$item->id)->where('status',1)->latest()->get();
                     $avarage = App\Models\Review::where('product_id',$item->id)->where('status',1)->avg('rating');
                     @endphp
                     <div class="product-rate-cover">
                        <div class="product-rate d-inline-block">
                           @if($avarage == 0)

                           @elseif($avarage == 1 || $avarage < 2)                     
                        <div class="product-rating" style="width: 20%"></div>
                           @elseif($avarage == 2 || $avarage < 3)                     
                        <div class="product-rating" style="width: 40%"></div>
                           @elseif($avarage == 3 || $avarage < 4)                     
                        <div class="product-rating" style="width: 60%"></div>
                           @elseif($avarage == 4 || $avarage < 5)                     
                        <div class="product-rating" style="width: 80%"></div>
                           @elseif($avarage == 5 || $avarage < 5)                     
                        <div class="product-rating" style="width: 100%"></div>
                        @endif
                        </div>
                        <span class="font-small ml-5 text-muted"> ({{count($reviewcount)}})</span>
                     </div>
                     @if($item->discount_price == NULL)
                     <div class="product-price">
                        <span>${{ $item->selling_price }}</span>
                     </div>
                     @else
                     <div class="product-price">
                        <span>${{ $item->discount_price }}</span>
                        <span class="old-price">${{ $item->selling_price }}</span>
                     </div>
                     @endif
                  </div>
               </article>
               @endforeach
            </div>
         </div>
      </div>
   </div>
</section>
<!--End 4 columns-->
<!--Vendor List -->
@include('frontend.home.home_vendor_list')
<!--End Vendor List -->
@endsection