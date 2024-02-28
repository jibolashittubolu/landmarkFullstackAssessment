<!DOCTYPE html>
<html>
   <head>
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

      <style type="text/css">
        .div_center{
            text-align: center;
            padding-top: 1rem ;
            /* width: 100%;
            display: flex;
            align-items: center;
            justify-content: center; */
        }

        .h2_font{
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .input_color{
            color: black;
        }

        .center{
            margin: auto;
            width: 90%;
            text-align: center;
            margin-top: 2rem;
            border: 1px solid gray;
        }

        label{
            display: inline-block;
            width: 200px;
        }

        .div_design{
            padding-bottom: 2rem;
        }

        .img_size{
            height: 100px;
            width: 200px;
            object-fit: cover
        }

        .th_color{
            /* border-bottom: 1px solid white; */
            /* display: flex; */
            gap: 1rem;
        }

        .th_deg{
            font-size: 1.4rem;
            padding: 0.3rem;
            background-color: gainsboro;
/* background-color: red; */
        }
    </style>
   </head>
   <body>
      @include('home.header')
      {{-- main body starts --}}
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

      <div>
        <table class="center">
            <tr class="th_color">
                <th class="th_deg">Product title</th>
                <th
                class="th_deg"
                >Quantity</th>
                <th
                class="th_deg">Price (&#8358;)</th>
                {{-- <th>Discount Price (&#8358;)</th> --}}
                <th
                class="th_deg">Payment Status</th>
                <th
                class="th_deg">Delivery Status</th>
                <th
                class="th_deg">Image</th>
                <th
                class="th_deg">Action</th>


            </tr>

            <?php $totalPrice=0; ?>

            @if ($order)
                @if ( count($order) > 0 )
                    @foreach ( $order as $order )

                    <tr>
                        <td>{{ $order->product_title }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td> &#8358; {{ $order->price }} </td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->delivery_status }}</td>

                        <td >
                            <img
                            style="margin: auto;"
                            src="/product/{{$order->image}}"
                            class="img_size"
                            alt="product image"  />
                        </td>
                        <td
                        >
                            @if ($order->delivery_status=='processing')
                                <a
                                onclick="
                                    return confirm('Do you want to cancel this order?')
                                "
                                class="btn btn-danger"
                                href="{{ url('cancel_order', $order->id) }}">
                                    Cancel order
                                </a>
                            @endif




                        </td>
                    </tr>

                    <?php $totalPrice = $totalPrice + $order->price; ?>
                    @endforeach
                @else
                    <div style="margin: auto; text-align:center; margin-top:2rem; font-size:2rem; font-weight:300;">There are no products in your cart, please add some products</div>
                @endif
            @endif


        </table>
        <div>
            <h1 style="padding: 2rem; margin:auto; font-size:1.5rem; text-align:center;">
            Total Price:
            &#8358; {{$totalPrice}}

            </h1>

        </div>
        <div style="margin: auto; text-align:center; margin-bottom:2.5rem;">
            <h1>Proceed to order</h1>
            <a
            href="{{url('/cash_order')}}"
            onclick="
            return confirm('Confirm order?')
            "
            class="btn btn-danger"> Cash on delivery</a>
            <a
            href="{{URL('/stripe', $totalPrice)}}"
            class="btn btn-danger"> Pay with card</a>
        </div>
      </div>

      {{-- main body ends --}}

      <!-- footer start -->
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
