<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Pdf</title>
</head>
<body>
    <h1>Order Details</h1>
    <div style="display: flex; flex-direction:column; gap:0.5rem;">
        <div>
            Customer name:
            <h3>{{$order->name }}</h3>
        </div>
        <div>
           Customer email :
           <h3>{{$order->email }}</h3>
        </div>
        <div>
            Customer phone: <br>
            <h3>{{$order->phone }}</h3>
        </div>
        <div>
           Delivery address : <h3>{{$order->address }}</h3>
        </div>
        <div>
            Customer id: <h3>{{$order->user_id }}</h3>
        </div>
        <div>
            Product title: <h3>{{$order->product_title }}</h3>
        </div>
        <div>
           Total price : <h3>{{$order->price }}</h3>
        </div>
        <div>
           Quantity : <h3>{{$order->quantity }}</h3>
        </div>
        <div>
            Product id: <h3>{{$order->product_id }}</h3>
        </div>
        <div>
            Payment mode: <h3>{{$order->payment_mode }}</h3>
        </div>
        <div>
            Payment status: <h3>{{$order->payment_status }}</h3>
        </div>
        <div>
            Delivery status: <h3>{{$order->delivery_status }}</h3>
        </div>
        <img
            style="height: 200px; width:200px;"
            src="product/{{$order->image }}"
            alt="product image"
        >
        {{-- <div>
            <img
            style="height: 200px; width:200px;"
            src="product/{{$order->image }}"
            alt="product image"
            />
        </div> --}}
    </div>
</body>
</html>
