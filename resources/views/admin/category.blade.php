
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
                    <h2 class="h2_font">Add Category</h2>
                    <form
                    action=" {{url('/add_category')}} "
                    method="POST"
                    >
                        @csrf
                        <input
                        type="text"
                        name="category"
                        placeholder="Input category name"
                        class="input_color"
                        />
                        <input
                        type="submit"
                        name="submit"
                        value="Add Catagory"
                        class="btn btn-primary"
                        />
                    </form>
                </div>

                <table class="center">
                    <tr>
                        <td>Category Name</td>
                        <td>Action</td>
                    </tr>

                    @foreach ( $data as $data )

                    <tr>
                        <td>{{ $data->category_name }}</td>
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
