<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
            <br/>
            <br/>
            <div>
                <form
                action="{{url('product_search')}}"
                method="GET"
                >
                    @csrf
                    <input
                    name="search"
                    type="text"
                    placeholder="search for product"
                    style="min-width:3rem; width:33rem;"
                    />
                    <input
                    type="submit"
                    value="Search" />
                </form>
            </div>
        </div>
        <div class="row">

            @foreach ( $product as $productv )
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                    <div class="option_container">
                        <div class="options">
                            <a href="{{url('/product_details', $productv->id)}}" class="option1">
                                Product Details
                            </a>
                            {{-- <a href="" class="option2">
                            Buy Now
                            </a> --}}
                            <form
                            action="{{url('add_cart', $productv->id)}}"
                            method="POST"
                            >
                                @csrf
                                <div class="row">
                                    <input
                                    name="quantity"
                                    type="number"
                                    value="1"
                                    min="1"
                                    {{-- max=5 --}}
                                    max={{$productv->quantity}}
                                    />
                                    <input
                                    type="submit"
                                    value="Add to Cart"
                                    />
                                </div>
                            </form>
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
                            <h6>s
                                &#8358; {{$productv->price}}
                            </h6>
                        @endif

                    </div>
                    </div>
                </div>
            @endforeach

        {{-- {!! $product->links('pagination::bootstrap-5') !!} --}}
        {{-- {!! $product->links('pagination::bootstrap-4') !!} --}}

        </div>
        <span style="margin-top: 1rem;">
            {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}
        </span>

        {{-- <div class="btn-box">
            <a href="">
            View All products
            </a>
        </div> --}}


    </div>
</section>
