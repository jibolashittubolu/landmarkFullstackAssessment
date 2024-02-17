<!DOCTYPE html>
<html>
   <head>
      <base href="/public" >
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="home/images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
    </head>
    <body>
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
         <!-- end slider section -->

         @if(session()->has('message'))
         {{-- @else --}}
            <div class="alert alert-success">
                <button
                type="button"
                class="close"
                data-dismiss="alert"
                aria-hidden="true">x</button>
                {{
                session()->get('message')
                }}
            </div>
        @endif
        <div
        style="margin: auto; width:80%; padding:1rem; padding-top:2rem;"
        class="col-sm-6 col-md-4 col-lg-4"
        >
            {{-- <div class="box">
            <div class="option_container">
                <div class="options">
                    <a href="{{url('/product_details', $product->id)}}" class="option1">
                        Product Details
                    </a>
                    <a href="" class="option2">
                    Buy Now
                    </a>
                </div>
            </div> --}}
            <div  style="padding: 1rem;" class="img-box">
                <img src="/product/{{$product->image}}" alt="">
            </div>
            <div class="detail-box">
                <h5>
                    {{$product->title}}
                </h5>

                @if ($product->discount_price != null)
                    <h6
                    style="text-decoration: line-through;">
                        &#8358; {{$product->price}}
                    </h6>
                    <h6>
                        Now: &#8358; {{$product->discount_price}}
                    </h6>

                @else
                    <h6>s
                        &#8358; {{$product->price}}
                    </h6>
                @endif

                <div style="display: flex; flex-direction:column; gap:0.7rem;">
                    <h6>Product Description: {{$product->description}}</h6>
                    <h6>Brand: {{$product->productBrand}}</h6>
                    <h6>Store: {{$product->productStore}}</h6>
                    <h6>Product Category: {{$product->category}}</h6>
                    <h6>Available Quantity: {{$product->quantity}}</h6>
                </div>

                <form
                action="{{url('add_cart', $product->id)}}"
                method="POST"
                >
                    @csrf
                    <div class="row" style="margin-top: 1rem;">
                        <div class="col-md-4">
                            <input
                            name="quantity"
                            type="number"
                            value="1"
                            min="1"
                            {{-- max=5 --}}
                            max={{$product->quantity}}
                            />
                        </div>
                        <div class="col-md-4">
                            <input
                            type="submit"
                            value="Add to Cart"
                            />
                        </div>
                    </div>
                </form>

                {{-- <a href="" class="btn btn-primary">
                    Add to Cart
                </a> --}}

            </div>
            </div>
        </div>



      <!-- footer start -->
        @include('home.footer')
      <!-- footer end -->

        <div class="cpy_">
            <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

            </p>

        </div>
       <!-- jQery -->
        <script src="home/js/jquery-3.4.1.min.js"></script>
       <!-- popper js -->
        <script src="home/js/popper.min.js"></script>
        <!-- bootstrap js -->
        <script src="home/js/bootstrap.js"></script>
        <!-- custom js -->
        <script src="home/js/custom.js"></script>
   </body>
</html>
