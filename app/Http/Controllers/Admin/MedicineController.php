<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Medicine;
use Faker\Provider\Medical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $medicines = Medicine::query()->get();
            return view('admin.modules.medicine.index', compact('medicines'));
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
        $categories = Category::query()->Active()->get(['category_id', 'name']);
        return view('admin.modules.medicine.createOrUpdate', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = Medicine::query()->Validation($request->all());
        if($validated){
            try{
                DB::beginTransaction();
                $medicine = Medicine::create([
                    'name' => $request->name,
                    'generic' => $request->generic,
                    'body' => $request->body,
                    'company' => $request->company,
                    'category_id' => $request->category_id
                ]);

                if (!empty($medicine)) {
                    DB::commit();
                    return redirect()->route('admin.medicine.index')->with('success','medicine Created successfully!');
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
        $show = Medicine::query()->FindId($id);
        return view('admin.modules.medicine.show', compact('show'));
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
            $edit = Medicine::query()->FindId($id);
            $categories = Category::query()->Active()->get(['category_id', 'name']);
            return view('admin.modules.medicine.createOrUpdate', compact('edit', 'categories'));
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
        $validated = Medicine::query()->Validation($request->all());
        if($validated){
            try{
                DB::beginTransaction();
                $medicine = Medicine::query()->FindId($id);
                $medicineU = $medicine->update([
                    'name' => $request->name,
                    'generic' => $request->generic,
                    'body' => $request->body,
                    'company' => $request->company,
                    'category_id' => $request->category_id
                ]);

                if (!empty($medicineU)) {
                    DB::commit();
                    return redirect()->route('admin.medicine.index')->with('success','medicine Created successfully!');
                }
                throw new \Exception('Invalid About Information');
            }catch(\Exception $ex){
                return back()->withError($ex->getMessage());
                DB::rollBack();
            }
        }
    }

    public function destroy($id)
    {
        try {
            Medicine::query()->FindId($id)->delete();
            return redirect()->route('admin.medicine.index')->with('success','Medicine Deleted Successfully!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function status($id)
    {
        try {
            $medicine = Medicine::query()->FindID($id); //self trait
            Medicine::query()->Status($medicine); // crud trait
            return redirect()->route('admin.medicine.index')->with('warning','Medicine Status Change successfully!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
