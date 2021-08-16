<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // to do this mass assignment, i had to add a fillable to my model, i can also add a table name incase i have a different name in  my model
        // Product::create([
        //     'name'=> 'Product one',
        //     'slug'=> 'product-one',
        //     'description'=>'This is product one',
        //     'price'=> '99.9'
        // ]);
        $request->validate([
            'name'=> 'required',
            'slug'=> 'required',
            'description'=>'required',
            'price'=> 'required'
        ]);
        Product::create($request->all());
           
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
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
        $product = Product::find($id);
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Product::destroy($id);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        // $pro = Product::all()->where($name, '=', $pro->name)->get();
        
        // return $pro;

        return Product::where('name', 'like','%'. $name. '%')->get();
    }
}
