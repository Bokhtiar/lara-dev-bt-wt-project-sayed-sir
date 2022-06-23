<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $results = Banner::latest()->get(['banner_id','title', 'image', 'status']);
            return response()->json([
                "status" => true,
                "data" => $results,
            ]);
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
        return view('admin.modules.banner.createOrUpdate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = Banner::query()->Validation($request->all());
        if($validated){
            try{
                DB::beginTransaction();
                $image = Banner::query()->Image($request);
                $banner = Banner::create([
                    'title' => $request->title,
                    'body' => $request->body,
                    'image' => $image
                ]);

                if (!empty($banner)) {
                    DB::commit();
                    return redirect()->route('admin.banner.index')->with('success','banner Created successfully!');
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
            $show = Banner::query()->FindId($id);
            return view('admin.modules.banner.show', compact('show'));
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
            $edit = Banner::query()->FindId($id);
            return view('admin.modules.banner.createOrUpdate', compact('edit'));
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
        $validated = Banner::query()->Validation($request->all());
        if($validated){
            try{
                DB::beginTransaction();
                $banner = Banner::query()->FindId($id);
                $reqImage = $request->image;
                if($reqImage){
                    $image = Banner::query()->Image($request);
                }else{
                    $bannerImage = $banner->image;
                }
                $bannerU = $banner->update([
                    'title' => $request->title,
                    'body' => $request->body,
                    'image' => $reqImage ? $image : $bannerImage,
                ]);

                if (!empty($bannerU)) {
                    DB::commit();
                    return redirect()->route('admin.banner.index')->with('success','banner Created successfully!');
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
            Banner::query()->FindId($id)->delete();
            return redirect()->route('admin.banner.index')->with('success','Banner Deleted Successfully!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function status($id)
    {
        try {
            $banner = Banner::query()->FindID($id); //self trait
            Banner::query()->Status($banner); // crud trait
            return redirect()->route('admin.banner.index')->with('warning','Banner Status Change successfully!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
