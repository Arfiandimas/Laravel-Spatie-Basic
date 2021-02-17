<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:product-list', ['only' => ['index']]);
         $this->middleware('permission:product-add', ['only' => ['store']]);
         $this->middleware('permission:product-detail', ['only' => ['show']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $response = Product::orderBy('id', 'desc')->get();
            return ngcApiReturn($response);
        } catch (\Exception $e) {
            return ngcApiCatch($e);
        }
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
            'name' => 'required|string|max:255',
            'purchase_price' => 'required|integer',
            'selling_price' => 'required|integer',
            'stock' => 'required|integer',
            'min_stock' => 'required|integer',
        ]);

        try {
            $product = new Product;
            $product->name = $request->name;
            $product->purchase_price = $request->purchase_price;
            $product->selling_price = $request->selling_price;
            $product->stock = $request->stock;
            $product->min_stock = $request->min_stock;
            $product->save();
            return ngcApiReturn($product);
        } catch (\Exception $e) {
            return ngcApiCatch($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $response = Product::where('id', $id)->first();
            return ngcApiReturn($response);
        } catch (\Exception $e) {
            return ngcApiCatch($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
