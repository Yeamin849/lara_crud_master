<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//use Illuminate\Http\Facades\validator;

class ProductController extends Controller
{
    // this method will show products page
    public function index(){
        $products = Product::get();  // orderBy('created_at','DESC')->
        return view('products.list',[
            'products' => $products
        ]);
    }
    // this method will show prosucts create page
    public function create(){
        return view('products.create');
    }
    // this method will store a products in db
    public function store(Request $request){
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric',

        ];
        if($request->image != ""){
            $rules['image'] = 'image';

        }
        $validator =  Validator::make($request->all(),$rules);
        
        if($validator->fails()){
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        // heare we will insert product in db

        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if($request->image != ""){

            // heare we will store image

            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext; // unique image name

            // save image to products directory

            $image->move(public_path('uplods/products'),$imageName);

            $product->image = $imageName;
            $product->save();

        }
       
        return redirect()-> route('products.index')->with('success', 'Products Added Successfully!');
    }
    // this method will show  products eidit page
    public function edit(){
        
    }
    // this method will show  products update page
    public function update(){
        
    }
     // this method will delete a  product
     public function delete(){
        
     }
}
