<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
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
            return view('home.userpage');
            // return view('dashboard');
            // return view('admin.home');
        }
    }
}
