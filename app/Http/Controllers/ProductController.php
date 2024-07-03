<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
    public function edit($id){
        $product = Product::findOrFail($id);
        return view('products.edit',[
            'product' => $product
        ]);
    }
    // this method will show  products update page
    public function update($id, Request $request){
        $product = Product::findOrFail($id);

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
            return redirect()->route('products.edit',$product->id)->withInput()->withErrors($validator);
        }

        // heare we will update product in db

        
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if($request->image != ""){

            // Delete Old Image

            File::delete(public_path('uplods/products/'.$product->image));

            // heare we will store image

            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext; // unique image name

            // save image to products directory

            $image->move(public_path('uplods/products'),$imageName);

            $product->image = $imageName;
            $product->save();

        }
       
        return redirect()-> route('products.index')->with('success', 'Products Updated Successfully!');
    }
     // this method will delete a  product
     public function destroy($id){
        $product = Product::findOrFail($id);

        // Delete Image

        File::delete(public_path('uplods/products/'.$product->image));

        // product delete in db

        $product->delete();

        return redirect()-> route('products.index')->with('success', 'Products Delete Successfully!');
     }
}
