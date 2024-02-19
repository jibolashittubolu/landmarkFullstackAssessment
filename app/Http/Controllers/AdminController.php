<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductStore;
use App\Models\Order;
use PDF;

use Exception;

class AdminController extends Controller
{
    //category starts
    public function view_category(){
        try{

            $data = Category::all();

            return view("admin.category", compact("data"));
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }

    public function add_category(Request $request){
        try{
            $data = new Category;
            $data->category_name = $request->category;
            $data->save();
            return redirect()->back()->with('message', 'Category added successfully');
            // return redirect("")->with("success","");
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }

    public function delete_category($id){
        try{
            $data = Category::find($id);
            $data->delete();

            return redirect()->back()->with('message','Category has now been deleted');
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }
    //category ends

    //product brand starts
    public function viewProductBrand(){
        try{

            $data = ProductBrand::all();

            return view("admin.productBrand.productBrandPage", compact("data"));
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }

    public function addProductBrand(Request $request){
        try{
            $data = new ProductBrand;
            $data->productBrand = $request->productBrand;
            $data->save();
            return redirect()->back()->with('message', 'Product Brand added successfully');
            // return redirect("")->with("success","");
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }

    public function deleteProductBrand($id){
        try{

            $data = ProductBrand::find($id);
            $data->delete();

            return redirect()->back()->with('message','Product Brand has now been deleted');
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }
    //product brand ends

    //product store starts
    public function viewProductStore(){
        try{
            $data = ProductStore::all();

            return view("admin.productStore.productStorePage", compact("data"));
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }

    public function addProductStore(Request $request){
        try{
            $data = new ProductStore;
            $data->productStore = $request->productStore;
            $data->save();
            return redirect()->back()->with('message', 'Product Store added successfully');
            // return redirect("")->with("success","");
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }

    public function deleteProductStore($id){
        try{

            $data = ProductStore::find($id);
            $data->delete();

            return redirect()->back()->with('message','Product Store has now been deleted');
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }
    //product store ends


    //product starts
    public function view_product(){
        try{
            $category = Category::all();
            $productBrands = ProductBrand::all();
            $productStores = ProductStore::all();
            $data = Product::all();
            return view('admin.product', compact('data', 'category', 'productBrands', 'productStores'));
            // return view('admin.product', compact('datum'));
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }


        //view
    public function show_product(){
        try{
            //this is supposed to be pluralized actually
            $category = Category::all();
            $productBrands = ProductBrand::all();
            $productStores = ProductStore::all();
            $product = Product::all(); //should be $products or
            return view('admin.show_product', compact('product', 'category', 'productBrands', 'productStores'));
            // return view('admin.product', compact('datum'));
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }

        //action
    public function add_product(Request $request){
        try{
            $product = new Product;
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->discount_price = $request->dis_price;
            $product->quantity = $request->quantity;
            $product->category = $request->category;
            $product->productBrand = $request->productBrand;
            $product->productStore = $request->productStore;

            //for the image, must be special
            // $data->image = $request->image;
            $image = $request->image;
            $imagename = time().'.'.$image->getClientOriginalExtension();
            // $image->move(public_path(''), $imagename);
            $request->image->move('product', $imagename);
            $product->image = $imagename;

            //for the image, must be special

            $product->save();
            return redirect()->back()->with('message', 'Product added successfully');
            // return redirect("")->with("success","");
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }

        //action
    public function delete_product($id){
        try{


            $product = Product::find($id);
            $product->delete();

            return redirect()->back()->with('message','Product has now been deleted');
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }

        //view
    public function update_product($id){
        try{

            $product = Product::find($id);
            $allProducts = Product::all();
            $category = Category::all();
            $productBrands = ProductBrand::all();
            $productStores = ProductStore::all();

            return view('admin.update_product', compact('product','allProducts', 'category', 'productBrands', 'productStores'));

            // return redirect()->back()->with('message','Product has just been updated');
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }

        //action
    public function update_product_confirm( Request $request, $id){
        try{
            $product = Product::find($id);

            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->discount_price = $request->dis_price;
            $product->quantity = $request->quantity;
            $product->category = $request->category;
            $product->productBrand = $request->productBrand;
            $product->productStore = $request->productStore;

            //for the image, must be special
            $image = $request->image;

            if($image){
                $imagename = time().'.'.$image->getClientOriginalExtension();
                $request->image->move('product', $imagename);
                $product->image = $imagename;
            }
            //image ends

            $product->save();
            // $allProducts = Product::all();
            // $category = Category::all();
            // $productBrands = ProductBrand::all();
            // $productStores = ProductStore::all();

            // return view('admin.update_product', compact('product','allProducts', 'category', 'productBrands', 'productStores'));

            return redirect()->back()->with('message','Product has just been updated');
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }
    //product ends


    //order
    public function order(){
        try{
            $order = Order::all();

            $orderItemsWithProductRef = $order->map(function ($orderItem) {
                $product = Product::find($orderItem->product_id);

                if ($product) {
                    $orderItem->productRef = $product;
                } else {
                    $orderItem->productRef = null; // Handle case where product is not found
                }
                return $orderItem;
            });

            $order = $orderItemsWithProductRef;

            return view('admin.order', compact('order'));
        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }


    public function setDeliveryStatus(Request $request, $id){
        try{

            $order = Order::find($id);

            $order->delivery_status = $request->delivery_status;
            // $order->payment_status = 'paid';
            if($request->delivery_status == 'delivered' ){
                $order->payment_status = 'paid';
            }
            else{
                $order->payment_status = 'unpaid';
            }

            //overwrite things
            if($order->payment_mode == 'card'){
                $order->payment_status = 'paid';
            }

            $order->save();
            return redirect()->back()->with('message','Delivery status updated');

        }
        catch(Exception $e){
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }

    public function print_pdf($id){
        try{
            $order = Order::find($id);

            $pdf = PDF::loadView('admin.pdf', compact('order'));
            return $pdf->download('order_details.pdf');
        }
        catch(Exception $e){
            dd($e);
            \Log::error('Error occurred: ' . $e->getMessage());
            return back()->with('message', 'Sorry, an error occurred. Please try again later.');
        }
    }
}
