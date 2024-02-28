
<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public" >
    @include('admin.css')

    <style>
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
            border: 1px solid white;
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
            border-bottom: 1px solid white;
            /* display: flex; */
            gap: 1rem;
        }
        .title_deg{
            margin: auto;
            text-align: center;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }

    </style>
  </head>
  <body>
    <div class="container-scroller">

      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->

        @include('admin.header')
        <!-- partial -->
        {{-- main-panel starts --}}
        <div class="main-panel">
            <div class="content-wrapper">

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

                <h1 class="title_deg">All Orders</h1>

                {{-- search field --}}
                <div style=" display:flex; align-items:center; justify-content:center; margin-bottom:2rem;">
                    <form
                    style="color:black;"
                    action="{{url('search')}}"
                    method="GET"
                    >
                    @csrf
                        <input type="text" name="search" placeholder="search for an item" />
                        <input type="submit" value="Search" class="btn btn-primary" />
                    </form>
                </div>

                <table style="border: 1px solid white; width: 100%; margin:auto; ">
                    <tr style="border-bottom: 1px solid white;">
                        <th >Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Product Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Store</th>
                        <th>Payment status</th>
                        <th>Delivery status</th>
                        <th>Payment mode</th>
                        <th>Image</th>
                        <th>Delivered</th>
                        <th>Print Invoice/Receipt</th>
                        <th>Send Email</th>
                    </tr>
                    @forelse ($order as $order)
                    <tr>
                        <td>{{$order->name}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->address}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{$order->product_title}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->productRef ? $order->productRef->productStore : '' }}</td>
                        <td>{{$order->payment_status}}</td>
                        <td>{{$order->delivery_status}}</td>
                        <td>{{$order->payment_mode}}</td>
                        <td>
                            <img
                            class="img_size"
                            src="product/{{$order->productRef ?  $order->productRef->image : ''}}"
                            alt="product image"
                            />
                        </td>
                        <td>
                            {{-- <a
                            href=""
                            class="btn btn-danger">No</a>
                            <a
                            href=""
                            class="btn btn-primary">Yes</a> --}}
                            <form
                            {{-- onsubmit="event.preventDefault(); submitForm();" --}}
                            style="color: black"
                            method="POST"
                            action=" {{ url('/set-delivery-status', $order->id) }}"
                            >
                                @csrf
                                <select name="delivery_status">
                                    <option
                                    value={{$order->delivery_status}}>{{$order->delivery_status}}</option>
                                    <option value="processing">processing</option>
                                    <option value="delivered">delivered</option>
                                    <option value="in transit">in transit</option>
                                    <option value="failed">failed</option>
                                </select>
                                <div style="display:flex; gap: 1rem;">

                                    <input
                                    type="submit"
                                    title="set"
                                    class="btn btn-primary">
                                    <span style="color: white;">


                                    @if ($order->delivery_status == 'delivered'  )
                                    <span
                                        style="min-width: 2rem; min-height:2rem; line-height:1; border-radius:50%; background-color:lime;">
                                        +
                                    </span>
                                    @endif
                                </div>

                            </form>
                        </td>
                        <td>
                            <a
                            href="{{url('print_pdf', $order->id)}}"
                            class="btn btn-secondary" >Print</a>
                        </td>
                        <td>
                            <a
                            href="{{url('send_email', $order->id)}}"
                            class="btn btn-info">
                            Send Email
                            </a>
                        </td>
                    </tr>

                    @empty
                    <div>
                        <tr>
                            <td colspan="16">
                                No data found
                            </td>
                        </tr>
                    </div>

                    @endforelse
                </table>


            </div>
        </div>

        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
  </body>
</html>
