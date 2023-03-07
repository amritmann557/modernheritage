<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        return view('Product.product')->with('product',$products);
    }
    public function show($id)
    {
        $products = Product::where('id', $id)->first();
        return view('Product.productDetails', compact('products'));
         
    }
    public function cart()
    {
        return view('cart.index');
         
    }
    public function shop($id)
    {

        if(!empty(request()->sub_id))
        {
            $product = Product::where('SubCategory_id',request()->sub_id)->where('Category_id',$id)->get();
        }
        else
        {
            $product = Product::where('Category_id',$id)->orderBy('id')->get();
        }
        $category_id = $id;
        $subcategory_id = request()->sub_id;

        return view('Frontend.Product.product_page',compact('category_id','subcategory_id'))->with('product',$product);

    }

}