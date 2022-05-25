<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $products = Product::with('orders')->get();
        if($request->by_order == 'no_orders'){
            $products = Product::with('orders')->whereDoesntHave('orders')->get();
        }

        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products|max:100',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|gt:0',
        ]);

        Product::create($request->all());

        return redirect()->route('product.index')->with('success', 'Product Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view ('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'max:100',
                Rule::unique('products')->ignore($product->id)
            ],
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|gt:0',
        ]);

        $product->update($validatedData);

        return redirect()->route('product.index')->with('success', 'Product Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->orders()->count()===0){
            $product->delete();
            return redirect()->route('product.index')->with('success', 'Product Deleted');
        } else {
            return redirect()->route('product.index')->with('success', 'Delete failed, Product still have orders. ');
        }

    }
}
