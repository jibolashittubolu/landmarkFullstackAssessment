<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    //
    public function index(){
        $product = Product::paginate(6);
        return view('home.userpage', compact('product'));
    }

    public function redirect(){
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


    public function product_details($id){
        $product = Product::find($id);

        return view("home.product_details", compact("product"));
    }


    public function add_cart(Request $request, $id){
        if(Auth::id()){
            // return redirect()->back();
            $user = Auth::user();
            $product = Product::find($id);

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

    public function modifyCartItemQuantity( Request $request, $id){

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


    public function show_cart(){

        if(Auth::id()){
            $id = Auth::user() -> id;
            $cart = Cart::where('user_id','=', $id)->get();

            // dd($cart);
            return view("home.showcart", compact('cart'));
        }

        //below means you are not authenticated

        return redirect('login');
    }

    public function remove_cart($id){
        $cart = Cart::find($id);
        $cart->delete();

        return redirect()->back()->with('message','Product has been removed from your cart');

    }



}
