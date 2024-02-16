
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
                    action=" {{url('/update_product_confirm', $product->id)}} "
                    method="POST"
                    enctype="multipart/form-data"
                    >
                        @csrf

                        <div class="div_design">
                            <label>Product Title :</label>
                            <input
                            value="{{$product->title}}"
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
                            value="{{$product->description}}"
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
                            value="{{$product->price}}"
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
                            value="{{$product->discount_price}}"
                            type="number"
                            name="dis_price"
                            placeholder="Input price discount"
                            class="input_color"
                            />
                        </div>
                        <div class="div_design">
                            <label>Product Quantity :</label>
                            <input
                            value="{{$product->quantity}}"
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
                                <option
                                value="{{$product->category}}"
                                selected>
                                    {{$product->category}}
                                </option>
                                @foreach ( $category as $category )
                                    <option
                                    value="{{$category->category_name}}"> {{$category->category_name}} </option>
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
                                <option
                                value="{{$product->productBrand}}"
                                selected
                                >
                                    {{$product->productBrand}}
                                </option>
                                @foreach ( $productBrands as $productBrand )
                                    <option
                                    {{-- style="display: {{ $productBrand == $product->productBrand ? 'none' : 'block' }};" --}}
                                    value="{{$productBrand->productBrand}}"> {{$productBrand->productBrand}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="div_design">
                            <label>Product Store :</label>
                            <select
                            name="productStore"
                            style="color: black;" required>
                                <option
                                value="{{$product->productStore}}"
                                selected>{{$product->productStore}}</option>
                                @foreach ( $productStores as $productStore )
                                <option
                                value="{{$productStore->productStore}}"> {{$productStore->productStore}} </option>
                            @endforeach
                            </select>
                        </div>

                        <div>
                            <label>Current product image : </label>
                            <img
                            src="/product/{{$product->image}}"
                            style="margin:auto;"
                            class="img_size"
                            alt="product image"  />
                        </div>

                        <div class="div_design">
                            <label>Change Product Image :</label>
                            <input
                            type="file"
                            name="image"
                            placeholder="Input product title"
                            class="input_color"
                            {{-- required --}}
                            />
                        </div>

                        <div class="div_design">
                            <input
                            type="submit"
                            name="submit"
                            value="Update Product"
                            class="btn btn-primary"
                            />
                        </div>
                    </form>
                </div>

                @if ($allProducts)
                    {{-- <div>{{$product}}</div> --}}
                    @if ( count( (array) $allProducts ) > 0)
                        <table class="center">
                            <tr class="th_color">
                                <th class="th_deg">Product title</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Discount Price</th>
                                <th>Brand</th>
                                <th>Store</th>
                                <th>Product Image</th>
                                <th>Action</th>
                            </tr>

                            @foreach ( $allProducts as $product )
                                <tr>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->category }}</td>
                                    <td>{{ $product->price }}</td>
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

                        </table>
                    @else
                        <h2 style="color: white;">No products exist in the system. Please add a product</h2>
                    @endif
                @endif
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
