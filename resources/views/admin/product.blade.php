
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
            width: 50%;
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
                    <h2 class="h2_font">Add Product</h2>
                    <form
                    action=" {{url('/add_product')}} "
                    method="POST"
                    enctype="multipart/form-data"
                    >
                        @csrf

                        <div class="div_design">
                            <label>Product Title :</label>
                            <input
                            type="text"
                            name="title"
                            placeholder="Input product title"
                            class="input_color"
                            required
                            />
                        </div>
                        <div class="div_design">
                            <label>Product Description :</label>
                            <input
                            type="text"
                            name="description"
                            placeholder="Input product description"
                            class="input_color"
                            required
                            />
                        </div>
                        <div class="div_design">
                            <label>Product Price (	&#8358;) :</label>
                            <input
                            type="number"
                            name="price"
                            placeholder="Input product price"
                            class="input_color"
                            required
                            />
                        </div>
                        <div class="div_design">
                            <label>Discount Price 	(&#8358;) :</label>
                            <input
                            type="number"
                            name="dis_price"
                            placeholder="Input price discount"
                            class="input_color"
                            />
                        </div>
                        <div class="div_design">
                            <label>Product Quantity :</label>
                            <input
                            type="number"
                            min="0"
                            name="quantity"
                            placeholder="Input product quantity"
                            class="input_color"
                            required
                            />
                        </div>
                        <div class="div_design">
                            <label>Product Category :</label>
                            <select
                            name="category"
                            style="color: black;" required>
                                <option value="">Add a category</option>
                                @foreach ( $category as $category )
                                    <option value="{{$category->category_name}}"> {{$category->category_name}} </option>
                                @endforeach

                                {{-- <option>Underwear</option> --}}
                                {{-- <option>Electronics</option> --}}
                            </select>
                        </div>
                        <div class="div_design">
                            <label>Product Brand :</label>
                            <select
                            name="productBrand"
                            style="color: black;" required>
                                <option value="">Add a brand</option>
                                @foreach ( $productBrands as $productBrand )
                                    <option value="{{$productBrand->productBrand}}"> {{$productBrand->productBrand}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="div_design">
                            <label>Product Store :</label>
                            <select
                            name="productStore"
                            style="color: black;" required>
                                <option value="">Add a store</option>
                                @foreach ( $productStores as $productStore )
                                <option value="{{$productStore->productStore}}"> {{$productStore->productStore}} </option>
                            @endforeach
                            </select>
                        </div>

                        <div class="div_design">
                            <label>Product Image :</label>
                            <input
                            type="file"
                            name="image"
                            placeholder="Input product title"
                            class="input_color"
                            required
                            />
                        </div>
                        <div class="div_design">
                            <input
                            type="submit"
                            name="submit"
                            value="Add Product"
                            class="btn btn-primary"
                            />
                        </div>
                    </form>
                </div>

                <table class="center">
                    <tr>
                        <td>Product Name</td>
                        <td>Action</td>
                    </tr>

                    @if ($data)

                    @foreach ( $data as $data )

                    <tr>
                        <td>{{ $data->title }}</td>
                        <td>
                            <a
                            onclick="
                                return confirm('Are you sure you want to delete this?')
                            "

                            class="btn btn-danger"
                            href="{{ url('delete_category', $data->id) }}">
                                Delete
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
