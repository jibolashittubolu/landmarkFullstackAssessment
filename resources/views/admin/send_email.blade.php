
<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public" />
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
        <div class="main-panel">
            <div
            style="text-align: center; margin:auto;"
            class="content-wrapper">

                @if(session()->has('message'))
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

                <h1 style="margin: 2rem 0rem; font-size: 2rem" >Send Email to {{$order->email}} </h1>

                <form
                method="POST"
                action="{{url('send_user_email', $order->id)}}"
                style="display: flex; flex-direction:column; gap:1rem;">
                @csrf
                    <div>
                        <label>Email Greeting</label>
                        <input
                        type="text"
                        name="greeting"
                        style="color:black;"
                        />
                    </div>
                    <div>
                        <label>First Line</label>
                        <input
                        type="text" name="firstLine"
                        style="color:black;"/>
                    </div>
                    <div>
                        <label>Email Body</label>
                        <input
                        type="text" name="body"
                        style="color:black;"/>
                    </div>
                    <div>
                        <label>Email Button name</label>
                        <input
                        type="text" name="button"
                        style="color:black;"/>
                    </div>
                    <div>
                        <label>Email Url</label>
                        <input
                        type="text" name="url"
                        style="color:black;"/>
                    </div>
                    <div>
                        <label>Last line</label>
                        <input
                        type="text" name="lastline"
                        style="color:black;"/>
                    </div>
                    <div>
                        <input
                        type="submit"
                        class="btn btn-primary"
                        value="Send Email" />
                    </div>
                </form>

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
