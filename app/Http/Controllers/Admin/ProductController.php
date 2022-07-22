<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get(['product_id', 'name', 'sku', 'sell_price', 'status']);
        return view('admin.modules.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::query()->Active()->get(['category_id', 'name']);
        return view('admin.modules.product.createOrUpdate', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = Product::query()->Validation($request->all());
        if($validated){
            try{
                DB::beginTransaction();
                $images = Product::query()->Images($request);
                $product = Product::create([
                    'name' => $request->name,
                    'category' => $request->category_id,
                    'images' => json_encode($images),
                    'generic' => $request->generic,
                    'body' => $request->body,
                    'company' => $request->company,
                    'sell_price' => $request->sell_price,
                    'discount_percentage' => $request->discount_percentage,
                    'sku' => $request->sku
                ]);
                if (!empty($product)) {
                    DB::commit();
                    return redirect()->route('admin.product.index')->with('success','product Created successfully!');
                }
                throw new \Exception('Invalid About Information');
            }catch(\Exception $ex){
                return back()->withError($ex->getMessage());
                DB::rollBack();
            }
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
            $show = Product::find($id);
            return view('admin.modules.product.show', compact('show'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $edit = Product::find($id);
            $categories = Category::query()->Active()->get(['category_id', 'name']);
        return view('admin.modules.product.createOrUpdate', compact('categories', 'edit'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
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
        $validated = Product::query()->Validation($request->all());
        if($validated){
            try{
                DB::beginTransaction();
                $product = Product::find($id);
                $reqImage = $request->image;
                
                if($reqImage){
                    $newimage = Product::query()->Image($request);
                }else{
                    $images = $product->images;
                }

                $productU = $product->update([
                    'name' => $request->name,
                    'category_id' => $request->category_id,
                    'images' => $reqImage ? json_encode($newimage) : $images,
                    'generic' => $request->generic,
                    'body' => $request->body,
                    'company' => $request->company,
                    'sell_price' => $request->sell_price,
                    'discount_percentage' => $request->discount_percentage,
                    'sku' => $request->sku
                ]);
                if (!empty($productU)) {
                    DB::commit();
                    return redirect()->route('admin.product.index')->with('success','product Created successfully!');
                }
                throw new \Exception('Invalid About Information');
            }catch(\Exception $ex){
                return back()->withError($ex->getMessage());
                DB::rollBack();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Product::query()->FindId($id)->delete();
            return redirect()->route('admin.product.index')->with('success','Product Deleted Successfully!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function status($id)
    {
        try {
            $product = Product::query()->FindID($id); //self trait
            Product::query()->Status($product); // crud trait
            return redirect()->route('admin.product.index')->with('warning','Product Status Change successfully!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
