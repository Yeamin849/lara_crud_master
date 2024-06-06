<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // this method will show products page
    public function index(){

    }
    // this method will show prosucts create page
    public function create(){
        return view('products.create');
    }
    // this method will store a products in db
    public function store(){
        
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
