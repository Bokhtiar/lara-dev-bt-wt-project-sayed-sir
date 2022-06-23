<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $categories = Category::latest()->get(['category_id','name', 'image', 'status']);
            return view('admin.modules.category.index', compact('categories'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.modules.category.createOrUpdate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = Category::query()->Validation($request->all());
        if($validated){
            try{
                DB::beginTransaction();
                $image = Category::query()->Image($request);
                $category = Category::create([
                    'name' => $request->name,
                    'image' => $image
                ]);

                if (!empty($category)) {
                    DB::commit();
                    return redirect()->route('admin.category.index')->with('success','category Created successfully!');
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
            $show = Category::query()->FindId($id);
            return view('admin.modules.category.show', compact('show'));
        } catch (\Throwable $th) {
            throw $th;
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
            $edit = Category::query()->FindId($id);
            return view('admin.modules.category.createOrUpdate', compact('edit'));
        } catch (\Throwable $th) {
            throw $th;
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
        $validated = Category::query()->Validation($request->all());
        if($validated){
            try{
                DB::beginTransaction();
                $category = Category::query()->FindId($id);
                $reqImage = $request->image;
                if($reqImage){
                    $image = Category::query()->Image($request);
                }else{
                    $categoryImage = $category->image;
                }
                $categoryU = $category->update([
                    'name' => $request->name,
                    'image' => $reqImage ? $image : $categoryImage,
                ]);

                if (!empty($categoryU)) {
                    DB::commit();
                    return redirect()->route('admin.category.index')->with('success','category Created successfully!');
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
            Category::query()->FindId($id)->delete();
            return redirect()->route('admin.category.index')->with('success','category Deleted Successfully!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function status($id)
    {
        try {
            $category = Category::query()->FindID($id); //self trait
            Category::query()->Status($category); // crud trait
            return redirect()->route('admin.category.index')->with('warning','category Status Change successfully!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
