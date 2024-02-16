<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
        </div>
        <div class="row">

        @foreach ( $product as $productv )
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="box">
                <div class="option_container">
                    <div class="options">
                        <a href="" class="option1">
                            {{$productv->title}}

                        </a>
                        <a href="" class="option2">
                        Buy Now
                        </a>
                    </div>
                </div>
                <div class="img-box">
                    <img src="/product/{{$productv->image}}" alt="">
                </div>
                <div class="detail-box">
                    <h5>
                        {{$productv->title}}
                    </h5>

                    @if ($productv->discount_price != null)
                        <h6
                        style="text-decoration: line-through;">
                            &#8358; {{$productv->price}}
                        </h6>
                        <h6>
                            &#8358; {{$productv->discount_price}}
                        </h6>

                    @else
                        <h6>
                            &#8358; {{$productv->price}}
                        </h6>
                    @endif

                </div>
                </div>
            </div>
        @endforeach

        {{-- {{!!$product->links()!!}} --}}
        {{-- {{$product->links()}} --}}
        {{-- {{!!$product->appends(Request::all())->links()!!}} --}}
        {{-- {{$product->appends(Request::all())->links()}} --}}

        </div>
        <div class="btn-box">
            <a href="">
            View All products
            </a>
        </div>
    </div>
</section>
