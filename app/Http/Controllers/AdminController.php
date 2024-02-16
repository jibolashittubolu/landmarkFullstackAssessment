<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductStore;

class AdminController extends Controller
{
    //category starts
    public function view_category(){
        $data = Category::all();

        return view("admin.category", compact("data"));
    }

    public function add_category(Request $request){
        $data = new Category;
        $data->category_name = $request->category;
        $data->save();
        return redirect()->back()->with('message', 'Category added successfully');
        // return redirect("")->with("success","");
    }

    public function delete_category($id){

        $data = Category::find($id);
        $data->delete();

        return redirect()->back()->with('message','Category has now been deleted');
    }
    //category ends

    //product brand starts
    public function viewProductBrand(){
        $data = ProductBrand::all();

        return view("admin.productBrand.productBrandPage", compact("data"));
    }

    public function addProductBrand(Request $request){
        $data = new ProductBrand;
        $data->productBrand = $request->productBrand;
        $data->save();
        return redirect()->back()->with('message', 'Product Brand added successfully');
        // return redirect("")->with("success","");
    }

    public function deleteProductBrand($id){

        $data = ProductBrand::find($id);
        $data->delete();

        return redirect()->back()->with('message','Product Brand has now been deleted');
    }
    //product brand ends

    //product store starts
    public function viewProductStore(){
        $data = ProductStore::all();

        return view("admin.productStore.productStorePage", compact("data"));
    }

    public function addProductStore(Request $request){
        $data = new ProductStore;
        $data->productStore = $request->productStore;
        $data->save();
        return redirect()->back()->with('message', 'Product Store added successfully');
        // return redirect("")->with("success","");
    }

    public function deleteProductStore($id){

        $data = ProductStore::find($id);
        $data->delete();

        return redirect()->back()->with('message','Product Store has now been deleted');
    }
    //product store ends


    //product starts
    public function view_product(){
        $category = Category::all();
        $productBrands = ProductBrand::all();
        $productStores = ProductStore::all();
        $data = Product::all();
        return view('admin.product', compact('data', 'category', 'productBrands', 'productStores'));
        // return view('admin.product', compact('datum'));
    }


        //view
    public function show_product(){
        //this is supposed to be pluralized actually
        $category = Category::all();
        $productBrands = ProductBrand::all();
        $productStores = ProductStore::all();
        $product = Product::all(); //should be $products or
        return view('admin.show_product', compact('product', 'category', 'productBrands', 'productStores'));
        // return view('admin.product', compact('datum'));
    }

        //action
    public function add_product(Request $request){
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

        //action
    public function delete_product($id){

        $product = Product::find($id);
        $product->delete();

        return redirect()->back()->with('message','Product has now been deleted');
    }

        //view
    public function update_product($id){

        $product = Product::find($id);
        $allProducts = Product::all();
        $category = Category::all();
        $productBrands = ProductBrand::all();
        $productStores = ProductStore::all();

        return view('admin.update_product', compact('product','allProducts', 'category', 'productBrands', 'productStores'));

        // return redirect()->back()->with('message','Product has just been updated');
    }

        //action
    public function update_product_confirm( Request $request, $id){

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
    //product ends
}
