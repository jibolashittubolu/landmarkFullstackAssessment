
<!DOCTYPE html>
<html lang="en">
  <head>
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

        .th_deg{
/* background-color: red; */
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

                <div class="div_center">
                    <h2 class="h2_font">All Products</h2>
                </div>


                <table class="center">
                    <tr class="th_color">
                        <th class="th_deg">Product title</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Price (&#8358;)</th>
                        <th>Discount Price (&#8358;)</th>
                        <th>Brand</th>
                        <th>Store</th>
                        <th>Product Image</th>
                        <th>Action</th>
                    </tr>

                    @if ($product)

                    @foreach ( $product as $product )

                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->price }} </td>
                        <td>{{ $product->discount_price }}</td>
                        <td>{{ $product->productBrand }}</td>
                        <td>{{ $product->productStore }}</td>
                        <td>
                            <img
                            src="/product/{{$product->image}}"
                            class="img_size"
                            alt="product image"  />
                        </td>
                        {{-- <td>{{ $product->title }}</td> --}}
                        <td>
                            <a
                            onclick="
                                return confirm('Are you sure you want to delete this?')
                            "

                            class="btn btn-danger"
                            href="{{ url('delete_product', $product->id) }}">
                                Delete
                            </a>

                            <a
                            onclick="
                                return confirm('Are you sure you want to update this?')
                            "

                            class="btn btn-warning"
                            href="{{ url('update_product', $product->id) }}">
                                Update
                            </a>
                        </td>
                    </tr>

                    @endforeach

                    @endif


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
