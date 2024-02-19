<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;

use Illuminate\Support\Facades\Log; // Import Log facade

use Session;
use Stripe;
use Exception;

class HomeController extends Controller
{
    //
    public function index(){
        try{

            $product = Product::paginate(6);
            return view('home.userpage', compact('product'));
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }

    public function redirect(){
        try{
            $usertype=Auth::user()->usertype;

            // return view('admin.home');
            // return view('welcome');

            if($usertype == '1'){
                return view('admin.home');
            }
            else{
                $product = Product::paginate(6);
                return view('home.userpage', compact('product'));
                // return view('dashboard');
                // return view('admin.home');
            }
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }


    public function product_details($id){
        $product = Product::find($id);

        return view("home.product_details", compact("product"));
    }




    //add product to cart
    public function add_cart(Request $request, $id){

        try{
            if(Auth::id()){
                // return redirect()->back();
                $user = Auth::user();
                $product = Product::find($id);


                // dd($id);
                //if product is in cart arlready, just increment the quantity, and the price
                // $existingCartItem = Cart::find($id);
                // $existingCartItem = Cart::where('product_id','=', $id)->get();
                // $existingCartItem = Cart::where('product_id', $id)->first();
                $existingCartItem = Cart::where('product_id', $id)
                            ->where('user_id', $user->id)
                            ->first();


                //if there is an existing cart item
                if($existingCartItem){

                    // $existingCartItem->price = $existingCartItem->price + ($product->price * $request->quantity);

                    if($product->discount_price != null){
                        $existingCartItem->price = $existingCartItem->price + ($product->discount_price * $request->quantity);
                        // $cart->price = $product->discount_price * $request->quantity ;
                    }
                    else{
                        $existingCartItem->price = $existingCartItem->price + ($product->price * $request->quantity);
                        // $cart->price = $product->price * $request->quantity;
                    }

                    $existingCartItem->quantity = $existingCartItem->quantity + $request->quantity;  //request

                    $existingCartItem->save();

                    return redirect()->back()->with('message','Product has been added to your cart');
                }


                //if no exact product (i.e with the same id) exists
                $cart = new Cart();

                $cart->user_id = $user->id;
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;


                $cart->product_id = $product->id;
                $cart->product_title = $product->title;
                // $cart->price = $product->price;
                if($product->discount_price != null){
                    $cart->price = $product->discount_price * $request->quantity ;
                }
                else{
                    $cart->price = $product->price * $request->quantity;
                }
                $cart->quantity = $request->quantity;  //request
                $cart->image = $product->image;

                $cart->save();

                return redirect()->back()->with('message','Product has just been added to your cart');

                // return redirect()->back();
            }

            else{
                return redirect('login');
            }
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }

    public function modifyCartItemQuantity( Request $request, $id){

        try{
            if($request->newCartItemQuantity){

            }

            $cart = Cart::find($id);

            //calculate per item cost instead of asking db or compact for the item cost
            //but to be secure, rather get the item cost from db
            //cart->quantity is the old quantity in the db
            $perItemCost = $cart->price / $cart->quantity;
            // dd($perItemCost);


            //set the new price to db
            $cart->price = $perItemCost * $request->newCartItemQuantity;
            // dd($request->newCartItemQuantity);

            // dd($cart->price, $cart->quantity );

            //set received qty to db
            $cart->quantity = $request->newCartItemQuantity;


            $cart->save();

            // dd($cart->price );

            return redirect()->back()->with('message','Product quantity modified');
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }


    public function show_cart(){

        try{
            if(Auth::id()){
                $id = Auth::user() -> id;
                $cart = Cart::where('user_id','=', $id)->get();


                // Fetch products associated with each cart item
                // Fetch products associated with each cart item
                $cartProducts = $cart->map(function ($item) {
                    $product = Product::find($item->product_id);
                    if ($product) {
                        $item->productRef = $product;
                    } else {
                        $item->productRef = null; // Handle case where product is not found
                    }
                    return $item;
                });

                $cart = $cartProducts;
                //now we have a ref of $cart->product

                // dd($cartProducts);
                // foreach ($cart as $cartItem) {
                //     $product = Product::find($cartItem->product_id);
                // // dd($cart);

                //     if ($product) {
                //         $cart->productRef = $product;
                //     } else {
                //         $cart->productRef = null;
                //     }
                //     // $cart->productRef = $product;
                // }
                // dd($cart);

                return view("home.showcart", compact('cart'));
            }

            //below means you are not authenticated

            return redirect('login');
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }

    public function remove_cart($id){
        try{
            $cart = Cart::find($id);
            $cart->delete();

            return redirect()->back()->with('message','Product has been removed from your cart');
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }

    }



    public function cash_order(){
        try{
            $user = Auth::user();

            $userid = $user->id;

            $cartItems = Cart::where('user_id','=', $userid)->get();
            foreach ($cartItems as $cartItem) {
                $order = new Order;
                // $order->user_id = $userid;

                $order->name = $cartItem->name;
                $order->cart_id = $cartItem->id; //not particularly useful
                $order->email = $cartItem->email;
                $order->phone = $cartItem->phone;
                $order->address = $cartItem->address;
                $order->user_id = $cartItem->user_id;
                $order->product_title = $cartItem->product_title;
                $order->price = $cartItem->price;
                $order->quantity = $cartItem->quantity;
                $order->image = $cartItem->image;
                $order->product_id = $cartItem->product_id;
                $order->payment_mode = 'cash on delivery'; //in future use numeric for scalability
                $order->payment_status = 'unpaid'; //in future use numeric for scalability
                $order->delivery_status = 'processing'; //in future use numeric for scalability

                $order->save();

                //deletes the cart item
                $cart_id = $cartItem->id;
                $cart=Cart::find($cart_id);
                $cart->delete();
            }

            return redirect()->back()->with('message','Order received. We will connect with you soon');
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }

    }

    public function stripe($totalPrice){
        try{
            return view('home.stripe', compact('totalPrice'));
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }



    public function stripePost(Request $request, $totalPrice)
    {
        try{
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            // dd($totalPrice);
            $totalPriceFixed = ($totalPrice / 1500) > 1 ? ($totalPrice / 1500) : 1;
            //cant be less than 1

            Stripe\Charge::create ([
                    "amount" => $totalPriceFixed  * 100,
                    "currency" => "usd",
                    "source" => $request->stripeToken,
                    "description" => "Test payment from jibolashittubolu"
            ]);


            $user = Auth::user();
            $userid = $user->id;
            $cartItems = Cart::where('user_id','=', $userid)->get();
            foreach ($cartItems as $cartItem) {
                $order = new Order;
                // $order->user_id = $userid;

                $order->name = $cartItem->name;
                $order->cart_id = $cartItem->id; //not particularly useful
                $order->email = $cartItem->email;
                $order->phone = $cartItem->phone;
                $order->address = $cartItem->address;
                $order->user_id = $cartItem->user_id;
                $order->product_title = $cartItem->product_title;
                $order->price = $cartItem->price;
                $order->quantity = $cartItem->quantity;
                $order->image = $cartItem->image;
                $order->product_id = $cartItem->product_id;
                $order->payment_mode = 'card';
                $order->payment_status = 'paid'; //in future use numeric for scalability
                $order->delivery_status = 'processing'; //in future use numeric for scalability

                $order->save();

                //deletes the cart item
                $cart_id = $cartItem->id;
                $cart=Cart::find($cart_id);
                $cart->delete();
            }

            Session::flash('success', 'Payment successful!');

            return back();
        }
        catch(Stripe\Exception\CardException $e){
            // Handle card errors
            $error = $e->getError();
            Session::flash('error', 'Payment failed: ' . $error->message);
        }
        catch (\Exception $e) {
            // Handle other errors
            Log::error('Stripe payment error: ' . $e->getMessage());
            Session::flash('error', 'An error occurred while processing your payment. Please try again later.');
        }
        return back();
    }


}
